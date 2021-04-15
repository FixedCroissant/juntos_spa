import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter)





//Register for Account
import RegisterPage from '../views/RegisterPage.vue';

//Homepage
import HomePageContent from '../views/HomePageContent.vue';
//PageNotFound
import PageNotFound from '../views/PageNotFound';

//Dashboard
import Dashboard from '../views/Dashboard';

//Students
import AllStudents from '../views/student/AllStudents';
import ShowStudents from '../views/student/ShowStudents';
import CreateStudent from '../views/student/CreateStudent';


//Parents
import AllParents from '../views/parents/AllParents';
//Creating a parent is being done through a modal.
//ToDo -- This reference needs to be removed.
import CreateParent from '../views/parents/CreateParent';
import ShowParent from '../views/parents/ShowParent';

//Events
import AllEvents from '../views/events/AllEvents';
import CreateEvent from '../views/events/CreateEvent';
import ShowEvent from '../views/events/ShowEvent';


//List event attendance by Event.
import ShowEventAttendance from '../views/events/ShowEventAttendance';

//Coaches Appointments.
import CoachAppointmentIndex from '../views/coachAppointments/CoachAppointmentIndex';
import CoachAppointmentCreate from '../views/coachAppointments/CoachAppointmentCreate';
import CoachAppointmentEdit from '../views/coachAppointments/CoachAppointmentEdit';

//Schedule List
import StudentScheduleIndex from '../views/schedules/StudentScheduleIndex';




//Admin Area
import AuthIndex from '../views/auth/AuthIndex.vue';
//UserEdit
import AdminUserEdit from '../views/auth/users/AdminUserEdit.vue';

//RoleIndex
import AdminRoleIndex from '../views/auth/roles/AdminRoleIndex.vue';

//End Admin Area


//Get store
import store from '../store/index';



 
let routes = [
    {
        name: 'home',
        path: '',
        component: HomePageContent,
    },
    {
        name: 'register',
        path:'/register',
        component: RegisterPage,
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard,
        beforeEnter: (to, from, next) => {
            if (to.name == 'dashboard' && !store.getters.isAuthenticated) next({ name: 'home' })
            else next()
          }        
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
        name: 'addStudent',
        path: '/student/create',
        component: CreateStudent,
        beforeEnter: (to, from, next) => {
            if (to.name == 'addStudent' && !store.getters.isAuthenticated) next({ name: 'home' })
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
        name: 'addParent',
        path: '/parents/create',
        component:CreateParent,
        beforeEnter: (to, from, next) => {
            if (to.name == 'addParent' && !store.getters.isAuthenticated) next({ name: 'home' })
            else next()
          }
    },
    {
        name: 'showparent',
        path: '/parents/:id',
        component:ShowParent
    },
    {
        name: 'allEvents',
        path: '/events',
        component: AllEvents
    },
    {
        name: 'createEvent',
        path: '/events/create',
        component: CreateEvent
    },
    {
        name:'showEvent',
        path:'/events/:id',
        component: ShowEvent
    },
    //Event Attendance
    {
        name: 'eventAttendance',
        path: '/events/:id/attendance',
        component: ShowEventAttendance,
        beforeEnter: (to, from, next) => {
            if (to.name == 'eventAttendance' && !store.getters.isAuthenticated) next({ name: 'home' })
            else next()
          }
    },

    //Coaching Appointments with Coordinators.
    //Index
    {
        name:'coachAppointments',
        path:'/coachAppointment/index',
        component: CoachAppointmentIndex,
        beforeEnter: (to, from, next) => {
            if (to.name == 'coachAppointments' && !store.getters.isAuthenticated) next({ name: 'home' })
            else next()
          }
    },
    //Create
    {
        name: 'createCoachAppointment',
        path: '/coachAppointment/create',
        component: CoachAppointmentCreate,
        beforeEnter: (to, from, next) => {
            if (to.name == 'createCoachAppointment' && !store.getters.isAuthenticated) next({ name: 'home' })
            else next()
          }
    },
    //Edit
    {
        name:'coachAppointmentEdit',
        path:'/coachAppointment/:id',
        component: CoachAppointmentEdit,
        beforeEnter: (to, from, next) => {
            if (to.name == 'coachAppointmentEdit' && !store.getters.isAuthenticated) next({ name: 'home' })
            else next()
          }
    },
    //Schedules
    //Display index of schedules that are limited based on student id.
    //scheduleList
    {
        name:'scheduleList',
        path:'/schedule/index/:id',
        component:StudentScheduleIndex,
        beforeEnter: (to, from, next) => {
            if (to.name == 'scheduleList' && !store.getters.isAuthenticated) next({ name: 'home' })
            else next()
          }
    },


  


    //Admin Pages
    //all start with /admin/ prefix.
    {
        name: 'adminIndex',
        path: '/admin/index',
        component: AuthIndex,
        beforeEnter: (to, from, next) => {
            if (to.name == 'adminIndex' && !store.getters.isAuthenticated) next({ name: 'home' })
            else next()
          }
    },
    //Edit User
    //admin/user/#/edit
    {
        name:'editUser',
        path:'/admin/user/:id/edit',
        component: AdminUserEdit
    },
    //List Roles
    //admin/user/roles/index
    {
        name:'rolesIndex',
        path:'/admin/user/role/index',
        component:AdminRoleIndex
    },


    // ... other routes ...
    { path: "*", 
    component: PageNotFound 
    }
]




export const router = new VueRouter({
       hashbang: false,
       mode: 'history',
       //docker everything else, etc.
       base: 'public/index.php',
       //shared hosting
       //base: "/apps/DASA/juntos/public/index.php",
       routes: routes
      });

