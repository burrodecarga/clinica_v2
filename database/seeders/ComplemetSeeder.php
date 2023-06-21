<?php

namespace Database\Seeders;


use App\Models\Disase;
use App\Models\Interview;
use App\Models\Key;

use App\Models\Medicine;

use App\Models\Pathology;
use App\Models\Parameter;
use App\Models\Surgery;
use App\Models\Symptom;
use App\Models\User;
use App\Models\Complemento;
use App\Models\Vaccine;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;


class ComplemetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

/*         $json = File::get('database/data/cie10_1.json');
        $data = json_decode($json);
        $numero = 0;
        $codigo2='0';
        $codigo3='0';

        foreach ($data as $obj) {
           $num = $obj->num;
           $capitulo = $obj->capitulo;
           $cod_2 = $obj->cod_2;
           $name = $obj->name;
           $cod_3 = $obj->cod_3;
           $description = $obj->description;

           if($numero<>$num){
            $chapter = new Chapter([
             'name' => $obj->capitulo
           ]);
           $numero = $num;
           $chapter->save();
           }

            if($codigo2<>$cod_2){
                $subchapter = new SubChapter([
            'name' => $obj->name,
            'code' => $cod_2,
            'chapter_id' => $chapter->id
           ]);
           $codigo2=$cod_2;
           $subchapter->save();
            }


           if($codigo3<>$cod_3){
            $theme = new Theme([
            'name' => $obj->description,
            'code' => $cod_3,
            'subchapter_id' => $subchapter->id
           ]);
           $theme->save();
           $codigo3=$cod_3;

        }

        }
 */

$json = File::get('database/data/dosis.json');
$data = json_decode($json);
foreach ($data as $obj) {
    DB::insert('insert into dose (unidad,equivalencia,plural) values (?, ?,?)', [$obj->unidad, $obj->equivalencia, $obj->plural]);

}

$json = File::get('database/data/patologias.json');
$data = json_decode($json);
foreach ($data as $obj) {
    $pathology = new Pathology();
    $pathology->code = mb_strtolower($obj->c);
    $pathology->name = mb_strtolower($obj->d);
    $pathology->slug = Str::slug($obj->d);
    $pathology->save();
}

// $pathology = Pathology::where('name', 'like', '%alerg%')->get();
// foreach ($pathology as $p) {
//     Allergy::create([
//         'code' => $p->code,
//         'name' => $p->name,
//         'slug' => $p->slug,
//     ]);
// }

        $json = File::get('database/data/sintomas.json');
        $data = json_decode($json);
        foreach($data as $obj){
            $symptom = new Symptom();
            $symptom->name = mb_strtolower($obj->name);
            $symptom->slug = Str::slug($obj->name);
            $symptom->save();
        }

        $json = File::get('database/data/operaciones.json');
        $data = json_decode($json);
        foreach($data as $obj){
            $surgery = new Surgery();
            $surgery->name = mb_strtolower($obj->name);
            $surgery->slug = Str::slug($obj->name);
            $surgery->save();
        }


$json = File::get('database/data/chequeos.json');
$data = json_decode($json);
foreach ($data as $obj) {
    $key = new Key();
    $key->name = mb_strtolower($obj->name);
    //$key->slug = Str::slug($obj->name);
    $key->specialty = $obj->specialty;
    $key->group = $obj->group;
    $key->unit = $obj->unit;
    $key->max = $obj->max;
    $key->min = $obj->min;
    $key->save();
}


$json = File::get('database/data/parameter.json');
$data = json_decode($json);
foreach ($data as $obj) {
    $parameter = new Parameter();
    $parameter->name = mb_strtolower($obj->name);
    $parameter->proof = mb_strtolower($obj->proof);
    $parameter->proof_id = mb_strtolower($obj->proof_id);
    //$parameter->slug = Str::slug($obj->name);
    $parameter->unit = $obj->unit;
    $parameter->max_value_male = $obj->max_value_male;
    $parameter->min_value_male = $obj->min_value_male;
    $parameter->max_value_female = $obj->max_value_female;
    $parameter->min_value_female = $obj->min_value_female;
    $parameter->max_value_children = $obj->max_value_children;
    $parameter->min_value_children = $obj->min_value_children;
    $parameter->observations = ($obj->observations);
    $parameter->save();
}

