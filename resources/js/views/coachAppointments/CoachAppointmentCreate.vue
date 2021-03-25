<template>
<v-container>
     <div v-if="$can('read', 'Admin')">
       <v-row>
                    <v-col cols="12" md="6" sm="6">
                        <h3>Create Appointment</h3>
                    </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" md="10" offset-md="1" offset-sm="1">
                            <CreateCoachAppointmentComponent />
            </v-col>
        </v-row>
    </div>
</v-container>
   
</template>

<script>
   //Local component registration...
    import CreateCoachAppointmentComponent from '../../components/CreateCoachAppointmentComponent.vue';
    
    export default {
        components:{
            CreateCoachAppointmentComponent,
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
        data() {
            return {
                coachAppointment:[],
            }
        }
    }
</script>