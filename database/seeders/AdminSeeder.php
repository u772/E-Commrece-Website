<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
        'name' => 'Admin',
        'email' => 'admin@gmail.com',
        'password' => Hash::make('12345678'),
        'phone_number' => '03176318139',
        'address'=>'Rahim Yar Khan',
        'role' => 'admin',
        'email_verified_at' => now(),
        'created_at' => now(),
        'updated_at' => now(),   
      ]);
    }
    
}
