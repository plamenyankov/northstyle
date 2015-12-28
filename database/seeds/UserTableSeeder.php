<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('users')->insert([
            [
                'name'=>'plamen',
                'email'=>'plamenyankov@yahoo.com',
                'password'=>bcrypt('secret')
            ]
        ]);
    }
}
