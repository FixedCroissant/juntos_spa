<template>
    <div>
               <v-form v-model="valid">
                
                <v-layout row >
                        <v-flex xs12 md12>
                                Please create a new coaching event on this page, please provide name of the attendee, date of appointment , method of contact at a minimum.
                                <br/>
                                You do not need to fill out the outcomes section if you don't have that information at hand. <br/>

                        </v-flex>
                </v-layout>

                <!--COACH NAME --- WILL BE BASED ON WHO IS SIGNED IN-->
                 <v-layout row wrap style="padding-top:25px;">
                        <v-flex xs3>
                                 Appointment for Coach:
                        </v-flex>
                        <v-flex xs4>
                                {{this.$store.getters.userid.name}}
                        </v-flex>
                </v-layout>

                <v-layout row wrap>
                        <v-flex xs8>
                                 <v-select
                                  v-model="appointmentStudent"
                                  :items="students"
                                  item-text="student_full_name"
                                  item-value="id"
                                  label="Select Student:"
                                  return-object
                                  single-line
                                  required 
                                ></v-select>
                        </v-flex>
                        <v-flex xs2></v-flex> <!--Whitespace-->
                </v-layout>
                <!---INDIVIDUAL NOTES-->
                <v-layout row wrap>
                        <v-flex xs6>
                        <h4>Individual Student Meeting Notes</h4>
                        <br/>
                        </v-flex>
                        <v-flex xs2></v-flex> <!--Whitespace-->
                </v-layout>
                <!--Appointment Date-->
                <v-layout row wrap>
                        <v-flex xs2>
                            Apppointment Date:
                        </v-flex>
                          <v-flex xs3></v-flex> <!--Whitespace-->
                         <v-flex xs3>
                                <v-menu
                                                ref="menu1"
                                                v-model="menu1"
                                                :close-on-content-click="false"
                                                :return-value.sync="initialAppointmentDate"
                                                transition="scale-transition"
                                                offset-y
                                                min-width="auto"
                                        >
                                                <template v-slot:activator="{ on, attrs }">
                                                <v-text-field
                                                v-model="initialAppointmentDate"
                                                prepend-icon="mdi-calendar"
                                                readonly
                                                v-bind="attrs"
                                                v-on="on"
                                                ></v-text-field>
                                                </template>
                                                <v-date-picker
                                                v-model="initialAppointmentDate"
                                                no-title
                                                scrollable
                                                >
                                                <v-spacer></v-spacer>
                                                <v-btn
                                                text
                                                color="primary"
                                                @click="menu1 = false"
                                                >
                                                Cancel
                                                </v-btn>
                                                <v-btn
                                                text
                                                color="primary"
                                                @click="$refs.menu1.save(initialAppointmentDate)"
                                                >
                                                OK
                                                </v-btn>
                                                </v-date-picker>
                                        </v-menu>
                        </v-flex>
                </v-layout><!--End Appointment Date-->
                <v-layout row wrap>
                        <v-flex xs8>
                                <v-select
                                :items="types"
                                v-model="methodOfContactType"
                                label="Method of Contact"
                                item-text="type"
                                item-value="type"
                                :rules="requiredRules"
                                required
                                ></v-select>
                        </v-flex>
                        <v-flex xs2></v-flex> <!--Whitespace-->
                </v-layout>
                <!--GOALS-->
                  <v-layout row wrap>
                        <v-flex xs8>
                                 <v-textarea
                                  v-model="EducationalGoals"
                                  label="Educational Goals"
                                  rows="2"
                                  row-height="25"
                                  hint="Aspirational Goals that the person may want to achieve this year."
                                ></v-textarea>
                        </v-flex>
                        <v-flex xs2></v-flex> <!--Whitespace-->
                </v-layout>
                <!--End GOALS-->
                <v-layout row wrap>
                        <v-flex xs8>
                                 <v-textarea
                                  v-model="initialAppointmentInformation"
                                  :rules=requiredRules
                                  label="Appointment Notes"
                                  rows="5"
                                  row-height="25"
                                hint="Provide any notes about your appointment here."
                                ></v-textarea>
                        </v-flex>
                        <v-flex xs2></v-flex> <!--Whitespace-->
                </v-layout>
                <!--End Individual Student Meeting and Actions Needed-->
                <v-divider></v-divider>  

                <!--START OF OUTCOMES--ACTION MADE-->
                <v-layout row wrap style="padding-top:25px;">
                        <v-flex xs6>
                        <h4>Outcomes Actions Made & Results</h4>
                        <br/>
                        </v-flex>
                        <v-flex xs2></v-flex> <!--Whitespace-->
                </v-layout>
                <!--Appointment Date-->
                <v-layout row wrap>
                        <v-flex xs2>
                            Follow Up Date:
                        </v-flex>
                        <v-flex xs3></v-flex> <!--Whitespace-->
                        <v-flex xs3>
                                  <v-menu
                                                ref="menu"
                                                v-model="menu2"
                                                :close-on-content-click="false"
                                                :return-value.sync="appointmentFollowUpDate"
                                                transition="scale-transition"
                                                offset-y
                                                min-width="auto"
                                        >
                                                <template v-slot:activator="{ on, attrs }">
                                                <v-text-field
                                                v-model="appointmentFollowUpDate"
                                                prepend-icon="mdi-calendar"
                                                readonly
                                                v-bind="attrs"
                                                v-on="on"
                                                ></v-text-field>
                                                </template>
                                                <v-date-picker
                                                v-model="appointmentFollowUpDate"
                                                no-title
                                                scrollable
                                                >
                                                <v-spacer></v-spacer>
                                                <v-btn
                                                text
                                                color="primary"
                                                @click="menu = false"
                                                >
                                                Cancel
                                                </v-btn>
                                                <v-btn
                                                        text
                                                        color="primary"
                                                        @click="$refs.menu.save(appointmentFollowUpDate)"
                                                >
                                                OK
                                                </v-btn>
                                                </v-date-picker>
                                        </v-menu>
                        </v-flex>
                </v-layout><!--End Appointment Date-->
                <!--INFORMATION ABOUT FOLLOWING UP-->
                <v-layout row wrap>
                        <v-flex xs8>
                                <p>After meeting with the student, please provide follow up information you would like to achieve.</p>
                        </v-flex>
                        <v-flex xs2></v-flex> <!--Whitespace-->
                </v-layout>
                <!--END INFORMATION ABOUT FOLLOWING UP-->
                <v-layout row wrap>
                        <v-flex xs8>
                                 <v-textarea
                                  v-model="follow_up_notes"
                                  :rules=requiredRules
                                  label="Follow up appointment Notes"
                                  rows="5"
                                  row-height="25"
                                hint="Provide any notes about your follow up appointment here."
                                ></v-textarea>
                        </v-flex>
                        <v-flex xs2></v-flex> <!--Whitespace-->
                </v-layout>
                <!--ACTIONS NEEDED-->
                  <v-layout row wrap>
                        <v-flex xs8>
                                 <v-textarea
                                  v-model="ActionsNeeded"
                                  label="Actions Needed"
                                  rows="1"
                                  row-height="25"
                                ></v-textarea>
                        </v-flex>
                        <v-flex xs2></v-flex> <!--Whitespace-->
                </v-layout>
                <!--End ACTIONS NEEDED-->
                <!--ACTIONS NEEDED-->
                  <v-layout row wrap>
                        <v-flex xs8>
                                 <v-textarea
                                  v-model="ActionsMade"
                                  label="Actions Made"
                                  rows="1"
                                  row-height="25"
                                ></v-textarea>
                        </v-flex>
                        <v-flex xs2></v-flex> <!--Whitespace-->
                </v-layout>
                <!--End ACTIONS NEEDED-->
                <!--ACTIONS NEEDED-->
                  <v-layout row wrap>
                        <v-flex xs8>
                                 <v-textarea
                                  v-model="ResultsAfterFollowUp"
                                  label="Results"
                                  rows="1"
                                  row-height="20"
                                ></v-textarea>
                        </v-flex>
                        <v-flex xs2></v-flex> <!--Whitespace-->
                </v-layout>
                <!--End ACTIONS NEEDED-->
                <!--End OF OUTCOMES-->



                <v-layout row wrap style="padding-top:25px; padding-bottom:200px;">
                        <v-flex xs6>
                             <v-btn elevation="2" style="margin-left:100px"  large v-on:click="createAppointment">Create Appointment</v-btn>
                        </v-flex>
                </v-layout>
    </v-form>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Create Coaching Appointment Component mounted.')
        },
        created() {
            this.axios
                .get(`${process.env.MIX_API_URL}/public/index.php/api/coachAppointment/create`)
                .then(response => {
                    this.students = response.data.students;
                });
        },
           data () {
            return {
                    valid: false,
                    modal: false,
                    menu1:false,
                    menu2:false,
                    appointmentStudent:'',
                    initialAppointmentDate: new Date().toISOString().substr(0, 10),
                    appointmentFollowUpDate:new Date().toISOString().substr(0, 10),
                    methodOfContactType: {type:'Select Contact Method ...'},
                    initialAppointmentInformation:'',
                    follow_up_notes:'',
                    EducationalGoals:'',
                    ActionsNeeded:'',
                    ActionsMade:'',
                    ResultsAfterFollowUp:'',
                    //REmove item.
                    eventDates: [],
                    students:[{id:0,student_full_name:'Select Student...'}],
                    types:[{type:'Select Contact Method ...'},
                           {type:'Face-To-Face'},
                           {type:'Phone'}
                        ],
                    requiredRules:[
                            v => !!v || 'Required Field'
                        ],
                   minimum: v => v.length <=5 || 'Max 5 characters',    
            }
        },
        methods:{
                async createAppointment(){
        try {  
               
          let res = await axios ({
                  //store method.
            url: `${process.env.MIX_API_URL}/public/index.php/api/coachAppointment/store`,
                    method: 'POST',
                    data: {
                        errors: [],
                        student_id:this.$data.appointmentStudent.id,                  
                        //Only logged in user currently can make appointments.
                        user_id:this.$store.getters.userid.id,                    
                        //Will likely move to another table/area.
                        //start_gpa:                        
                        //end_gpa:
                        Additional_Information:'',
                        StudentCounselor:'',
                        EducationalGoals:this.$data.EducationalGoals,
                        appointment_date:this.$data.initialAppointmentDate,
                        appointment_follow_up_date:this.$data.appointmentFollowUpDate,
                        method_of_contact:this.$data.methodOfContactType,
                        follow_up_notes:this.$data.follow_up_notes,
                        actions_needed:this.$data.ActionsNeeded,
                        actions_made:this.$data.ActionsMade,
                        results:this.$data.ResultsAfterFollowUp,                
                    }
          }).then(
                        response=>{
                                this.errors= response.data.error;
                                if(response.status=200 && response.data.error===undefined){
                                        this.$store.dispatch('setSuccessAlert','A successful new coaching appointment has been created!!')
                                        // Remove banner.
                                        setTimeout(() => {
                                                this.$store.dispatch('removeSuccessAlert')
                                        }, 2000)

                                        //Reroute page to the coaching Appointment list page after 5 seconds.
                                        setTimeout(() => {
                                                this.$router.push({name: "coachAppointments"});
                                        }, 5000)
                                }
                                else
                                {
                                                //Set error alert.
                                                this.$store.dispatch('setErrorAlert','You are missing required fields, please retry submitting.')
                                                //Remove Error Alert.
                                                setTimeout(() => {
                                                        this.$store.dispatch('removeErrorAlert')
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


