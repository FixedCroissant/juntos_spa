<template>
<div>
                <v-layout row wrap>
                        <v-flex xs4>
                                <v-text-field
                                    v-model="myStudentSelection.student_first_name"
                                    label="First Name"
                                ></v-text-field>
                        </v-flex>
                        <v-flex xs2></v-flex> <!--Whitespace-->
                        <v-flex xs4>
                            <v-text-field
                            v-model="myStudentSelection.student_last_name"
                            label="Last Name"
                            ></v-text-field>
                        </v-flex>
                </v-layout>
                <v-layout row wrap>
                        <v-flex xs4>
                                <v-text-field
                                    v-model="myStudentSelection.address_line_1"
                                    label="Address"
                                    required
                                ></v-text-field>
                        </v-flex>
                        <v-flex xs2></v-flex> <!--Whitespace-->
                        <v-flex xs4>
                            <v-text-field
                            v-model="myStudentSelection.city"
                            label="City"
                            required
                            ></v-text-field>
                        </v-flex>
                </v-layout>
                <v-layout row wrap>
                        <v-flex xs4>
                                 <v-select
                                 v-model="myStudentSelection.state"
                                 :items="items"
                                 label="State"
                                 required
                                ></v-select>
                        </v-flex>
                        <v-flex xs2></v-flex> <!--Whitespace-->
                        <v-flex xs4>
                            <v-text-field
                            v-model="myStudentSelection.zip"
                            label="Zip Code"
                            required
                            ></v-text-field>
                        </v-flex>
                </v-layout>
                <v-layout row wrap>
                        <v-flex xs3>
                               <!--  <v-text-field
                                     v-model="myStudentSelection.student_id"
                                     label="Student ID"
                                     style="padding-bottom:25px;"
                                     required
                                 ></v-text-field>-->

                                        <v-text-field
                                            v-model="myStudentSelection.student_id"
                                            label="Student ID"
                                            style="padding-bottom:25px;"
                                            required
                                            :rules="rulesFromParent"
                                        ></v-text-field>


                        </v-flex>
                        <v-flex xs2></v-flex>
                </v-layout>

</div>
</template>

<script>

    export default {

        mounted() {
            console.log('Student Contact Component mounted.')
        },
       props: ['myStudentSelection','rulesFromParent'],

        methods:
        {
            updateValue: function (value) {
                        console.log(value);
            }
        },

        data () {
      return {
        valid: false,
        items: ['AL', 'FL', 'GA', 'NC','SC','CT'],
        studentrecord:{
           maximum: v => v.length >=12 || 'Max 12 characters',
           required: v => !!v || 'Required'
        },
        nameRules: [
                rulesFromParent => !!rulesFromParent || 'Name is required',

      ],
      }
    },
    }

</script>
