<?php
/**
 * User: miqueias
 * Date: 24/10/15
 * Time: 01:27
 */

if(!function_exists("public_path")){
    function public_path(){
        return __DIR__.'/..';
    }
}

function msbimgurl(){
    $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
    $url = public_path().'/packages/miqueiasdesouza/boleto/assets/imagens';

    return $url;
}

define('MS_BOLETO_PATH_CACHE', public_path().'/packages/miqueiasdesouza/boleto/cache');
define('MS_BOLETO_PATH_IMG', public_path().'/packages/miqueiasdesouza/boleto/assets/imagens');
define('MS_BOLETO_PATH_LAYOUTS', __DIR__.'/Boletos/layouts');
define('MS_BOLETO_PATH_VENDOR', 'vendor');


// HTML2PDF class include
require_once(MS_BOLETO_PATH_VENDOR.'/html2pdf/html2pdf.class.php');
