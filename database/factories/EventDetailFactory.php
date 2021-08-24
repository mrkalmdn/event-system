<?php

namespace Database\Factories;

use App\Models\EventDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EventDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => now()->format('Y-m-d'),
        ];
    }
}
