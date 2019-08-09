@extends('layouts.padrao')

@section('titulo-principal')
Escolha uma forma de pagamento
@endsection
@section('conteudo-principal')
Transferência
{!! Form::open(array('route' => ['events.inscricoes',$evento->id],'method'=>'POST')) !!}
{!! Form::hidden('info', 'mostrar_inscricao') !!}
{!! Form::submit('Tranferência', ['class'=>'btn btn-primary']) !!}
{!! Form::close() !!}

Boleto
{!! Form::open(array('route' => ['events.inscricoes', $data['id']],'method'=>'GET')) !!}
{!! Form::hidden('info', 'mostrar_inscricao') !!}
{!! Form::submit('Boleto', ['class'=>'btn btn-primary']) !!}
{!! Form::close() !!}


@endsection