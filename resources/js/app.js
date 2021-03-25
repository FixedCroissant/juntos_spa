require('./bootstrap');
import Vue from 'vue';

//Use our abilities we setup.
//REMOVED THESE IMORTS AND NOW ARE BEING USED IN STORE/INDEX.
//added back and removed from our store at 3/10 @6:44pm.
import defineAbilityFor from './config/ability';
import { abilitiesPlugin } from '@casl/vue';

//Using Vuetify
import  vuetify from './src/plugins/vuetify';

 //Main App file.
import App from './App.vue';

//Import Components
import login from './views/Login.vue';
//End Components

//Import moment for dates;
import moment from 'moment';

//Register components
// Globally register your component(s)
Vue.component('login', login);
Vue.component('instructions',instructions);


import VueAxios from 'vue-axios';
import axios from 'axios';
//Call my router.
import { router  }from './router';

//VUEX STORE from separate file.
import store from './store';
//import Vuex from 'vuex';


Vue.use(VueAxios, axios);



//temp start -- handle castle abilities.
//globally register can component.
import { Can } from '@casl/vue';

Vue.component('Can', Can);

//Get User
//using local storage.
const user = JSON.parse(localStorage.getItem('vuex'));

//Check if null, if so redirect to login.
if(user==null){
  //Go back to the homepage to login.
  router.push({name: 'home'});
}else
{
  const ability = defineAbilityFor(user.ROLES);
  //Utilize our abilities that we setup in /config/ability.js
  //If added from the user above.
   Vue.use(abilitiesPlugin, ability);
   //If testing in the ability plugin, keep as a function like this ability().
   //Vue.use(abilitiesPlugin, ability());
  //temp end -- end handle castle abilties.
}












//Add vue filter for formatting dates.
Vue.filter('formatDate', function(value) {
  if (value) {
      return moment(String(value)).format('MM/DD/YYYY')
  }
});


//Create new Vue Application
new Vue({
  store: store,
  vuetify,
  router:router,
  render: h=>h(App),
}).$mount('#app');