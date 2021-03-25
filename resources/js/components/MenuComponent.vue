<template>
  <div class="text-center">
    <v-menu offset-y>
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          color="primary"
          dark
          v-bind="attrs"
          v-on="on"
        >
          Actions
        </v-btn>
      </template>
      <v-list>
        <v-list-item
          v-for="(item, index) in items"
          :key="index"
          @click="selectSection(item.actionName)" >
          <v-list-item-title>{{ item.title }}</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>

    <!-- TODO -- FIX SO THAT THIS MENU SHOWS UP MORE THAN JUST ONE TIME. -->
    <!-- TODO-- CURRENTLY ONLY SHOWING IT ONCE. -->
    <EventDropdownModal v-bind:totalStudentsForEvent="totalStudentsForEvent" v-bind:attendanceType="attendanceType" v-on:eventDialog="changeDialog" :dialog="addToEvent"  v-if=this.addToEvent />
  </div>
  
</template>

<script>
 import EventDropdownModal from './EventDropdownModal.vue';
    export default {
         components:{
                EventDropdownModal,
        },
        mounted() {
            console.log('Menu Component mounted.')
        },
        props: ['totalStudentsForEvent','attendanceType'],
        data: () => ({
                items: [
                    { title: 'Add to Event Attendance', actionName: 'addAttendance' },
                ],
                addToEvent:false,                
            }),
          methods:{
            //Get information back from our child component
            changeDialog: function(id) {
		            	     //Information stored in ID is the data response.
                        console.log('Event from parent component emitted', id)
                        this.addToEvent=false;
                          
		        },
            selectSection(item) {
                  //console.log(item);
                  //this.selectedSection = item;
                  if(item=="addAttendance"){
                      this.addToEvent=true;
                  }
            }  
          }
    }
</script>