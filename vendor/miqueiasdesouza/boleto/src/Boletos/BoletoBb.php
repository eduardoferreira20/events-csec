<?php
// +----------------------------------------------------------------------+
// | BoletoPhp - Versão Beta                                              |
// +----------------------------------------------------------------------+
// | Este arquivo está disponível sob a Licença GPL disponível pela Web   |
// | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
// | Você deve ter recebido uma cópia da GNU Public License junto com     |
// | esse pacote; se não, escreva para:                                   |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Originado do Projeto BBBoletoFree que tiveram colaborações de Daniel |
// | William Schultz e Leandro Maniezo que por sua vez foi derivado do	  |
// | PHPBoleto de João Prado Maia e Pablo Martins F. Costa				  |
// | 																	  |
// | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Equipe Coordenação Projeto BoletoPhp: <boletophp@boletophp.com.br>   |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Reescrito como classes e pacote para o composer com Facade para o    |
// | Laravel.						                                      |
// | Miquéias de Souza <miqueiasdesouza@live.com>                         |
// +----------------------------------------------------------------------+

require_once __DIR__.'/Core/CoreBoletos.php';

use Miqueiasdesouza\Boleto\Boletos\Core\CoreBoletos as Core;

class BoletoBb extends Core
{

    public function setFuncoes()
    {
        $this->dadosboleto = array_merge($this->dadosboleto, $this->sacado, $this->cedente);


        $codigobanco = "001";
        $codigo_banco_com_dv = $this->geraCodigoBanco($codigobanco);
        $nummoeda = "9";
        $fator_vencimento = $this->fator_vencimento($this->dadosboleto["data_vencimento"]);

        //valor tem 10 digitos, sem virgula
        $valor = $this->formata_numero($this->dadosboleto["valor_boleto"],10,0,"valor");
        //agencia é sempre 4 digitos
        $agencia = $this->formata_numero($this->dadosboleto["agencia"],4,0);
        //conta é sempre 8 digitos
        $conta = $this->formata_numero($this->dadosboleto["conta"],8,0);
        //carteira 18
        $carteira = $this->dadosboleto["carteira"];
        //agencia e conta
        $agencia_codigo = $agencia."-". $this->modulo_11($agencia) ." / ". $conta ."-". $this->modulo_11($conta);
        //Zeros: usado quando convenio de 7 digitos
        $livre_zeros='000000';

        // Carteira 18 com Convênio de 8 dígitos
        if ($this->dadosboleto["formatacao_convenio"] == "8") {
            $convenio = $this->formata_numero($this->dadosboleto["convenio"],8,0,"convenio");
            // Nosso n�mero de até 9 dígitos
            $nossonumero = $this->formata_numero($this->dadosboleto["nosso_numero"],9,0);
            $dv=$this->modulo_11("$codigobanco$nummoeda$fator_vencimento$valor$livre_zeros$convenio$nossonumero$carteira");
            $linha = "$codigobanco$nummoeda$dv$fator_vencimento$valor$livre_zeros$convenio$nossonumero$carteira";
            //montando o nosso numero que aparecerá no boleto
            $nossonumero = $convenio . $nossonumero ."-". $this->modulo_11($convenio.$nossonumero);
        }

        // Carteira 18 com Convênio de 7 dígitos
        if ($this->dadosboleto["formatacao_convenio"] == "7") {
            $convenio = $this->formata_numero($this->dadosboleto["convenio"],7,0,"convenio");
            // Nosso número de até 10 dígitos
            $nossonumero = $this->formata_numero($this->dadosboleto["nosso_numero"],10,0);
            $dv=$this->modulo_11("$codigobanco$nummoeda$fator_vencimento$valor$livre_zeros$convenio$nossonumero$carteira");
            $linha="$codigobanco$nummoeda$dv$fator_vencimento$valor$livre_zeros$convenio$nossonumero$carteira";
            $nossonumero = $convenio.$nossonumero;
            //Não existe DV na composição do nosso-número para convênios de sete posições
        }

        // Carteira 18 com Convênio de 6 dígitos
        if ($this->dadosboleto["formatacao_convenio"] == "6") {
            $convenio = $this->formata_numero($this->dadosboleto["convenio"],6,0,"convenio");

            if ($this->dadosboleto["formatacao_nosso_numero"] == "1") {

                // Nosso número de até 5 dígitos
                $nossonumero = $this->formata_numero($this->dadosboleto["nosso_numero"],5,0);
                $dv = $this->modulo_11("$codigobanco$nummoeda$fator_vencimento$valor$convenio$nossonumero$agencia$conta$carteira");
                $linha = "$codigobanco$nummoeda$dv$fator_vencimento$valor$convenio$nossonumero$agencia$conta$carteira";
                //montando o nosso numero que aparecerá no boleto
                $nossonumero = $convenio . $nossonumero ."-". $this->modulo_11($convenio.$nossonumero);
            }

            if ($this->dadosboleto["formatacao_nosso_numero"] == "2") {

                // Nosso número de até 17 dígitos
                $nservico = "21";
                $nossonumero = $this->formata_numero($this->dadosboleto["nosso_numero"],17,0);
                $dv = $this->modulo_11("$codigobanco$nummoeda$fator_vencimento$valor$convenio$nossonumero$nservico");
                $linha = "$codigobanco$nummoeda$dv$fator_vencimento$valor$convenio$nossonumero$nservico";
            }
        }

        $this->dadosboleto["codigo_barras"] = $linha;
        $this->dadosboleto["linha_digitavel"] = $this->monta_linha_digitavel($linha);
        $this->dadosboleto["agencia_codigo"] = $agencia_codigo;
        $this->dadosboleto["nosso_numero"] = $nossonumero;
        $this->dadosboleto["codigo_banco_com_dv"] = $codigo_banco_com_dv;

        return $this->dadosboleto;

    }


