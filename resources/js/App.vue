<template>
  <v-app id="inspire">
    <v-navigation-drawer
      app
      v-if="this.$store.state.isAuthenticated"
      v-model="drawer"
    >
        <!--Left side menu bar-->
            <v-list
                    nav
                    dense
                    >
          <v-list-item-group
            v-model="group"
            active-class="deep-red--text text--accent-4"
          >
            <!--Will need to do better than this... but using VUEX-->
            <v-list-item v-if="this.$store.state.isAuthenticated"> 
                <v-list-item-icon>
                  <v-icon>mdi-view-dashboard</v-icon> 
                </v-list-item-icon>

                <v-list-item-content>
                  <router-link to="/dashboard"  style="text-decoration: none; color: inherit;" ><v-list-item-title>Dashboard</v-list-item-title></router-link>
                </v-list-item-content>
            </v-list-item>
           
      
            <!--SUBITEM FOR OUR STUDENTS-->
          <v-list-group
            :value="false"
            no-action
            sub-group
          >
          <template v-slot:activator>
            <v-list-item-content>
              <v-list-item-title>Students</v-list-item-title>
            </v-list-item-content>
          </template>

          <v-list-item
           class="#"
            v-for="([title, icon,link], i) in studentList"
            :key="i"
            link
          >
          <!--Sub items-->
          <v-list-item-title ><router-link :to=link style="text-decoration: none; color: inherit;" >{{title}}</router-link></v-list-item-title>
            <v-list-item-icon>
              <v-icon v-text="icon"></v-icon>
            </v-list-item-icon>
          </v-list-item>
        </v-list-group>

        <!--SUBITEM FOR OUR PARENTS-->
          <v-list-group
            :value="false"
            no-action
            sub-group
          >
          <template v-slot:activator>
            <v-list-item-content>
              <v-list-item-title>Parent/Guardians</v-list-item-title>
            </v-list-item-content>
          </template>

          <v-list-item class="#"
            v-for="([title, icon,link], i) in parentList"
            :key="i"
            link
          >
          <!--Sub items-->
           <v-list-item-icon>
              <v-icon v-text="icon"></v-icon>
            </v-list-item-icon>
          <v-list-item-title ><router-link :to=link style="text-decoration: none; color: inherit;" >{{title}}</router-link></v-list-item-title>
          </v-list-item>
        </v-list-group>
          <!--END SUBITEM-->
          <!--BEGIN SUB ITEMS FOR EVENTS-->
           <v-list-group
            :value="false"
            no-action
            sub-group
          >
          <template v-slot:activator>
            <v-list-item-content>
              <v-list-item-title>Events</v-list-item-title>
            </v-list-item-content>
          </template>

          <v-list-item
            v-for="([title, icon,link], i) in eventList"
            :key="i"
            link
          >
          <!--Sub items-->
           <v-list-item-icon>
              <v-icon v-text="icon"></v-icon>
            </v-list-item-icon>
          <v-list-item-title ><router-link :to=link style="text-decoration: none; color: inherit;" >{{title}}</router-link></v-list-item-title>
          </v-list-item>
        </v-list-group>
          <!--END SUB ITEMS FOR EVENTS-->

      <!--BEGIN SUB ITEMS FOR COACHING-->
           <v-list-group
            :value="false"
            no-action
            sub-group
          >
          <template v-slot:activator>
            <v-list-item-content>
              <v-list-item-title>Coaching</v-list-item-title>
            </v-list-item-content>
          </template>

          <v-list-item
            v-for="([title, icon,link], i) in coachList"
            :key="i"
            link
          >
          <!--Sub items-->
          <v-list-item-title ><router-link :to=link style="padding-left:-150px; text-decoration: none; color: inherit;" >{{title}}</router-link></v-list-item-title>
          </v-list-item>
        </v-list-group>
        <!--END SUB ITEMS FOR COACHING-->


            <!--REPORTING-->
            <!--Coming Soon!-->
            <v-list-item class="red" v-if="this.$store.state.isAuthenticated"> 
              <v-list-item-icon>
                  <v-icon>mdi-chart-bar</v-icon>
                </v-list-item-icon>
              <v-list-item-title>
                        <router-link to="/reporting"  style="text-decoration: none; color: inherit;" >Reporting</router-link>
              </v-list-item-title>
            </v-list-item>
            

            <!--Break off of temp items and real items-->
             <v-divider></v-divider>

          <!--TEMPORARY LOGOUT BUTTON-->
            <v-list-item v-if="this.$store.state.isAuthenticated"> 
                  <v-btn block v-on:click="logout" style="text-decoration: none; color: inherit;">LOGOUT</v-btn>
            </v-list-item>
          </v-list-item-group>
        </v-list>

        <!--Show who is signed in-->
        <v-list-item v-if="this.$store.state.isAuthenticated"> 
              <v-list-item-title>
                User Currently Signed In is 
                <br/> 
                <br/>
                {{this.$store.getters.userid.name}}
              </v-list-item-title>
        </v-list-item>
        <!--End show who is currently signed in-->  

        <!--BOTTOM ITEM-->
        <template v-slot:append>
              <div class="pa-2">
                <v-btn block v-on:click="showAdmin" >ADMIN</v-btn>
              </div>
        </template>

        <!--END BOTTOM ITEM-->
    </v-navigation-drawer>

    <v-app-bar app
      >
      <!--MAIN ICON TO SHOW SIDEBAR-->
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

      <v-toolbar-title>Juntos Database</v-toolbar-title>
    </v-app-bar>

    <!--Neccessary for VueRouter-->
    <v-main>
            <!--Main Content Here for the application.--> 
              <!--ADD CONSISTENT NOTIFICATION-->
              <!--Start Success Message-->
                      <v-row>
                          <v-col cols="12" md="7" offset-md="2">
                                      <v-alert v-if="this.$store.getters.success"  type="success">
                                           {{this.$store.getters.success}}
                                      </v-alert>
                                      <v-alert v-if="this.$store.getters.error"  type="error">
                                            {{this.$store.getters.error}}
                                      </v-alert>
                          </v-col>
                      </v-row>
              <!--EndSuccessMessage-->
              <router-view></router-view>
  </v-main>

  
    <!-- FOOTER AREA HERE -->
     <v-footer padless>
              <v-col
                class="text-center"
                cols="12"
              >
               <strong>&nbsp;</strong> {{ new Date().getFullYear() }}
            </v-col>
      </v-footer>


  </v-app>
