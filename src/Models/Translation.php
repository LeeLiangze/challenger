<?php

namespace CHG\Voyager\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $table = 'crm_cms_translations';

    protected $fillable = ['table_name', 'column_name', 'foreign_key', 'locale', 'value'];
}
