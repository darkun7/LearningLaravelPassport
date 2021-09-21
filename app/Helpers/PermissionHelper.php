<?php

if (!function_exists('user_role_order')) {
    /**
     * user_role_order
     * Higher role of authenticated user based on id, so record on db must be adjusted
     *
     * @param  bool $auth
     * @return bool
     */
    function user_role_order ($auth = True) : bool
    {
        if($auth){
            $user = Illuminate\Support\Facades\Auth::user();
            $model = \App\Models\Role::get();
            $arrRole = collection_simplify($model,'name','id');
            $roles = $user->getRoleNames();
            $small = 9999;
            $higherRole = null;
            foreach($roles as $role)
            {
                if($small > $arrRole[$role]){
                    $small = $arrRole[$role];
                    $higherRole = $role;
                }
            }
            return $higherRole ?? false;
        }
        return false;
    }
}
if (!function_exists('perm')) {
    /**
     * perm
     * Check whether the authenticated user has permission to
     *
     * @param  string $perm
     * @param  bool $auth
     * @return bool
     */
    function perm (string $perm, bool $auth = True) : bool
    {
        if($auth){
            $user = Illuminate\Support\Facades\Auth::user();
            return $user->hasPermissionTo($perm);
        }
        return false;
    }
}
if (!function_exists('any_perm')) {
    /**
     * any_perm
     * Check whether the authenticated user has permission within array
     *
     * @param  array $perms
     * @param  bool $auth
     * @return bool
     */
    function any_perm (array $perms, bool $auth = True) : bool
    {
        if($auth){
            $user = Illuminate\Support\Facades\Auth::user();
            if(is_array($perms))
            {
                foreach($perms as $perm){
                    if( $user->hasPermissionTo($perm) ){
                        return True;
                    }
                }
            }else{
                return $user->can($perms);
            }
        }
        return false;
    }
}
