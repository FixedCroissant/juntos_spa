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
           <td>
            <v-checkbox
                 v-model="parents.item.checked"
                 @change="addToList(parents.item.id,$event)"
              ></v-checkbox>
            </td>
           
           <td>
               <div v-if="parents.item.student">
                     {{parents.item.student.student_full_name}}
                </div>
           </td>
           <td>
               {{parents.item.parent_full_name}}
           </td>
           <td>{{parents.item.address_line_1}}</td>
           <td>{{parents.item.city}}</td>
           <td>{{parents.item.state}}</td>
           <td>{{parents.item.zip}}</td>
           <td style="width:200px">
             <router-link :to="{name: 'showparent', params: { id: parents.item.id }}" 
               elevation="2"
               x-small>
                Details
             </router-link>
              |
              <DeleteConfirmationComponent  style="padding-left:95px;"  v-bind:recordToRemove="parents.item.id" v-on:event_deletion="checkParentDeletion" />
          </td>
        </tr>
  </template>
  </v-data-table>
</template>

<script>
    import DeleteConfirmationComponent from './DeleteConfirmationComponent.vue';
    
    export default {
       components:{
                DeleteConfirmationComponent
        },
        mounted() {
            console.log('Parent Table Component mounted.')
            this.overlay = true;            
        },
         data() {
            return {
                headers:[
                    {
                    text:'Select'
                  },
                  {
                  text: 'Associated Student',
                  align: 'start',
                  sortable: true,
                  value: 'student.student_full_name',
                  },
          { text: 'Parent Full Name', value: 'parent_full_name' },
          { text: 'Address', value: 'address_line_1' },
          { text: 'City', value: 'city' },
          { text: 'State', value: 'state' },
          { text: 'Zip', value: 'zip' },
          { text: 'Actions', value: 'actions' },
                  
                ],
                parents: [],
                eventStudentListTotal:[],
                search:'',
                overlay:true,
            }
        }, 
        //item has middleware on it.       
        created() {
            this.axios
                .get(`${process.env.MIX_API_URL}/public/index.php/api/parents`)
                .then(response => {
                    this.parents = response.data.parents;
                    this.overlay = false;
                });
        },
        methods: {
          checkParentDeletion(value){
            console.log('From child component, person really wanted to delete a record.' + value);

           //Call our delete method.
           //Fully delete the parent record.
           this.deleteParent(value);

          },
          addToList(id,event){
                this.parents.forEach(myParent => {
                        if(myParent.checked && event==true){                           
                          this.eventStudentListTotal.indexOf(myParent.id)==-1 ? this.eventStudentListTotal.push(myParent.id) : "---"; 
                        }
                });
              
                //Unchecked Item.
                if(event==false){
                  var index = this.eventStudentListTotal.indexOf(id);
                      this.eventStudentListTotal.splice(index, 1);
                }
                
                //send information back to the parent component using the dummy method below.
                //Get total list of people select.
                //See below function.
                this.addParent(this.eventStudentListTotal);
          }, 
            //Send event information back to the main page.
            addParent(value){
                //Send to parent component.
                //Todo -rename function to something more appropriate.
                this.$emit('event_parent_creation',value)
            },
            deleteParent(id) {
                this.axios
                    .delete(`${process.env.MIX_API_URL}/public/index.php/api/parents/${id}`)
                    .then(response => {
                        //Remove our parents from our table.                        
                        let itemInTable = this.parents.map(item=>item.id).indexOf(id);
                        this.parents.splice(itemInTable, 1);

                        if(response.status==200){
                                                          //Call main success message.
                                                          this.$store.dispatch('setSuccessAlert','Successfully Deleted Parent Information.')
                                                          // Remove alert
                                                          setTimeout(() => {
                                                                        this.$store.dispatch('removeSuccessAlert')
                                                          }, 7000)
                                                  }

                    });
            }
        }
    }
</script>
