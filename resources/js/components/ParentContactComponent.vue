<template>
<div>
     <v-form v-model="valid">
                <v-layout row wrap>
                        <v-flex xs4>
                                <v-text-field
                                    v-model="myParentSelection.parent_first_name"
                                    label="First Name"
                                ></v-text-field>
                        </v-flex>
                        <v-flex xs2></v-flex> <!--Whitespace-->
                        <v-flex xs4>
                            <v-text-field
                            v-model="myParentSelection.parent_last_name"
                            label="Last Name"
                            ></v-text-field>
                        </v-flex>
                </v-layout>
                <v-layout row wrap>
                        <v-flex xs4>
                                <v-text-field
                                    v-model="myParentSelection.address_line_1"
                                    label="Address"
                                    required
                                ></v-text-field>
                        </v-flex>
                        <v-flex xs2></v-flex> <!--Whitespace-->
                        <v-flex xs4>
                            <v-text-field
                            v-model="myParentSelection.city"
                            label="City"
                            required
                            ></v-text-field>
                        </v-flex>
                </v-layout>
                <v-layout row wrap>
                        <v-flex xs4>
                                 <v-select
                                 v-model="myParentSelection.state"
                                 :items="items"
                                 label="State"
                                 required
                                ></v-select>
                        </v-flex>
                        <v-flex xs2></v-flex> <!--Whitespace-->
                        <v-flex xs4>
                            <v-text-field
                            v-model="myParentSelection.zip"
                            label="Zip Code"
                            required
                            ></v-text-field>
                        </v-flex>
                </v-layout>
    </v-form>

    <!--Button to update information-->
    <v-btn
                                    elevation="2"
                                    x-small
                                    v-on:click="updateParentInformation"
                            >
                            Update Information
                        </v-btn>

     <!--Button to remove parent information-->
     <v-btn
            elevation="2"
            x-small
            color="error"
            style="margin-left:125px;"
            v-on:click="removeParent"
        >
        Remove Parent/Guardian</v-btn>                   
                     
</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Parent Contact Component mounted.')            
        },
       props: ['myParentSelection'],
         
        methods: 
        { 
            updateValue: function (value) {
                        console.log(value);
                        //this.$emit('input', value);
            },
            removeParent(){
                    alert('Removing parent not implemented yet.');
            },
            async updateParentInformation(){
                                        try {
                            let res = 
                                        await axios ({
                                        url: `${process.env.MIX_API_URL}/public/index.php/api/parents/`+ this.$props.myParentSelection.id,
                                        method: 'PATCH',
                                        data: {
                                                            parent_first_name:this.$props.myParentSelection.parent_first_name,
                                                            parent_last_name:this.$props.myParentSelection.parent_last_name,
                                                            address_line_1:this.$props.myParentSelection.address_line_1,
                                                            city:this.$props.myParentSelection.city,
                                                            state:this.$props.myParentSelection.state,
                                                            zip:this.$props.myParentSelection.zip,
                                            
                                        },
                                        headers:
                                        {
                                            Authorization: `Bearer ${this.$store.getters.token}`,
                                        }
                                        }).then(
                                        //Get Result.
                                        response=>{
                                                    if(response.status==200){
                                                                    //Call main success message.
                                                                            this.$store.dispatch('setSuccessAlert','Updated Parent Information.')
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
        },
        data () {
      return {
         valid: false,
        items: ['AL', 'FL', 'GA', 'NC','SC','CT'],
        studentIDRules:[
           v => !!v || 'Required'
         ],
      }
    },
    }

</script>
