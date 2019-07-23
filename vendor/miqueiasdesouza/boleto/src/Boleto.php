<?php

namespace Miqueiasdesouza\Boleto;

require_once 'boleto.inc.php';

class Boleto
{
    protected $sacado = [];
    protected $cedente = [];
    protected $banco;


    public function sacado($data = array())
    {
        $this->sacado = $data;
    }

    public function cedente($data = array())
    {
        $this->cedente = $data;
    }

    public function banco($nome_banco, $data)
    {
        $this->initConfig();

        $banco = 'Boleto' . ucfirst($nome_banco);
        require_once 'Boletos/' . $banco . '.php';

        $this->boleto = new $banco();
        $this->boleto->nome_banco = $nome_banco;

        return $this->boleto->start($this->sacado, $this->cedente, $data);
    }

    public function pdf($titulo = false, $orientacao = 'P', $folha = 'A4'){
        return $this->boleto->pdf($titulo, $orientacao, $folha);
    }

    public function html($titulo = false){
        return $this->boleto->html($titulo);
    }

    private function initConfig(){
        $path_img = MS_BOLETO_PATH_IMG;
        $path_cache = MS_BOLETO_PATH_CACHE;

        if(is_dir($path_cache))
            return true;

        $src = __DIR__.'/Boletos/imagens';

        mkdir($path_img, 0777, true);
        mkdir($path_cache, 0777, true);

        $dst = $path_img;

        $files = glob($src."/*.*");
        foreach($files as $file){
            $file_to_go = str_replace($src,$dst,$file);
            copy($file, $file_to_go);
        }
    }
}
