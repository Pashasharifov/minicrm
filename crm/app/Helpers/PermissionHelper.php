<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class PermissionHelper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    }
    public static function defaultPermissions(): array{
        return [
            "users_view"=>false,
            "users_create"=>false,
            "users_edit"=>false,
            "users_delete"=>false,
            "clients_view"=>true,
            "clients_create"=>true,
            "clients_edit"=>true,
            "clients_delete"=>false,
            "projects_view"=>true,
            "projects_create"=>true,
            "projects_edit"=>true,
            "projects_delete"=>false,
            "tasks_view"=>true,
            "tasks_create"=>true,
            "tasks_edit"=>true,
            "tasks_delete"=>false,
        ];
    }

    public static function isAdmin(array $permissions): bool{
        $defaultPermissions = self::defaultPermissions();
        foreach($defaultPermissions as $key => $value){
            if(!isset($permissions[$key]) || $permissions[$key] != true)
                return false;
        }
        return true;
    }

    public static function isEmpty(array $permissions): bool{
        $defaultPermissions = self::defaultPermissions();
        foreach($defaultPermissions as $key => $value){
            if(isset($permissions[$key]) && $permissions[$key] == true)
                return false;
        }
        return true;
    }

    public static function isClient(array $permissions): bool{
        $defaultPermissions = self::defaultPermissions();
        foreach($defaultPermissions as $key => $value){
            if($key != "clients_view" && isset($permissions[$key]) && $permissions[$key] == true)
                return false;
        }
        if(!isset($permissions["clients_view"]) || $permissions["clients_view"] == false)
            return false;
        return true;
    }

    public static function checkPermission(string $permission): bool{
        // return true; // temporary
        $user = Auth::user();
        if(!$user) return false;//abort(403, 'Not authenticated');
        if($user->isAdmin()) return true;
        if($user->isOperator() && in_array($permission, ['clients_delete', 'projects_delete', 'tasks_delete', 'users_delete'])) return false;//abort(403, 'Permission denied');
        if(!$user->permissions || !isset($user->permissions[$permission]) || $user->permissions[$permission] == false) return false;//abort(403, 'Permission denied');
        return true;
    }
    public static function authorizeOrAbort(string $permission): void{
        if(!self::checkPermission($permission))
            abort(403, 'Permission denied');
    }

}
