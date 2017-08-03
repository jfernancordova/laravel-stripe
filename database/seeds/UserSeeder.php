<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder{

    public function run(){
        DB::table('users')->delete();

        User::create(array(
            'name'          => 'John',
            'email'         => 'jon@doe.com',
            'password'      => Hash::make('password'),
            'token'         => str_random(64),
            'activated'     => true
        ));

        User::create(array(
            'name'          => 'Joshn',
            'email'         => 'josh@gg.com',
            'password'      => Hash::make('password123'),
            'token'         => str_random(64),
            'activated'     => true
        ));

    }
}