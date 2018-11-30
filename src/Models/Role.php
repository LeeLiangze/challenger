<?php

namespace CHG\Voyager\Models;

use Illuminate\Database\Eloquent\Model;
use CHG\Voyager\Facades\Voyager;
use CHG\Voyager\Traits\HasRelationships;

class Role extends Model
{
    use HasRelationships;

    protected $table = 'crm_cms_roles';

    protected $guarded = [];

    public function users()
    {
        $userModel = Voyager::modelClass('User');

        return $this->belongsToMany($userModel, 'crm_cms_user_roles')
                    ->select(app($userModel)->getTable().'.*')
                    ->union($this->hasMany($userModel))->getQuery();
    }

    public function permissions()
    {
        return $this->belongsToMany(Voyager::modelClass('Permission'));
    }
}
