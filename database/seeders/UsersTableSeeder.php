<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'mehdi',
            'email' => 'mahdisetayande@yahoo.com',
            'password' => bcrypt('password'),
            'phone' => '09919979109'
        ]);
        DB::table('user_requests')->insert([
            'user_id' => '1',
            'src' => 'THR',
            'dst' =>'ISF',
            'date' => '2023-23-23'
        ]);
    }
}
