<template>
  <div class="text-center">
    <v-dialog
      :value="dialog" 
      @input="$emit('input')"
      width="600"
    >
      <!-- <template v-slot:activator="{ on, attrs }">
         <v-btn
          color="red lighten-2"
          dark
          v-bind="attrs"
          v-on="on"
        >
          Click Me
        </v-btn>
      </template> -->

      <v-card>
        <v-card-title class="headline grey lighten-2">
          Add to Event Attendance:
        </v-card-title>

        <v-card-text>

          Total People Selected: {{this.$props.totalStudentsForEvent.length}} 
          <br/>
          <br/>
          Please select the event that you would like to add this particular person as a participant for the following event:

                    <v-select
                    v-model="selectedEvent"
                    :items="events"
                    item-text="event_name" 
                    item-value="id"
                    label="Pick Event"
                    width="450"
                    ></v-select>
        </v-card-text>

        <v-divider></v-divider>
      

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="addParent(false)"
          >
            Go Back
          </v-btn>
          <v-btn
            color="primary"
            text
            @click="addAttendees(selectedEvent,typeofAddition)"
          >
           Add Event Attendee
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
    export default {
        mounted() {
            console.log('Dropdown Modal Component mounted.')
        },
        computed: {
          //ToDo Remove these, not going to use.
                  propModel: {
                          get () { return this.value },
                          set (value) { this.$emit('input', value) },
        },
    },
        props:['totalStudentsForEvent','dialog'],
          data() {
            return {
                fakeevents:[
                          {id:'1',name:'Lets go to the zoo!'},
                          {id:'2',name:'Science Museum'},
                          {id:'3',name:'Internation Civil Rights Center'}],
                events:[],
                selectedEvent: null,
                typeofAddition:this.$attrs['attendanceType']
              }
        },
        methods:{
             //Send event information back to the main page.
             addParent(value){
               console.log('child component hit from EventDropdown!');

               

              //Send to parent component...MenuComponent
                this.$emit('eventDialog', value);
            },
             async addAttendees(eventID,type) {

               
               if(type=="parent"){
                 //For testing.
                 //alert("The person you are trying to add to attendance is a parent!");

                //Add to parent attendance.
                try {
                  let res = await axios ({
                                        url: `${process.env.MIX_API_URL}/public/index.php/api/events/attendance/` + eventID,
                                        method: 'POST',
                                        data: {
                                                            parents:true,
                                                            //Need to make sure we have the correct Values.
                                                            attendees:this.$props.totalStudentsForEvent
                                             },
                                        headers:
                                        {
                                            Authorization: `Bearer ${this.$store.getters.token}`,
                                        }
                                        }).then(
                                        response=>{
                                                this.errors= response.data.error;
                                                if(response.status=200 && response.data.error===undefined){
                                                            
                                                            this.addParent(false);

                                                            this.$store.dispatch('setSuccessAlert','Successfully Added a new parent attendee to Event!');

                                                              setTimeout(() => {
                                                                            this.$store.dispatch('removeSuccessAlert')
                                                              }, 7000)
                                                        }
                                                }
                                )//end axios.
                }
                catch(err){
                              alert(err);
                        }

               }//End parents
              
              //Students....
              else {
              
              //Students.               
              try {
                    let res = await axios ({
                                        url: `${process.env.MIX_API_URL}/public/index.php/api/events/attendance/` + eventID,
                                        method: 'POST',
                                        data: {
                                                            students:true,
                                                            attendees:this.$props.totalStudentsForEvent,
                                             },
                                        headers:
                                        {
                                            Authorization: `Bearer ${this.$store.getters.token}`,
                                        }
                                        }).then(
                                        response=>{
                                                this.errors= response.data.error;
                                                if(response.status=200 && response.data.error===undefined){
                                                            
                                                            //Close our dialog after submission.
                                                            //this.dialog=false;
                                                            //Go back to the parent component and remove our modal from 
                                                            //showing up.
                                                            this.addParent(false);

                                                            //ToDo --- Remember to add information to the modal.
                                                            //Present Notifications to the end user after success.
                                                            this.$store.dispatch('setSuccessAlert','Successfully Added a new attendee to Event!');

                                                              setTimeout(() => {
                                                                            this.$store.dispatch('removeSuccessAlert')
                                                              }, 7000)
                                                          //End Notifications.   
                                                        }
                                                }

                                )//end axios.
                        }
                        catch(err){
                                                alert(err);
                        }

              }



              
           
           
             },
             
          },
          created() {

            //console.log('Hello, this is running from EventDropDown Modal!');
            //Get attendance type from our attribute.
            //attendance type being parent or student for now.
            //console.log(this.$attrs['attendanceType']) 

                                             this.axios
                                                            .get(`${process.env.MIX_API_URL}/public/index.php/api/events`,
                                                            {
                                                               headers:
                                                               {
                                                                   Authorization: `Bearer ${this.$store.getters.token}`,
                                                               }
                                                            })
                                                            .then(response => {
                                                                this.events = response.data.events;                    
                                                            });
                      }
      }
</script>
