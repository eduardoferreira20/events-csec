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
      <th scope="col">Hora de envio</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($boletos as $boleto)
    <tr>
      <td>{{$boleto->event_id}}</td>
      <td>{{$boleto->created_at}}</td>
      <td>
      	<a href="{{route('pay.download',$boleto->id)}}">
          Download
      		<!-- button type="download" class="btn btn-primary">
      			<i class="glyphicon glyphicon-download">Boletos</i>
      		</button> -->
      	</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection