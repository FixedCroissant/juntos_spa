<template> 
  <v-data-table
    :headers="headers" 
    :items-per-page="5"
    :items="counties"
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
  <template v-slot:item="counties">
        <tr>
           <td>
                {{counties.item.state.state_name}}
           </td>
           <td>
               {{counties.item.county_name}}
           </td>
            <td>
                 <router-link :to="{name: 'editCounty', params: { id: counties.item.id }}" >Edit</router-link>
                | 
                 <DeleteConfirmationComponent v-bind:recordToRemove="counties.item.id" 
                v-on:event_deletion="checkCountyDeletion" /> 
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
            console.log('Admin County Table Component Loaded.');
        },
         data() {
            return {
                headers:[
                        { text: 'State', value: 'county_name' },
                        { text: 'County', value: 'county_name' },
                        { text: 'Actions', value: 'actions' },
                ],
                counties: [],
                search:'',
            }
        }, 
        created() {  
            this.axios.get(`${process.env.MIX_API_URL}/public/index.php/api/admin/counties`)
                .then(response => {
                    this.counties = response.data.counties;
                });
        },
        methods: {
            checkCountyDeletion(value){
                this.deleteCounty(value);
            },
            deleteCounty(id){
                this.axios
                .delete(`${process.env.MIX_API_URL}/public/index.php/api/admin/counties/${id}`)
                    .then(response => {
                        let county = this.counties.map(site=>site.id).indexOf(id);                      
                        this.counties.splice(county, 1);
                        
                        this.$store.dispatch('setSuccessAlert','County Deleted')
                                setTimeout(() => {
                                        this.$store.dispatch('removeSuccessAlert')
                                }, 7000)
                    });
            }
            
        }
    }
</script>
