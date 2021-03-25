<template>
<v-container>
     <div v-if="$can('read', 'Admin')">
       <v-row>
                    <v-col cols="12" md="6" sm="6">
                        <h3>Edit Appointment</h3>
                    </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" md="10" offset-md="1">
                            <EditCoachAppointmentComponent />
            </v-col>
        </v-row>
    </div>
</v-container>
   
</template>

<script>
   //Local component registration...
    import EditCoachAppointmentComponent from '../../components/EditCoachAppointmentComponent.vue';
    
    export default {
        components:{
            EditCoachAppointmentComponent,
        },
        created() {
            
        },
        data() {
            return {
                coachAppointment:[],
            }
        }
    }
</script>