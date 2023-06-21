<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Skill>
 */
class SkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $doctors = User::role(['doctor'])->pluck('id');

        return [
            'title'=>$this->faker->word(),
            'specialty'=>Specialty::all()->random()->name,
            'description'=>$this->faker->text(250),
            'user_id'=>$this->faker->randomElement($doctors)
        ];
    }
}
