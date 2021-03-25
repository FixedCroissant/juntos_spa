
<template>
<v-container>
    <!--Start Validation-->
    <v-row>
        <v-col cols="12" md="5" offset-md="1">
                <!-- <h4 v-if="errors">Errors Creating Record</h4> -->
                <ul id="messages" style="color:red;">
                     <li v-for="myerrors in errors">
                        <div v-for="myitem in myerrors">
                                    {{myitem}}
                        </div>
                    </li>
                </ul>
                
        </v-col>
    </v-row>
    <!--End Validation-->
      <!--Start Success Message-->
    <v-row>
        <v-col cols="12" md="7" offset-md="2">
                        <v-alert v-if="this.alert"  type="success">
                         Saved Record
                    </v-alert>
        </v-col>
    </v-row>
    <!--EndSuccessMessage-->
       <v-row>
          <v-col cols="12" md="5" offset-md="1">
            <h4>Student Contact Information</h4>
            <br>
                 <StudentContactComponent v-bind:myStudentSelection="student" />
                
                <v-btn
                        elevation="2"
                        x-small
                        v-on:click="createStudentInformation"
                        style="margin-top:10px;"
                >
                Create Student
                </v-btn>  
            </v-col>
            <v-col cols="12" md="5">
                    <h4>Parent Information Here </h4>
                    <p>
                        Add student information first, please. You will have the opportunity to add a new parent afterwards.
                    </p>
            </v-col>
        </v-row>
    </v-container>
</template>
 
<script>

        //Local component registration...
        //import NoteTabComponent from '../../components/NoteTabComponent.vue';  
        import StudentContactComponent from '../../components/StudentContactComponent.vue';  
        
       export default {
        components:{
           // NoteTabComponent,
            StudentContactComponent,
            
                
        },
        data() {
            return {
                student:[],
                // array to hold form errors
                errors: [],
                alert:false  
            }
        },
        methods:{
                async createStudentInformation(){
        try {
                    let res = 
                            await axios ({
                                        url: `${process.env.MIX_API_URL}/public/index.php/api/students`,
                                        method: 'POST',
                                        data: {
                                                            student_id: this.$data.student.student_id,
                                                            student_first_name:this.$data.student.student_first_name,
                                                            student_last_name:this.$data.student.student_last_name,
                                                            address_line_1:this.$data.student.address_line_1,
                                                            city:this.$data.student.city,
                                                            state:this.$data.student.state,
                                                            zip:this.$data.student.zip,
                                            
                                        },
                                        headers:
                                        {
                                            Authorization: `Bearer ${this.$store.getters.token}`,
                                        }
                                        }).then(
                                        //Get Result.
                                        response=>{
                                                //console.log(response.data.error)
                                                //Above comes undefined when successful.
                                                 // form submission failed, pass form  errors to errors array
                                                this.errors= response.data.error;
                                                    //console.log(response.status);
                                                //If response is okay, send a notification at the top.
                                                //call from the state action.
                                                if(response.status=200 && response.data.error===undefined){
                                                    //alert('Validation passed!');
                                                             //To use, do this:
                                                            //this.$store.dispatch('setSuccess');
                                                            //temporary as we work with the store function.
                                                            //this.alert=true;

                                                            this.$store.dispatch('setSuccessAlert','Your New Student has been Created! ... Redirecting in 5 seconds ...')
                                                            
                                                            //Remove messages after 4 seconds.
                                                            setTimeout(() => {
                                                                                  this.$store.dispatch('removeSuccessAlert')
                                                            }, 4000)

                                                            //Reroute page to the student edit page after 5 seconds.
                                                            setTimeout(() => {
                                                                                   this.$router.push({name: "showstudent",params:{id: response.data.student.id}});
                                                                    }, 5000)
                                                        }    
                                            
                                        }

                                )
                        }
                                        catch(err){
                                                                alert(err);
                                        }
                },  
        }
    }
</script>