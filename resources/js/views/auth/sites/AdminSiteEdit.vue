<template>
<v-container>
     <div v-if="$can('read', 'Admin')">
       <v-row>
                    <v-col cols="12" md="6" sm="6">
                        <h4>Edit Site Information</h4>
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
                        Site Created:
                </v-col>
                <v-col cols="12" md="5" sm="5">
                       <span v-if="loaded">
                             {{site.created_at |formatDate}}
                       </span>
                       <span v-else>
                            Loading...
                        </span>
                </v-col>
        </v-row>
        <v-row>
                <v-col cols="12" md="2" sm="2"  offset-md="1">
                        Associated County:
                </v-col>
                <v-col cols="12" md="5" sm="5">
                        <span v-if="loaded">
                            {{site.county.county_name}}
                       </span>
                       <span v-else>
                            Loading...
                        </span>
                </v-col>
        </v-row>
        <v-row>
                <v-col cols="12" md="2" sm="2"  offset-md="1">
                        Site Name:
                </v-col>
                <v-col cols="12" md="5" sm="5">
                         <v-text-field
                                    v-model="site.site_name"
                        ></v-text-field>
                </v-col>
        </v-row>
        <v-row>
                <v-col cols="12" md="5" sm="5" offset-md="1">
                      <v-btn elevation="2" large v-on:click="updateSite">Update Site Information</v-btn>
                </v-col>
        </v-row>
    </div>
      
</v-container>
   
</template>

<script>
    export default {
        created() {
            this.axios
                .get(`${process.env.MIX_API_URL}/public/index.php/api/admin/sites/${this.$route.params.id}`,
                {
                  headers:
                  {
                      Authorization: `Bearer ${this.$store.getters.token}`,
                  }
                })
                .then(response => {
                    this.site = response.data.site; 
                    this.loaded=true;                 
                });
        },
        methods:{
            async updateSite(){
                    try{
                        let res = await axios ({
                                        url: `${process.env.MIX_API_URL}/public/index.php/api/admin/sites/${this.$route.params.id}`,
                                        method: 'PUT',
                                        data: {
                                                            site_name:this.$data.site.site_name,
                                               },
                                        headers:
                                        {
                                            Authorization: `Bearer ${this.$store.getters.token}`,
                                        }
                                        }).then(
                                        response=>{
                                                this.errors= response.data.error;
                                                if(response.status=200 && response.data.error===undefined){
                                                            this.$store.dispatch('setSuccessAlert','Updated Site Information!');
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
                site:[],
                loaded:false,
                breadcrumbOption: [
                    { 
                      text:'Site Area',
                      disabled:false, 
                      to:'/admin/index#sites',
                    }, 
                    {
                    text: 'Site Edit',
                    disabled: true,
                    },
                ],
            }
        }
    }
</script>