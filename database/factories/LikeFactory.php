<?php

// database/factories/LikeFactory.php

namespace Database\Factories;

use App\Models\Like;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    protected $model = Like::class;

    public function definition()
    {
        return [
            'category' => $this->faker->randomElement(['business', 'service', 'website']), // Random category from these options
            'count' => $this->faker->numberBetween(1, 1000), // Random count of likes between 1 and 1000
        ];
    }
}
