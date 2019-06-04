<!DOCTYPE html>
<html>
<head>
 <title>Certificado evento {{$title}}</title>
</head>
<body>
	<div>
	<img src="http://csec.poli.br/wp-content/uploads/2018/02/csec_banner.png" style="width: 100%; height: 25%;">
	</div>
	<br>
	<br>
	<div class="texto">
 	<p>Certificado do evento <strong>{{$title}}</strong>
 		<br>
 	<a href="{{(url('/certificado/download/'.$evento_id.'/usuario/'.$user_id) )}}" class="btn btn-success"">abrir</a></p>
 	</div>
</body>
</html>