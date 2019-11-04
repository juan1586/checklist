<?php

use Illuminate\Database\Seeder;

class TiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Tipo::create([
            'Nombre' =>'Coordinador Zona',           
        ]);
        App\Tipo::create([           
            'Nombre' =>'Anfitrión',            
        ]);
        App\Tipo::create([
            'Nombre' =>'Coordinador Zona - Anfitrión',
        ]);
    }
}
