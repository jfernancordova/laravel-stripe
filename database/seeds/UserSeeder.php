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
            'name'          => 'Joan',
            'email'         => 'jane.doe@doe.me',
            'password'      => Hash::make('janePassword'),
            'token'         => str_random(64),
            'activated'     => true
        ));

    }
}