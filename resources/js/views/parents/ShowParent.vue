
<template>
<v-container>
       <v-row>
          <v-col cols="12" md="5" offset-md="1">
            <h3>Parent/Guardian Detail Information</h3>
            <br>
            <h4>{{this.$data.parent.parent_first_name}} {{this.$data.parent.parent_last_name}}</h4>
                 <table>
                            <tr>
                                <td style="width:500px;">
                                    Address
                                </td>
                                <td>
                                    {{this.$data.parent.address_line_1}}
                                </td>
                            </tr>
                            <tr>
                                <td style="width:500px;">
                                    City:
                                </td>
                                <td>
                                    {{this.$data.parent.city}}
                                </td>
                            </tr>
                            <tr>
                                <td style="width:500px;">
                                    State & Zip:
                                </td>
                                <td>
                                    {{this.$data.parent.state}}  {{this.$data.parent.zip}}
                                </td>
                            </tr>
                            <tr>
                                <td style="width:500px;">
                                   Related Student:
                                </td>
                                <td>
                                    Student Information coming soon!
                                </td>
                            </tr>
                </table>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
    export default {
        data() {
            return {
                parent:[],
            }
        },
        methods:{

        },
        created() {
            //Event Information
                    this.axios
                        .get(`${process.env.MIX_API_URL}/public/index.php/api/parents/` + this.$route.params.id,
                            {
                                headers:
                                {
                                    Authorization: `Bearer ${this.$store.getters.token}`,
                                }
                                })
                                .then(response => {
                                     this.parent = response.data.parent;                                          
                                });           
                        },
        }
</script>
