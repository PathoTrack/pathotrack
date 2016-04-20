<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('package_id');
            $table->unsignedInteger('profile_id')->nullable();
            $table->unsignedInteger('test_id');
            $table->timestamps();
        });

        Schema::table('package_tests', function($table) {
           $table->foreign('package_id')->references('id')->on('packages');
           $table->foreign('profile_id')->references('id')->on('tests');
           $table->foreign('test_id')->references('id')->on('tests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('package_tests');
    }
}
