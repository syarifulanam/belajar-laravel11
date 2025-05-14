<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();

        User::factory()
            ->count(5)
            ->create();

        // DB::table('users')->insert([
        //     'name' => 'admin',
        //     'email' => 'admin@email.com',
        //     'password' => Hash::make('adminP4ssw0rd'),
        // ]);

        // DB::table('users')->insert([
        //     'name' => 'anam',
        //     'email' => 'anam18@gmail.com',
        //     'password' => Hash::make('user1P4ssw0rd'),
        // ]);
    }
}
