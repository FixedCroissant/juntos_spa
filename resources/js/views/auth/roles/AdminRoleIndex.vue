<template>
<v-container>
     <div v-if="$can('read', 'Admin')">
       <v-row>
                    <v-col cols="12" md="6" sm="6">
                        <h3>Role Information</h3>
                    </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" md="10" offset-md="1">
                        <template>
                                    <v-simple-table>
                                        <template v-slot:default>
                                        <thead>
                                            <tr>
                                            <th class="text-left">
                                                Date Created
                                            </th>
                                            <th class="text-left">
                                                Role Name
                                            </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                            v-for="myRole in roles"
                                            :key="myRole.id"
                                            >
                                            <td>{{ myRole.created_at | formatDate }}</td>
                                            <td>{{ myRole.name }}</td>
                                            </tr>
                                        </tbody>
                                        </template>
                                    </v-simple-table>
                        </template>
                    </v-col>
        </v-row>

        <v-row>
              <v-col cols="12" md="10" offset-md="1">
                    <p>
                        Ability to update name will come soon, these are the default options available.  
                    </p>
             </v-col>
        </v-row>
    </div>
</v-container>
   
</template>

<script>
   

    export default {
        created() {
            this.axios
                .get(`${process.env.MIX_API_URL}/public/index.php/api/admin/user/roles/index`,
                               
                {
                  headers:
                  {
                      Authorization: `Bearer ${this.$store.getters.token}`,
                  }
                })
                .then(response => {
                    this.roles = response.data.roles;
                });
        },
        methods:{            
        
        },
        computed: {
             myUserRolesSorted: function () {
                return this.userRole.sort((a,b)=>(a.id) - (b.id));
            }
        },
        data() {
            return {
                roles:[],
            }
        }
    }
</script>