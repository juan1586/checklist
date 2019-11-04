<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChecklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ 
    public function up() 
    {
        Schema::create('checklists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Nombre')->unique();
            $table->text('Descripcion')->nullable();;            
            $table->unsignedInteger('id_usuario')->nullable();
            $table->unsignedInteger('id_frecuencia')->nullable();
            $table->timestamps();
            
            $table->foreign('id_usuario')->references('id')->on('users')
            ->onDelete('set null')
            ->onUpdate('cascade');

            $table->foreign('id_frecuencia')->references('id')->on('frecuencias')
            ->onDelete('set null')
            ->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropForeign(['id_usuario']);
        Schema::dropForeign(['id_frecuancia']);
        Schema::dropIfExists('checklists');
    }
}
