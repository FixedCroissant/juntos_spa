<template>
  <v-row>
    <v-dialog
      v-model="dialog"
      persistent
      max-width="600px"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          elevation="2"
          x-small
          v-bind="attrs"
          v-on="on"
        >
          Create New Parent
        </v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="headline">New Parent or Guardian Information</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col
              cols="12"
              sm="6"
              md="6">
                <span>for  {{mystudent.student_first_name}} {{mystudent.student_last_name}}</span>
              </v-col>
            </v-row>
            <v-row>
              <v-col
                cols="12"
                sm="6"
                md="6 "
              >
                <v-text-field
                  v-model="parents.parent_first_name"
                  label="First name*"
                  required
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                sm="6"
                md="5"
              >
                <v-text-field
                  label="Last name*"
                  v-model="parents.parent_last_name"
                  hint="Parent/Guardian Last Name"
                  persistent-hint
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  label="Address"
                  v-model="parents.address_line_1"
                  required
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                sm="6"
              >
                <v-text-field
                  label="City"
                  v-model="parents.city"
                  required
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                sm="6"
              >
                <v-select
                v-model="parents.state"
                :items="states"
                label="State"
                required
                ></v-select>
              </v-col>
               <v-col cols="12">
                <v-text-field
                  v-model="parents.zip"
                  label="Zip*"
                  required
                ></v-text-field>
              </v-col>
             
            </v-row>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue darken-1"
            text
            @click="dialog = false"
          >
            Close
          </v-btn>
          <v-btn
            color="blue darken-1"
            text
            @click="createParentInformation"
          >
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>
<script>
  export default {
    props:['mystudent'],  
       methods:{
                  async createParentInformation(){
                    try {
                    let res = 
                            await axios ({
                                        url: `${process.env.MIX_API_URL}/public/index.php/api/parents`,
                                        method: 'POST',
                                        data: {
                                                            student_id: this.mystudent.id,
                                                            parent_first_name:this.$data.parents.parent_first_name,
                                                            parent_last_name:this.$data.parents.parent_last_name,
                                                            address_line_1:this.$data.parents.address_line_1,
                                                            city:this.$data.parents.city,
                                                            state:this.$data.parents.state,
                                                            zip:this.$data.parents.zip,
                                            
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
                                                            
                                                            //Gets me proper data.
                                                            //console.log(response.data.parent)
                                                            //Add back to the parent component.
                                                            this.addParent(response.data.parent);

                                                            //Close our dialog after submission.
                                                            this.dialog=false;

                                                            //Call main success message.
                                                             this.$store.dispatch('setSuccessAlert','Created new Parent Record!')
                                                            // Remove alert
                                                                    setTimeout(() => {
                                                                                  this.$store.dispatch('removeSuccessAlert')
                                                                    }, 7000)
                                                        }
                                                }

                                )
                        }
                              catch(err){
                                                      alert(err);
                              }
                },
    addParent(value){
          //Send to parent component.
          this.$emit('event_parent_creation', value)          
        },
    },
    data: () => ({
      dialog: false,
      parents:[],
      states: ['AL', 'FL', 'GA', 'NC','SC','CT'],
    }),
  }
</script>