<template>
  <v-card>
    <v-toolbar
      color="grey lighten-1"
      light
     >
      <template v-slot:extension>
          <!--Selected-->
        <v-tabs
          v-model="tab"
          align-with-title
          color="black"
        >
          <v-tabs-slider color="red"></v-tabs-slider>

          <v-tab
            v-for="item in items"
            :key="item"
            
          >
            {{ item }}
          </v-tab>
        </v-tabs>
      </template>
    </v-toolbar>

    <v-tabs-items v-model="tab">
      <v-tab-item
        v-for="item in items"
        :key="item"
      >
        <v-card flat>
          <v-card-text
            v-if="item=='Users'"
          >

          <p>
            <v-btn
              elevation="2"
              small
             >Create New User
             </v-btn>
              <br/>
              <br/>
            
            This is the admin area.
            
          </p>


          <AdminUserTableComponent users="users"/>
          </v-card-text>
          
          <!--ROLE LIST-->
          <v-card-text
          v-if="item=='Roles'"
          >
          <br/>
          <br/>
          <AdminRoleIndex />
          </v-card-text>
          <!--End Roles-->
          
          
          <v-card-text
            v-if="item=='Notes'"
          >
          <ul>
                    <li>
                    
                    </li>
          </ul>
          </v-card-text>
        </v-card>
      </v-tab-item>
    </v-tabs-items>
  </v-card>
</template>

<script>
  import AdminUserTableComponent from './AdminUserTableComponent.vue';
  import AdminRoleIndex from '../views/auth/roles/AdminRoleIndex.vue';

    export default {
        mounted() {
            console.log('Auth Tab NoteTab Component mounted.')
        },
        components:{
            AdminUserTableComponent,
            AdminRoleIndex
        },
      props: [],
      data () {
      return {
        tab: null,
        items: [
          'Users','Roles', 'District/Counties','Sites','Etc. TBD'
        ],
        itemText:[
          'item1',
          'item2',
          'item3'
        ]        
      }
    },
    }
</script>
