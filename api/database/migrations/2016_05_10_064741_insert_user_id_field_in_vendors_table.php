<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertUserIdFieldInVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendors', function(Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable()->after('id');
        });

        Schema::table('vendors', function($table) {
           $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('vendors', function(Blueprint $table) {
            $table->dropColumn(['name']);
            $table->dropColumn(['email']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendors', function(Blueprint $table) {
            $table->dropColumn(['user_id']);
            $table->string('name')->after('id');
            $table->string('email')->after('name');
        });
    }
}
