<?php

namespace CHG\Voyager\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use CHG\Voyager\Contracts\User as UserContract;
use CHG\Voyager\Traits\HasRelationships;
use CHG\Voyager\Traits\VoyagerUser;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements UserContract
{
    use VoyagerUser,
        HasRelationships,
        HasApiTokens;

    protected $guard = 'admin';

    protected $table = 'crm_cms_users';

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

    public function findForPassport($username) {
        return $this->orWhere('usr_id', $username)->orWhere('email',$username)->first();
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
