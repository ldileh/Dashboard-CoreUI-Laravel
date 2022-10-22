<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function($table) {
                $table->foreign('user_role_id', 'fk_user_user_role')->references('id')->on('user_roles')->onDelete('cascade')->onUpdate('restrict');
            });
        }


        if (Schema::hasTable('profiles')) {
            Schema::table('profiles', function($table) {
                $table->foreign('user_id', 'fk_profile_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('restrict');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {}
}
