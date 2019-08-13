@extends('layouts.padrao')

@section('titulo-principal')
<div class="d-flex">
  <div class="d-flex flex-fill">
    Lista de Boletos
  </div>
</div>
@endsection
@section('conteudo-principal')
<table class="table">
  <thead>
    <tr>
      <th scope="col">Evento</th>
      <th scope="col">Usuário</th>
      <th scope="col">Hora de envio</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($boletos as $boleto)
    <tr>
      <td>{{$boleto->event_id}}</td>
      <td>{{$boleto->user_id}}</td>
      <td>{{date('d-m-Y/H:m',strtotime($boleto->created_at))}}</td>
      <td>
      	<a href="{{route('pay.download',$boleto->id)}}" target="_blank" download="{{$boleto->comprovante_path}}">
          Download
      	</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection