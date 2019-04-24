@extends('layouts.padrao')

@section('titulo-principal')
Eventos disponíveis
@endsection

@section('conteudo-principal')
<div>
<table style="float: left; font-style: 'Montserrat;'" class="table table-bordered">
	<thead>
		<tr>
			<th>Evento</th>
			<th>Data - Hora</th>
			<th>Local</th>
			<th>Cidade</th>
			<th>Valor</th>
			<th>Inicio</th>
			@auth('admin-web')
			<th>Ação</th>
			@endauth
		</tr>
	</thead>
	<tbody>	
		@foreach($events as $titulo)
		<tr>
			<td>{{$titulo->title}}</td>
			<td>{{$titulo->start_date}}</td>
			<td>{{$titulo->local}}</td>
			<td>{{$titulo->cidade}}</td>
			@if($titulo['valor'] != 0)
			<td>R$ {{$titulo->valor}}</td>
			@else
			<td>grátis</td>
			@endif
			<td>{{$titulo->inicio_inscricoes}}</td>
			@auth('admin-web')
			<td>
				<a class="btn btn-danger" href="javascript:(confirm('Deletar esse vento?') ? window.location.href='{{route('events.deletar', $titulo->id)}}' : false)">Deletar</a>
				<a class="btn btn-default" href="{{route('events.edit',$titulo->id)}}">Editar</a>
			</td>
			@endauth
		</tr>
		@endforeach
	</tbody>
</table>
</div>
@endsection