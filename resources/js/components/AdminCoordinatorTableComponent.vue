  <template> 
  <v-data-table
    :headers="headers" 
    :items-per-page="5"
    :items="users"
    :search="search"
    class="elevation-1"
  >
  <template v-slot:top>
        <v-text-field
          v-model="search"
          label="Search"
          class="mx-4"
        ></v-text-field>
  </template>
  <template v-slot:item="users">
        <tr>
           <td>
                {{users.item.name}}
           </td>
           <td>
                {{users.item.email}}
           </td>
           <td>
                <div v-for="role in users.item.roles">
                     {{role.name}}
                </div>
            </td>
            <td>
                <router-link :to="{name: 'editUser', params: { id: users.item.id }}" class="btn btn-primary">Edit</router-link>
                | Delete
            </td>
        </tr>
  </template>
  </v-data-table>
</template>

<script>
    export default {
        mounted() {
            console.log('Admin Coordinator Table Component Loaded.');
        },
         data() {
            return {
                headers:[
                        { text: 'Name', value: 'name' },
                        { text: 'Email Address', value: 'email' },
                        { text: 'Site Assigned', value: 'roles' },
                        { text: 'Actions', value: 'actions' },
                ],
                users: [],
                search:'',
            }
        }, 
        created() {  
            this.axios.get(`${process.env.MIX_API_URL}/public/index.php/api/admin/users`)
                .then(response => {
                    this.users = response.data.users;
                });
        },
        methods: {
            
        }
    }
</script>
