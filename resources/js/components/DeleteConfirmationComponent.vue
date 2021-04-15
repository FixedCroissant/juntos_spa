<template>
    <v-dialog
      v-model="dialog"
      persistent
      max-width="350"
    >
      <template v-slot:activator="{ on, attrs }">
        <a
               v-bind="attrs"
               v-on="on"
               
         >Delete</a>
      </template>
      <v-card>
        <v-card-title class="headline">
         Really Delete?
        </v-card-title>
                    <v-card-text>
                        Are you really sure that you want to delete this record? 
                        <br/>
                        <br/>
                        There's no going back, so make sure this is something that 
                        you really want to do.
                    </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="green darken-1"
            text
            @click="dialog = false"
          >
            Cancel
          </v-btn>
          <v-btn
            color="green darken-1"
            text
            @click="deleteConfirmation(true)"
          >
            Please proceed
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

</template>

<script>
  export default {
    props:['recordToRemove'],
    data () {
      return {
        dialog: false,
      }
    },
    methods:{
        deleteConfirmation(value){
                this.$emit('event_deletion', this.$props.recordToRemove);
                this.$data.dialog=false;
            },
    }
  }
</script>