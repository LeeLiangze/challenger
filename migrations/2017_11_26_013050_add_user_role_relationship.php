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
        Schema::table('crm_cms_users', function (Blueprint $table) {
            $table->unsignedInteger('role_id')->change();
            $table->foreign('role_id')->references('id')->on('crm_cms_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('crm_cms_users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->integer('role_id')->change();
        });
    }
}
