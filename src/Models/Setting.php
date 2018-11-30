<?php

namespace TCG\Voyager\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'crm_cms_settings';

    protected $guarded = [];

    public $timestamps = false;
}
