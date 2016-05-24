<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('dob')->nullable()->after('email');
            $table->enum('sex', ['Male', 'Female'])->after('dob');
            $table->string('phone_number')->nullable()->after('sex');
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
            $table->dropColumn(['dob']);
            $table->dropColumn(['sex']);
            $table->dropColumn(['phone_number']);
        });
    }
}
