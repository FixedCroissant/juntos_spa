<template>
<v-container>
     <div v-if="$can('read', 'Admin')">
         <v-row>
                    <v-col cols="12" md="6" sm="6">
                        <h4>Create County Information</h4>
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
                        Pick State:
                </v-col>
                <v-col cols="12" md="5" sm="5">
                        <v-select
                            v-model="county.state"
                            :items="states"
                            label="State name"
                            item-text="state_name"
                            item-value="id"
                            return-object
                            required
                        ></v-select>
                </v-col>
        </v-row>
        <v-row>
                <v-col cols="12" md="2" sm="2"  offset-md="1">
                        County Name:
                </v-col>
                <v-col cols="12" md="5" sm="5">
                        <v-text-field
                        v-model="county.county_name"
                        size="2"
                        ></v-text-field>
                </v-col>
        </v-row>
        <v-row>
                <v-col cols="12" md="5" sm="5" offset-md="1">
                   <v-btn elevation="2" large v-on:click="createCounty">Save County Information</v-btn>
                </v-col>
        </v-row>
    </div>
</v-container>
</template>

<script>
    export default {
    created() {
            this.axios
                .get(`${process.env.MIX_API_URL}/public/index.php/api/admin/counties/create`,
                {
                  headers:
                  {
                      Authorization: `Bearer ${this.$store.getters.token}`,
                  }
                })
                .then(response => {
                    this.states = response.data.states;
                });
        },
    
    methods:{
    async createCounty(){
        try {  
          let res = await axios ({
            url: `${process.env.MIX_API_URL}/public/index.php/api/admin/counties`,
                    method: 'POST',
                    data: {
                        errors: [],
                        //should have the id represented.
                        //state: this.$data.county.state_id,
                        state:this.$data.county.state.id,
                        //working
                        //state: this.$data.site.county.id,   
                        county_name: this.$data.county.county_name,
                    }
          }).then(
                        response=>{
                                this.errors= response.data.error;
                                if(response.status=200 && response.data.error===undefined){
                                        this.$store.dispatch('setSuccessAlert','A successful new county has been created!!')
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
        }
        
        },
        data() {
            return {
                county:[],
                states:[],
                 breadcrumbOption: [
                    { 
                      text:'County Area',
                      disabled:false, 
                      to:'/admin/index#counties',
                    }, 
                    {
                    text: 'County Create',
                    disabled: true,
                    },
                ],
            }
        }
    }
</script>