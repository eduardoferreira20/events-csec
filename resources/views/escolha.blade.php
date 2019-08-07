@extends('layouts.padrao')

@section('titulo-principal')
Escolha uma forma de pagamento
@endsection
@section('conteudo-principal')
<a href="{{ route('events.inscricoes', ['id' => $data['id']]) }}" class="btn btn-primary mr-3">Tranferência</a>
Transferência
{!! Form::open(array('route' => ['events.inscricoes',$data['$id']],'method'=>'POST')) !!}
{!! Form::hidden('info', 'mostrar_inscricao') !!}
{!! Form::submit('Tranferência', ['class'=>'btn btn-primary']) !!}
{!! Form::close() !!}

Boleto
{!! Form::open(array('route' => ['events.inscricoes', $data['id']],'method'=>'POST')) !!}
{!! Form::hidden('info', 'mostrar_inscricao') !!}
{!! Form::submit('Boleto', ['class'=>'btn btn-primary']) !!}
{!! Form::close() !!}


@endsection