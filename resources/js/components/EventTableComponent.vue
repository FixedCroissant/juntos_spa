  <template> 
  <v-data-table
    :headers="headers" 
    :items-per-page="5"
    :items="events"
    :search="search"
    class="elevation-1"  
  >
  <template v-slot:top>
        <v-text-field
          v-model="search"
          label="Search"
          class="mx-4"
        ></v-text-field>
  </template>

  <template v-slot:item="events">
        <tr>
           <td>{{events.item.event_start_date | formatDate}}</td>
           <td>{{events.item.event_name}}</td>
           <td>
             {{events.item.event_type}}
           </td>
           <td>{{events.item.event_city}}</td>
           <td>{{events.item.event_state}}</td>
           <td>
              <v-col>
                 <router-link :to="{name: 'showEvent', params: { id: events.item.id }}">Event Details</router-link>
                |
                 <router-link :to="{name: 'eventAttendance', params: { id: events.item.id }}">Attendance</router-link>
                  |
                   <DeleteConfirmationComponent v-bind:recordToRemove="events.item.id" v-on:event_deletion="checkEventDeletion" />
              </v-col>
            </td>
        </tr>
  </template>
  </v-data-table>
</template>
<script>
  import DeleteConfirmationComponent from './DeleteConfirmationComponent.vue';
    export default {
      components:{
                DeleteConfirmationComponent
        },
        mounted() {
            console.log('Event Table Component mounted.')
        },

         data() {
            return {
                headers:[
                { text: 'Event Date', value: 'event_start_date' },
                { text: 'Event Name', value: 'event_name' },
                { text: 'Type', value: 'event_type' },
                { text: 'City', value: 'event_city' },
                { text: 'State', value: 'event_state' },
                { text: 'Actions', value: 'actions' },
                  
                ],
                events: [],
                search:'',
                overlay:true,
            }
        }, 
        //item has middleware on it.       
        created() {
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
                    this.overlay = false;
                });
        },
        methods: {
           checkEventDeletion(value){
           //Fully delete the event record.
           this.deleteEvent(value);
          },
            deleteEvent(id) {
                this.axios
                    .delete(`${process.env.MIX_API_URL}/public/index.php/api/events/${id}`)
                    .then(response => {
                        let event = this.events.map(event=>event.id).indexOf(id)                      
                        this.events.splice(event, 1);
                        //Notify user of success.
                        this.$store.dispatch('setSuccessAlert','Event Deleted')
                                        //Remove success alert.
                                setTimeout(() => {
                                                this.$store.dispatch('removeSuccessAlert')
                                }, 7000)
                    });
            }
        }
    }
</script>
