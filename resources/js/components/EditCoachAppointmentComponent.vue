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
                                  v-model="appointment.student_id"
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
                                                v-model="appointment.appointment_date"
                                                prepend-icon="mdi-calendar"
                                                readonly
                                                v-bind="attrs"
                                                v-on="on"
                                                ></v-text-field>
                                                </template>
                                                <v-date-picker
                                                v-model="appointment.appointment_date"
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
                                                @click="$refs.menu1.save(appointment.appointment_date)"
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
                                v-model="appointment.method_of_contact"
                                label="Method of Contact"
                                item-text="type"
                                item-value="type"
                                :rules="requiredRules"
                                required
                                ></v-select>
                        </v-flex>
                        <v-flex xs1></v-flex> <!--Whitespace-->
                </v-layout>
                <v-layout row wrap>
                        <v-flex xs8>
                                 <v-textarea
                                  v-model="appointment.Additional_Information"
                                  :rules=requiredRules
                                  label="Appointment Notes"
                                  rows="5"
                                  row-height="25"
                                hint="Provide any notes about your appointment here."
                                ></v-textarea>
                        </v-flex>
                        <v-flex xs1></v-flex> <!--Whitespace-->
                </v-layout>
                <!--End Individual Student Meeting and Actions Needed-->
                <v-divider></v-divider>  

                <!--START OF OUTCOMES--ACTION MADE-->
                <v-layout row wrap style="padding-top:25px;">
                        <v-flex xs6>
                        <h4>Outcomes Actions Made & Results</h4>
                        <br/>
                        </v-flex>
                        <v-flex xs1></v-flex> <!--Whitespace-->
                </v-layout>
                <!--Appointment Date-->
                <v-layout row wrap>
                        <v-flex xs2>
                            <v-tooltip bottom>
                                <template v-slot:activator="{ on, attrs }">
                                        <span
                                        v-bind="attrs"
                                        v-on="on"
                                        >Follow Up Date:</span>
                                </template>
                                 <span>If no follow up date created, value will show 01-01-1999.</span>
                        </v-tooltip>
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
                                                v-model="appointment.appointment_follow_up_date"
                                                prepend-icon="mdi-calendar"
                                                readonly
                                                v-bind="attrs"
                                                v-on="on"
                                                ></v-text-field>
                                                </template>
                                                <v-date-picker
                                                v-model="appointment.appointment_date"
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
                                                        @click="$refs.menu.save(appointment.appointment_date)"
                                                >
                                                OK
                                                </v-btn>
                                                </v-date-picker>
                                        </v-menu>
                        </v-flex>
                </v-layout><!--End Appointment Date-->
                <v-layout row wrap>
                        <v-flex xs8>
                                 <v-textarea
                                  v-model="appointment.follow_up_notes"
                                  label="Follow up appointment Notes"
                                  rows="5"
                                  row-height="25"
                                hint="Provide any notes about your follow up appointment here."
                                ></v-textarea>
                        </v-flex>
                        <v-flex xs1></v-flex> <!--Whitespace-->
                </v-layout>
                <!--End OF OUTCOMES-->



                <v-layout row wrap style="padding-top:25px; padding-bottom:200px;">
                        <v-flex xs6>
                             <v-btn elevation="2" style="margin-left:100px"  large v-on:click="updateAppointment">Update Appointment</v-btn>
                        </v-flex>
                </v-layout>
    </v-form>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Update Coaching Appointment Component mounted.')
        },
        created() {
            //Get students.    
            this.axios
                .get(`${process.env.MIX_API_URL}/public/index.php/api/coachAppointment/create`)
                .then(response => {
                    this.students = response.data.students;
                });
            //Get appointment details. 
           const appointmentInformation = this.axios
                .get(`${process.env.MIX_API_URL}/public/index.php/api/coachAppointment/${this.$route.params.id}/edit`)
                .then(response => {
                        this.appointment = response.data.appointment;

                        //handle nulls in dates.        
                        if (!response.data.appointment.appointment_follow_up_date) {
                                response.data.appointment.appointment_follow_up_date="1999-01-01";
                        }
                });

        },
           data () {
            return {
                    valid: false,
                    modal: false,
                    menu1:false,
                    menu2:false,
                    appointment:[],
                    appointmentStudent:'',
                    initialAppointmentDate: new Date().toISOString().substr(0, 10),
                    appointmentFollowUpDate:new Date().toISOString().substr(0, 10),
                    methodOfContactType: {type:'Select Contact Method ...'},
                    initialAppointmentInformation:'',
                    followupAppointmentInformation:'',
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
                async updateAppointment(){
                        try {  
               
                                let res = await axios ({
                                url: `${process.env.MIX_API_URL}/public/index.php/api/coachAppointment/${this.$route.params.id}/update`,
                                        method: 'POST',
                                        data: {
                                                errors: [],
                                                student_id:this.appointment.student_id.id,                  
                                                //Only logged in user currently can make appointments.
                                                user_id:this.$store.getters.userid.id,                    
                                                appointment_date:this.appointment.appointment_date,
                                                appointment_follow_up_date:this.appointment.appointment_follow_up_date,
                                                follow_up_notes:this.appointment.follow_up_notes,
                                                method_of_contact:this.appointment.method_of_contact,
                                        }
          }).then(
                        response=>{
                                this.errors= response.data.error;
                                if(response.status=200 && response.data.error===undefined){
                                        this.$store.dispatch('setSuccessAlert','Updated Coaching Appointment Information')
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


