<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // factory(LaraDex\Rol::class,2)->create();
         App\Rol::create([
            'Nombre' =>'Coordinador Operaciones'
        ]);

        App\Rol::create([
            'Nombre' =>'Coordinador Zona'
        ]);
        App\Rol::create([
            'Nombre' => 'Anfitrión'
        ]);
        App\Rol::create([
            'Nombre' => 'Invitado'
        ]);
    }

}