// for ($i = 1; $i < 20; $i++) {
//     Medicine::create([
//         'name' => 'medicine' . $i,
//         'slug' => 'medicine' . $i,
//     ]);
// }

Medicine::factory()->count(25)->create();

for ($i = 1; $i < 20; $i++) {
    Vaccine::create([
        'name' => 'vacuna Número ' . $i,
        'slug' => 'vacuna Número ' . $i,
        'pai'=>random_int(0,1)
    ]);
}





        $patient = User::role('patient')->get();
        $surgeries =Surgery::inRandomOrder()->limit(3)->pluck('id');
        $symptoms =Symptom::inRandomOrder()->limit(5)->pluck('id');
        $disases = Disase::inRandomOrder()->limit(3)->pluck('id');
        $vaccines = Vaccine::inRandomOrder()->limit(3)->pluck('id');
        $pathologies = Pathology::inRandomOrder()->limit(4)->pluck('id');

        foreach($patient as $p){
            $observation = 'loremMagna veniam et exercitation id velit id veniam. Consectetur nostrud eu Lorem est cillum laborum exercitation dolor veniam proident. Proident mollit cupidatat ea aute incididunt sint voluptate occaecat ex. Eu anim proident velit ex dolor sit commodo do duis voluptate velit aliqua consectetur velit. Excepteur reprehenderit occaecat labore qui occaecat voluptate exercitation est consectetur tempor. Incididunt nisi nulla labore duis ex pariatur incididunt.';

            $rand = rand(50,100);
            $observation = Str::limit($observation, $rand);
            $p->surgeries()->attach($surgeries,
            ['year'=>1985,
            'observation'=>$observation,
            'name'=>Surgery::inRandomOrder()->limit(1)->pluck('name')->join("")

        ]);
            $p->disases()->attach($disases,['year'=>1985]);
            $doctors =User::role('doctor')->inRandomOrder()->limit(3)->pluck('id');
            foreach($doctors as $d){
                $interview = Interview::create([
                    'date' =>now(),
                    'suspicion'=>'loreVoluptate aliquip aliqua consectetur adipisicing labore sint non enim non. incididunt quis aliqua et ',
                    'diagnosis'=>'Anim voluptate aute ipsum ad excepteur sint ut. Aliqua aute ex sunt sint  officia eu commodo ipsum tempor.',
                    'doctor_id'=>$d,
                    'user_id'=>$p->id
                ]);
                 $p->symptoms()->attach($symptoms,
                 ['interview_id'=>$interview->id,
                 'name'=>Symptom::inRandomOrder()->limit(1)->pluck('name')->join("")
                ]);

                $int= mt_rand(1262055681,1262055681);
                $string = date("Y-m-d H:i:s",$int);


                $p->vaccines()->attach($vaccines,
                ['interview_id'=>$interview->id,
                'date'=>$string,
               ]);

               $p->pathologies()->attach($pathologies);

                  }


        }


        Complemento::factory()->count(25)->create();

        $complementos = Complemento::all();

        foreach($complementos as $c){
            DB::table('interview_medicine')->insert([
                'name'=>$c->name,
                'dose'=>$c->dose,
                'dose_unit'=>$c->dose_unit,
                'num_frecuency'=>$c->num_frecuency,
                'frecuency'=>$c->frecuency,
                'num_duration'=>$c->num_duration,
                'duration'=>$c->duration,
                'instruction'=>$c->instruction,
                'interview_id'=>$c->interview_id,
                'user_id'=>$c->user_id,
                'medicine_id'=>$c->medicine_id,
                'created_at'=>now()
            ]);
        }
    }
}
