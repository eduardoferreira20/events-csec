# miqueiasdesouza/boleto - BoletoPHP

Criei esse package para utilizar em meus projetos com Laravel 4.2 e 5.1. E também para disponibilizar um conjunto de classes que trabalha com o BoletoPHP para ser utilizado com ou sem a necessidade de framework. 
Utilizei os arquivos do BoletoPHP porém fiz algumas modificações para conseguir a re-utilização do código em classes já que o projeto original é feito em PHP Estruturado.
Estou disponibilizando o código para comunidade como uma forma de agradecimento pelas informações já adquiridas.
Estou utilizando também as classes HTML2PDF para geração dos boleto em PDF.

## Instalação
### Composer
Se você já conhece o **Composer** (o que é extremamente recomendado), simplesmente adicione a dependência abaixo à diretiva *"require"* seu **composer.json**:
```
"miqueiasdesouza/boleto": "dev-master"
```

###Instalação manual
Se você quer simplesmente baixar e dar um include, também é muito simples. Primeiro baixe o repositorio ou de um git clone https://miqueiasdesouza@bitbucket.org/miqueiasdesouza/boleto.git, e coloque em uma pasta específica.


###Integração com Laravel 4.2
Adicione o serviceProvider arquivo config/app.php
```
providers' => array(

  'Illuminate\Foundation\Providers\ArtisanServiceProvider',
  'Illuminate\Auth\AuthServiceProvider',
  'Illuminate\Cache\CacheServiceProvider', 
   ....

  'Miqueiasdesouza\Boleto\Laravel\v4\BoletoServiceProvider',
    
``` 
Adicione a Facade arquivo config/app.php
``` 
'aliases' => array(

  'App'             => 'Illuminate\Support\Facades\App',
  'Artisan'         => 'Illuminate\Support\Facades\Artisan',
  'Auth'            => 'Illuminate\Support\Facades\Auth',
  ...
  
  'Boleto'          => 'Miqueiasdesouza\Boleto\Laravel\v4\BoletoFacade',
```

###Integração com Laravel 5.1
Adicione o serviceProvider arquivo config/app.php
```
'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Foundation\Providers\ArtisanServiceProvider::class,
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        ....

        Miqueiasdesouza\Boleto\Laravel\v5\BoletoServiceProvider::class,
    
``` 
Adicione a Facade arquivo config/app.php
``` 
'aliases' => [

        'App'       => Illuminate\Support\Facades\App::class,
        'Artisan'   => Illuminate\Support\Facades\Artisan::class,
        'Auth'      => Illuminate\Support\Facades\Auth::class,
        ...
  
        'Boleto'    => Miqueiasdesouza\Boleto\Laravel\v5\BoletoFacade::class,
```



##Utilização Laravel 4.2 e 5.1
``` 
 Boleto::sacado(array(
            'sacado'    => "Nome do seu Cliente",
            'endereco1' => "Endereço do seu Cliente",
            'endereco2' => "Cidade - Estado -  CEP: 00000-000"
        ));

 Boleto::cedente(array(
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
            'cedente'           => "Coloque a Razão Social da sua empresa aqui",
            'contrato'          =>  "12345678900"
        ));

        Boleto::banco('bradesco', array(
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
Boleto::pdf();

//PARA GERAR O BOLETO EM HTML
Boleto::html();

``` 

##Utilização normal sem o Laravel
Pegue o modelo na pasta exemples/bradesco.php


## Bancos suportados
Deixei configurado os seguintes bancos (vou adicionando mais conforme vou tendo tempo):

* Banco do Brasil
* Bradesco
* Itaú
* Santander

Lembre-se de homologar com seu banco antes de disponibilizar para o cliente final.

## Licença
* MIT License


### Contato ###

* Miquéias de Souza
* miqueiasdesouza@live.com