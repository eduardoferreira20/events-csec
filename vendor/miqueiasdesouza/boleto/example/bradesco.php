<?php



class Bradesco {

    private $boleto;

    /**
     * Instanciando a classe Boleto
     */
    public function __construct()
    {
        require_once __DIR__.'/../src/Boleto.php';
        $this->boleto = new Miqueiasdesouza\Boleto\Boleto();
    }

    /**
     * Metodo principal
     * @return mixed
     */
    public function init()
    {
        //Definindo os dados do sacado
        $this->boleto->sacado(array(
            'sacado'    => "Nome do seu Cliente",
            'endereco1' => "Endereço do seu Cliente",
            'endereco2' => "Cidade - Estado -  CEP: 00000-000"
        ));

        //Definindo os dados do Cedente
        $this->boleto->cedente(array(
            'agencia'           => "1100", // Num da agencia, sem digito
            'agencia_dv'        => "0", // Digito do Num da agencia
            'conta'             => "0102003", 	// Num da conta, sem digito
            'conta_dv'          => "4",
            'conta_cedente'     => "0102003", // ContaCedente do Cliente, sem digito (Somente Números)
            'conta_cedente_dv'  => "4", // Digito da ContaCedente do Cliente
            'carteira'          => "06",  // Código da Carteira: pode ser 06 ou 03
            'identificacao'     => "BoletoPhp - Código Aberto de Sistema de Boletos",
            'cpf_cnpj'          => "",
            'endereco'          => "Coloque o endereço da sua empresa aqui",
            'cidade_uf'         => "Cidade / Estado",
            'cedente'           => "Coloque a Razão Social da sua empresa aqui"
        ));

        //Definindo os dados do boleto. Banco, valores, vencimento, informações e etc...
        $this->boleto->banco('bradesco', array(
            'valor_boleto'          => '89,90', // Nosso numero sem o DV - REGRA: Máximo de 11 caracteres!
            'nosso_numero'          => '789', //Num do pedido ou do documento = Nosso numero
            'numero_documento'      =>  '789', //// Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
            'data_vencimento'       =>  date('d/m/Y'), //Data de emissão do Boleto
            'data_documento'        =>  date('d/m/Y'), //Data de processamento do boleto (opcional)
            'data_processamento'    =>  date('d/m/Y'), //Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula
            'quantidade'            =>  "001",
            'valor_unitario'        =>  '89,90',
            'aceite'                =>  "",
            'especie'               =>  "R$",
            'especie_doc'           =>  "DS",
            'demonstrativo1'        =>  "Pagamento de Compra na Loja Nonononono",
            'demonstrativo2'        =>  "Mensalidade referente a ...",
            'demonstrativo3'        =>  "EMPRESA X - www.site_da_empresa.com.br",
            'instrucoes1'           =>  "- Sr. Caixa, cobrar multa de 2% após o vencimento",
            'instrucoes2'           =>  "- Receber atá 10 dias após o vencimento",
            'instrucoes3'           =>  "- Em caso de dúvidas entre em contato conosco: contato@blimoveisitupeva.com.br",
            'instrucoes4'           =>  ""

        ));

        //Retorna o Objeto do Boleto
        return $this->boleto;
    }

    //Gerando o PDF do boleto
    public function pdf($boleto){
        $boleto->pdf();
    }

    //Gerando o HTML do boleto
    public function html($boleto){
        $boleto->html();
    }
}


$obj = new Bradesco();
$boleto = $obj->init();

$obj->pdf($boleto);