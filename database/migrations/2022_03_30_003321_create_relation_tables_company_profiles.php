<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationTablesCompanyProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('company_profiles')) {
            Schema::table('company_profiles', function($table) {
                $table->foreign('company_profile_type_id', 'fk_company_profiles_company_profile_types')->references('id')->on('company_profile_types')->onDelete('cascade')->onUpdate('restrict');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
