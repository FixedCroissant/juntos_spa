<template>
<v-container>
     <div v-if="$can('read', 'Admin')">
         <v-row>
                    <v-col cols="12" md="6" sm="6">
                        <h4>Create State Information</h4>
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
                        State Abbreviation:
                </v-col>
                <v-col cols="12" md="5" sm="5">
                        <v-text-field
                        v-model="state.state_abbreviation"
                        size="2"
                        maxlenth="2"
                        ></v-text-field>
                </v-col>
        </v-row>
        <v-row>
                <v-col cols="12" md="2" sm="2"  offset-md="1">
                        State Name:
                </v-col>
                <v-col cols="12" md="5" sm="5">
                        <v-text-field
                        v-model="state.state_name"
                        size="2"
                        ></v-text-field>
                </v-col>
        </v-row>
        <v-row>
                <v-col cols="12" md="5" sm="5" offset-md="1">
                   <v-btn elevation="2" large v-on:click="createState">Create State</v-btn>
                </v-col>
        </v-row>
    </div>
</v-container>
</template>

<script>
    export default {
    created() {
            
        },
    
    methods:{
    async createState(){
        try {  
          let res = await axios ({
            url: `${process.env.MIX_API_URL}/public/index.php/api/admin/states`,
                    method: 'POST',
                    data: {
                        errors: [],
                        state_abbreviation: this.$data.state.state_abbreviation,
                        state_name: this.$data.state.state_name,
                    }
          }).then(
                        response=>{
                                this.errors= response.data.error;
                                if(response.status=200 && response.data.error===undefined){
                                        this.$store.dispatch('setSuccessAlert','A new state has been created!')
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
                state:[],
                 breadcrumbOption: [
                    { 
                      text:'State Area',
                      disabled:false, 
                      to:'/admin/index#states',
                    }, 
                    {
                    text: 'State Create',
                    disabled: true,
                    },
                ],
            }
        }
    }
</script>