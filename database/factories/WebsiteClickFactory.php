<?php

// database/factories/WebsiteClickFactory.php

namespace Database\Factories;

use App\Models\WebsiteClick;
use Illuminate\Database\Eloquent\Factories\Factory;

class WebsiteClickFactory extends Factory
{
    protected $model = WebsiteClick::class;

    public function definition()
    {
        return [
            'date' => $this->faker->date,  // Random date
            'count' => $this->faker->numberBetween(1, 500), // Random number of clicks between 1 and 500
        ];
    }
}
