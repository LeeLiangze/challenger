<?php

use Illuminate\Database\Migrations\Migration;

class AddVoyagerUserFields extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('crm_cms_users', function ($table) {
            if (!Schema::hasColumn('crm_cms_users', 'avatar')) {
                $table->string('avatar')->nullable()->after('email')->default('users/default.png');
            }
            $table->integer('role_id')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        if (Schema::hasColumn('crm_cms_users', 'avatar')) {
            Schema::table('crm_cms_users', function ($table) {
                $table->dropColumn('avatar');
            });
        }
        if (Schema::hasColumn('crm_cms_users', 'role_id')) {
            Schema::table('crm_cms_users', function ($table) {
                $table->dropColumn('role_id');
            });
        }
    }
}
