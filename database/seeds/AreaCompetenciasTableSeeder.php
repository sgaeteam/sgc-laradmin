<?php

use Illuminate\Database\Seeder;
use App\Models\Area_Competencia;

class AreaCompetenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * Fonte das informações: Reunião com Vitola em 13/07/2017.
     */
    public function run()
    {
         $area_competencias = array (
            [
                'sigla' => 'E', 
                'descricao' => 'MM',
            ],
            [
                'sigla' => 'CD', 
                'descricao' => 'A',
            ],
            [
                'sigla' => 'DE', 
                'descricao' => 'RLAM',
            ]       
        );
        
        foreach ($area_competencias as $area_competencia) {

            Area_Competencia::create($area_competencia);
        }
    }
}
