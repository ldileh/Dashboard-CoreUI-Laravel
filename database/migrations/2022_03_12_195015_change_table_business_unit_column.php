<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTableBusinessUnitColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('business_units')) {
            Schema::table('business_units', function($table) {
                $table->bigInteger('business_unit_id')->nullable()->unsigned();
                $table->string('url_page', 225)->nullable();
                $table->longText('content')->nullable()->change();
            });
        }

        if (Schema::hasTable('business_units')) {
            Schema::table('business_units', function($table) {
                $table->foreign('business_unit_id', 'fk_business_unit_business_unit')->references('id')->on('business_units')->onDelete('cascade')->onUpdate('restrict');
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
        //
    }
}
