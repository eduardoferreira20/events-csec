@extends('layouts.padrao')

@section('conteudo-principal')
@if($info == 'mostrar_edicao')
{!! Form::open(array('route' => ['events.inscricoes', $evento->id],'method'=>'POST')) !!}
<div class="d-flex flex-column">
    <div class="d-flex flex-column my-4">
        {!! Form::label('inicio_inscricoes','Início:') !!}
        {!! Form::date('inicio_inscricoes', null, ['class' => 'form-control']) !!}
    </div>
    <div class="d-flex flex-column">
        {!! Form::label('fim_inscricoes','Término:') !!}
        {!! Form::date('fim_inscricoes', null, ['class' => 'form-control']) !!}
    </div>
    <div class="d-flex my-4">
        <a href="{{ route('events.show', ['id' => $evento->id]) }}" class="btn btn-primary mr-3">Voltar</a>
        {!! Form::hidden('info', 'add') !!}
        {!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
    </div>
</div>
{!! Form::close() !!}
@elseif($info == 'mostrar_inscricao')

<p>Ol&aacute;!</p>
<p>Ficamos feliz por voc&ecirc; ter se interessado pelo nosso evento.</p>
<p>Informamos da necessidade de realizar um dep&oacute;sito no valor de <strong>R$ {{$evento->valor}} reais</strong> para inscri&ccedil;&atilde;o no evento.</p>
<p>Ap&oacute;s, realizado dep&oacute;sito/transfer&ecirc;ncia, &eacute; necess&aacute;rio enviar o comprovante para n&oacute;s pelo campo abaixo e aguardar a confirma&ccedil;&atilde;o da sua inscri&ccedil;&atilde;o!</p>

{!! Form::open(array('route' => ['events.inscricoes', $evento->id],'method' => 'POST', 'files' => true)) !!}
{!! Form::label('comprovante','Enviar comprovante:') !!}
{!! Form::file('comprovante', ['class' => 'file-field', 'accept' => 'application/pdf, image/jpeg, image/png, image/jpg']) !!}

<a href="{{ route('events.show', ['id' => $evento->id]) }}" class="btn btn-primary mr-3">Voltar</a>

{!! Form::hidden('info', 'inscrever') !!}
<!-- {!! Form::hidden('user_id', '1') !!} -->
<!-- {!! Form::hidden('user_name', 'Jair Medeiros Ferreira Filho') !!} -->
{!! Form::submit('Enviar',['class'=>'btn btn-primary my-4']) !!}
{!! Form::close() !!}
@endif
@endsection
