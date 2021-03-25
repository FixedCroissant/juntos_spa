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
                        }),
                
    ],
  state: {
          count: 0,
          isAuthenticated:false,
          token:false,
          drawer:false,
          message:'',
          myuserInformation:null,
          //array of roles.
          ROLES: [],
          successMessage:null,
          errorMessage:null,
  },
  getters: {
    token: state => state.token,
    message: state=>state.message,
    userid: state=>state.myuserInformation,
    role: state=>state.ROLES, 
    isAuthenticated: state=>state.isAuthenticated,
    drawer:state=>state.drawer,
    success:state=>state.successMessage,
    error:state=>state.errorMessage,
  },
  mutations: {
    isAuthenticated(state){
        //Set authentication flag.
        state.isAuthenticated=true;
        state.drawer=true;
        //Go to dashboard page.
        router.push({path:'dashboard'})
    },

    isLoggedOut(state){
      //Not needed to keep.
      state.message="You have logged out, please close your browser.";
    
    //Reset authentication.
    state.isAuthenticated=false;
    state.myuserInformation=null;
    state.ROLES=[];
    state.token=false;    
    router.push({path: '/'});    
            
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
    //Save our roles and keep them for access in the applications  
    saveRole(state,roleInformation){
      //Only keep certain items, as only some of these are important.
      roleInformation.forEach(roleName => {
        state.ROLES.push(roleName.name);
      });
    },  
    reset(state){
        Object.assign(state,reset())
    },
    saveSuccess(state,message){
      state.successMessage=message;
    },
    saveError(state,message){
      state.errorMessage=message;
    },
    REMOVE_ALERT(state) {
      state.successMessage = null
    },
    REMOVE_ERROR_ALERT(state) {
      state.errorMessage = null
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

      setSuccessAlert({commit},message){
        commit('saveSuccess',message)
      },
      //RemoveOurSuccessAlert.
      removeSuccessAlert({commit}){
        commit('REMOVE_ALERT')
      },
      
      setErrorAlert({commit},message){
        commit('saveError', message)
      },
     //Remove Error Alert
     removeErrorAlert({commit}){
        commit('REMOVE_ERROR_ALERT')
     } 
   }
})

export default store;