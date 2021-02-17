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
           <td>{{students.item.id}}</td>
           <td>{{students.item.student_first_name}} {{students.item.student_last_name}}</td>
           <td></td>
           <td></td>
           <td>{{students.item.coordinator}}</td>
           <td>{{students.item.event}}</td>
           <td>
             <router-link :to="{name: 'showstudent', params: { id: students.item.id }}" class="btn btn-primary">Details
             </router-link>

             |
             <router-link :to="{name: 'edit', params: { id: students.item.id }}" class="btn btn-primary">Edit
              </router-link>
              |
              <button class="btn btn-danger" @click="deleteStudent(students.item.id)">Delete</button>
          </td>
        </tr>
  </template>
  
    <template v-slot:default>
      <thead>
        <tr>
           <th class="text-left">
            Student ID
          </th>
           <th class="text-left">
            Student Name
          </th>
          <th class="text-left">
            County
          </th>
          <th class="text-left">
              School Name
           </th>           
          <th class="text-left">
             Coordinator
           </th>
           <th class="text-left">
             Events
           </th>           
            <th class="text-left">
               Actions
            </th>
        </tr>
      </thead>
      <tbody>
           <tr v-if="overlay">
               <td colspan=9>
                    <!-- <v-progress-circular align="center"  :size="35" :width="5" indeterminate color="primary" /> -->
                <v-layout align-center justify-center column fill-height>
            <v-flex row align-center>
                <v-progress-circular indeterminate :size="50" color="primary" class=""></v-progress-circular>
            </v-flex>
        </v-layout>
               </td>
           </tr>
          <tr v-for="student in students" :key="student.id">
                 <td>{{student.id}}</td>
                 <td>{{ student.student_first_name }} {{ student.student_last_name }}</td>
                 <td v-for="myschool in student.school" >
                      {{myschool.school_county}}
                 </td>
                 <td v-for="myschool in student.school">
                      {{myschool.school_name}}
                 </td>
                 <td>Coordinator Here</td>
                 <td>Events</td>              
                <td>
                    <div class="btn-group" role="group">
                          <router-link :to="{name: 'showstudent', params: { id: student.id }}" class="btn btn-primary">Details
                          </router-link>
                        <router-link :to="{name: 'edit', params: { id: student.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deleteStudent(student.id)">Delete</button>
                    </div>
                </td>
            </tr>
      </tbody>  
    </template>
  </v-data-table>
</template>
  
<script>
    export default {
        mounted() {
            console.log('Student Table Component mounted.')
            this.overlay = true;
            console.log(this);
        },
         data() {
            return {
                headers:[
                  {
                  text: 'Student ID',
                  align: 'start',
                  sortable: false,
                  value: 'student_id',
                  },
          { text: 'Student Name', value: 'name' },
          { text: 'County', value: 'county' },
          { text: 'School Name', value: 'school_name' },
          { text: 'Coordinator', value: 'coordinator' },
          { text: 'Events', value: 'events' },
          { text: 'Actions', value: 'actions' },
                  
                ],
                students: [],
                search:'',
                overlay:true,
            }
        }, 
        //item has middleware on it.       
        created() {
            this.axios
                .get('http://localhost:9000/public/index.php/api/students')
                .then(response => {
                    this.students = response.data.students;
                    this.overlay = false;
                });
        },
        methods: {
            deleteStudent(id) {
                this.axios
                    .delete(`http://localhost:9000/public/index.php/api/students/${id}`)
                    .then(response => {
                        let item = this.students.map(item=>item.id).indexOf(id)
                        //Starts 
                        //console.log (this.students);

                        
                        //let i = this.students.map(item => item.id).indexOf(id); 
                        // find index of your object and remove it from our list of data.
                        //this in turn will remove it from our displayed table.
                        this.students.splice(item, 1)
                    });
            }
        }
    }
</script>
