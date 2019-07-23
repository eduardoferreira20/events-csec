<?php

namespace Miqueiasdesouza\Boleto\Boletos\Core;
use \HTML2PDF;
require_once __DIR__.'../../../boleto.inc.php';

abstract class CoreBoletos {

    protected $dadosboleto = [];
    protected $sacado = [];
    protected $cedente = [];
    public $nome_banco;
    protected $path;
    protected $path_cache;
    protected $html_boleto;

    public abstract function setFuncoes();

    public function __construct()
    {
        $this->path = MS_BOLETO_PATH_LAYOUTS;
        $this->path_cache = MS_BOLETO_PATH_CACHE;

        $this->setDefaultDadosBoleto();
    }

    public function start($sacado, $cedente, $data)
    {
        $this->setDadosBoleto($data);
        $this->sacado = $sacado;
        $this->cedente = $cedente;

        $data_html = array(
            'logo_banco'   =>  $this->nome_banco
        );

        $boleto = $this->getBoleto($data_html);

        return $boleto;
    }

    public function pdf($titulo, $orientacao = 'P', $folha = 'A4'){
        $this->getPdf($titulo, $orientacao, $folha);
    }

    public function html($titulo = false){
        $this->getHtml($titulo);
    }

    public function getBoleto($data_html)
    {
        $dadosboleto = $this->setFuncoes();
        $data_html['dadosboleto'] = $dadosboleto;

        $this->htmlLayout($data_html);

        return $this;

    }

    public function getPdf($titulo = false, $orientacao = 'P', $folha = 'A4'){

        if(!$titulo)
            $titulo = $this->nome_banco;

        $html2pdf = new HTML2PDF($orientacao, $folha, 'en');
        $html2pdf->setTestIsImage(true);
        $html2pdf->writeHTML($this->html_boleto, isset($_GET['vuehtml']));
        $html2pdf->Output($titulo.'.pdf');
    }


    public function getHtml($titulo = false){

        if(!$titulo)
            $titulo = $this->nome_banco;

        header('Content-Type: text/html; charset=utf-8');
        echo '<title>'.$titulo.'</title>';
        echo '<style> table{ width: 666px; font-size: 10px; margin: 0 auto; }</style>';
        echo $this->html_boleto;
        exit(0);
    }

    private function htmlLayout($html_data){

        $content_new_html = '<?php '."\n";
        foreach($html_data as $var => $data){
            $content_new_html .= '$'.$var.' = '.((is_array($data)) ? var_export($data, TRUE) : '"'.$data.'"').'; ';
        }
        $content_new_html .= ' ?> '."\n";

        #$html = file_get_contents($this->path.'/'.$this->nome_banco.'.php');
        $html = file_get_contents($this->path.'/default.php');
        $html = str_replace('<?php fbarcode($dadosboleto["codigo_barras"]); ?>', $this->fbarcode($html_data['dadosboleto']['codigo_barras']), $html);

        $html_cache = fopen($this->path_cache.'/layout_'.$this->nome_banco.'.cache.php', 'w+');
        fwrite($html_cache, $content_new_html."\n".$html);
        #fwrite($html_cache, $html);
        fclose($html_cache);

        ob_start();
        require_once($this->path_cache.'/layout_'.$this->nome_banco.'.cache.php');
        $this->html_boleto =  ob_get_clean();

        return $this->html_boleto;


    }

