<?php

namespace Database\Factories;

use App\Models\Interview;
use App\Models\Medicine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class InterviewMedicineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'interview_id'=>Interview::inRandomOrder()->limit(3)->pluck('id'),
            'medicine_id'=>Medicine::inRandomOrder()->limit(3)->pluck('id'),


        ];
    }
}
