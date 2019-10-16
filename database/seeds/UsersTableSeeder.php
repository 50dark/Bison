<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//        $user = new User();
//        $user->name ='Marie de Ubeda';
//        $user->email = 'm.de.Ubeda@gmail.com';
//        $user-> password = Hash::make('1234567890');
//        $user->save();
//        $user->roles()->attach(1);


        $user = new User();
        $user->name ="Bob l'eponge";
        $user->email = "bob.leponge@gmail.com";
        $user-> password = Hash::make('1234567890');
        $user->save();
        $user->roles()->attach(2);

    }
}

