<template> 
  <v-data-table
    :headers="headers" 
    :items-per-page="5"
    :items="sites"
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
  <template v-slot:item="sites">
        <tr>
           <td>
                {{sites.item.county.county_name}}
           </td>
           <td>
                {{sites.item.site_name}}
           </td>
            <td>
                 <router-link :to="{name: 'editSite', params: { id: sites.item.id }}" >Edit</router-link>
                | 
                <DeleteConfirmationComponent v-bind:recordToRemove="sites.item.id" 
                v-on:event_deletion="checkSiteDeletion" />
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
            console.log('Admin Site Table Component Loaded.');
        },
         data() {
            return {
                headers:[
                        { text: 'County', value: 'county.county_name' },
                        { text: 'Site', value: 'site_name' },
                        { text: 'Actions', value: 'actions' },
                ],
                sites: [],
                search:'',
            }
        }, 
        created() {  
            this.axios.get(`${process.env.MIX_API_URL}/public/index.php/api/admin/sites`)
                .then(response => {
                    this.sites = response.data.sites;
                });
        },
        methods: {
            checkSiteDeletion(value){
                this.deleteSite(value);
            },
            deleteSite(id) {
                this.axios
                    .delete(`${process.env.MIX_API_URL}/public/index.php/api/admin/sites/${id}`)
                    .then(response => {
                        let site = this.sites.map(site=>site.id).indexOf(id);                      
                        this.sites.splice(site, 1);
                        
                        this.$store.dispatch('setSuccessAlert','Site Deleted')
                                setTimeout(() => {
                                        this.$store.dispatch('removeSuccessAlert')
                                }, 7000)
                    });
            }


        }
    }
</script>
