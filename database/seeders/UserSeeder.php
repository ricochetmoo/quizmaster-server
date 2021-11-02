<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert
        ([
            'name' => 'Admin Deleteme',
            'email' => 'john.doe@jamesbarber.tech',
            'password' => app('hash')->make('password')
        ]);
    }
}
