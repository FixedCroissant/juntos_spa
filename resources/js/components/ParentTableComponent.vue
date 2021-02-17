  <template> 
  <v-data-table
    :headers="headers" 
    :items-per-page="5"
    :items="parents"
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
  <template v-slot:item="parents">
        <tr>
           <td>{{parents.item.student_id}}</td>
           <td>{{parents.item.parent_first_name}} {{parents.item.parent_last_name}}</td>
           <td>{{parents.item.address_line_1}}</td>
           <td>{{parents.item.city}}</td>
           <td>{{parents.item.state}}</td>
           <td>{{parents.item.zip}}</td>
           <td>
             <router-link :to="{name: 'showparent', params: { id: parents.item.id }}" class="btn btn-primary">Details
             </router-link>

             |
             <router-link :to="{name: 'edit', params: { id: parents.item.id }}" class="btn btn-primary">Edit
              </router-link>
              |
              <button class="btn btn-danger" @click="deleteParent(parents.item.id)">Delete</button>
          </td>
        </tr>
  </template>
  </v-data-table>
</template>

<script>
    export default {
        mounted() {
            console.log('Parent Table Component mounted.')
            this.overlay = true;
            console.log(this);
        },
         data() {
            return {
                headers:[
                  {
                  text: 'Associated Student',
                  align: 'start',
                  sortable: false,
                  value: 'student_id',
                  },
          { text: 'Parent Name', value: 'name' },
          { text: 'Address', value: 'address_line_1' },
          { text: 'City', value: 'city' },
          { text: 'State', value: 'state' },
          { text: 'Zip', value: 'zip' },
          { text: 'Actions', value: 'actions' },
                  
                ],
                parents: [],
                search:'',
                overlay:true,
            }
        }, 
        //item has middleware on it.       
        created() {
            this.axios
                .get('http://localhost:9000/public/index.php/api/parents')
                .then(response => {
                    this.parents = response.data.parents;
                    this.overlay = false;
                });
        },
        methods: {
            deleteParent(id) {
                this.axios
                    .delete(`http://localhost:9000/public/index.php/api/parent/${id}`)
                    .then(response => {
                        let item = this.parents.map(item=>item.id).indexOf(id)
                       
                       this.parents.splice(item, 1)
                    });
            }
        }
    }
</script>
