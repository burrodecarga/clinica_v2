<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicine>
 */
class MedicineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
$name =  $this->faker->streetName();
        return [
            'name' => $name,
            'slug' =>Str::slug($name),
            'active'=>'activo',
            'presentation'=>$this->faker->randomElement(['comprimido','pastillas','grageas',
            'Polvos medicinales',
'Papelillos',
'Tabletas',
'Comprimidos',
'Grageas',
'Píldoras',
'Cápsulas',
'Suspensión para vía oral',
'Ampollas',
'Jarabes',
'Pociones',
'Melitos',
'Tisanas',
'Vinos medicinales',
'Limonadas',
'Inyectables',
'Emulsiones',
'Colirios',
'Gotas nasales',
'Gotas óticas',
'Colutorios',
'Irrigaciones',
'Enemas',
'Supositorios',
'Óvulos',
'Pomadas',
'Jabones',
'Emplastos',
'Aerosoles',
'jarabe']),
'via'=>$this->faker->randomElement(['oral','inyectable','tópico']),
'company'=>$this->faker->company()

        ];
    }
}

