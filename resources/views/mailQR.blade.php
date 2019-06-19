<!DOCTYPE html>
<html>
<head>
	<title>Comprovante evento {{$title}}</title>
</head>
<body>
	<div>
		<img src="http://csec.poli.br/wp-content/uploads/2018/02/csec_banner.png" style="width: 100%; height: 25%;">
	</div>
	<br>
	<br>
	
	<div style="width:100%;background-color:#cacaca;font-family:Arial,Helvetica,sans-serif">
		<table width="600" border="0" style="margin:0 auto;background-color:#ff2b34;border-collapse:collapse">
			<tbody><tr>
				<td style="padding:30px 60px;text-align:left;color:#ffffff;font-size:32px">
					<center>{{$title}}</center></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div style="width:100%;background-color:#cacaca;font-family:Arial,Helvetica,sans-serif"><span class="im">
		<table width="600" border="0" bgcolor="ffffff" style="font-size:14px;line-height:20px;color:#515050;margin:0 auto;padding:40px 60px;background-color:#ffffff">
			<tbody><tr>
				<td>
					<h1 style="font-size:19px;font-weight:bold">
						Prezado(a) {{$name}},
					</h1>
					<p>Sua incrição no evento <b>{{$title}}</b> foi confirmada com sucesso!</p>
					<p>Verifique atentamente as informações contidas neste e-mail:</p>
					<br>
					<center>
						<a href="{{(url('/qrcode/'.$evento_id,$user_id) )}}" style="color:#515050;display:inline-block;border:1px solid #515050;padding:10px;border-radius:5px;text-decoration:none;font-size:15px" target="_blank">
						Visualizar comprovante da inscrição</a>
					</center>
				</td>
			</tr>
		</tbody></table>
	</span><table width="600" border="0" style="font-size:14px;line-height:18px;color:#515050;margin:0 auto;padding:40px 60px;background-color:#ededed">
		<tbody><tr>
			<td colspan="2">
				<h1 style="font-size:19px;font-weight:bold">
				Dados da Inscrição        </h1>
				<hr style="border:1px solid #cacaca;border-top:none;margin-bottom:15px">
			</td>
		</tr>
		<tr>
			<td>
				<p>
					<b style="text-transform:uppercase">Nome</b><br>
					<span style="line-height:10px">
					{{$name}}</span>
				</p>
			</td>
		</tr>
		<tr>
			<td>
				<p>
					<b style="text-transform:uppercase">E-mail</b><br>
					<span style="line-height:10px">
						<a href="mailto:animedudu12345@gmail.com" style="color:#3673b0" target="_blank">
						{{$email}}</a>
					</span>
				</p>
			</td>
			<td>
				<p>
					<b style="text-transform:uppercase">Inscrição Nº</b><br>
					<span style="line-height:10px">
					{{$id}}</span>
				</p>
			</td>
		</tr>
		<tr>
			<td>
				<p>
					<b style="text-transform:uppercase">Data</b><br>
					<span style="line-height:10px">{{date('d/m/Y', strtotime($data))}}</span>
				</p>
			</td>
		</tr>

	</tbody>
</table>
<div class="yj6qo ajU">
	<div id=":ps" class="ajR" role="button" tabindex="0" aria-label="Ocultar conteúdo expandido" aria-expanded="true" data-tooltip="Ocultar conteúdo expandido">
		<img class="ajT" src="//ssl.gstatic.com/ui/v1/icons/mail/images/cleardot.gif"
		></div>
	</div>

</body>
</html>