    private function fator_vencimento($data)
    {
        $data = explode("/",$data);
        $ano = $data[2];
        $mes = $data[1];
        $dia = $data[0];
        return(abs(($this->_dateToDays("1997","10","07")) - ($this->_dateToDays($ano, $mes, $dia))));
    }

    private function monta_linha_digitavel($linha)
    {

        // Posição 	Conteúdo
        // 1 a 3    Número do banco
        // 4        Código da Moeda - 9 para Real
        // 5        Digito verificador do Código de Barras
        // 6 a 19   Valor (12 inteiros e 2 decimais)
        // 20 a 44  Campo Livre definido por cada banco

        // 1. Campo - composto pelo código do banco, código da moéda, as cinco primeiras posições
        // do campo livre e DV (modulo10) deste campo
        $p1 = substr($linha, 0, 4);
        $p2 = substr($linha, 19, 5);
        $p3 = $this->modulo_10("$p1$p2");
        $p4 = "$p1$p2$p3";
        $p5 = substr($p4, 0, 5);
        $p6 = substr($p4, 5);
        $campo1 = "$p5.$p6";

        // 2. Campo - composto pelas posiçoes 6 a 15 do campo livre
        // e livre e DV (modulo10) deste campo
        $p1 = substr($linha, 24, 10);
        $p2 = $this->modulo_10($p1);
        $p3 = "$p1$p2";
        $p4 = substr($p3, 0, 5);
        $p5 = substr($p3, 5);
        $campo2 = "$p4.$p5";

        // 3. Campo composto pelas posicoes 16 a 25 do campo livre
        // e livre e DV (modulo10) deste campo
        $p1 = substr($linha, 34, 10);
        $p2 = $this->modulo_10($p1);
        $p3 = "$p1$p2";
        $p4 = substr($p3, 0, 5);
        $p5 = substr($p3, 5);
        $campo3 = "$p4.$p5";

        // 4. Campo - digito verificador do codigo de barras
        $campo4 = substr($linha, 4, 1);

        // 5. Campo composto pelo valor nominal pelo valor nominal do documento, sem
        // indicacao de zeros a esquerda e sem edicao (sem ponto e virgula). Quando se
        // tratar de valor zerado, a representacao deve ser 000 (tres zeros).
        $campo5 = substr($linha, 5, 14);

        return "$campo1 $campo2 $campo3 $campo4 $campo5";
    }


}
