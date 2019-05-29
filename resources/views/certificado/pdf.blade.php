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
    height: 101%;
    width: 1110px;
    position: fixed;
  }

  header{
    height: 100%;
  }

  .table{
    padding-top: 6%;
    padding-left: 47%;
    width: 49%;
  }

  .data{
    padding-top: 24.5%;
    padding-left: 55%;
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
          <div class="data"> 
            @if(date('m', strtotime($user->evento->start_date) == 2))
            <p>{!!$user->evento->cidade!!}, {{ date('d', strtotime($user->evento->start_date)) }} de Abril de {{ date('Y', strtotime($user->evento->start_date)) }}</p>
            @elseif(date('m', strtotime($user->evento->start_date) == 3))
            <p>{!!$user->evento->cidade!!}, {{ date('d', strtotime($user->evento->start_date)) }} de Março de {{ date('Y', strtotime($user->evento->start_date)) }} e {!!$user->evento->start_date->day!!}</p>
            @endif
          </div>
          <div class="table">
            <p>Certificamos que <strong>{{$user->name}}</strong>, portador do documento <strong>{{$user->documento}}</strong>, participou com exito do evento <strong>{{$user->evento->title}}</strong>  realizado na <strong>{!!$user->evento->local!!}</strong> na cidade de <strong>{!!$user->evento->cidade!!}</strong>, contabilizando carga horária total de <strong>{!!$user->evento->hora_comple!!}</strong> horas.</p>
          </div>
        </div>
      </div>
     </div> 

  </body>
</html>