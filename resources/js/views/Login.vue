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
          md="6"
          sm="6"
          xs="6"
          offset-md="3"
          offset-sm="2"
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
        md="6"
        sm="6"
        xs="6"
        offset-md="3"
        offset-sm="2"
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
        </v-col>
      </v-row>

      <v-row>
        <!--<v-col cols="12" lg="6" md="6" sm="6" xs="6" offset-md="4" offset-sm="3" offset-xs="5" >
          <v-btn style="margin-left:15px" v-on:click="loginGoogle" type="button">Login with Google</v-btn>
        </v-col>-->
      </v-row>
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
      errors:[],
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

            //Allow popup to happen for Google.
             window.addEventListener('message', this.onMessage, false);            
    },
    beforeDestroy () {
              window.removeEventListener('message', this.onMessage);
    },
    methods:{  
    //The popup is launched.
    openWindow (url, title, options = {}) 
    {
      if (typeof url === 'object') {
                options = url
                url = ''
      }

      //Minimum options.
      options = { url, title, width: 600, height: 720, ...options }

      //Set screen
      const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : window.screen.left
      const dualScreenTop = window.screenTop !== undefined ? window.screenTop : window.screen.top
      const width = window.innerWidth || document.documentElement.clientWidth || window.screen.width
      const height = window.innerHeight || document.documentElement.clientHeight || window.screen.height

      options.left = ((width / 2) - (options.width / 2)) + dualScreenLeft
      options.top = ((height / 2) - (options.height / 2)) + dualScreenTop

      const optionsStr = Object.keys(options).reduce((acc, key) => 
      {
                  acc.push(`${key}=${options[key]}`)
                  return acc
      }, []).join(',')

       //Create Window with constraints.
      const newWindow = window.open(url, title, optionsStr)

      if (window.focus) {
        newWindow.focus()
      }

      return newWindow
    },
  
  //VUEX
  loginAttempt(){
      //Change the boolean value of isLoggedin.
      this.$store.commit('login');
     
  },
  //CASTL TEMP
  //Check role.
  updateAbility(roles) {
      const { can, cannot, rules } = new AbilityBuilder();

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


  // This method call the function to launch the popup and makes the request to the controller. 
  loginGoogle () {
            const newWindow = this.openWindow('', 'message');
            
            this.axios.get(`${process.env.MIX_API_URL}/public/index.php/api/googleRedirect`,                               
                {
                  headers:
                  {
                  }
                }).then(result => 
                {
                      newWindow.location.href = result.data.url;
                    })
                    .catch(function (error) {
                      console.error(error);
                    });
              },
              // This method save the new token and username
              onMessage (e) {
                if (e.origin !== window.origin || !e.data.token) {
                    return
                 }

                //Check if we have a token in the system.
                if(e.data.token!=undefined){

                      //Parse Information
                      let userParsed = JSON.parse(e.data.user.replace(/&quot;/g,'"'));
                      let rolesParsed = JSON.parse(e.data.roles.replace(/&quot;/g,'"'));
                  
                      //Allow user to progress through application. 
                      this.$store.commit('saveUser',userParsed);
                      this.$store.commit('saveRole',rolesParsed);
                      this.updateAbility(rolesParsed);
                      this.$store.dispatch('setAuthenticated');  
                  }

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

            response=>{
                 //Set any errors.
               this.errors= response.data.error;
              if(response.status=200 && response.data.error===undefined && response.data.access_token){
                                        
                     //Allow progress throught the application
                    this.$store.commit('saveToken',response.data.access_token)
                    this.$store.commit('saveUser',response.data.user);
                    this.$store.commit('saveRole',response.data.roles);
                    
                    //Causes issues on first page load.
                    //this.updateAbility(response.data.roles);
                    
                    
                    this.$store.dispatch('setAuthenticated');
                    }
                                else if(response.data.message){
                                              this.$store.dispatch('setErrorAlert',response.data.message)
                                                setTimeout(() => {
                                                        this.$store.dispatch('removeErrorAlert')
                                                }, 5000);
                                }
                                else
                                {
                                                this.$store.dispatch('setErrorAlert','You are missing required fields (email & password), please retry again.')
                                                setTimeout(() => {
                                                        this.$store.dispatch('removeErrorAlert')
                                                }, 5000);
                                }
                            })}
              catch(err){
                //write to log.
                console.log('error processing');
                console.log(err);
                alert(err);
              }
      }
    }
  }
</script>	
	