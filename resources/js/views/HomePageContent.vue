<template>
    <p> 
        <login v-show="!this.$store.state.isAuthenticated"></login>
    </p>

    

    
</template>

<script>
 import DemoModal from '../components/DemoModal.vue';
    export default {
     components:{
                DemoModal
        }
    }
</script>