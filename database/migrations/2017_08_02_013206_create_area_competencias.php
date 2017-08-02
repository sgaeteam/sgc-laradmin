<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaCompetencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Module::generate("Area_Competencias", 'area_competencias', 'sigla', 'fa-list', [
            ["sigla", "Sigla", "String", true, "", 2, 10, true],
            ["descricao", "Descrição", "String", false, "", 0, 256, true],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('area_competencias')) {
            Schema::drop('area_competencias');
        }
    }
}
