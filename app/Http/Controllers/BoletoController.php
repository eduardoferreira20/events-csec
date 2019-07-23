<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Miqueiasdesouza\Boleto\Laravel\v5\BoletoFacade;
use Miqueiasdesouza;
use Miqueiasdesouza\Boleto\Boleto;
use Illuminate\Support\Facades\Auth;

class BoletoController extends Controller
{
	public function boleto(){


		$boleto = new Boleto;

    $boleto->sacado(array(
            'sacado'    => "Nome do seu Cliente",
            'endereco1' => "Endereço do seu Cliente",
            'endereco2' => "Cidade - Estado -  CEP: 00000-000"
        ));

 $boleto->cedente(array(
            'agencia'           => "1100", // Num da agencia, sem digito
            'agencia_dv'        => "0", // Digito do Num da agencia
            'conta'             => "0102003",     // Num da conta, sem digito
            'conta_dv'          => "4",
            'conta_cedente'     => "0102003", // ContaCedente do Cliente, sem digito (Somente Números)
            'conta_cedente_dv'  => "4", // Digito da ContaCedente do Cliente
            'carteira'          => "06",  // Código da Carteira: pode ser 06 ou 03
            'identificacao'     => "BoletoPhp - Código Aberto de Sistema de Boletos",
            'cpf_cnpj'          => "",
            'endereco'          => "Coloque o endereço da sua empresa aqui",
            'cidade_uf'         => "Cidade / Estado",
            'cedente'           => "Coloque a Razão Social da sua empresa aqui",
            'contrato'          =>  "12345678900"
        ));

        $boleto->banco('bradesco', array(
            'valor_boleto'          => '289,90', // Nosso numero sem o DV - REGRA: Máximo de 11 caracteres!
            'nosso_numero'          => '789', //Num do pedido ou do documento = Nosso numero
            'numero_documento'      =>  '789', //// Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
            'data_vencimento'       =>  date('d/m/Y'), //Data de emissão do Boleto
            'data_documento'        =>  date('d/m/Y'), //Data de processamento do boleto (opcional)
            'valor_unitario'        =>  '289,90',
            'demonstrativo1'        =>  "Pagamento de Compra na Loja Nonononono",
            'demonstrativo2'        =>  "Mensalidade referente a ...",
            'demonstrativo3'        =>  "Empresa- http://www.seusite.com.br",
            'instrucoes1'           =>  "- Sr. Caixa, cobrar multa de 2% após o vencimento",
            'instrucoes2'           =>  "- Receber atá 10 dias após o vencimento",
            'instrucoes3'           =>  "- Em caso de dúvidas entre em contato conosco: contato@seusite.com.br",

        ));

//PARA GERAR O BOLETO EM PDF
// $boleto->pdf();

//PARA GERAR O BOLETO EM HTML
$boleto->html();
}

}
