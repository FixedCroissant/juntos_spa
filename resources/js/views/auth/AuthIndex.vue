<template>
   <div>

        <div v-if="$can('read', 'Admin')">
            <p>
                    

                    <AuthTabComponent style="padding:100px;"/>
            </p>
        </div>
        <p v-else>
                404-Page Not Found
        </p>
   </div>
    
</template>

<script>
    //Local component imports.
    import AuthTabComponent from '../../components/AuthTabComponent.vue';

    export default {
        components:{
            AuthTabComponent
        },
        methods:{            
        },
        data:{
        }  
    }
</script>