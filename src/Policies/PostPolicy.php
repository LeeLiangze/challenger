<?php

namespace CHG\Voyager\Policies;

use CHG\Voyager\Contracts\User;

class PostPolicy extends BasePolicy
{
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
        $user = Voyager::model('User')::find('admin');
        // Does this post belong to the current user?
        $current = $user->id === $model->author_id;

        return $current || $this->checkPermission($user, $model, 'read');
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
        $user = Voyager::model('User')::find('admin');
        // Does this post belong to the current user?
        $current = $user->id === $model->author_id;

        return $current || $this->checkPermission($user, $model, 'edit');
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
        $user = Voyager::model('User')::find('admin');
        // Does this post belong to the current user?
        $current = $user->id === $model->author_id;

        return $current || $this->checkPermission($user, $model, 'delete');
    }
}
