<?php

namespace CHG\Voyager\Policies;

use CHG\Voyager\Contracts\User;
use CHG\Voyager\Facades\Voyager;
use CHG\Voyager\Models\DataType;

class MenuItemPolicy extends BasePolicy
{
    protected static $datatypes = null;
    protected static $permissions = null;

    /**
     * Check if user has an associated permission.
     *
     * @param User   $user
     * @param object $model
     * @param string $action
     *
     * @return bool
     */
    protected function checkPermission($model, $action)
    {
//        if (self::$permissions == null) {
//            self::$permissions = Voyager::model('Permission')->all();
//        }

        if (self::$datatypes == null) {
            self::$datatypes = DataType::all()->keyBy('slug');
        }

        $regex = str_replace('/', '\/', preg_quote(route('voyager.dashboard')));
        $slug = preg_replace('/'.$regex.'/', '', $model->link(true));
        $slug = str_replace('/', '', $slug);

        if ($str = self::$datatypes->get($slug)) {
            $slug = $str->name;
        }

        if ($slug == '') {
            $slug = 'admin';
        }

        if (empty($action)) {
            $action = 'browse';
        }

//        // If permission doesn't exist, we can't check it!
//        if (!self::$permissions->contains('key', $action.'_'.$slug)) {
//            return true;
//        }

        return $user->hasPermission($action.'_'.$slug);
    }
}
