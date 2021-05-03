
<template>
<v-container>
       <v-row>
          <v-col cols="12" md="5" offset-md="1">
            <h4>Student Contact Information</h4>
            <br>
                 <v-form v-model="isFormValid">   
                    <StudentContactComponent  v-bind:rulesFromParent="myRules" v-bind:myStudentSelection="student" />
                 </v-form>  
                <v-btn
                        elevation="2"
                        x-small
                        v-on:click="updateStudentInformation"
                >
                <br/><br/>
                Update Student Information
                </v-btn>  
            </v-col>
            <v-col cols="12" md="5">
                    <h4>Parent Guardian Information </h4>
                    <br>
                    <!--Handle Long Parent Lists-->
                    <template>
                        <div style="border: 1px solid grey; height:250px; overflow:auto; padding:30px;">
                            <div v-for="theparents in student.parent">
                                    <ParentContactComponent v-bind:myParentSelection="theparents" style="height:250px;"/>
                            </div>
                        </div>
                    </template>
                    <!--End Handle long parent lists-->
                     <!--NO PARENTS ADD ONE-->
                    <template>
                       <CreateNewParentModal 
                        v-bind:mystudent="student"
                        v-on:event_parent_creation="eventParentCreation"
                        style="margin-top:15px;"
                        />
                    </template>
                    <br/>
            </v-col>
        </v-row>
     <!--Grade Information here?-->
     <v-row>
         <v-col cols="12" md="10" offset-md="1">
                <h4>Student Grades:</h4>

                <ul>
                    <li>
                        7th Grade
                    </li>
                    <li>
                        8th Grade
                    </li>
                    <li>
                        9th Grade
                    </li>
                    <li>
                        ...
                    </li>
                </ul>
         </v-col>
     </v-row>

     <v-row style="padding-top:80px;">
          <v-col cols="12" md="10" offset-md="1">                  
                     <NoteTabComponent  v-bind:myStudentSelection="student" />
            </v-col>
     </v-row>


    </v-container>
</template>
 
<script>

        //Local component registration...
        import NoteTabComponent from '../../components/NoteTabComponent.vue';  
        import StudentContactComponent from '../../components/StudentContactComponent.vue';  
        import ParentContactComponent from '../../components/ParentContactComponent.vue';
        import CreateNewParentModal from '../../components/CreateNewParentModal.vue';  

       export default {
        components:{
            NoteTabComponent,
            StudentContactComponent,
            ParentContactComponent,
            CreateNewParentModal
                
        },
        data() {
            return {
                isFormValid:false,
                student:[],
                createParent:false,
                newParent:true,
                alert:false,
                myRules:[
                        v => !!v || 'StudentID is required',
                       v => v.length <= 10 || 'StudentID must be less than 10 characters',
                ],
                /*myRules:[
                    {
                     maximum:   v => v.length <= 10 || 'StudentID must be less than 10 characters',         
                     required:  v => !!v || 'StudentID is required',
                     }
                ]*/ 
            }
        },
        methods:{
                //Get information back from our child component
                eventParentCreation: function(id) {
		                this.student.parent.push( id );
		        },
                createParentInformationModal(){
                    this.createParent=true;
                },
                async updateStudentInformation(){
                    try {
                    let res = 
                            await axios ({
                                        url: `${process.env.MIX_API_URL}/public/index.php/api/students/`+ this.$route.params.id,
                                        method: 'PATCH',
                                        data: {
                                                            student_first_name:this.$data.student.student_first_name,
                                                            student_last_name:this.$data.student.student_last_name,
                                                            address_line_1:this.$data.student.address_line_1,
                                                            city:this.$data.student.city,
                                                            state:this.$data.student.state,
                                                            zip:this.$data.student.zip,
                                                            student_id:this.$data.student.student_id,
                                            
                                        },
                                        headers:
                                        {
                                            Authorization: `Bearer ${this.$store.getters.token}`,
                                        }
                                        }).then(
                                        //Get Result.
                                        response=>{
                                                    if(response.status==200){
                                                                      this.$store.dispatch('setSuccessAlert','Student Record has been updated.')
                                                                       setTimeout(() => {
                                                                                    this.$store.dispatch('removeSuccessAlert')
                                                                        }, 5000)
                                                    }
                                        }

                                )
                        }
                    catch(err){
                                alert(err);
                    }
                },  
        },
         created() {
                                this.axios
                                .get(`${process.env.MIX_API_URL}/public/index.php/api/students/` + this.$route.params.id,
                                {
                                headers:
                                {
                                    Authorization: `Bearer ${this.$store.getters.token}`,
                                }
                                })
                                .then(response => {
                                    this.student = response.data.student;      
                                    
                                    

                                });
                        },
    }
</script>