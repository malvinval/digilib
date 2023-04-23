<?php

namespace Database\Seeders;

use App\Models\Authors;
use App\Models\Books;
use App\Models\Categories;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(9)->create();
        Authors::factory(10)->create();
        Books::factory(10)->create();

        Categories::create([
            "name" => "Comedy",
            "slug" => "comedy"
        ]);

        Categories::create([
            "name" => "Romance",
            "slug" => "romance"
        ]);

        Categories::create([
            "name" => "Science Fiction",
            "slug" => "scifi"
        ]);
    }
}
