<?php

namespace CHG\Voyager\Traits;

use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use CHG\Voyager\Facades\Voyager;
use CHG\Voyager\Models\Role;

/**
 * @property  \Illuminate\Database\Eloquent\Collection  roles
 */
trait VoyagerUser
{
    /**
     * Return default User Role.
     */
//    public function role()
//    {
//        return $this->belongsTo(Voyager::modelClass('Role'));
//    }

    /**
     * Return alternative User Roles.
     */
//    public function roles()
//    {
//        return $this->belongsToMany(Voyager::modelClass('Role'), 'crm_cms_user_roles');
//    }

    /**
     * Return all User Roles, merging the default and alternative roles.
     */
//    public function roles_all()
//    {
//        $this->loadRolesRelations();
//
//        return collect([$this->role])->merge($this->roles);
//    }

    /**
     * Check if User has a Role(s) associated.
     *
     * @param string|array $name The role(s) to check.
     *
     * @return bool
     */
    public function hasRole($name)
    {
        $roles = cas()->getAttribute('role');

        foreach ((is_array($name) ? $name : [$name]) as $role) {
            if (in_array($role, $roles)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Set default User Role.
     *
     * @param string $name The role name to associate.
     */
//    public function setRole($name)
//    {
//        $role = Voyager::model('Role')->where('name', '=', $name)->first();
//
//        if ($role) {
//            $this->role()->associate($role);
//            $this->save();
//        }
//
//        return $this;
//    }

    public function hasPermission($name)
    {
        $cas_permissions = cas()->getAttribute('permission');

        $_permissions = array();
        foreach ($cas_permissions as $permission) {
            $permission_exp = explode(":", $permission);
            $_permissions[] = $permission_exp[2] . "_" . $permission_exp[1];
        }

        return in_array($name, $_permissions);
    }

    public function hasPermissionOrFail($name)
    {
        if (!$this->hasPermission($name)) {
            throw new UnauthorizedHttpException(null);
        }

        return true;
    }

    public function hasPermissionOrAbort($name, $statusCode = 403)
    {
        if (!$this->hasPermission($name)) {
            return abort($statusCode);
        }

        return true;
    }

//    private function loadRolesRelations()
//    {
//        if (!$this->relationLoaded('role')) {
//            $this->load('role');
//        }
//
//        if (!$this->relationLoaded('roles')) {
//            $this->load('roles');
//        }
//    }
//
//    private function loadPermissionsRelations()
//    {
//        $this->loadRolesRelations();
//
//        if (!$this->role->relationLoaded('permissions')) {
//            $this->role->load('permissions');
//            $this->load('roles.permissions');
//        }
//    }
}
