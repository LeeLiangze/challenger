<?php

namespace CHG\Voyager\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'sys_cms_settings';

    protected $connection = 'pgsql';

    protected $guarded = [];

    public $timestamps = false;
}
