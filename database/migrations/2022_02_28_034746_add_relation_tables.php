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

        if (Schema::hasTable('news')) {
            Schema::table('news', function($table) {
                $table->foreign('user_id', 'fk_news_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('restrict');
            });
        }

        if (Schema::hasTable('news_thread')) {
            Schema::table('news_thread', function($table) {
                $table->foreign('news_id', 'fk_news_thread_news')->references('id')->on('news')->onDelete('cascade')->onUpdate('restrict');
            });
        }

        if (Schema::hasTable('members')) {
            Schema::table('members', function($table) {
                $table->foreign('member_status_id', 'fk_member_member_status')->references('id')->on('member_statuses')->onDelete('cascade')->onUpdate('restrict');
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
