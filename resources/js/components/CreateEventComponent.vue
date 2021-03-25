<template>
    <div>
               <v-form v-model="valid">
                
                <v-layout row >
                        <v-flex xs12 md12>
                                Please create a new event on this page, please provide name of event, location and date at a minimum.
                        </v-flex>
                </v-layout>

                <v-layout row wrap>
                        <v-flex xs6>
                                <v-text-field
                                    v-model="eventName"
                                    label="Event Name *"
                                    :rules="requiredRules"
                                    required
                                ></v-text-field>
                        </v-flex>
                        <v-flex xs2></v-flex> <!--Whitespace-->
                </v-layout>
                
                <v-layout row wrap>
                        <v-flex xs6>
                                <v-select
                                :items="types"
                                v-model="eventType"
                                label="Event Type"
                                item-text="type"
                                item-value="type"
                                :rules="requiredRules"
                                required
                                ></v-select>
                        </v-flex>
                        <v-flex xs2></v-flex> <!--Whitespace-->
                </v-layout>

                  <v-layout row wrap>
                        <v-flex xs6>
                                <v-text-field
                                    label="City"
                                    v-model="eventCity"
                                ></v-text-field>
                        </v-flex>
                        <v-flex xs2></v-flex> <!--Whitespace-->
                </v-layout>                 
                 <v-layout row wrap>
                        <v-flex xs6>
                                <v-select
                                  v-model="eventState"
                                  :items="states"
                                  item-text="state"
                                  item-value="abbr"
                                  label="Select State"
                                  return-object
                                  single-line
                                  required 
                                >
                                </v-select>
                        </v-flex>
                        <v-flex xs2></v-flex> <!--Whitespace-->
                </v-layout>
                <v-layout row wrap>
                        <v-flex xs6>
                                <v-text-field
                                label="Zip"
                                v-model="eventZip"
                                :rules=requiredRules
                                ></v-text-field>
                        </v-flex>
                        <v-flex xs2></v-flex> <!--Whitespace-->
                </v-layout>
                <v-layout row wrap>
                        <v-flex xs6>
                                 <v-textarea
                                  v-model="eventNotes"
                                  :rules=requiredRules
                                  label="Event Notes"
                                  rows="1"
                                  row-height="15"
                                hint="Provide any notes about your event here."
                                ></v-textarea>
                        </v-flex>
                        <v-flex xs2></v-flex> <!--Whitespace-->
                </v-layout>
                <!--Begin Start Date-->
                <v-layout row wrap>
                        <v-flex xs2>
                            Event Date Range:
                        </v-flex>
                        <v-flex xs1></v-flex> <!--Whitespace-->
                        <v-flex xs3>
                                 <v-dialog
                                        ref="dialog"
                                        v-model="modal"
                                        :return-value.sync="eventDates"
                                        persistent
                                        width="290px"
                                >
                                <template v-slot:activator="{ on }">
                                        <v-text-field
                                        md3
                                        v-model="eventDates"
                                        label="Event Dates *"
                                        readonly
                                        v-on="on"
                                        ></v-text-field>
                                </template>
                                 <v-date-picker v-model="eventDates" range scrollable>
                                <v-spacer></v-spacer>
                                <v-btn text color="primary" @click="modal = false">Cancel</v-btn>
                                <v-btn text color="primary" @click="$refs.dialog.save(eventDates)">OK</v-btn>
                        </v-date-picker>
                        </v-dialog>
                        </v-flex>
                </v-layout><!--End Event Start Date-->
                <v-layout row wrap style="padding-top:25px;">
                        <v-flex xs6>
                             <v-btn elevation="2" style="margin-left:100px"  large v-on:click="createEvent">Create Event</v-btn>
                              <!-- <v-btn elevation="2" style="margin-left:100px"  large v-on:click="reset">Reset</v-btn> -->
                        </v-flex>
                </v-layout>
    </v-form>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Create Event Component mounted.')
        },
           data () {
            return {
                    valid: false,
                    modal: false,
                    eventName:'',
                    eventDate:'',
                    eventCity:'',
                    eventType: {type:'Select Type ...'},
                    eventState:{state:'North Carolina', abbr:'NC'},
                    eventZip:'',
                    eventNotes:'',
                    states: [
                                { state: 'North Carolina', abbr: 'NC' },
                                { state: 'Florida', abbr: 'FL' },
                                { state: 'Georgia', abbr: 'GA' },
                                { state: 'Nebraska', abbr: 'NE' },
                                { state: 'California', abbr: 'CA' },
                                { state: 'New York', abbr: 'NY' },
                    ],
                    eventDates: [],
                    types:[{type:'Select Type ...'},
                           {type:'4H'},
                           {type:'Field Trip'},
                           {type:'Family Night'},
                           {type:'Civic Engagement'},
                           {type:'Other'}
                        ],
                    requiredRules:[
                            v => !!v || 'Required Field'
                        ],
                   minimum: v => v.length <=5 || 'Max 5 characters',    
            }
        },
        methods:{
                async createEvent(){
        try {  
               // console.log(this.$data.eventDates.length);
          let res = await axios ({
            url: `${process.env.MIX_API_URL}/public/index.php/api/events`,
                    method: 'POST',
                    data: {
                        errors: [],    
                        event_name: this.$data.eventName,
                        event_start_date: this.$data.eventDates.length>1 ? this.$data.eventDates[0] : this.$data.eventDates[0],
                        event_end_date: this.$data.eventDates.length>1 ? this.$data.eventDates[1] : this.$data.eventDates[0],
                        event_city: this.$data.eventCity,
                        event_state: this.$data.eventState.abbr,                        
                        event_type: this.$data.eventType,                        
                        event_zip: this.$data.eventZip,                        
                        event_notes: this.$data.eventNotes,                        
                    }
          }).then(
                        response=>{
                                this.errors= response.data.error;
                                if(response.status=200 && response.data.error===undefined){
                                        this.$store.dispatch('setSuccessAlert','A successful new event has been created!!')
                                        // Remove banner.
                                        setTimeout(() => {
                                                this.$store.dispatch('removeSuccessAlert')
                                        }, 2000)

                                        //Reroute page to the event list page after 5 seconds.
                                        setTimeout(() => {
                                                this.$router.push({name: "allEvents"});
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


