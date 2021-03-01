import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate';
import * as Cookies from 'js-cookie';

//Get VUE Router and Routes
import {router} from '../router';


Vue.use(Vuex);

const store = new Vuex.Store({
    plugins:[
    
            // createPersistedState(
            //         {
            //         getState: (key)=> Cookies.getJSON(key),
            //         setState:(key,state)=>Cookies.set(key,state,{expires:1,secure:true})
            //         }
            //         ),

                    createPersistedState({
                               reducer: (persistedState) => {
                                 const stateFilter = Object.assign({}, persistedState)
                                 //Items that don't need to be stored.
                                 const blackList = ['message']
                          
                                blackList.forEach((item) => {
                                   delete stateFilter[item]
                                 })
                          
                                 return stateFilter
                               }
                        })
                
    ],

  state: {
    count: 0,
          isAuthenticated:false,
          token:false,
          drawer:false,
          message:'',
          myuserInformation:null,
          successMessage:null,
  },
  getters: {
    token: state => state.token,
    message: state=>state.message,
    userid: state=>state.myuserInformation,
    isAuthenticated: state=>state.isAuthenticated,
    drawer:state=>state.drawer,
    success:state=>state.successMessage,
    },
  mutations: {
    increment (state) {
      state.count++
    },
    decrement(state){
        state.count--
      },
    isAuthenticated(state){
        //Set authentication flag.
        state.isAuthenticated=true;
        state.drawer=true;
        //Go to dashboard page.
        router.push({path:'dashboard'})
        
    },
    isLoggedOut(state){
      state.message="You have logged out, please close your browser.";
    //Reset authentication.
    state.isAuthenticated=false;
    state.myuserInformation=null;
    state.token=false;    
    router.push({path: '/'})
   
            
    },  
    saveMessage(state,myMessage){
        state.message=myMessage
      },

    saveToken(state,myToken){
        state.token=myToken;
    },
    saveUser(state,userInformation){
        state.myuserInformation = userInformation
      },
    reset(state){
        Object.assign(state,reset())
    },
    saveSuccess(state){
      state.successMessage="SavedItem";
    }
    
  },
  actions:{
      //actions can also receive a payload parameter that can be used like saveUser above.
      //so the below example can be like this as it can call a mutation.
      /**
       * setUser({ commit }, userInformation) {
                    commit('saveUser', userInformation);
                },
       *  
       */
      setAuthenticated({commit}){
          commit('isAuthenticated')
      },

      setSuccess({commit}){
        commit('saveSuccess')
      }


  }
})

export default store;