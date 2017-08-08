<?php

use Illuminate\Database\Seeder;
use App\Models\Atividade;


class AtividadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 $atividades = array (
            [
                'descricao' => 'Capoeira', 
                'mensalidade' => '40.13',
            ],
            [
                'descricao' => 'Dança de Salão', 
                'mensalidade' => '50.00',
            ],
            [
                'descricao' => 'Futebol de Campo',
                'mensalidade' => '0.00',
            ],
            [
                'descricao' => 'Futebol Society',
                'mensalidade' => '0.00',
            ],            
            [
                'descricao' => 'Futebol de Mesa', 
                'mensalidade' => '0.00',
            ],  
            [
                'descricao' => 'Handebol',
                'mensalidade' => '0.00',
            ],           
            [
                'descricao' => 'Karate',
                'mensalidade' => '40.13',
            ],
            [
                'descricao' => 'Natação',
                'mensalidade' => '0.00',
            ],  
            [
                'descricao' => 'Patinação', 
                'mensalidade' => '50.00',
            ],              
            [
                'descricao' => 'Pilates',
                'mensalidade' => '0.00',
            ],  
            [
                'descricao' => 'Tai Chi Chuan',
                'mensalidade' => '20.00',
            ]               
        );
        
        foreach ($atividades as $atividade) {
            Atividade::create($atividade);
        } 
    }
}
