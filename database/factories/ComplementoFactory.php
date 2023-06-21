<?php

namespace Database\Factories;

use App\Models\Interview;
use App\Models\Medicine;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Complemento>
 */
class ComplementoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $medicina = Medicine::inRandomOrder()->first();
        $dosis = DB::table('dose')->inRandomOrder()->first();


        return [
            'name'=>$medicina->name,
            'dose'=>$this->faker->randomDigit(),
            'dose_unit'=>$dosis->unidad,
            'num_frecuency'=>$this->faker->randomDigit(),
            'frecuency'=>$this->faker->randomElement(['horas','días','semanas','meses']),
            'num_duration'=>$this->faker->randomDigit(),
            'duration'=>$this->faker->randomElement(['días','semanas','meses']),
            'instruction'=>$this->faker->text(65),
            'interview_id'=>Interview::inRandomOrder()->first()->id,
            'user_id'=>User::inRandomOrder()->first()->id,
            'medicine_id'=>$medicina->id
        ];
    }
}
