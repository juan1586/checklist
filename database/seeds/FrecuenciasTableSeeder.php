<?php

use Illuminate\Database\Seeder;

class FrecuenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          // factory(LaraDex\Rol::class,2)->create();
          App\Frecuencia::create([
            'Nombre' =>'Bimestral'
        ]);

        App\Frecuencia::create([
            'Nombre' =>'Semestral'
        ]);
        App\Frecuencia::create([
            'Nombre' =>'Diario',
            
        ]);
    }
}
