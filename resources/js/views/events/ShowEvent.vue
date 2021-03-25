
<template>
<v-container>
       <v-row>
          <v-col cols="12" md="5" offset-md="1">
            <h3>Event Detail Information</h3>
            <br>
            <h4>Event Name:  {{this.$data.event.event_name}}</h4>
                 <table>
                            <tr>
                                <td style="width:500px;">
                                    Event Type:
                                </td>
                                <td>
                                    {{event.event_type}}
                                </td>
                            </tr>
                            <tr>
                                <td style="width:500px;">
                                    Event Duration :
                                </td>
                                <td>
                                    {{event.event_start_date | formatDate}} -  {{event.event_end_date | formatDate}}
                                   
                                </td>
                            </tr>
                            <tr>
                                <td style="width:500px;">
                                    Event City:
                                </td>
                                <td>
                                    {{event.event_city}}
                                </td>
                            </tr>
                            <tr>
                                <td style="width:500px;">
                                    Event State & Zip:
                                </td>
                                <td>
                                    {{event.event_state}}, {{event.event_zip}}
                                </td>
                            </tr>
                            <tr>
                                <td style="width:500px;">
                                    Event Notes:
                                </td>
                                <td>
                                    {{event.event_notes}}
                                </td>
                            </tr>
                </table>
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
        data() {
            return {
                event:[],
            }
        },
        methods:{

        },
        created() {
            //Event Information
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
                                });           
                        },
        }
</script>