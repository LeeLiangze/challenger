<?php

namespace CHG\Voyager\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use CHG\Voyager\Contracts\User as UserContract;
use CHG\Voyager\Traits\HasRelationships;
use CHG\Voyager\Traits\VoyagerUser;

class User extends Authenticatable
{

    protected $guard = 'admin';

    protected $table = 'sys_cms_users';

//    protected $primaryKey = 'usr_id';

    protected $guarded = [];

    protected $casts = [
        'settings' => 'array',
    ];

    public function getAvatarAttribute($value)
    {
        if (is_null($value)) {
            return config('voyager.user.default_avatar', 'users/default.png');
        }

        return $value;
    }

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function setLocaleAttribute($value)
    {
        $this->attributes['settings'] = collect($this->settings)->merge(['locale' => $value]);
    }

    public function getLocaleAttribute()
    {
        return $this->settings['locale'];
    }
}
