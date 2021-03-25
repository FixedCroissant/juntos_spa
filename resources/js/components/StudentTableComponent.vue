  <template> 
  <v-data-table
    :headers="headers" 
    :items-per-page="5"
    :items="students"
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

  <template v-slot:item="students">
        <tr>
           <td> <v-checkbox
                 v-model="students.item.checked"
                 @change="addToList(students.item.id,$event)"
                
              ></v-checkbox>
          </td>
           <td> {{students.item.id}}</td>
           <td>{{students.item.student_full_name}}</td>
           <td>{{students.item.student_email}}</td>
           <td>
              <div v-if="students.item.school_county">
              {{students.item.school_county}}
             </div>
             <div v-else>
               No school.
              </div>
           </td>
           <td>
             <div v-if="students.item.school_name">
              {{students.item.school_name}}
             </div>
             <div v-else>
               No school.
              </div>
           </td>
           <td>{{students.item.coordinator}}</td>
           <td>
             <router-link :to="{name: 'showstudent', params: { id: students.item.id }}" class="btn btn-primary">Details
             </router-link>
              <div v-if="$can('create', 'Post')">
              |
              <button class="btn btn-danger" @click="deleteStudent(students.item.id)">Delete</button>
              </div>
          </td>
        </tr>
  </template>
  </v-data-table>
</template>
<script>
    export default {
        mounted() {
            console.log('Student Table Component mounted.')
            this.overlay = true;
        },

         data() {
            return {
                headers:[
                  {
                    text:'Select'
                  },
                  {
                  text: 'Student ID',
                  align: 'start',
                  sortable: false,
                  value: 'stu_id',
                  },
                { text: 'Student Name', value: 'student_full_name' },
                 {text:'Email',value:'student_email'},  
                { text: 'County', value: 'school_county' },
                { text: 'School Name', value: 'school_name' },
                { text: 'Coordinator', value: 'coordinator' },
                { text: 'Actions', value: 'actions' },
                  
                ],
                students: [],
                eventStudentListTotal:[],
                search:'',
                overlay:true,
            }
        }, 
        //item has middleware on it.       
        created() {
            this.axios
                .get(`${process.env.MIX_API_URL}/public/index.php/api/students`,
                {
                  headers:
                  {
                      Authorization: `Bearer ${this.$store.getters.token}`,
                  }
                })
                .then(response => {
                    this.students = response.data.students;
                    this.overlay = false;
                });

           
        },
        methods: {
           addToList(id,event){
                this.students.forEach(myStudent => {
                        if(myStudent.checked && event==true){
                          this.eventStudentListTotal.indexOf(myStudent.id)==-1 ? this.eventStudentListTotal.push(myStudent.id) : "---"; 
                        }
                });
                //Unchecked Item.
                if(event==false){
                  var index = this.eventStudentListTotal.indexOf(id);
                      this.eventStudentListTotal.splice(index, 1);
                }

                //See what's in my list.
                //console.log(this.eventStudentListTotal);
                //How many people are selected to be added?
                //console.log(this.eventStudentListTotal.length);


                //send information back to the parent component using the dummy method below.
                //Get total list of people select.
                //See below function.
                this.addParent(this.eventStudentListTotal);

          }, 
            //Send event information back to the main page.
           addParent(value){
              //Send to parent component.
              //Todo -rename function to something more apprpriate.
                this.$emit('event_parent_creation', value)
            },
            deleteStudent(id) {
                this.axios
                    .delete(`${process.env.MIX_API_URL}/public/index.php/api/students/${id}`)
                    .then(response => {
                        let item = this.students.map(item=>item.id).indexOf(id)                      
                        this.students.splice(item, 1)
                    });
            }
        }
    }
</script>
