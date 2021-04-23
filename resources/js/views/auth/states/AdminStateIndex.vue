<template> 
  <v-data-table
    :headers="headers" 
    :items-per-page="5"
    :items="states"
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
  <template v-slot:item="states">
        <tr>
           <td>
                {{states.item.state_name}}
           </td>
           
            <td> 
                 <router-link :to="{name: 'editState', params: { id: states.item.id }}" >Edit</router-link>
                | 
                <DeleteConfirmationComponent v-bind:recordToRemove="states.item.id" v-on:event_deletion ="checkStateDeletion"
                />
            </td>
        </tr>
  </template>
  </v-data-table>
</template>

<script>
    import DeleteConfirmationComponent from '../../../components/DeleteConfirmationComponent.vue';
  
    export default {
        components:{
            DeleteConfirmationComponent
        },
        mounted() {
            console.log('Admin State Table Component Loaded.');
        },
         data() {
            return {
                headers:[
                        { text: 'State', value: 'state_name' },
                        { text: 'Actions', value: 'actions' },
                ],
                states: [],
                search:'',
            }
        }, 
        created() {  
            this.axios.get(`${process.env.MIX_API_URL}/public/index.php/api/admin/states`)
                .then(response => {
                    this.states = response.data.states;
                });
        },
        methods: {
            checkStateDeletion(value){
                this.deleteState(value);
            },
            deleteState(id) {
                this.axios
                    .delete(`${process.env.MIX_API_URL}/public/index.php/api/admin/states/${id}`)
                    .then(response => {
                        let mystate = this.states.map(state=>state.id).indexOf(id);                      
                        this.states.splice(mystate, 1);
                        
                        this.$store.dispatch('setSuccessAlert','State Deleted')
                                setTimeout(() => {
                                        this.$store.dispatch('removeSuccessAlert')
                                }, 7000)
                    });
            }
        }
    }
</script>
