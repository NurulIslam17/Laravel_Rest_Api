<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['name' => 'Nurul','email' => 'nurul@gmail.com','password' =>'nurul123'],
            ['name' => 'Anirban','email' => 'anir@gmail.com','password' =>'anir123'],
            ['name' => 'Jovan','email' => 'jovan@gmail.com','password' =>'jovan123']
        ]);
    }
}
