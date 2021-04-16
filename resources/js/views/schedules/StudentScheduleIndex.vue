<template>
<v-container>
     <div v-if="$can('read', 'Admin')">
       <v-row>
                    <v-col cols="12" md="6" sm="6">
                        <h3>Student Schedule List</h3>
                           
                        <p>
                        </p>
                    </v-col>
        </v-row>
        <br/>
        <br/>
        
        
        <v-row>
            <!-- {{this.schedules}} -->
            <v-col cols="6" md="3" offset-md="1">
                    <h4>{{studentName.student_first_name}} {{studentName.student_last_name}}</h4>


                            Year: {{this.year}} <br/>
                            <br/>
                            
            </v-col>
                    
            <!-- <v-col cols="6" md="5">
                    Semester: 
            </v-col> -->
        </v-row>
        <!--Data-->
        <!--Handle if nothing exists-->
        <v-row v-if="this.schedules.length==0">
            <v-col cols="6" md="3" offset-md="1">
                        No Schedule Exists for student.
                                    <v-select
                                            :items="yearSchedule"
                                            v-model="newYearSchedule"
                                            label="Create Schedule with Year:"
                                            :selected="2020"
                                            item-text="year_date"
                                            item-value="year_date"
                                        ></v-select>
                                        <br/>
                                          <v-btn elevation="2" v-on:click="addSchedule()">Create New Schedule</v-btn>
            </v-col>    
        </v-row>
        <v-row 
        v-for="(mySchedule,mainIndex,myKey) in schedules"
        :key="mySchedule.id"
        >
        <!-- My main index here for each parts of the array. -->
        <!-- {{mainIndex}} -->
