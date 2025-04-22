<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blogs')->truncate();

        Blog::factory()
            ->count(30)
            ->create();

        // DB::table('blogs')->insert([
        //     'title' => "Blog 2",
        //     'description' => 'Ini adalah description untuk blog 2',
        // ]);

        // DB::table('blogs')->insert([
        //     'title' => "Blog 3",
        //     'description' => 'Ini adalah description untuk blog 3',
        // ]);

        // DB::table('blogs')->insert([
        //     'title' => "Blog 4",
        //     'description' => 'Ini adalah description untuk blog 4',
        // ]);
    }
}
