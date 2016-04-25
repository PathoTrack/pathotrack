<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use PathoTrack\Role;

class RoleTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();
        
        Role::create(['name' => 'staff', 'display_name' => 'Staff', 'description' => null]);
        Role::create(['name' => 'vendor', 'display_name' => 'Vendor', 'description' => null]);
        Role::create(['name' => 'admin', 'display_name' => 'Admin', 'description' => null]);
    }

}