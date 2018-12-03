<?php

namespace CHG\Voyager\Models;

use Illuminate\Database\Eloquent\Model;
use CHG\Voyager\Facades\Voyager;
use CHG\Voyager\Traits\HasRelationships;

class Permission extends Model
{
    use HasRelationships;

    protected $table = 'crm_cms_permissions';

    protected $guarded = [];

    public function roles()
    {
        return $this->belongsToMany(Voyager::modelClass('Role'),'crm_cms_permission_role');
    }

    public static function generateFor($table_name)
    {
        self::firstOrCreate(['key' => 'browse_'.$table_name, 'table_name' => $table_name]);
        self::firstOrCreate(['key' => 'read_'.$table_name, 'table_name' => $table_name]);
        self::firstOrCreate(['key' => 'edit_'.$table_name, 'table_name' => $table_name]);
        self::firstOrCreate(['key' => 'add_'.$table_name, 'table_name' => $table_name]);
        self::firstOrCreate(['key' => 'delete_'.$table_name, 'table_name' => $table_name]);
    }

    public static function removeFrom($table_name)
    {
        self::where(['table_name' => $table_name])->delete();
    }
}
