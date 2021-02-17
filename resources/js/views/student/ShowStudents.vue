
<template>
<v-container>
       <v-row>
          <v-col cols="12" md="5" offset-md="2">  

                    <div style="float:left; padding-right:50px;">
                            <!-- <img :src="image"/>   -->
                            <img width="50" height="50" src="https://ui-avatars.com/api/?name=${student.student_first_name}+${student.student_last_name}"/>
                    </div>
                    <div>
                         <h3>{{ student.student_first_name }} {{student.student_last_name}}</h3>
                    </div>

                            
                   
                   <ul v-for="myschool in student.school">
                       <li>{{myschool.school_name}} |  {{myschool.school_county}}</li>
                    </ul>
                   
                   <br/>
                   <h5>Contact Information</h5>
                   {{student.address_line_1}} <br/>
                   {{student.city}} <br/>
                   {{student.state}} <br/>
                   {{student.zip}}

                   <br/>
            </v-col>
            <v-col cols="12" md="5">
                    <h3>Parent Information Here </h3>

                      <template v-for="theparents in student.parent">
                         {{theparents.parent_first_name}} |  {{theparents.parent_last_name}} <br/>
                         {{theparents.address_line_1}} <br/>
                         {{theparents.city}}, 
                         {{theparents.state}} <br/>
                         {{theparents.zip}}
                    </template>  
            </v-col>
        </v-row>
     <v-row style="padding-top:125px;">
          <v-col cols="12" md="10" offset-md="1">                  
                     <NoteTabComponent />
            </v-col>
     </v-row>


    </v-container>
</template>
 
<script>

        //Local component registration...
        import NoteTabComponent from '../../components/NoteTabComponent.vue';  

       export default { 

        components:{
            NoteTabComponent
                
        },
        data() {
            return {
                student:[],
                //image: "https://placekitten.com/200/300"                
                //image:"https://ui-avatars.com/api/?name=John+Doe"
            }
        },
         created() {
            this.axios
                .get('http://localhost:9000/public/index.php/api/students/'+ this.$route.params.id)
                .then(response => {
                    this.student = response.data.student;
                });
            // this.axios.get('https://ui-avatars.com/api/?name=John+Doe').then(response=>{
            //     this.image
            // })    
        },
    }
</script>