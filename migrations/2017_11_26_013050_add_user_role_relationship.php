<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserRoleRelationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sys_cms_users', function (Blueprint $table) {
            $table->unsignedInteger('role_id')->change();
            $table->foreign('role_id')->references('id')->on('sys_cms_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sys_cms_users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->integer('role_id')->change();
        });
    }
}
