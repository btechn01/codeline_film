<?php

namespace Database\Factories;

use App\Models\Film;
use Illuminate\Database\Eloquent\Factories\Factory;

class FilmFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Film::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(5),
            'description' => $this->faker->realText(rand(80, 600)),
            'release_date' => $this->faker->date(),
            'rating' => $this->faker->numberBetween(1, 5),
            'ticket_price' => $this->faker->numberBetween(1, 10),
            'country' => $this->faker->country,
            'photo' => '/storage/' . $this->faker->image('public/storage', 400, 300, null, false),
            'genres' => json_encode($this->faker->randomElements([
                "Action",
                "Adventure",
                "Comedy",
                "Crime",
                "Drama",
                "Historical",
                "Epics",
                "Horror",
                "Musical",
                "Dance",
                "Science fiction",
                "War",
                "Westerns"
            ]))
        ];
    }
}
