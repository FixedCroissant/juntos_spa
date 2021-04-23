<template>
<v-container>
     <div v-if="$can('read', 'Admin')">
       <v-row>
                    <v-col cols="12" md="6" sm="6">
                        <h4>Edit State Information</h4>
                    </v-col>
                    <v-col cols="12" md="4" offset-md="2">
                        <v-breadcrumbs
                        :items="breadcrumbOption"
                        divider="-"
                        ></v-breadcrumbs>
                    </v-col>
        </v-row>
        <v-row>
                <v-col cols="12" md="2" sm="2"  offset-md="1">
                        State Created:
                </v-col>
                <v-col cols="12" md="5" sm="5">
                       {{state.created_at |formatDate}}
                </v-col>
        </v-row>
         <v-row>
                <v-col cols="12" md="2" sm="2"  offset-md="1">
                        State Name:
                </v-col>
                <v-col cols="12" md="5" sm="5">
                         <v-text-field
                                    v-model="state.state_name"
                        ></v-text-field>
                </v-col>
        </v-row>
         <v-row>
                <v-col cols="12" md="2" sm="2"  offset-md="1">
                        State Abbreviation:
                </v-col>
                <v-col cols="12" md="5" sm="5">
                        <v-text-field
                        v-model="state.state_abbreviation"
                        size="2"
                        ></v-text-field>
                </v-col>
        </v-row>
      
        
        <v-row>
             <v-col cols="12" md="2" sm="2"  offset-md="1">
                        <v-btn elevation="2" large v-on:click="updateState">Update State Information</v-btn>
             </v-col>
        </v-row>
    </div>
</v-container>
</template>
<script>
export default {
        created() {
            this.axios
                .get(`${process.env.MIX_API_URL}/public/index.php/api/admin/states/${this.$route.params.id}`,
                {
                  headers:
                  {
                      Authorization: `Bearer ${this.$store.getters.token}`,
                  }
                })
                .then(response => {
                    this.state = response.data.state;                  
                });
        },
        methods:{            
         async updateState(){
                    try{
                        let res = await axios ({
                                        url: `${process.env.MIX_API_URL}/public/index.php/api/admin/states/${this.$route.params.id}`,
                                        method: 'PUT',
                                        data: {
                                                            state_name:this.$data.state.state_name,
                                                            state_abbreviation:this.$data.state.state_abbreviation,
                                               },
                                        headers:
                                        {
                                            Authorization: `Bearer ${this.$store.getters.token}`,
                                        }
                                        }).then(
                                        response=>{
                                                this.errors= response.data.error;
                                                if(response.status=200 && response.data.error===undefined){
                                                            this.$store.dispatch('setSuccessAlert','Updated State Information!');
                                                             setTimeout(() => {
                                                                            this.$store.dispatch('removeSuccessAlert')
                                                              }, 5000)
                                                }
                                        }
                                )
                        }
                        catch(err){
                                                alert(err);
                        }
            }, //end state.
         },//End methods
        data() {
            return {
                state:[],
                breadcrumbOption: [
                    { 
                      text:'State Area',
                      disabled:false, 
                      to:'/admin/index#states',
                    }, 
                    {
                    text: 'State Edit',
                    disabled: true,
                    },
                ],
            }
        }
    }
</script>