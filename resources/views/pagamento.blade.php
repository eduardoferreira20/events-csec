@extends('layouts.padrao')

@section('titulo-principal')
<div class="d-flex">
  <div class="d-flex flex-fill">
    Pagamentos
  </div>
</div>
@endsection
@section('conteudo-principal')
<table class="table">
  <thead>
    <tr>
      <th scope="col">Evento</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($pagar as $evento)
    <tr>
      <td>{{$evento->title}}</td>
      <td>
      	<a href="{{route('lista.pay',$evento->id)}}">
      		<button type="download" class="btn btn-primary">
      			<i class="glyphicon glyphicon-download">Download</i>
      		</button>
      	</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection