<?php

use Illuminate\Database\Seeder;

class ChecklistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Checklist::create([
            'Nombre' =>'Auditor',
            'Descripcion' =>'Solo para auditor',
            'id_usuario' =>1,
            'id_frecuencia' =>1,
            'tipo_id' =>1
        ]);
    }
}