<v-col cols="12" md="12" offset-md="0">
 <v-simple-table dense>
    <template v-slot:default>
         <thead class="grey lighten-4">
             <th colspan="9" >
                 Year: 
                        <span v-for="(value,index,key) in mySchedule.slice(0,1)">
                        {{value.semester_year}}

                        
                        </span>

                            <!-- <span  v-for="(value,index,key) in schedules">
                        {{index}} {{key}}
                        </span> -->
            </th>
         </thead>
      <thead class="grey lighten-4">
                            <th>
                                 Semester
                             </th>
                             <th>
                                 Period
                             </th>
                             <th>
                                 Grade
                             </th>
                             <th>
                                 Class
                             </th>
                             <th>
                                 Teacher 
                             </th>
                             <th>
                                 Room 
                             </th>
                             <th>
                                 Notes 
                             </th>
                              <th>
                                 Final Grade 
                             </th>
                             <th>
                                 Actions 
                             </th>
                        </thead>
                        <tbody>
                       
                        <tr
                        v-for="(val,key,index) of mySchedule"
                        :key="val.id"
                        style="text-align:center;"
                        >   <td>
                              <!-- {{key}} -->
                              <!-- {{index}} -->
                              <!-- {{val.id}} -->
                                    <span v-if="val.newItem==true">
                                                    <v-select
                                                     v-model="newSemester[val.id]"
                                                    :items="semester"
                                                    width=10
                                                    label="Semester"
                                                    required 
                                                    ></v-select>                                       
                                 </span>
                                <span v-if="val.editable==true">
                                                 <v-select
                                                  v-model="val.semester_number"
                                                    :items="semester"
                                                    :selected="1"
                                                    width=10
                                                    label="Semester"
                                                    required 
                                                    ></v-select>
                                </span>
                                  <span v-else>
                                   {{val.semester_number}}
                                  </span>
                                                              
                            </td>
                            <td>
                               
                                 <span v-if="val.newItem==true">
                                                    <v-select
                                                    v-model="newPeriod[val.id]"
                                                    :items="period"
                                                    width=10
                                                    label="Period"
                                                    required 
                                                    ></v-select>
                                       
                                 </span>
                                       <span v-if="val.editable==true">
                                                 <v-select
                                                    v-model="val.period_id"
                                                    :items="period"
                                                    :selected="1"
                                                    width=10
                                                    label="Period"
                                                    required 
                                                    ></v-select>
                                       </span>
                                <span v-else>
                                                {{val.period_id}}
                                 </span>
                            </td>
                            <td>
                                <span v-if="val.newItem==true">
                                        <v-select
                                                     v-model="newGrade[val.id]"
                                                    :items="grades"
                                                    width=10
                                                    item-text="grade"
                                                    item-value="abbr"
                                                    label="Grade"
                                                    return-object
                                                    single-line
                                                    required 
                                                    ></v-select>
                                 </span>
                                 <span v-if="val.editable==true">
                                                 <v-select
                                                    v-model="val.grade"
                                                    :items="grades"
                                                    width=10
                                                    item-text="grade"
                                                    item-value="abbr"
                                                    label="Grade"
                                                    return-object
                                                    single-line
                                                    required 
                                                    ></v-select>
                                </span>
                                  <span v-else>
                                 {{val.grade}}
                                 </span>
                            </td>
                            <td>
                                <span v-if="val.newItem==true">
                                         <v-text-field
                                            v-model="newClassName[val.id]"
                                            label="Class"
                                        ></v-text-field>
                                 </span>
                                        <span v-if="val.editable==true">
                                                <v-text-field
                                                v-model="val.class_name"
                                                label="Class"
                                            ></v-text-field>
                                        </span>
                                <span v-else>
                                 {{val.class_name}}
                                </span>
                                
                            </td>
                            <td>
                                <span v-if="val.newItem==true">
                                      <v-text-field
                                        v-model="newTeacherName[val.id]"
                                        label="Teacher"
                                    ></v-text-field>
                                 </span>
                                 <span v-if="val.editable==true">
                                        <v-text-field
                                        v-model="val.teacher_name"
                                        label="Teacher"
                                    ></v-text-field>
                                </span>
                                <span v-else>
                                  {{val.teacher_name}}
                                </span>
                            </td>
                            <td style="text-align:center;">
                                <span v-if="val.newItem==true">
                                            <v-text-field
                                            v-model="newRoomName[val.id]"
                                            label="Room"
                                        ></v-text-field>
                                 </span>
                                 <span v-if="val.editable==true">
                                        <v-text-field
                                        v-model="val.room_number"
                                        label="Class"
                                    ></v-text-field>
                                 </span>
                                  <span v-else>
                                    {{val.room_number}}
                                  </span>
                            </td>
                            <td style="text-align:center;">
                                <span v-if="val.newItem==true">
                                            <v-text-field
                                            v-model="newNotes[val.id]"
                                            label="Notes"
                                        ></v-text-field>
                                 </span>
                                 <span v-if="val.editable==true">
                                        <v-text-field
                                        v-model="val.notes_lunch_period"
                                        label="Notes"
                                    ></v-text-field>
                                 </span>
                                  <span v-else>
                                    {{val.notes_lunch_period}}
                                  </span>
                            </td>
                            <td>
                                <span v-if="val.newItem==true">
                                       <v-form v-model="isFormValid">
                                            <v-text-field
                                            v-model="newAcademicGrade[val.id]"
                                            label="Academic Grade"
                                             :rules="academicGradeRules"
                                            type="number"
                                            min="1"
                                            max="100"
                                            ></v-text-field>
                                        </v-form>
                                 </span>
                                <span v-if="val.editable==true">
                                    <v-form v-model="isFormValid">
                                            <v-text-field
                                                v-model="val.academic_grade"
                                                :rules="academicGradeRules"
                                                type="number"
                                                min="1"
                                                max="100"
                                            >   
                                            </v-text-field>
                                    </v-form>
                                 </span>
                                  <span v-else>
                                  {{val.academic_grade}}
                                </span>
                            </td>
                            <td style="text-align:right;">

                                     <span  v-for="(value,index,key) in schedules">
                                            <!-- {{index}}


                                            {{mySchedule}} -->
                                             <!-- {{mySchedule[index]}} -->
                                            <!-- {{mySchedule.indexOf(index) == -1 ? "found" : "not found" }} -->
                                     </span>

                                     <!-- <span v-for="(value,index,key) in mySchedule.slice(0,1)">
                                        {{value.semester_year}} {{key}}
                                        </span> -->
                                <span v-if="val.newItem==true" >
                                    <!-- {{val.semester_year}} -->
                                        <v-btn :disabled="!isFormValid" v-on:click="createClass(key,val.id,val.semester_year)">Create</v-btn>
                                        
                                            <!-- array is:
                                            {{key}}

                                            unique id of object is:
                                            {{val.id}} -->
                                        
                                </span>
                                <span v-if="val.editable==true && val.newItem!=true">
                                            <v-btn :disabled="!isFormValid" v-on:click="updateClass(val.id,mainIndex,key)">Update Class</v-btn>
                                </span>
                                <span v-if="val.editable!=true && val.newItem!=true">
                                            <a v-on:click="addClass(mainIndex,val.id)">Add</a> |
                                            <a v-on:click="editClass(val.id,mainIndex,key)">Edit</a> |
                                            <DeleteConfirmationComponent v-bind:recordToRemove="[val.id,mainIndex,key]" v-on:event_deletion="checkClassDeletion" />
             
                                </span>
                                <!-- For Debug
                                {{key}} -->
                                
                            </td>
                        </tr>
                        </tbody>
                        </template>
        </v-simple-table>
    </v-col>
