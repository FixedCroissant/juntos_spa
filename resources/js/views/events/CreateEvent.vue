<template>
<v-container>
    <v-row>
        <v-col cols="12" md="11" offset-md="1">
                           <CreateEventComponent/>
        </v-col>
    </v-row>
</v-container>
</template>

<script>
    //Local component registration...
    import CreateEventComponent from '../../components/CreateEventComponent.vue';
    
    export default {
        components:{
            CreateEventComponent,
        },
        mounted() {
            console.log('Create Event Page Loaded.')
        },
         data() {
            return {
               
            }
        },
    }
</script>
