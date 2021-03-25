<template>

  <v-form v-model="valid">
    <v-row>
<v-col
cols="12"
offset-md="3"
>
{{this.$store.getters.message}}
</v-col>
</v-row>
    <v-container style="border:1px solid #427E93; border-radius: 25px; margin-top:90px;">
      <!--End check any feedback after logging in-->
      <v-row>
          <v-col
          cols="8"
          md="5"
          offset-md="3"
        >
          <v-text-field
            v-model="email"
            :rules="emailRules"
            label="E-mail Address"
            required
          ></v-text-field>
        </v-col>
      </v-row>
      <v-row>
        <v-col
        cols="8"
        md="5"
        offset-md="3"
        >
        <v-text-field
          label="Password"
          type="password"
          v-model="password"
          :rules="passwordRules"
          required
        >
        </v-text-field>

          <v-btn elevation="2" style="margin-left:100px"  large v-on:click="login">Login</v-btn>

          <v-btn router-link to="/register" elevation="2" color="primary" style="margin-left:40px;" large>Register For Account</v-btn>

          <br/>
          <br/>

        <!----STANDARD BUTTONS-->
        <!--COMMENT OUT-->
          <!-- <button type="button" v-on:click="increment">Increment</button>
          <br/>
          <br/>
          <button type="button" v-on:click="decrement">Decrement</button> -->

          <!--TRY LOGGING IN-->
          <!-- <button type="button" v-on:click="loginAttempt">ChangeLoginValue</button>
           -->
        </v-col>
      </v-row>

      <!--DEBUG INFORMATION HERE-->
      <!-- This is the count:
      {{ this.$store.state.count }}

      Is the individual currently logged into the application:?
      {{this.$store.state.isLoggedIn}} -->
      
    </v-container>    
  </v-form>

 
</template>

<script>
 
  //CASTL We ARE USING VERSION 5; but does not seem to work with VUE 2.X, which is 
  //what we are using in this application.
  import { AbilityBuilder } from '@casl/ability';

  export default {
    data: () => ({
      valid: false,
      email: '',
      password:'',
      results:null,
      accesstoken:null,
      message:null,
      //isAuthenticated:false,
      emailRules: [
        v => !!v || 'E-mail is required.',
        v => /.+@.+/.test(v) || 'E-mail must be valid',
      ],
      passwordRules:[
        v=>!!v || 'Password is required.'
      ]
    }),
    mounted() {
            console.log('Login Component mounted!!')
            console.log(process.env.MIX_API_URL)
            
    },
    
    
    
    methods:{  
    //VUEX
  loginAttempt(){
      //Change the boolean value of isLoggedin.
      this.$store.commit('login');
     
  },
  //CASTL TEMP
  //Check role.
  updateAbility(roles) {
      const { can, cannot, rules } = new AbilityBuilder();

      //Get role information.
      console.log(roles);

     //Check if proper role exists.
     if(roles.map(myROLETOCHECK=>myROLETOCHECK.name).includes('Admin'))
        {
          can('read','Admin');

        
          can('read','CoachAppointment');
          can('create','CoachAppointment');
          can('destroy','CoachAppointment');
        }else{
           console.log("This person cannot read the admin page.");
            cannot('read','Admin');
        }

      this.$ability.update(rules);
    },
  //CASTL END TEMP


  

  increment() {
    //Standard mutation that doesn't have a payload parameter.
    //this.$store.commit('increment')

    //Increment with a payload.
    this.$store.commit('increment', 10)
    //console.log(this.$store.state.count)
  },
  decrement(){
    this.$store.commit('decrement')
  },  
  //END VUEX
      async login(){
        try {
          let res = await axios ({
            url: `${process.env.MIX_API_URL}/public/index.php/api/login`,
                    method: 'POST',
                    data: {
                        email: this.email,
                        password: this.password,
                        grant_type: 'password'
                    }
          }).then(           

            /*COMMENT OUT WHILE TRYING OUT VUEX.*/
            result=>{

               
                //Get response.
                //console.log(result);
               
               //Store results the variable.
               //.then(response => (this.info = response))

              //Error Message.
              // this.results = result.data.message;
              //this.results = result.data;

              //this.accesstoken = result.data.access_token;
              

         
             //Provide a message
              if(result.data.message){
                //this.message = 'You have provided invalid credentials. Please try again.'; 
                this.$store.commit('saveMessage',"You have provided invalid credentials. Please try again.")             
                
                
              }else if(result.data.access_token)
              {
                //Set token.
                //axios.defaults.headers.common["Authorization"] = "Bearer " + result.data.access_token;
                //window.axios.defaults.headers.common['Authorization']= "Bearer " + result.data.access_token;
                //axios.defaults.headers.common["Accept"] = "application/json";

                //Save token in cookie on page refresh.
                //Save cookie in VUEX
                this.$store.commit('saveToken',result.data.access_token)

                 
                 //Save id
                //this.$store.commit('saveUser',result.data.user.id)
                
                //Save all information about the user.
                this.$store.commit('saveUser',result.data.user);

                //console.log("This is what is being returned currently: " + result.data.roles);
                //console.log(result.data.roles);

                //Save information about the role of the logged in person.
                this.$store.commit('saveRole',result.data.roles);

                //Update my abilities with our ROLES in the system.
                this.updateAbility(result.data.roles);
                //End set token.

                //Go ahead and set it as iSAuthenticated
                //change to action.
                this.$store.dispatch('setAuthenticated');             

           }
        }

         
          
          )
        }
        catch(err){
          alert(err);
        }
      }
    }
  }
</script>