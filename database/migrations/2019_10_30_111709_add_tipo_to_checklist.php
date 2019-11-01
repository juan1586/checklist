<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTipoToChecklist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::table('checklists', function (Blueprint $table){
            $table->unsignedInteger('tipo_id')->nullable(); 

            $table->foreign('tipo_id')->references('id')->on('tipos')
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
        Schema::table('checklists', function (Blueprint $table){
            $table->dropForeign(['tipo_id']); 
            $table->dropColumn('tipo_id');    
        });
    }
}
