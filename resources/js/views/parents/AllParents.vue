
<template>
<v-container>
       <v-row>
           <v-col cols="12" md="12" sm="12">
                <h1>Current Parents</h1>
               
                 Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                  veritatis et quasi architecto beatae vitae dicta sunt explicabo. <br/>
                  Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos 
                  qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non 
                  numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam <br/>
                  corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil <br/>
                  molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur
           
                  <MenuComponent v-bind:totalStudentsForEvent="totalStudentsForEvent" v-bind:attendanceType="attendanceType" style="position: absolute; left: 150px;"/>
                  
                  <br/>
                  <br/>
                  <br/>
           </v-col>
      </v-row>
      <v-row>
          <v-col cols="12" md="10" offset-md="1">                  
                     <ParentTableComponent
                     v-on:event_parent_creation="eventParentCreation" 
                      parents="parents"/>
            </v-col>
        </v-row>
    </v-container>
</template>
 
<script>
    //Local Component Registration.   
    import ParentTableComponent from '../../components/ParentTableComponent.vue';
    import MenuComponent from '../../components/MenuComponent.vue';

    export default {
        components:{
                ParentTableComponent,
                MenuComponent
        },
        data() {
            return {
                 totalStudentsForEvent:[],
                 attendanceType:"parent"
            }
        },
        methods:
        {   
            //To-Do--Rename this method so that it makes more sense!
            eventParentCreation(id){
                   //Information stored in ID is the data response.
                   console.log('ALL PARENTS!! ... Event from child component emitted: ', id)
                   //Set to totalStudentsAttendance
                   this.totalStudentsForEvent = id;
            },
        },
    }
</script>