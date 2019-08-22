@extends('layouts.padrao')

@section('titulo-principal')
<div class="d-flex">
  <div class="d-flex flex-fill">
    Lista de Comprovantes
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
  	@foreach($boleto as $boleto)
    <tr>
      <td>{{$boleto->event_id}}</td>
      <td>{{$boleto->user_id}}</td>
      <td>{{date('d-m-Y/H:m',strtotime($boleto->created_at))}}</td>
      <td>
      	<a href="{{route('pay.download',$boleto->id,$boleto->comprovante_path)}}" download="{{$boleto->comprovante_path}}" target="_blank" class="btn btn-primary">
          Download
      	</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection