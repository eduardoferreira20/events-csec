@extends('layouts.padrao')

@section('estilos')
@if($field == "apresentation")
<link rel="stylesheet" type="text/css" href="{{ asset('css/simeditor/simditor.css') }}" />
@endif
@endsection

@section('titulo-principal')
@if($field == "apresentation")
Editar apresentação
@elseif($field == "enderecos")
Editar dados complementares
@elseif($field == "users")
Editar dados
@endif
@endsection

@section('conteudo-principal')
@if($field == "apresentation")
<div class="d-flex my-4">
{!! Form::open(array('route' => ['user.edit', $id],'method'=>'POST')) !!}
{!! Form::textarea('input', $old, ['id' => 'editor']) !!}
<div class="mt-4">
<a href="{{ route('user.index', ['id' => $id]) }}" class="btn btn-primary mr-3">Voltar</a>
{!! Form::hidden('info', 'add_apresentation') !!}
{!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
</div>
{!! Form::close() !!}
</div>

@elseif($field == "enderecos")
  <div class="d-flex flex-column">
    {!! Form::open(array('route' => ['user.edit', $id],'method'=>'POST')) !!}
        {!! Form::label('cep','CEP: ') !!}
        {!! Form::text('cep', $old->cep, ['class' => 'form-control', 'style' => 'width:100px']) !!}

        {!! Form::label('logradouro','Logradouro: ') !!}
        {!! Form::text('logradouro', $old->logradouro, ['class' => 'form-control', 'style' => 'width:500px']) !!}

        {!! Form::label('numero','Numero: ') !!}
        {!! Form::text('numero', $old->numero, ['class' => 'form-control', 'style' => 'width:80px']) !!}

        {!! Form::label('complemento','Complemento: ') !!}
        {!! Form::text('complemento', $old->complemento, ['class' => 'form-control', 'style' => 'width:500px']) !!}

        {!! Form::label('bairro','Bairro: ') !!}
        {!! Form::text('bairro', $old->bairro, ['class' => 'form-control', 'style' => 'width:200px']) !!}

        {!! Form::label('cidade','Cidade: ') !!}
        {!! Form::text('cidade', $old->cidade, ['class' => 'form-control', 'style' => 'width:200px']) !!}

        <div class="mt-4">
        <a href="{{ route('user.index', ['id' => $id]) }}" class="btn btn-primary mr-3">Voltar</a>

        {!! Form::hidden('info', 'add_endereco') !!}
        {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}
  </div>

@elseif($field == "users")
  <div class="d-flex flex-column">
    {!! Form::open(array('route' => ['user.edit', $id],'method'=>'POST')) !!}
        {!! Form::label('name','Nome Completo: ') !!}
        {!! Form::text('name', $old->name, ['class' => 'form-control', 'style' => 'width:500px']) !!}

        {!! Form::label('email', 'E-mail: ') !!}
        {!! Form::email('email', $old->email, ['class' => 'form-control', 'style' => 'width:300px'])!!}

        {!! Form::label('nacionalidade','Nacionalidade: ') !!}
        {!! Form::text('nacionalidade', $old->nacionalidade, ['class' => 'form-control', 'style' => 'width:300px']) !!}

        {!! Form::label('documento', 'Documento: ') !!}

        {!! Form::select('tipo', ['1' => 'CPF', '2' => 'Passaporte'], $old->tipo, ['class' => 'form-control mb-3', 'style' => 'width:150px', 'onChange' => 'yesnoCheck(this)', 'placeholder' => 'Selecione']) !!}

        {!! Form::text('documento', $old->documento, ['class' => 'form-control', 'style' => 'width:300px', 'onkeypress' => 'return isNumberKey(event)', 'id' => 'documento']) !!}

        {!! Form::label('phone','Telefone: ') !!}
        {!! Form::text('phone', $old->phone, ['class' => 'form-control mb-4', 'style' => 'width:150px', 'onkeypress' => 'return isNumberKey(event)', 'placeholder' => '(__) ____-____']) !!}

        {!! Form::label('celular','Celular: ') !!}
        {!! Form::text('celular', $old->celular, ['class' => 'form-control ', 'style' => 'width:150px','onkeypress' => 'return isNumberKey(event)', 'placeholder' => '(__) _____-____']) !!}

        <div class="mt-4">
        <a href="{{ route('user.index', ['id' => $id]) }}" class="btn btn-primary mr-3">Voltar</a>

        {!! Form::hidden('info', 'editar_geral') !!}
        {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}
  </div>

@endif
@endsection

@section('script')
 
 @if($field == "users")

<script type="text/javascript">
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>

<script type="text/javascript">
    function yesnoCheck(that) {
        if (that.value == '1') {
            document.getElementById('documento').placeholder = "___.___.___-__";
        }else {
            document.getElementById('documento').placeholder = "";
        }
    }
</script>
@endif
@endsection