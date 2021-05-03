<template>
  <v-card>
    <v-toolbar
      color="grey lighten-1"
      light
     >
      <template v-slot:extension>
          <!--Selected-->
        <v-tabs
          v-model="tab"
          align-with-title
          color="black"
        >
          <v-tabs-slider color="red"></v-tabs-slider>

          <v-tab
            v-for="item in items"
           :to="item.href"
           :key="item.name"
          >
            {{ item.name }}
          </v-tab>
        </v-tabs>
      </template>
    </v-toolbar>
<v-tabs-items v-model="tab">
                <div class="tab-content">
                      <div :class="['tab-pane', { 'active': $route.hash === '#users' }]">
                            <p v-if="$route.hash=='#users'" >
                                 <AdminUserTableComponent users="users"/>
                            </p>
                      </div>
                      <div :class="['tab-pane', { 'active': $route.hash === '#roles' }]">
                          <p v-if="$route.hash=='#roles'" >
                                  <AdminRoleIndex />
                          </p>
                      </div>
                      <div :class="['tab-pane', { 'active': $route.hash === '#states' }]">
                          <p v-if="$route.hash=='#states'" >
                                   <v-btn style="margin:10px" elevation="2" small :to="{name: 'createState'}">Create State</v-btn>
                                   <AdminStateIndex />
                          </p>
                      </div>
                      <div :class="['tab-pane', { 'active': $route.hash === '#counties' }]">
                          <p v-if="$route.hash=='#counties'" >
                                  <v-btn  style="margin:10px" elevation="2" small :to="{name: 'createCounty'}">Create County</v-btn>
                                  <AdminCountyIndex />
                          </p>
                      </div>
                      <div :class="['tab-pane', { 'active': $route.hash === '#sites' }]">
                          <p v-if="$route.hash=='#sites'" >
                                   <v-btn  style="margin:10px" elevation="2" small :to="{name: 'createSite'}" > Create Site</v-btn>
                                   <AdminSiteIndex />
                          </p>
                      </div>
                      <div :class="['tab-pane', { 'active': $route.hash === '#coordassign' }]">
                          <p v-if="$route.hash=='#coordassign'" >
                                   <AdminCoordinatorTableComponent users="users"/>
                          </p>
                      </div>
              </div>
    </v-tabs-items>
  </v-card>
</template>

<script>
  import AdminUserTableComponent from './AdminUserTableComponent.vue';
  import AdminCoordinatorTableComponent from './AdminCoordinatorTableComponent.vue';
  import AdminRoleIndex from '../views/auth/roles/AdminRoleIndex.vue';
  import AdminStateIndex from '../views/auth/states/AdminStateIndex.vue';
  import AdminCountyIndex from '../views/auth/counties/AdminCountyIndex.vue';
  import AdminSiteIndex from '../views/auth/sites/AdminSiteIndex.vue';


    export default {
        mounted() {
            console.log('Auth Tab NoteTab Component mounted.')
        },
        components:{
            AdminUserTableComponent,
            AdminCoordinatorTableComponent,
            AdminRoleIndex,
            AdminStateIndex,
            AdminCountyIndex,
            AdminSiteIndex
        },
      props: [],

      //href="/" router
      data () {
      return {
        tab: null,
        /*items: [
          'Users','Roles', 'States','Counties','Sites'
        ],*/
        items:[
              {
                  name:'Users',
                  href:'#users'
              },
              {
                  name:'Roles',
                  href:'#roles'
              },
              {
                 name:'States',
                 href:'#states'
              },
              {
                 name:'Counties',
                 href:'#counties'
              },
              {
                 name:'Sites',
                 href:'#sites'
              },
              {
                name:'Coordinator Assignment',
                href: '#coordassign'
              }
          ],    
      }
    },
    }
</script>
