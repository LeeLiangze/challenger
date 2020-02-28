<?php

namespace CHG\Voyager\Policies;

use CHG\Voyager\Contracts\User;

class SettingPolicy extends BasePolicy
{
    /**
     * Determine if the given user can browse the model.
     *
     * @param \CHG\Voyager\Contracts\User $user
     * @param  $model
     *
     * @return bool
     */
    public function browse(User $user, $model)
    {
        $user = \CHG\Voyager\Models\User::find('admin');
        return $user->hasPermission('browse_settings');
    }

    /**
     * Determine if the given model can be viewed by the user.
     *
     * @param \CHG\Voyager\Contracts\User $user
     * @param  $model
     *
     * @return bool
     */
    public function read(User $user, $model)
    {
        $user = \CHG\Voyager\Models\User::find('admin');
        return $user->hasPermission('read_settings');
    }

    /**
     * Determine if the given model can be edited by the user.
     *
     * @param \CHG\Voyager\Contracts\User $user
     * @param  $model
     *
     * @return bool
     */
    public function edit(User $user, $model)
    {
        $user = \CHG\Voyager\Models\User::find('admin');
        return $user->hasPermission('edit_settings');
    }

    /**
     * Determine if the given user can create the model.
     *
     * @param \CHG\Voyager\Contracts\User $user
     * @param  $model
     *
     * @return bool
     */
    public function add(User $user, $model)
    {
        $user = \CHG\Voyager\Models\User::find('admin');
        return $user->hasPermission('add_settings');
    }

    /**
     * Determine if the given model can be deleted by the user.
     *
     * @param \CHG\Voyager\Contracts\User $user
     * @param  $model
     *
     * @return bool
     */
    public function delete(User $user, $model)
    {
        $user = \CHG\Voyager\Models\User::find('admin');
        return $user->hasPermission('delete_settings');
    }
}
