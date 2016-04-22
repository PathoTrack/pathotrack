<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class OauthClientTableSeeder extends Seeder {

    public function run()
    {
        DB::table('oauth_clients')->delete();

        DB::table('oauth_clients')->insert(
            ['id' => 'zgisIxWAehLZ4mvr', 'secret' => 'fGXnEsBQFqxNgxIIpWqNUiBw7VdDv0oK', 'name' => 'webapp']
        );
        DB::table('oauth_clients')->insert(
            ['id' => 'ZDRbRrJF1vO6kaIN', 'secret' => 'LtMpgJl5ink5dFrz1j6mOBVc1F91Wj0c', 'name' => 'mobileapp']
        );

    }
}