<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name'     =>'juan pablo',
            'email'    =>'jpg1586@gmail.com',
            'password' => bcrypt('12345678'),
            'id_rol'     =>'1'
        ]);
        App\User::create([
            'name'     =>'juan camilo parra',
            'email'    =>'camilo.parra@spacialized.com',
            'password' => bcrypt('12345678'),
            'id_rol'     =>'1'
        ]);
    }
}
