<template>
<v-container>
     <div v-if="$can('read', 'Admin')">
       <v-row>
                    <v-col cols="12" md="6" sm="6">
                        <h4>Edit County Information</h4>
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
                        County Created:
                </v-col>
                <v-col cols="12" md="5" sm="5">
                       <span v-if="loaded">
                             {{county.created_at |formatDate}}
                       </span>
                       <span v-else>
                            Loading...
                        </span>
                </v-col>
        </v-row>
        <v-row>
                <v-col cols="12" md="2" sm="2"  offset-md="1">
                        Associated State:
                </v-col>
                <v-col cols="12" md="5" sm="5">
                       <span v-if="loaded">
                             {{county.state.state_name}}
                       </span>
                       <span v-else>
                            Loading...
                        </span>
                </v-col>
        </v-row>
        <v-row>
                <v-col cols="12" md="2" sm="2"  offset-md="1">
                        County Name:
                </v-col>
                <v-col cols="12" md="5" sm="5">
                         <v-text-field
                                    v-model="county.county_name"
                        ></v-text-field>
                </v-col>
        </v-row>
        <v-row>
                <v-col cols="12" md="5" sm="5" offset-md="1">
                      <v-btn elevation="2" large v-on:click="updateCounty">Update County Information</v-btn>
                </v-col>
        </v-row>
    </div>
      
</v-container>
   
</template>

<script>
    export default {
        created() {
            this.axios
                .get(`${process.env.MIX_API_URL}/public/index.php/api/admin/counties/${this.$route.params.id}`,
                {
                  headers:
                  {
                      Authorization: `Bearer ${this.$store.getters.token}`,
                  }
                })
                .then(response => {
                    this.county = response.data.county; 
                    this.loaded=true;                 
                });
        },
        methods:{
            async updateCounty(){
                    try{
                        let res = await axios ({
                                        url: `${process.env.MIX_API_URL}/public/index.php/api/admin/counties/${this.$route.params.id}`,
                                        method: 'PUT',
                                        data: {
                                                            county_name:this.$data.county.county_name,
                                               },
                                        headers:
                                        {
                                            Authorization: `Bearer ${this.$store.getters.token}`,
                                        }
                                        }).then(
                                        response=>{
                                                this.errors= response.data.error;
                                                if(response.status=200 && response.data.error===undefined){
                                                            this.$store.dispatch('setSuccessAlert','Updated County Information!');
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
                    },            
        
        },//methods.
        data() {
            return {
                county:[],
                loaded:false,
                breadcrumbOption: [
                    { 
                      text:'County Area',
                      disabled:false, 
                      to:'/admin/index#counties',
                    }, 
                    {
                    text: 'County Edit',
                    disabled: true,
                    },
                ],
            }
        }
    }
</script>