    private function setDefaultDadosBoleto(){

        $data = array(
            'valor_boleto'              =>  '', // Nosso numero sem o DV - REGRA: Máximo de 11 caracteres!
            'nosso_numero'          =>  '', //Num do pedido ou do documento = Nosso numero
            'numero_documento'      =>  '', //// Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
            'data_vencimento'       =>  date('d/m/Y'), //Data de emissão do Boleto
            'data_documento'        =>  date('d/m/Y'), //Data de processamento do boleto (opcional)
            'data_processamento'    =>  date('d/m/Y'), //Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula
            'quantidade'            =>  "001",
            'valor_unitario'        =>  '',
            'aceite'                =>  "",
            'especie'               =>  "R$",
            'especie_doc'           =>  "DS",
            'demonstrativo1'        =>  "",
            'demonstrativo2'        =>  "",
            'demonstrativo3'        =>  "",
            'instrucoes1'           =>  "",
            'instrucoes2'           =>  "",
            'instrucoes3'           =>  "",
            'instrucoes4'           =>  "",
            'agencia'               =>  "", // Num da agencia, sem digito
            'agencia_dv'            =>  "", // Digito do Num da agencia
            'conta'                 =>  "", 	// Num da conta, sem digito
            'conta_dv'              =>  "",
            'conta_cedente'         =>  "", // ContaCedente do Cliente, sem digito (Somente Números)
            'conta_cedente_dv'      =>  "", // Digito da ContaCedente do Cliente
            'carteira'              =>  "",  // Código da Carteira: pode ser 06 ou 03
            'identificacao'         =>  "",
            'cpf_cnpj'              =>  "",
            'endereco'              =>  "",
            'cidade_uf'             =>  "",
            'cedente'               =>  "",
            'contrato'              =>  "",
            'sacado'                =>  "",
            'endereco1'             =>  "",
            'endereco2'             =>  "",
            'formatacao_convenio'   =>  "7",
            'convenio'              =>  "7777777",
            'codigo_cliente'        =>  "1234567"
        );

        $this->setDadosBoleto($data);
    }

    protected function setDadosBoleto($data){

        foreach($data as $key => $value){
            $this->dadosboleto[$key] = $value;
        }
    }

    protected function formata_numero($numero, $loop, $insert, $tipo = "geral")
    {
        if ($tipo == "geral") {
            $numero = str_replace(",", "", $numero);
            while (strlen($numero) < $loop) {
                $numero = $insert . $numero;
            }
        }
        if ($tipo == "valor") {
            /*
            retira as virgulas
            formata o numero
            preenche com zeros
            */
            $numero = str_replace(",", "", $numero);
            while (strlen($numero) < $loop) {
                $numero = $insert . $numero;
            }
        }
        if ($tipo == "convenio") {
            while (strlen($numero) < $loop) {
                $numero = $numero . $insert;
            }
        }
        return $numero;
    }

    protected function fbarcode($valor)
    {

        $fino = 1;
        $largo = 3;
        $altura = 50;

        $barcodes[0] = "00110";
        $barcodes[1] = "10001";
        $barcodes[2] = "01001";
        $barcodes[3] = "11000";
        $barcodes[4] = "00101";
        $barcodes[5] = "10100";
        $barcodes[6] = "01100";
        $barcodes[7] = "00011";
        $barcodes[8] = "10010";
        $barcodes[9] = "01010";
        for ($f1 = 9; $f1 >= 0; $f1--) {
            for ($f2 = 9; $f2 >= 0; $f2--) {
                $f = ($f1 * 10) + $f2;
                $texto = "";
                for ($i = 1; $i < 6; $i++) {
                    $texto .= substr($barcodes[$f1], ($i - 1), 1) . substr($barcodes[$f2], ($i - 1), 1);
                }
                $barcodes[$f] = $texto;
            }
        }

        $img = '<img src='.msbimgurl().'/p.png width=' . $fino . ' height=' . $altura . ' border=0>';
        $img .= '<img src='.msbimgurl().'/b.png width=' . $fino . ' height=' . $altura . ' border=0>';
        $img .= '<img src='.msbimgurl().'/p.png width=' . $fino . ' height=' . $altura . ' border=0>';
        $img .= '<img src='.msbimgurl().'/b.png width=' . $fino . ' height=' . $altura . ' border=0>';
        $img .= '<img ';

        $texto = $valor;
        if ((strlen($texto) % 2) <> 0) {
            $texto = "0" . $texto;
        }

        // Draw dos dados
        while (strlen($texto) > 0) {
            $i = round($this->esquerda($texto, 2));
            $texto = $this->direita($texto, strlen($texto) - 2);
            $f = $barcodes[$i];
            for ($i = 1; $i < 11; $i += 2) {
                if (substr($f, ($i - 1), 1) == "0") {
                    $f1 = $fino;
                } else {
                    $f1 = $largo;
                }

                $img .= 'src='.msbimgurl().'/p.png width=' . $f1 . ' height=' . $altura . ' border=0>';
                $img .= '<img ';

                if (substr($f, $i, 1) == "0") {
                    $f2 = $fino;
                } else {
                    $f2 = $largo;
                }

                $img .= 'src='.msbimgurl().'/b.png width=' . $f2 . ' height=' . $altura . ' border=0>';
                $img .= '<img ';

            } //for
        } // while
        // Draw guarda final

        $img .= 'src='.msbimgurl().'/p.png width=' . $largo . ' height=' . $altura . ' border=0>';
        $img .= '<img src='.msbimgurl().'/b.png width=' . $fino . ' height=' . $altura . ' border=0>';
        $img .= '<img src='.msbimgurl().'/p.png width=1 height=' . $altura . ' border=0>';

        return $img;
    }

