<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();
            $table->dropColumn('last_name', 'national_code', 'phone', 'birthday', 'gender', 'bank_number', 'province_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('last_name');
            $table->string('national_code');
            $table->string('phone');
            $table->string('birthday');
            $table->tinyInteger('gender');
            $table->string('bank_number');
            $table->unsignedBigInteger('province_id');
            $table->dropColumn('profile_photo_path');
            $table->dropForeign(['current_team_id']);
        });
    }
}
