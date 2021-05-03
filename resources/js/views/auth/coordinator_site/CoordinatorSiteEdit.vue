<template>
<v-container>
     <div v-if="$can('read', 'Admin')">
       <v-row>
                    <v-col cols="12" md="6" sm="6">
                        <h4>Edit Coordinator Assignment</h4>
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
                        Account Created:
                </v-col>
                <v-col cols="12" md="5" sm="5">
                       {{user.created_at |formatDate}}
                </v-col>
        </v-row>
        <v-row>
                <v-col cols="12" md="2" sm="2"  offset-md="1">
                        Name:
                </v-col>
                <v-col cols="12" md="4" sm="5">
                         <v-text-field
                                    v-model="user.name"
                                ></v-text-field>
                </v-col>
        </v-row>
        <v-row>
                <v-col cols="12" md="2" sm="2"  offset-md="1">
                        E-Mail Address/Login:
                </v-col>
                <v-col cols="12" md="4" sm="5">
                        <v-text-field
                                    v-model="user.email"
                        ></v-text-field>
                </v-col>
        </v-row>
        <v-row>
                <v-col cols="12" md="2" sm="2"  offset-md="1">
                        Reset Password:
                </v-col>
                <v-col cols="12" md="4" sm="5">
                        Click to send password reset email. <br/> 
                        Not completed!
                </v-col>
        </v-row>
        <v-row>
                <v-col cols="12" md="2" sm="2"  offset-md="1">
                        Current Roles for User:
                </v-col>
                <v-col cols="12" md="4" sm="5">
                     <template v-for="roles,i in myUserRolesSorted">
                        <!-- {{roles}} -->
                            <v-switch
                            v-model="roles.checked"
                            :label="roles.name"
                        ></v-switch>
                    </template>
                </v-col>
        </v-row>
        <v-row>
             <v-col cols="12" md="4" sm="2"  offset-md="2">
                        <v-btn class="primary" v-on:click="updateRoleInformation">Update Site Assignment</v-btn>
                </v-col>
        </v-row>

    </div>
</v-container>
   
</template>

<script>
   

    export default {
        created() {
            this.axios
                .get(`${process.env.MIX_API_URL}/public/index.php/api/admin/user/${this.$route.params.id}/edit`,
                               
                {
                  headers:
                  {
                      Authorization: `Bearer ${this.$store.getters.token}`,
                  }
                })
                .then(response => {
                    this.user = response.data.user;    
                    this.availableRoles = response.data.roles; 
                    this.userRole=response.data.mainCollection;              
                });
        },
        methods:{            
        async updateRoleInformation(){

            try {
                    let res = await axios ({
                                        url: `${process.env.MIX_API_URL}/public/index.php/api/admin/user/${this.$route.params.id}/role`,
                                        method: 'POST',
                                        data: {
                                                            user:this.user,
                                                            roles:this.userRole
                                             },
                                        headers:
                                        {
                                            Authorization: `Bearer ${this.$store.getters.token}`,
                                        }
                                        }).then(
                                        response=>{
                                                this.errors= response.data.error;
                                                if(response.status=200 && response.data.error===undefined){
                                                            
                                                            this.$store.dispatch('setSuccessAlert','Updated User Information!');
                                                        
                                                             setTimeout(() => {
                                                                            this.$store.dispatch('removeSuccessAlert')
                                                              }, 5000)
                                                    //End Notifications.   
                                                }
                                    }

                                )
                        }
                        catch(err){
                                                alert(err);
                        }
                }//updateRoleInformation
        },//methods.
        
        data() {
            return {
                user:'',
                userRole:[],
                availableRoles:[],
                breadcrumbOption: [
                    { 
                      text:'Coordinator Site Asignment',
                      disabled:false, 
                      to:{name: 'adminIndex'}
                    }, 
                    {
                    text: 'User Edit',
                    disabled: true,
                    },
                ],
            }
        }
    }
</script>