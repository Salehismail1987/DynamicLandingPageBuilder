<?php

// database/factories/WebsiteVisitorFactory.php

namespace Database\Factories;

use App\Models\WebsiteVisitor;
use Illuminate\Database\Eloquent\Factories\Factory;

class WebsiteVisitorFactory extends Factory
{
    protected $model = WebsiteVisitor::class;

    public function definition()
    {
        return [
            'date' => $this->faker->date,  // Random date
            'count' => $this->faker->numberBetween(1, 500), // Random number of visitors between 1 and 500
        ];
    }
}
