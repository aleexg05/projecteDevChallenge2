<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Àlex',
                'email' => 'alexhey744@gmail.com',
                'password' => Hash::make('secret'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}