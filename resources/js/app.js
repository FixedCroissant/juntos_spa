require('./bootstrap');
import Vue from 'vue';

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