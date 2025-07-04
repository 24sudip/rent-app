<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // admin
            [
                'name'=>'Admin',
                'slug'=>'admin',
                'email'=>'admin@gmail.com',
                'password'=>Hash::make('111'),
                'role'=>'admin'
            ],
            // manager
            [
                'name'=>'Manager',
                'slug'=>'manager',
                'email'=>'manager@gmail.com',
                'password'=>Hash::make('111'),
                'role'=>'manager'
            ],
            // user
            [
                'name'=>'User',
                'slug'=>'user',
                'email'=>'user@gmail.com',
                'password'=>Hash::make('111'),
                'role'=>'user'
            ]
        ]);
    }
}
