<template>
<v-container>
     <div v-if="$can('read', 'Admin')">
         <v-row>
                    <v-col cols="12" md="6" sm="6">
                        <h4>Create Site Information</h4>
                    </v-col>
                    <v-col cols="12" md="4" offset-md="2">
                        <v-breadcrumbs
                        :items="breadcrumbOption"
                        divider="-"
                        ></v-breadcrumbs>
                    </v-col>
        </v-row>
       <v-row>
                    <v-col cols="12" md="6" sm="6">
                        <p>
                            Please create a new site based on the county you have selected.
                        </p>
                    </v-col>
        </v-row>
        <v-row>
                <v-col cols="12" md="2" sm="2"  offset-md="1">
                        Pick County:
                </v-col>
                <v-col cols="12" md="5" sm="5">
                        <v-select
                            v-model="site.county"
                            :items="counties"
                            label="County name"
                            item-text="county_name"
                            item-value="id"
                            return-object
                            required
                           
                        ></v-select>
                </v-col>
        </v-row>
        <v-row>
                <v-col cols="12" md="2" sm="2"  offset-md="1">
                        Site Name:
                </v-col>
                <v-col cols="12" md="5" sm="5">
                        <v-text-field
                        v-model="site.site_name"
                        size="2"
                        ></v-text-field>
                </v-col>
        </v-row>
        <v-row>
                <v-col cols="12" md="5" sm="5">
                      
                      <v-btn elevation="2" large v-on:click="createSite">Create Site</v-btn>
                </v-col>
        </v-row>
        
    </div>
</v-container>
   
</template>

<script>
    export default {
        created() {
            this.axios
                .get(`${process.env.MIX_API_URL}/public/index.php/api/admin/sites/create`,
                               
                {
                  headers:
                  {
                      Authorization: `Bearer ${this.$store.getters.token}`,
                  }
                })
                .then(response => {
                    this.counties = response.data.counties;
                });
        },
        methods:{
            async createSite(){
                  
        try {  
          let res = await axios ({
            url: `${process.env.MIX_API_URL}/public/index.php/api/admin/sites`,
                    method: 'POST',
                    data: {
                        errors: [],
                        //ID Number.
                        county: this.$data.site.county.id,   
                        site_name: this.$data.site.site_name,                        
                    }
          }).then(
                        response=>{
                                this.errors= response.data.error;
                                if(response.status=200 && response.data.error===undefined){
                                        this.$store.dispatch('setSuccessAlert','A successful new site has been created!!')
                                        setTimeout(() => {
                                                this.$store.dispatch('removeSuccessAlert')
                                        }, 2000);
                                }
                                else
                                {
                                        this.$store.dispatch('setErrorAlert','You are missing required fields, please retry submitting.')
                                            
                                        setTimeout(() => {
                                                this.$store.dispatch('removeErrorAlert')
                                        }, 5000)
                                }               
                            }
          )
        }
                //Let us know of error.     
                catch(err){
                alert(err);
                }
        
        },//End CreateSite
        
        
        
        },
        data() {
            return {
                counties:[],
                county:[],
                site:[],
                  breadcrumbOption: [
                    { 
                      text:'Site Area',
                      disabled:false, 
                      to:'/admin/index#sites',
                    }, 
                    {
                    text: 'Site Create',
                    disabled: true,
                    },
                ],
            }
        }
    }
</script>