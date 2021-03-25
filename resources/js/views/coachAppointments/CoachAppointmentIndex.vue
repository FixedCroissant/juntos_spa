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
                            
                            <v-simple-table>
                                        <template v-slot:default>
                                        <thead>
                                            <tr>
                                            <th class="text-left">
                                                Date Created
                                            </th>
                                            <th class="text-left">
                                               Appointment With: 
                                            </th>
                                            <th class="text-left">
                                                Appointment Date:
                                            </th>
                                            
                                            <th class="text-left">
                                                Coordinator/Coach:
                                            </th>
                                            
                                            <th class="text-left">
                                                Review Schedule:
                                            </th>

                                            <th class="text-left">
                                                Actions
                                            </th>
                                            </tr>

                                             <tr
                                            v-for="myAppointment in coachAppointment"
                                            :key="myAppointment.id"
                                            >
                                            <td>{{ myAppointment.created_at | formatDate }}</td>
                                            <td>
                                                {{myAppointment.student.student_full_name}}
                                            </td>
                                            <td>
                                                {{myAppointment.appointment_date | formatDate }}
                                            </td>
                                            <td>
                                                {{myAppointment.coach.name}}
                                            </td>
                                            <td>
                                                <router-link :to="{name: 'scheduleList', params: { id: myAppointment.student.id}}">Student Schedule List</router-link>
                                            </td>
                                            <td>
                                                <router-link :to="{name: 'coachAppointmentEdit', params: { id: myAppointment.id }}" class="btn btn-primary">Edit Appointment
                                                </router-link>
                                                |
                                                <button class="btn btn-danger">Remove</button>
              
                                            </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                        </tbody>
                                        </template>
                                    </v-simple-table>
                        </template>
                    </v-col>
        </v-row>
    </div>
</v-container>
   
</template>

<script>
    export default {
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
        
        },
        computed: {
             myUserRolesSorted: function () {
                return this.userRole.sort((a,b)=>(a.id) - (b.id));
            }
        },
        data() {
            return {
                coachAppointment:[],
            }
        }
    }
</script>