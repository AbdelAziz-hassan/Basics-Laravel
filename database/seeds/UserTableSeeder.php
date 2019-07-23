<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        \Eloquent::unguard();

        //disable foreign key check for this connection before running seeders
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        App\User::create([
            'name'=>'Super Admin',
            'email'=> 'superadmin@aflamk.com',
            'password'=>Hash::make('admin'),
            'type'=>'super_admin',
        ]);
        App\User::create([
            'name'=>'admin',
            'email'=> 'admin@aflamk.com',
            'password'=>Hash::make('admin'),
            'type'=>'admin',
        ]);
    }
}