</template>

 
<script>
     export default {
    components:{
        
    },
    data: () => ({ 
    drawer: null, 
    group: null,
    studentList:[
        ['List Students', '','/students'],
        ['New Student', 'mdi-cog-outline','/student/create']
    ],
    parentList:[
       ['List Parents/Guardian','mdi-account-circle','/parents'],
      //  Does not appear to be needed in the left hand menu right now.
      //  ['New Parent','','/parents/create']
    ],
    eventList:[
       ['List Events','mdi-account-circle','/events'],
       ['New Event','','/events/create']
    ],
    //Coaches
    coachList:[
       ['List Coaching Appointments','','/coachAppointment/index'],
       ['New Appointment','','/coachAppointment/create']
    ],
    //Schedules TBD
    
    }),

    methods:{      
      async logout(){
        try {
          let res = 
          await axios ({
            url: `${process.env.MIX_API_URL}/public/index.php/api/logout`,
                    method: 'POST',
                    data: {
                        user_id: this.$store.getters.userid,
                        
                    }
          }).then(
              //Get Result.
            result=>{
                //Remove things from the store.
                this.$store.commit('isLoggedOut');
              }

          )
        }
        catch(err){
          alert(err);
        }
      },
      showAdmin(){
        //Go to the admin page.
        this.$router.push({path: '/admin/index'});        
      }
    },
  }
</script>