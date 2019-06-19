<!DOCTYPE html>
<html>
<head>

  <title>Comprovante de Inscrição</title>

  <script type="text/javascript">var Croogo = {"basePath":"\/","params":{"controller":"inscricoes","action":"imprimir_voucher","named":[]}};
</script>

</head>

<body>
  <header class="content-1 clearfix">
    <h1 class="event-title font-30">{!!$i->evento->title!!}</h1>
    <ul>
      <li class="date-and-hour"><i class="fa fa-calendar-minus-o" aria-hidden="true"></i>&nbsp;&nbsp;{!!date('d/F',strtotime($i->evento->start_date))!!} de {!!date('Y',strtotime($i->evento->start_date))!!} às {!!date('h:m',strtotime($i->evento->start_date))!!}.</li>
      <li class="address"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;{!!$i->evento->local!!},  {!!$i->evento->rua!!} - Madalena - {!!$i->evento->cidade!!}.</li>
    </ul>
  </header>
  <div class="content-left">
    <div class="box b ">
      <p><span class="font-14">Nº de Inscrição:</span><b class="font-35 bold"> {!!$i->id!!}</b></p>
    </div>
    <div class="box b">
      <p><span class="font-14">Nome:</span><b class="font-18 bold"> {!!$i->user->name!!}</b></p>
    </div>
    <div class="box">
      <p><span class="font-14">E-mail:</span><b class="font-18 email bold"> {!!$i->user->email!!}</b></p>
    </div>
  </div>
  <div class="content-3 clearfix">
    <div class="barcode">{!!$qr!!}</div>
    <p style="text-align: center;">OBS: Não esqueça de levar esse comprovante no dia do evento.</p>
  </div>
  <div class="button-print">
    <button onclick="window.print()"><i class="fa fa-print" aria-hidden="true" style="color: #83807F"></i>Imprimir</button>
  </div>

</body>

</html>

<style type="text/css">

body {width: 100%; max-width: 850px; background: #fff; margin: 20px auto; padding: 3% 2%; box-sizing: border-box;}
.content-left {width: 75%; float: left;}
.content-right {width: 25%; float: left;}

.content-1 {border: 1px solid #000;border-top-left-radius: 20px;border-top-right-radius: 20px;padding: 4% 3%;}
.content-1 h1 {margin-bottom: 15px; font-weight: normal;}
.content-1 li {color: #83807f;}
.content-1 li:first-child {margin-bottom: 15px;}
.content-1 li img {margin-right: 5px; vertical-align: middle; position: relative; top: -2px;}

.content-2 {border: 1px solid #000; border-top: 0;}
.content-2 .content-left {display: flex; flex-flow: row; flex-wrap: wrap;}
.content-2 .content-right {padding: 8px 5px; box-sizing: border-box; text-align: center;}

.content-3 {border: 1px solid #000; border-top: 0; padding: 35px 0; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; margin-bottom: 30px;}
.content-3 > div {text-align: center;}
.content-3 .free-message {clear: left; padding: 25px 3% 0; text-align: center;}
.content-left.mini-content {width: 64%;}

.button-print {text-align: center; margin-bottom: 50px;}
.button-print button {background: transparent; border: 1px solid #000; border-radius: 50px; padding: 10px 20px;}
.button-print button img {margin-right: 10px;}

.font-14 {font-size: 0.875em;margin-left: 5%;}

.content-left {width: 75%; float: left;font-weight: normal;}
.content-right {width: 25%; float: left;}

</style>