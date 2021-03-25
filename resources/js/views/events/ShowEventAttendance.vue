
<template>
<v-container>
       <v-row>
          <v-col cols="12" md="5" offset-md="1">
            <h3>Event Attendance Information</h3>
            <br>
            <h4>Event Name:  {{this.$data.event.event_name}}</h4>
                 Currently, the following individuals have signed up for the this event:
                 <table>
                            <tr v-for="myattendees in attendees">
                                <td style="width:500px;">
                                      {{myattendees.student_first_name}} {{myattendees.student_last_name}} 
                                      <!-- {{myattendees.id}} -->
                                </td>
                                <td>
                                    <v-btn
                                            elevation="2"
                                             x-small
                                            v-on:click="removeAttendeeFromEvent(event.id,myattendees.id)"
                                            >Remove Attendee
                                 </v-btn>
                                </td>
                            </tr>
               
                </table>
                Total Students Participants: {{attendees.length}}
            </v-col>
           
        </v-row>
        <v-row>
          <v-col cols="12" md="5" offset-md="1">
           Volunteer List (also) coming soon!

           <h4>Parents & Guardians</h4>
            <table>
                            <tr v-for="myparentsattendees in parent_attendance">
                                <td style="width:500px;">
                                      {{myparentsattendees.parent_first_name}} {{myparentsattendees.parent_last_name}} 
                                      
                                </td>
                                <td>
                                   Remove Parents/Guardians From Attendance
                                </td>
                            </tr>
                </table>
                 Total Parent Participants: {{parent_attendance.length}}
              
            </v-col>
        </v-row>

    <!--Total Combined Number-->
        <v-row>
          <v-col cols="12" md="5" offset-md="1">
           <h5>Total</h5>
            Total Combined Participants: {{attendees.length + parent_attendance.length}}
            </v-col>
    </v-row>

     <v-row style="padding-top:80px;">
          <v-col cols="12" md="10" offset-md="1">                  
                    
        </v-col>
     </v-row>


    </v-container>
</template>
 
<script>
       export default {
        components:{
        },
        data() {
            return {
                attendees:[],
                parent_attendance:[],
                event:"",
            }
        },
        methods:{
            //ID is currently the student id from the system.
            //first param is the event id; second param is the student_id in event_attendance table.
            //if we pass myattendees.student_id, we will have the student_id from the student table, not helpful in this case.

            async removeAttendeeFromEvent(eventID,student_id){
                 try {
                    let res = await axios ({
                                        url: `${process.env.MIX_API_URL}/public/index.php/api/events/attendance/` + eventID +`/remove`,
                                        method: 'POST',
                                        data: {
                                                            attendeesToRemove: student_id,
                                             },
                                        headers:
                                        {
                                            Authorization: `Bearer ${this.$store.getters.token}`,
                                        }
                                        }).then(
                                        response=>{
                                                this.errors= response.data.error;
                                                if(response.status=200 && response.data.error===undefined){
                                                             this.$store.dispatch('setSuccessAlert','Your Attendee has been Removed!')
                                                                    setTimeout(() => {
                                                                                  this.$store.dispatch('removeSuccessAlert')
                                                                    }, 7000)
                                                        }
                                                }
                                )
                        }//close try
                        catch(err){
                                                alert(err);
                        }
           
           
             },
        },
         created() {
                    //Event & Attendance Information
                     this.axios
                                .get(`${process.env.MIX_API_URL}/public/index.php/api/events/` + this.$route.params.id,
                                {
                                headers:
                                {
                                    Authorization: `Bearer ${this.$store.getters.token}`,
                                }
                                })
                                .then(response => {
                                    this.event = response.data.event;
                                    this.attendees = response.data.event.attendance;                     
                                    this.parent_attendance = response.data.event.parent_attendance;                     
                                });           
                        },
    }
</script>