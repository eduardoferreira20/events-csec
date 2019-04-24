<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$user->name}}</title>

    
    <style type="text/css">

  html,body{
    background:url('Certificado.jpg');
    background-repeat: no-repeat;
    transform: rotate(270deg);
    transform-origin:47% 53%;  
    height: 100%;
    width: 1100px;
    position: fixed;
  }

  header{
    height: 100%;
  }

  .table{
    padding-top: 36%;
    padding-left: 47%;
    width: 49%;
  }

  p { 
    line-height: 150%; 
    text-align: justify;
  }


</style>
  </head>
  <body>

    <div class="conteiner">
      <div class="r">
        <div class="col-md-12">
          <div class="table"><p>Certificamos que <strong>{{$user->name}}</strong>, portador do documento <strong>{{$user->documento}}</strong>, participou com exito do evento <strong>{{$user->name}}</strong>  realizado na <strong>POLI/UPE</strong> na cidade de <strong>Recife</strong>, contabilizando carga horária total de <strong>{{$user->name}}</strong> horas. </p></div>
        </div>
      </div>
     </div> 

  </body>
</html>