import { defineAbility } from '@casl/ability';

//Get person from VueX
//var user = JSON.parse(localStorage.getItem('vuex'));

export default (roles) => defineAbility((can,cannot) => {

   //Debug information of the roles that the logged in user has.
   console.log(roles)

   //TO-DO -- IF ROLES IS UNDEFINED, GO BACK TO THE LOGIN PAGE.
   //ERROR when trying to reload the page after computer restart.
   //Appears to be fixed with IF clause.

    //Use Map with includes to properly make sure the value exists.
    if(roles.map(myROLETOCHECK=>myROLETOCHECK).includes('Admin'))
    {
      can('read','Admin');

      can('read','CoachAppointment');
      can('create','CoachAppointment');
      can('destroy','CoachAppointment');
    }else{
       console.log("This person cannot read the admin page or alter appointments.");
        cannot('read','Admin');
    }







});