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
    <v-container style="margin-top:25px;">     
        <v-row>
        <v-col
        cols="12"
        offset-md="3"
        >
        <p>In order to register for an account, please provide:

            <ul>
                    <li>name</li>
                    <li>email</li>
                    <li>password</li>
            </ul>
        </p>
        </v-col>
</v-row>
       
       <v-row>
          <v-col
          cols="8"
          md="3"
          offset-md="3"
        >
          <v-text-field
            v-model="firstName"
            :rules="nameRules"
            label="First Name"
            required
          ></v-text-field>
        </v-col>

        <v-col
          cols="8"
          md="3"
          offset-md="0"
        >
          <v-text-field
            v-model="lastName"
            :rules="nameRules"
            label="Last Name"
            required
          ></v-text-field>
        </v-col>
      </v-row>
      
      <v-row>
          <v-col
          cols="8s"
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
          :rules=[rules.required,rules.minimum]
          hint= "At least 8 characters"
          required
        ></v-text-field>
        

        <v-text-field
          label="Password confirmation"
          type="password"
          v-model="passwordMatch"
          :rules=[rules.required,rules.minimum,passwordConfirmationRule]
          required
        ></v-text-field>
          <v-btn elevation="2" style="margin-left:100px"  large v-on:click="register">Create Account</v-btn>
          <v-btn elevation="2" style="margin-left:100px"  large v-on:click="reset">Reset</v-btn>
        </v-col>
      </v-row>
    </v-container>    
  </v-form>
</template>


<script>
  export default {
     data: () => ({
      valid: false,
      firstName:'',
      lastName:'',
      email: '',
      password:'',
      passwordMatch:'',
      results:null,
      message:null,
      rules:{
          minimum: v => v.length >=8 || 'Min 8 characters',
          required:v => !!v || 'Required'
      },
      nameRules:[
          v => !!v || 'Required'
          ],
      emailRules: [
        v => !!v || 'E-mail is required.',
        v => /.+@.+/.test(v) || 'E-mail must be valid',
      ],
      nameRules:[
          v=>!!v || 'Name is required.'
      ],
      passwordRules:[
        v=>!!v || 'Password is required.'
      ],
      passwordMatchRules:[
        v=>!!v || 'Password is required.'
      ]
    }),
    mounted() {
            console.log('Register Component mounted!!')
    },
    computed:{
        passwordConfirmationRule(){
            return (this.password === this.passwordMatch) || 'Passwords must match.'
        }
    },
    methods:{
 
  loginAttempt(){
      //Change the boolean value of isLoggedin.
      //this.$store.commit('login');
     
  },
  
  reset(){
    this.name=''  
     this.email='' 
     this.password=''
     this.passwordMatch=''
  },
  
      async register(){
        try {
          let res = await axios ({
            url: `${process.env.MIX_API_URL}/public/index.php/api/register`,
                    method: 'POST',
                    data: {
                        firstName: this.firstName,
                        lastName: this.lastName,
                        email: this.email,
                        password: this.password,                        
                    }
          }).then(
                        result=>{
                            
                            //For testing only.
                            //console.log(result.data);

                        
                        
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