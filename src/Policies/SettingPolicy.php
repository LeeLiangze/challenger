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
    public function browse($user, $model)
    {
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
    public function read($user, $model)
    {
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
    public function edit($user, $model)
    {
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
    public function add($user, $model)
    {
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
    public function delete($user, $model)
    {
        return $user->hasPermission('delete_settings');
    }
}
