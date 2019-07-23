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
// | Desenvolvimento Boleto Bradesco: Ramon Soares						  |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Reescrito como classes e pacote para o composer com Facade para o    |
// | Laravel.						                                      |
// | Miquéias de Souza <miqueiasdesouza@live.com>                         |
// +----------------------------------------------------------------------+

require_once __DIR__.'/Core/CoreBoletos.php';

use Miqueiasdesouza\Boleto\Boletos\Core\CoreBoletos as Core;

class BoletoBradesco extends Core
{

    public function setFuncoes()
    {
        $this->dadosboleto = array_merge($this->dadosboleto, $this->sacado, $this->cedente);

        //dd($this->dadosboleto['conta']);
        $codigobanco = "237";
        $codigo_banco_com_dv = $this->geraCodigoBanco($codigobanco);
        $nummoeda = "9";
        $fator_vencimento = $this->fator_vencimento($this->dadosboleto["data_vencimento"]);

        //valor tem 10 digitos, sem virgula
        $valor = $this->formata_numero($this->dadosboleto["valor_boleto"], 10, 0, "valor");
        //agencia é 4 digitos
        $agencia = $this->formata_numero($this->dadosboleto["agencia"], 4, 0);
        //conta é 6 digitos
        $conta = $this->formata_numero($this->dadosboleto["conta"], 6, 0);
        //dv da conta
        $conta_dv = $this->formata_numero($this->dadosboleto["conta_dv"], 1, 0);
        //carteira é 2 caracteres
        $carteira = $this->dadosboleto["carteira"];

        //nosso número (sem dv) é 11 digitos
        $nnum = $this->formata_numero($this->dadosboleto["carteira"], 2, 0) . $this->formata_numero($this->dadosboleto["nosso_numero"], 11, 0);
        //dv do nosso número
        $dv_nosso_numero = $this->digitoVerificador_nossonumero($nnum);

        //conta cedente (sem dv) é 7 digitos
        $conta_cedente = $this->formata_numero($this->dadosboleto["conta_cedente"], 7, 0);
        //dv da conta cedente
        $conta_cedente_dv = $this->formata_numero($this->dadosboleto["conta_cedente_dv"], 1, 0);

        //$ag_contacedente = $agencia . $conta_cedente;

        // 43 numeros para o calculo do digito verificador do codigo de barras
        $dv = $this->digitoVerificador_barra("$codigobanco$nummoeda$fator_vencimento$valor$agencia$nnum$conta_cedente" . '0', 9, 0);
        // Numer para o codigo de barras com 44 digitos
        $linha = "$codigobanco$nummoeda$dv$fator_vencimento$valor$agencia$nnum$conta_cedente" . "0";

        $nossonumero = substr($nnum, 0, 2) . '/' . substr($nnum, 2) . '-' . $dv_nosso_numero;
        $agencia_codigo = $agencia . "-" . $this->dadosboleto["agencia_dv"] . " / " . $conta_cedente . "-" . $conta_cedente_dv;

        $this->dadosboleto["codigo_barras"] = $linha;
        $this->dadosboleto["linha_digitavel"] = $this->monta_linha_digitavel($linha);
        $this->dadosboleto["agencia_codigo"] = $agencia_codigo;
        $this->dadosboleto["nosso_numero"] = $nossonumero;
        $this->dadosboleto["codigo_banco_com_dv"] = $codigo_banco_com_dv;

        return $this->dadosboleto;

    }

    private function digitoVerificador_nossonumero($numero)
    {
        $resto2 = $this->modulo_11($numero, 7, 1);
        $digito = 11 - $resto2;
        if ($digito == 10) {
            $dv = "P";
        } elseif ($digito == 11) {
            $dv = 0;
        } else {
            $dv = $digito;
        }
        return $dv;
    }

    private function digitoVerificador_barra($numero)
    {
        $resto2 = $this->modulo_11($numero, 9, 1);
        if ($resto2 == 0 || $resto2 == 1 || $resto2 == 10) {
            $dv = 1;
        } else {
            $dv = 11 - $resto2;
        }
        return $dv;
    }

    private function fator_vencimento($data)
    {
        $data = explode("/", $data);
        $ano = $data[2];
        $mes = $data[1];
        $dia = $data[0];
        return (abs(($this->_dateToDays("1997", "10", "07")) - ($this->_dateToDays($ano, $mes, $dia))));
    }

    private function monta_linha_digitavel($codigo)
    {

        // 01-03    -> Código do banco sem o digito
        // 04-04    -> Código da Moeda (9-Real)
        // 05-05    -> Dígito verificador do código de barras
        // 06-09    -> Fator de vencimento
        // 10-19    -> Valor Nominal do Título
        // 20-44    -> Campo Livre (Abaixo)

        // 20-23    -> Código da Agencia (sem dígito)
        // 24-05    -> Número da Carteira
        // 26-36    -> Nosso Número (sem dígito)
        // 37-43    -> Conta do Cedente (sem dígito)
        // 44-44    -> Zero (Fixo)


        // 1. Campo - composto pelo código do banco, código da moéda, as cinco primeiras posisões
        // do campo livre e DV (modulo10) deste campo

        $p1 = substr($codigo, 0, 4);                            // Numero do banco + Carteira
        $p2 = substr($codigo, 19, 5);                        // 5 primeiras posisões do campo livre
        $p3 = $this->modulo_10("$p1$p2");                        // Digito do campo 1
        $p4 = "$p1$p2$p3";                                // Unio
        $campo1 = substr($p4, 0, 5) . '.' . substr($p4, 5);

        // 2. Campo - composto pelas posiçoes 6 a 15 do campo livre
        // e livre e DV (modulo10) deste campo
        $p1 = substr($codigo, 24, 10);                        //Posições de 6 a 15 do campo livre
        $p2 = $this->modulo_10($p1);                                //Digito do campo 2
        $p3 = "$p1$p2";
        $campo2 = substr($p3, 0, 5) . '.' . substr($p3, 5);

        // 3. Campo composto pelas posicoes 16 a 25 do campo livre
        // e livre e DV (modulo10) deste campo
        $p1 = substr($codigo, 34, 10);                        //Posições de 16 a 25 do campo livre
        $p2 = $this->modulo_10($p1);                                //Digito do Campo 3
        $p3 = "$p1$p2";
        $campo3 = substr($p3, 0, 5) . '.' . substr($p3, 5);

        // 4. Campo - digito verificador do codigo de barras
        $campo4 = substr($codigo, 4, 1);

        // 5. Campo composto pelo fator vencimento e valor nominal do documento, sem
        // indicacao de zeros a esquerda e sem edicao (sem ponto e virgula). Quando se
        // tratar de valor zerado, a representacao deve ser 000 (tres zeros).
        $p1 = substr($codigo, 5, 4);
        $p2 = substr($codigo, 9, 10);
        $campo5 = "$p1$p2";

        return "$campo1 $campo2 $campo3 $campo4 $campo5";
    }


}
