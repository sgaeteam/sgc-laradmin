<?php

use Illuminate\Database\Seeder;
use App\Models\Cobranca;

class CobrancasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * Fonte das informações: Reunião com Vitola em 13/07/2017.
     */
    public function run()
    {

         $cobrancas = array (
            [
                'descricao' => 'Secretaria',
            ],
            [
                'descricao' => 'BANEB - Ag. Centro',
            ],
            [
                'descricao' => 'Folha de Pagamento',
            ],
            [
                'descricao' => 'Isento de Pagamento', 
            ],  
            [
                'descricao' => 'Sócio Afim',
            ]               
        );
        
        foreach ($cobrancas as $cobranca) {

            Cobranca::create($cobranca);
        }          
    }
}
