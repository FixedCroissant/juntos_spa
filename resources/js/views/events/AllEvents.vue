
<template>
<v-container>
       <v-row>
           <v-col cols="12" md="12" sm="12">
               <h3>Event List</h3>
                 Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                  veritatis et quasi architecto beatae vitae dicta sunt explicabo. <br/>
                  Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos 
                  qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non 
                  numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam <br/>
                  corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil <br/>
                  molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.

               
           </v-col>
      </v-row>
      <v-row>
          <v-col cols="12" md="11" offset-md="1">                  
                     <EventTableComponent events="events"/>
            </v-col>
        </v-row>
    </v-container>
</template>
 
<script>
    //Local Component Registration.
    import EventTableComponent from '../../components/EventTableComponent.vue';
   
    export default {
        components:{
                EventTableComponent,
               
        },
        data() {
            return {
                
            }
        }
    }
</script>