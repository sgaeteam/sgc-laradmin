<?php

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     *
     * Fonte das informações: Reunião com Vitola em 13/07/2017.
     */
    public function run()
    {
        
         $categorias = array (
            [
                'descricao' => 'Sócio A', 
                'mensalidade' => '40.13',
                'convites' => '4',
            ],
            [
                'descricao' => 'Sócio B', 
                'mensalidade' => '50.00',
                'convites' => '4',
            ],
            [
                'descricao' => 'Sócio Benemérito', 
                'mensalidade' => '0.00',
                'convites' => '4',
            ],
            [
                'descricao' => 'Sócio Remido', 
                'mensalidade' => '0.00',
                'convites' => '4',
            ],  
            [
                'descricao' => 'Sócio Afim', 
                'mensalidade' => '40.13',
                'convites' => '4',
            ],            
            [
                'descricao' => 'Sócio a Petros', 
                'mensalidade' => '40.13',
                'convites' => '4',
            ],
            [
                'descricao' => 'Sócio Honorário', 
                'mensalidade' => '0.00',
                'convites' => '4',
            ],  
            [
                'descricao' => 'Sócio Contribuinte', 
                'mensalidade' => '50.00',
                'convites' => '4',
            ],              
            [
                'descricao' => 'Conveniado', 
                'mensalidade' => '0.00',
                'convites' => '2',
            ],  
            [
                'descricao' => 'CEPE(S)', 
                'mensalidade' => '35.11',
                'convites' => '4',
            ], 
            [
                'descricao' => 'COMAB', 
                'mensalidade' => '20.00',
                'convites' => '4',
            ],              
            [
                'descricao' => 'SINDPREV/BA', 
                'mensalidade' => '6.10',
                'convites' => '4',
            ],   
            [
                'descricao' => 'ELEQUEIROZ', 
                'mensalidade' => '5.13',
                'convites' => '4',
            ],               
            [
                'descricao' => 'BR Distribuidoras S.A.', 
                'mensalidade' => '40.13',
                'convites' => '4',
            ], 
            [
                'descricao' => 'Unificado', 
                'mensalidade' => '5.13',
                'convites' => '4',
            ], 
            [
                'descricao' => 'Sócio Atleta', 
                'mensalidade' => '40.00',
                'convites' => '4',
            ],             
            [
                'descricao' => 'SINDI-SAUDE', 
                'mensalidade' => '6.10',
                'convites' => '4',
            ],   
            [
                'descricao' => 'DESENBAHIA', 
                'mensalidade' => '20.00',
                'convites' => '4',
            ],   
            [
                'descricao' => 'AMIRFA', 
                'mensalidade' => '40.00',
                'convites' => '4',
            ]               
        );
        
        foreach ($categorias as $categoria) {

            Categoria::create($categoria);
        }
    }
}
