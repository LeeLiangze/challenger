<?php

namespace CHG\Voyager\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $table = 'sys_cms_translations';

    protected $connection = 'pgsql';

    protected $fillable = ['table_name', 'column_name', 'foreign_key', 'locale', 'value'];
}
