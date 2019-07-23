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

class BoletoItau extends Core
{

    public function setFuncoes()
    {
        $this->dadosboleto = array_merge($this->dadosboleto, $this->sacado, $this->cedente);

        $codigobanco = "341";
        $codigo_banco_com_dv = $this->geraCodigoBanco($codigobanco);
        $nummoeda = "9";
        $fator_vencimento = $this->fator_vencimento($this->dadosboleto["data_vencimento"]);

        //valor tem 10 digitos, sem virgula
        $valor = $this->formata_numero($this->dadosboleto["valor_boleto"],10,0,"valor");
        //agencia 4 digitos
        $agencia = $this->formata_numero($this->dadosboleto["agencia"],4,0);
        //conta  5 digitos + 1 do dv
        $conta = $this->formata_numero($this->dadosboleto["conta"],5,0);

        $conta_dv = $this->formata_numero($this->dadosboleto["conta_dv"],1,0);
        //carteira 175
        $carteira = $this->dadosboleto["carteira"];
        //nosso_numero no maximo 8 digitos
        $nnum = $this->formata_numero($this->dadosboleto["nosso_numero"],8,0);

        $codigo_barras = $codigobanco.$nummoeda.$fator_vencimento.$valor.$carteira.$nnum.$this->modulo_10($agencia.$conta.$carteira.$nnum).$agencia.$conta.$this->modulo_10($agencia.$conta).'000';
        // 43 numeros para o calculo do digito verificador
        $dv = $this->digitoVerificador_barra($codigo_barras);
        // Numero para o codigo de barras com 44 digitos
        $linha = substr($codigo_barras,0,4).$dv.substr($codigo_barras,4,43);

        $nossonumero = $carteira.'/'.$nnum.'-'.$this->modulo_10($agencia.$conta.$carteira.$nnum);

        $agencia_codigo = $agencia." / ". $conta."-".$this->modulo_10($agencia.$conta);

        $this->dadosboleto["codigo_barras"] = $linha;

        $this->dadosboleto["linha_digitavel"] = $this->monta_linha_digitavel($linha); // verificar

        $this->dadosboleto["agencia_codigo"] = $agencia_codigo ;

        $this->dadosboleto["nosso_numero"] = $nossonumero;

        $this->dadosboleto["codigo_banco_com_dv"] = $codigo_banco_com_dv;

        return $this->dadosboleto;

    }

    private function digitoVerificador_barra($numero) {
        $resto2 = $this->modulo_11($numero, 9, 1);
        $digito = 11 - $resto2;
        if ($digito == 0 || $digito == 1 || $digito == 10  || $digito == 11) {
            $dv = 1;
        } else {
            $dv = $digito;
        }
        return $dv;
    }


    private function fator_vencimento($data)
    {
        $data = explode("/",$data);
        $ano = $data[2];
        $mes = $data[1];
        $dia = $data[0];
        return(abs(($this->_dateToDays("1997","10","07")) - ($this->_dateToDays($ano, $mes, $dia))));
    }

    private function monta_linha_digitavel($codigo)
    {

        // campo 1
        $banco    = substr($codigo,0,3);
        $moeda    = substr($codigo,3,1);
        $ccc      = substr($codigo,19,3);
        $ddnnum   = substr($codigo,22,2);
        $dv1      = $this->modulo_10($banco.$moeda.$ccc.$ddnnum);
        // campo 2
        $resnnum  = substr($codigo,24,6);
        $dac1     = substr($codigo,30,1);//modulo_10($agencia.$conta.$carteira.$nnum);
        $dddag    = substr($codigo,31,3);
        $dv2      = $this->modulo_10($resnnum.$dac1.$dddag);
        // campo 3
        $resag    = substr($codigo,34,1);
        $contadac = substr($codigo,35,6); //substr($codigo,35,5).modulo_10(substr($codigo,35,5));
        $zeros    = substr($codigo,41,3);
        $dv3      = $this->modulo_10($resag.$contadac.$zeros);
        // campo 4
        $dv4      = substr($codigo,4,1);
        // campo 5
        $fator    = substr($codigo,5,4);
        $valor    = substr($codigo,9,10);

        $campo1 = substr($banco.$moeda.$ccc.$ddnnum.$dv1,0,5) . '.' . substr($banco.$moeda.$ccc.$ddnnum.$dv1,5,5);
        $campo2 = substr($resnnum.$dac1.$dddag.$dv2,0,5) . '.' . substr($resnnum.$dac1.$dddag.$dv2,5,6);
        $campo3 = substr($resag.$contadac.$zeros.$dv3,0,5) . '.' . substr($resag.$contadac.$zeros.$dv3,5,6);
        $campo4 = $dv4;
        $campo5 = $fator.$valor;

        return "$campo1 $campo2 $campo3 $campo4 $campo5";
    }


}
