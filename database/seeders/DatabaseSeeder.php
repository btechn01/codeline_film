<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Film;
use App\Models\User;
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
        User::factory(10)->create();
        Film::factory(3)->create();
        $films = Film::all();
        $films->each(function ($film) {
            Comment::factory(1)
                ->create([
                    'film_id' => $film->id,
                    'user_id' => User::all()->random()->id
                ]);
        });
    }
}
