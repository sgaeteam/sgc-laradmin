<?php

use Illuminate\Database\Seeder;
use App\Models\Espaco;

class EspacosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * Fonte das informações: http://www.cepe2004.com.br/salao-de-festas
     */
    public function run()
    {

         $espacos = array (
            [
                'nome' => 'Recanto Familiar',
                'descricao' => 'Um espaço familiar, voltado para a descontração dos sócios e não sócios com seus amigos e parentes. Aonde pode ser feito um churrasco e também assar uma pizza, comportando 40 pessoas, onde são fornecidas cadeiras, mesas, grelha e pá de pizza.',
                'capacidade' => '40',
            ],
            [
                'nome' => 'Salão Verde',
                'descricao' => 'O espaço é voltado a realização de festas de aniversário, casamentos, bodas, confraternizações, chás beneficientes, coquetéis e convenções. Coberto, o ambiente possui ar condicionado e é equipado com freezer, cozinha com fogão, geladeira, mesas pranchões (3m x 60 cm)ou mesas redondas (1,50 diâmetro) e cadeiras de plástico. Para 250 pessoas.',
                'capacidade' => '250',
            ],
            [
                'nome' => 'Salão Amarelo',
                'descricao' => 'Outro espaço destinado a eventos sociais é o Salão Amarelo. Com ar condicionado, cozinha com fogão e freezer, o espaço tem capacidade para 150 pessoas e é ideal para a celebração de aniversário, casamentos, bodas, confraternizações, chás beneficentes, coquetéis e convenções. Juntamente com o aluguel do salão, estão inclusas mesas pranchões (3m x 60 cm)ou mesas redondas (1,50 diâmetro) e cadeiras de plástico.',
                'capacidade' => '150',
            ],
            [
                'nome' => 'Churrasqueira VIP',
                'descricao' => 'Trata-se de um espaço social, onde podem ser realizados aniversários confraternizações, entre outros, inclusive sendo anexa ao Salão Verde (que possui capacidade para 250 pessoas). Sua estrutura conta com ar condicionado, ventilador e freezer, com cadeiras de plástico e mesas pranchões (3m x 60 cm)ou mesas redondas ( 1,50 diâmetro)todos estes utensílios em um espaço totalmente coberto, com capacidade para 60 pessoas. 
                 Por ser anexa ao Salão Verde, a churrasqueira vip pode ser alugada juntamente com o salão, desta maneira, se alugados juntos, passa para uma capacidade total de 310 pessoas ( 60 pessoas na churrasqueira e 250 pessoas no salão).',
                'capacidade' => '310',
            ], 
            [
                'nome' => 'Churrasqueira Social',
                'descricao' => '',
                'capacidade' => '0',
            ],              
            [
                'nome' => 'Churrasqueira Familiar',
                'descricao' => '',
                'capacidade' => '0',
            ],   
            [
                'nome' => 'Campo de Futebol Society',
                'descricao' => '',
                'capacidade' => '0',
            ],    
            [
                'nome' => 'Quadra Poliesportiva',
                'descricao' => '',
                'capacidade' => '0',
            ],     
            [
                'nome' => 'Campo de Futebol (Gramado)',
                'descricao' => '',
                'capacidade' => '0',
            ],                
            [
                'nome' => 'Piscina Adulto',
                'descricao' => '',
                'capacidade' => '0',
            ],   
            [
                'nome' => 'Piscina Infantil',
                'descricao' => '',
                'capacidade' => '0',
            ],             
        );
        
        foreach ($espacos as $espaco) {

            Espaco::create($espaco);
        }   
    }
}
