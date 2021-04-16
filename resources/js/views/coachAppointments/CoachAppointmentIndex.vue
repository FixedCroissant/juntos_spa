<template>
<v-container>
     <div v-if="$can('read', 'Admin')">
       <v-row>
                    <v-col cols="12" md="6" sm="6">
                        <h3>Coach Appointments</h3>
                    </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" md="10" offset-md="1">
                        <template>
                            <v-btn v-if="$can('create','CoachAppointment')" :to="{name:'createCoachAppointment'}">
                                Create New Appointment
                            </v-btn>
                            
                                                <v-row 
                                                    v-for="myAppointment in coachAppointment"
                                                    :key="myAppointment.id">
                                                    <v-col cols="12" md="12" sm="12">
                                                        <h3>
                                                        {{myAppointment.student_full_name}}
                                                        </h3>
                                                        <!-- {{myAppointment.coach_appointments}} -->
                                                        <v-simple-table>
                                                                <template v-slot:default>
                                                                              <thead>
                                                                                <tr>
                                                                                    <th class="text-left">Student ID</th>
                                                                                    <th class="text-left">Date Created</th>
                                                                                    <th class="text-left">Appointment Date</th>
                                                                                    <th class="text-left">With Coach</th>
                                                                                    <th class="text-left">Schedule</th>
                                                                                    <th class="text-left">Actions</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                        <tr v-for="myAppointmentInfo in myAppointment.coach_appointments">
                                                                                            <td>
                                                                                                   {{myAppointmentInfo.student_id}}
                                                                                            </td>
                                                                                            <td>
                                                                                                {{myAppointmentInfo.created_at | formatDate}}
                                                                                            </td>
                                                                                            <td>
                                                                                                 {{myAppointmentInfo.appointment_date}}
                                                                                            </td>
                                                                                            <td>
                                                                                                     {{myAppointmentInfo.coach.name}}
                                                                                            </td>
                                                                                            <td>
                                                                                              <router-link :to="{name: 'scheduleList', params: { id: myAppointmentInfo.student_id}}">Student Schedule</router-link> 
                                                                                            </td>
                                                                                            <td>
                                                                                                <router-link :to="{name: 'coachAppointmentEdit', params: { id: myAppointmentInfo.id }}">Edit Appointment</router-link>
                                                                                                |
                                                                                                <DeleteConfirmationComponent  v-bind:recordToRemove="myAppointmentInfo.id" v-on:event_deletion="checkAppointmentDeletion" />
                                                                                            </td>
                                                                                        </tr>
                                                                            </tbody>
                                                                </template>
                                                        </v-simple-table>

                                                                
                                                    </v-col>
                                                </v-row>
                                            
                                      
                        </template>
                    </v-col>
        </v-row>
    </div>
</v-container>
   
</template>

<script>
 import DeleteConfirmationComponent from '../../components/DeleteConfirmationComponent.vue';
    export default {
        components:{
                DeleteConfirmationComponent
        },
        created() {
            this.axios
                .get(`${process.env.MIX_API_URL}/public/index.php/api/coachAppointment/index`,                               
                {
                  headers:
                  {
                      Authorization: `Bearer ${this.$store.getters.token}`,
                  }
                })
                .then(response => {
                    this.coachAppointment = response.data.appointments;
                });
        },
        methods:{            
                checkAppointmentDeletion(value){
                    this.deleteAppointment(value);
                },
                repullInformation(){
                        this.axios
                            .get(`${process.env.MIX_API_URL}/public/index.php/api/coachAppointment/index`,                               
                        {
                        headers:
                        {
                            Authorization: `Bearer ${this.$store.getters.token}`,
                        }
                        })
                        .then(response => {
                                        this.coachAppointment = response.data.appointments;
                        });
            },
                deleteAppointment(id) {
                this.axios
                    .delete(`${process.env.MIX_API_URL}/public/index.php/api/coachAppointment/${id}`)
                    .then(response => {
                        this.$store.dispatch('setSuccessAlert','Appointment Deleted')
                                setTimeout(() => {
                                                this.$store.dispatch('removeSuccessAlert')
                                }, 5000);
                    });
                    this.repullInformation();
            }

        },
        data() {
            return {
                coachAppointment:[],
            }
        }
    }
</script>