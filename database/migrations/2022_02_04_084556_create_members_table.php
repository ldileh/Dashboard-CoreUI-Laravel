<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->integer('member_status_id')->unsigned()->default(config('constants.MEMBER.STATUS.REGISTER'));
            $table->string('name', 225);
            $table->string('birth_place');
            $table->date('birth_date');
            $table->enum('gender', ['m', 'f']);
            $table->string('nik', 30);
            $table->string('profession', 100);
            $table->string('address', 225);
            $table->string('phone_number', 25);
            $table->string('email', 125);
            $table->string('file_ktp', 125);
            $table->string('file_passport_photo', 125);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