</v-row>
        
        
    </div>
</v-container>
   
</template>

<script>
import DeleteConfirmationComponent from '../../components/DeleteConfirmationComponent.vue';
    export default {
         components:{
                DeleteConfirmationComponent
        },
        created() {
            this.axios
                .get(`${process.env.MIX_API_URL}/public/index.php/api/schedule/index/` + this.$route.params.id,                               
                {
                  headers:
                  {
                      Authorization: `Bearer ${this.$store.getters.token}`,
                  }
                })
                .then(response => {
                    this.schedules = response.data.schedules;
                    console.log(this.schedules);
                    this.year = response.data.year;
                    this.studentName=response.data.studentInformation;
                });
        },
        methods:{
            checkClassDeletion(value){
               this.deleteClass(value[0],value[1],value[2]);
            },
            //Update our selected class in the table.
            async updateClass(id,mainIndex,key){

                         let itemInTable = this.schedules[mainIndex].map(item=>item.id).indexOf(id);
                         //Let's make sure we're adjusting the class we need in our table.
                         //Array Number.
                         //console.log(itemInTable);

                         //Remove editable.
               

                          try {  
                                let res = await axios ({
                                url: `${process.env.MIX_API_URL}/public/index.php/api/schedule/class/${id}/update`,
                                        method: 'POST',
                                        data: {
                                                errors: [],
                                                student_id: this.schedules[mainIndex][itemInTable].student_id,
                                                period_id:this.schedules[mainIndex][itemInTable].period_id,
                                                semester_year:this.schedules[mainIndex][itemInTable].semester_year,
                                                class_name:this.schedules[mainIndex][itemInTable].class_name,
                                                semester_number:this.schedules[mainIndex][itemInTable].semester_number,
                                                schedule_type:this.schedules[mainIndex][itemInTable].schedule_type,
                                                grade:this.schedules[mainIndex][itemInTable].grade,
                                                teacher_name:this.schedules[mainIndex][itemInTable].teacher_name,
                                                room_number:this.schedules[mainIndex][itemInTable].room_number,
                                                notes_lunch_period:this.schedules[mainIndex][itemInTable].notes_lunch_period,
                                                academic_grade:this.schedules[mainIndex][itemInTable].academic_grade
                                              },
                                    }).then(
                        response=>{
                                                    this.errors= response.data.error;
                                                    if(response.status=200 && response.data.error===undefined){
                                                            this.$store.dispatch('setSuccessAlert','Updated Class Information');
                                                            this.schedules[mainIndex][itemInTable].editable=false;
                                                            setTimeout(() => {
                                                                    this.$store.dispatch('removeSuccessAlert')
                                                            }, 3000)
                                                    }

                                else
                                {
                                                //Set error alert.
                                                this.$store.dispatch('setErrorAlert','You are missing required fields, please retry submitting.')
                                                //Remove Error Alert.
                                                setTimeout(() => {
                                                        this.$store.dispatch('removeErrorAlert')
                                                }, 5000)
                                
                                }
                                                
                            }
          
          )
        }
                                catch(err){
                                alert(err);
                                }//end catch

            },
            deleteClass(id,mainIndex,key) {
                this.axios
                    .delete(`${process.env.MIX_API_URL}/public/index.php/api/schedule/class/${id}/remove`)
                    .then(response => {
                        //ID above is the unique ID of the record.
                        //console.log(this.schedules[mainIndex][key]);

                        //Map it with our id that we passed.
                        //Working; will show up the id in the array where the item matches.
                        //console.log(this.schedules[mainIndex].map(item=>item.id).indexOf(id))

                        let itemInTable = this.schedules[mainIndex].map(item=>item.id).indexOf(id);
                        //REmove the item from our table as it has been removed.
                        this.schedules[mainIndex].splice(itemInTable, 1);


                        if(response.status==200){
                                                          //Call main success message.
                                                          this.$store.dispatch('setSuccessAlert','Successfully deleted class.')
                                                          // Remove alert
                                                          setTimeout(() => {
                                                                        this.$store.dispatch('removeSuccessAlert')
                                                          }, 7000)
                                                  }
                                                  //repull data, so that hey have it after the update.
                                                this.repullInformation();

                    });
            },    
            repullInformation(){
                this.axios
                .get(`${process.env.MIX_API_URL}/public/index.php/api/schedule/index/` + this.$route.params.id,                               
                {
                  headers:
                  {
                      Authorization: `Bearer ${this.$store.getters.token}`,
                  }
                })
                .then(response => {
                    this.schedules = response.data.schedules;
                    this.year = response.data.year;
                    this.studentName=response.data.studentInformation;
                });
            },
            //currentID is the same as val.id that is passed.
            //semesterYear is the year that is passed by the method.
            async createClass(key,currentID,semesterYear){
                    let year = semesterYear;
                  try {
                    let res = 
                            await axios ({
                                        url: `${process.env.MIX_API_URL}/public/index.php/api/schedule/store`,
                                        method: 'POST',
                                        data: {
                                                            student_id: this.$data.studentName.id,
                                                            period_id:this.$data.newPeriod[currentID],
                                                            semester_year: year,
                                                            semester_number: this.$data.newSemester[currentID],
                                                            schedule_type:"Block",
                                                            grade:this.$data.newGrade[currentID].abbr,
                                                            class_name:this.$data.newClassName[currentID],
                                                            teacher_name:this.$data.newTeacherName[currentID],
                                                            room_number:this.$data.newRoomName[currentID],
                                                            notes_lunch_period:this.$data.newNotes[currentID],
                                                            academic_grade:this.$data.newAcademicGrade[currentID]
                                         
                                        },
                                        headers:
                                        {
                                            Authorization: `Bearer ${this.$store.getters.token}`,
                                        }
                                        }).then(
                                        //Get Result.
                                        response=>{
                                                this.errors= response.data.error;
                                         
                                                if(response.status=200 && response.data.error===undefined){
                                                            this.$store.dispatch('setSuccessAlert','Created new class.')
                                                            setTimeout(() => {
                                                                        this.$store.dispatch('removeSuccessAlert')
                                                            }, 4000)
                                                        }
                                                
                                                //repull data, so that hey have it after the update.
                                                this.repullInformation();
                                        }

                                )
                        }
                                        catch(err){
                                                                alert(err);
                                        }
                    },
            editClass(id,mainIndex,key){

                //Our specific id
                let updateID = id;

                 //Our current item.
                let currentItem = mainIndex;
                //Our current row
                let currentRow = key;

                //console.log("ID passed: " + id);
               
                 //let itemInTable = this.schedules[mainIndex].map(item=>item.id).indexOf(id);
                 //working  
                 let itemInTable = this.schedules[mainIndex].map(item=>item.id).indexOf(id);

                //Display record.
                 //console.log(itemInTable);
            
                //Our specific item record clicked.
               // console.log(this.schedules[mainIndex][itemInTable]);

                
                //Correctly update field with reactivity in VUE.
                //first parameter is the Object and the fields to adjust.
                this.$set(this.schedules[mainIndex][itemInTable], 'editable', true);

            },
            //Temporary add a class in the list before actually saving it.       
            addClass(key,currentID){
                //console.log("key, index should follow: " +"key is :" + key + "currentID is  " + currentID);

               
                
                //Our current item.
                let currentItem = currentID;
                //Our current row
                let currentRow = key;

                //Get more data, what was in the prior element?
                let lastItem = this.schedules[currentRow].length;

                //Find the year of the last item.
                let contentsOfLastItem = this.schedules[currentRow][lastItem-1];

                //Spit out our contents.
                //console.log(contentsOfLastItem);

                //currentRow++;

                //console.log(currentRow);

                let newItem={                         
                         id: currentItem+1,
                         newItem:true,
                         semester_year:contentsOfLastItem.semester_year,
                        }
                //Debug information.
                //console.log(this.schedules[currentRow]);

                //update our item.
                //this.schedules[0].push(newItem);
                this.schedules[currentRow].push(newItem);
                //allow a new record entry to show up.
                //this.newRecord=true;

            },//end addClass
            //Add new schedule if none exists, using the same addClass Functionality.
            addSchedule(){
                    const newSchedule = [{newItem:true, semester_year: this.newYearSchedule}] 
                    this.$set(this.schedules, 0, newSchedule);

            },
        },  
        computed: {
        semesters() {
                //return this.schedules.map((index,key)=>console.log('hello'));
                let test = this.schedules;

                return console.log(test);
            },
            filteredItems: function () {
                return this.schedules;
            }    
        },
        data() {
            return {
                isFormValid: false,
                schedules:[],
                year:[],
                studentName:[],
                semesterOld:1,
                semesterNew:2,
                newRecord:false,
                //start creating a new grade record. 
                //models
                //with the unique.id held as key.
                newYear:[],
                newNotes:[],
                newAcademicGrade:[],
                newGrade:[],
                newSemester:[],
                newPeriod:[],
                newClassName:[],
                newTeacherName:[],
                newRoomName:[],
                //end creating new grades
                newYearSchedule:'2020',
                //Dropdowns.
                yearSchedule:[
                    {year_date:'2020'},
                    {year_date:'2021'},
                    {year_date:'2022'},
                    {year_date:'2023'},
                    {year_date:'2024'},
                    {year_date:'2025'},
                    {year_date:'2026'},
                    {year_date:'2027'},
                    {year_date:'2028'},
                    {year_date:'2029'},
                    {year_date:'2030'},
                    {year_date:'2031'},
                ],

                academicGradeRules: [ 
                          v => !!v || "This field is required",
                          v => ( v && v >= 1 ) || "Min should be above 1",
                         v => ( v && v <= 100 ) || "Max should not be above 100",
                ],
                
                
                semester:[1,2],
                period:[1,2,3,4,5,6,7],
                grades: [
                                { grade: '8th', abbr: '8' },
                                { grade: '9th', abbr: '9' },
                                { grade: '10th', abbr: '10' },
                                { grade: '11th', abbr: '11' },
                                { grade: '12th', abbr: '12' },                             
                    ],
            }
        }
    }
</script>