    protected function esquerda($entra, $comp)
    {
        return substr($entra, 0, $comp);
    }

    protected function direita($entra, $comp)
    {
        return substr($entra, strlen($entra) - $comp, $comp);
    }

    protected function _dateToDays($year, $month, $day)
    {
        $century = substr($year, 0, 2);
        $year = substr($year, 2, 2);
        if ($month > 2) {
            $month -= 3;
        } else {
            $month += 9;
            if ($year) {
                $year--;
            } else {
                $year = 99;
                $century--;
            }
        }
        return (floor((146097 * $century) / 4) +
            floor((1461 * $year) / 4) +
            floor((153 * $month + 2) / 5) +
            $day + 1721119);
    }

    protected function modulo_10($num)
    {
        $numtotal10 = 0;
        $fator = 2;

        // Separacao dos numeros
        for ($i = strlen($num); $i > 0; $i--) {
            // pega cada numero isoladamente
            $numeros[$i] = substr($num, $i - 1, 1);
            // Efetua multiplicacao do numero pelo (falor 10)
            // 2002-07-07 01:33:34 Macete para adequar ao Mod10 do Ita
            $temp = $numeros[$i] * $fator;
            $temp0 = 0;
            foreach (preg_split('//', $temp, -1, PREG_SPLIT_NO_EMPTY) as $k => $v) {
                $temp0 += $v;
            }
            $parcial10[$i] = $temp0; //$numeros[$i] * $fator;
            // monta sequencia para soma dos digitos no (modulo 10)
            $numtotal10 += $parcial10[$i];
            if ($fator == 2) {
                $fator = 1;
            } else {
                $fator = 2; // intercala fator de multiplicacao (modulo 10)
            }
        }

        // várias linhas removidas, vide função original
        // Calculo do modulo 10
        $resto = $numtotal10 % 10;
        $digito = 10 - $resto;
        if ($resto == 0) {
            $digito = 0;
        }

        return $digito;

    }

    protected function modulo_11($num, $base = 9, $r = 0)
    {
        /**
         *   Autor:
         *           Pablo Costa <pablo@users.sourceforge.net>
         *
         *   Função:
         *    Calculo do Modulo 11 para geracao do digito verificador
         *    de boletos bancarios conforme documentos obtidos
         *    da Febraban - www.febraban.org.br
         *
         *   Entrada:
         *     $num: string numérica para a qual se deseja calcularo digito verificador;
         *     $base: valor maximo de multiplicacao [2-$base]
         *     $r: quando especificado um devolve somente o resto
         *
         *   Saída:
         *     Retorna o Digito verificador.
         *
         *   Observações:
         *     - Script desenvolvido sem nenhum reaproveitamento de código  existente.
         *     - Assume-se que a verificação do formato das variáveis de entrada é feita antes da execução deste script.
         */

        $soma = 0;
        $fator = 2;

        /* Separacao dos numeros */
        for ($i = strlen($num); $i > 0; $i--) {
            // pega cada numero isoladamente
            $numeros[$i] = substr($num, $i - 1, 1);
            // Efetua multiplicacao do numero pelo falor
            $parcial[$i] = $numeros[$i] * $fator;
            // Soma dos digitos
            $soma += $parcial[$i];
            if ($fator == $base) {
                // restaura fator de multiplicacao para 2
                $fator = 1;
            }
            $fator++;
        }

        /* Calculo do modulo 11 */
        if ($r == 0) {
            $soma *= 10;
            $digito = $soma % 11;
            if ($digito == 10) {
                $digito = 0;
            }
            return $digito;
        } elseif ($r == 1) {
            $resto = $soma % 11;
            return $resto;
        }
    }

    protected function geraCodigoBanco($numero)
    {
        $parte1 = substr($numero, 0, 3);
        $parte2 = $this->modulo_11($parte1);
        return $parte1 . "-" . $parte2;
    }
}
