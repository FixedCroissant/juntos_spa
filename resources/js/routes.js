import AllPosts from './views/AllPosts';
import AddPost from './views/AddPost';
import EditPost from './views/EditPost';

//Dashboard
import Dashboard from './views/Dashboard';

//Students
import AllStudents from './views/student/AllStudents';
import ShowStudents from './views/student/ShowStudents';
//Parents
import AllParents from './views/parents/AllParents';

import ProtectedRoute from './views/Protected.vue';


const User = {
    props: ['id'],
    template: '<div>User {{ id }}</div>'
  }


 
export const routes = [
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard,        
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
        component: AllStudents
    },
    {
        name: 'showstudent',
        path: '/student/:id',
        component: ShowStudents
    },
    {
        name: 'parents',
        path: '/parents',
        component:AllParents
    },
    {
        name: 'showparent',
        path: '/parents/:id',
        component:AllPosts
    },
    //ToDo -- Add the Appropriate component there for showing an individual parent.
    
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditPost
    },
    {
        name:'protected',
        path: '/protected',
        component: ProtectedRoute,
        beforeEnter: (to, from, next) => {
          
            if (to.name == 'protected' && !isAuthenticated) next({ name: 'Login' })
            else next()
          }
    }
];