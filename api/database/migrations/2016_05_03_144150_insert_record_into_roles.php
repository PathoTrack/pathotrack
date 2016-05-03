<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertRecordIntoRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $entries = DB::table('roles')->insert(array(
            array('name' => 'staff', 'display_name' => 'Staff', 'description' => null),
            array('name' => 'vendor', 'display_name' => 'Vendor', 'description' => null),
            array('name' => 'admin', 'display_name' => 'Admin', 'description' => null)
        ));
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
