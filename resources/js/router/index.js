import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter)




import AllPosts from '../views/AllPosts';
import AddPost from '../views/AddPost';
import EditPost from '../views/EditPost';

//Homepage
import HomePageContent from '../views/HomePageContent.vue';
//PageNotFound
import PageNotFound from '../views/PageNotFound';



//Dashboard
import Dashboard from '../views/Dashboard';

//Students
import AllStudents from '../views/student/AllStudents';
import ShowStudents from '../views/student/ShowStudents';
//Parents
import AllParents from '../views/parents/AllParents';








//Get store
import store from '../store/index';

 
let routes = [
    {
        name: 'home',
        path: '/',
        component: HomePageContent,
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard,
        // beforeEnter: (to, from, next) => {
        //     if (to.name == 'dashboard' && !store.getters.isAuthenticated) next({ name: 'home' })
        //     else next()
        //   }        
    },
    {
        name: 'add',
        path: '/add',
        component: AddPost
    },
    {
        name: 'all',
        path:'/allposts',
        component: AllPosts
    },
    {
        name: 'students',
        path: '/students',
        component: AllStudents,
        beforeEnter: (to, from, next) => {
            if (to.name == 'students' && !store.getters.isAuthenticated) next({ name: 'home' })
            else next()
          }
    },
    {
        name: 'showstudent',
        path: '/student/:id',
        component: ShowStudents,
        beforeEnter: (to, from, next) => {
            if (to.name == 'showstudent' && !store.getters.isAuthenticated) next({ name: 'home' })
            else next()
          }
    },
    {
        name: 'parents',
        path: '/parents',
        component:AllParents,
        beforeEnter: (to, from, next) => {
            if (to.name == 'parents' && !store.getters.isAuthenticated) next({ name: 'home' })
            else next()
          }
    },
    {
        name: 'showparent',
        path: '/parents/:id',
        component:AllPosts
    },
    // ... other routes ...
    { path: "*", 
    component: PageNotFound 
    }
]




export const router = new VueRouter({
       hashbang: false,
       mode: 'history',
       base: 'public/index.php',
       routes: routes
      });

