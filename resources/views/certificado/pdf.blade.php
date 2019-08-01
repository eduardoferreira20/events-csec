<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$user->user->name}}</title>

    
    <style type="text/css">

  body{
    font-family: 'Montserrat';
    font-size: 21px;
    background: url("/Certificado1.jpg");
    background-repeat: no-repeat;
    transform: rotate(270deg);
    transform-origin:47% 53%;  
    height: 102%;
    width: 1110px;
    position: fixed;
    background-position: 70% 3%;
    background-size: 111800px !important;
    z-index: -100000000000;
  }

  .table{
    padding-top: 4%;
    padding-left: 47%;
    width: 49%;
  }

  .data{
    padding-top: 24.5%;
    padding-left: 73%;
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
            @if(date('F', strtotime($user->evento->start_date)) == 'January' )
            <p>{!!$user->evento->cidade!!}, {{ date('d', strtotime($user->evento->start_date)) }} de Janeiro de {{ date('Y', strtotime($user->evento->start_date)) }}</p>
            @elseif(date('F', strtotime($user->evento->start_date)) == 'February' )
            <p>{!!$user->evento->cidade!!}, {{ date('d', strtotime($user->evento->start_date)) }} de Fevereiro de {{ date('Y', strtotime($user->evento->start_date)) }}</p>
            @elseif(date('F', strtotime($user->evento->start_date)) == 'March')
            <p>{!!$user->evento->cidade!!}, {{ date('d', strtotime($user->evento->start_date)) }} de Março de {{ date('Y', strtotime($user->evento->start_date)) }}</p>
            @elseif(date('F', strtotime($user->evento->start_date)) == 'April' )
            <p>{!!$user->evento->cidade!!}, {{ date('d', strtotime($user->evento->start_date)) }} de Abril de {{ date('Y', strtotime($user->evento->start_date)) }}</p>
            @elseif(date('F', strtotime($user->evento->start_date)) == 'May' )
            <p>{!!$user->evento->cidade!!}, {{ date('d', strtotime($user->evento->start_date)) }} de Abril de {{ date('Y', strtotime($user->evento->start_date)) }}</p>
           @elseif(date('F', strtotime($user->evento->start_date)) == 'June' )
            <p>{!!$user->evento->cidade!!}, {{ date('d', strtotime($user->evento->start_date)) }} de Junho de {{ date('Y', strtotime($user->evento->start_date)) }}</p>
            @elseif(date('F', strtotime($user->evento->start_date)) == 'July' )
            <p>{!!$user->evento->cidade!!}, {{ date('d', strtotime($user->evento->start_date)) }} de Julho de {{ date('Y', strtotime($user->evento->start_date)) }}</p>
            @elseif(date('F', strtotime($user->evento->start_date)) == 'August' )
            <p>{!!$user->evento->cidade!!}, {{ date('d', strtotime($user->evento->start_date)) }} de Agosto de {{ date('Y', strtotime($user->evento->start_date)) }}</p>
            @elseif(date('F', strtotime($user->evento->start_date)) == 'September' )
            <p>{!!$user->evento->cidade!!}, {{ date('d', strtotime($user->evento->start_date)) }} de Setembro de {{ date('Y', strtotime($user->evento->start_date)) }}</p>
            @elseif(date('F', strtotime($user->evento->start_date)) == 'October' )
            <p>{!!$user->evento->cidade!!}, {{ date('d', strtotime($user->evento->start_date)) }} de Outubro de {{ date('Y', strtotime($user->evento->start_date)) }}</p>
            @elseif(date('F', strtotime($user->evento->start_date)) == 'November' )
            <p>{!!$user->evento->cidade!!}, {{ date('d', strtotime($user->evento->start_date)) }} de Novembro de {{ date('Y', strtotime($user->evento->start_date)) }}</p>
            @elseif(date('F', strtotime($user->evento->start_date)) == 'December' )
            <p>{!!$user->evento->cidade!!}, {{ date('d', strtotime($user->evento->start_date)) }} de Dezembro de {{ date('Y', strtotime($user->evento->start_date)) }}</p>
            @endif
          </div>
          <div class="table">
            <p>Certificamos que <strong>{{$user->user->name}}</strong>, portador do documento <strong>{{$user->user->documento}}</strong>, participou com êxito do evento <strong>{{$evento->title}}</strong>  realizado na <strong>{{$evento->local}}</strong> na cidade de <strong>{{$evento->cidade}}</strong>, contabilizando carga horária total de <strong>{{$evento->hora_comple}}</strong> horas.</p>
          </div>
        </div>
      </div>
     </div> 
  </body>
</html>