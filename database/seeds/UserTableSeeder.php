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
        //
        $data = file_get_contents('storage/app/user.sql');
        $data = json_decode($data,true);
         \App\User::insert($data);
    }
}
