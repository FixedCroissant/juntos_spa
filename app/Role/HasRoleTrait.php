<?php
namespace App\Role;

//Get Role
use App\Models\Role;

trait HasRoleTrait{

    //Roles
  
    
    /**
     * See if user has existing role in the system.
     */
    public function hasRole( ... $roles ) {
        foreach ($roles as $role) {
                if ($this->roles->contains('slug', $role)) {
                  return true;
                }
        }
        return false;
      }

      /***
       * Get all roles
       */
      public function roles() {
        return $this->belongsToMany(Role::class,'users_roles')->withTimestamps();
      }

}

?>