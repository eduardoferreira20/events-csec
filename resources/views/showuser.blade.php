@extends('layouts.padrao')

@section('titulo-principal')
  <div class="d-flex">
    <div class="d-flex flex-fill">
      {{ $user->name }}
    </div>
    <div class="d-flex align-self-center">
      <a href="{{ route('events.index') }}" class="btn btn-primary">Voltar</a>
    </div>
  </div>
@endsection

@section('conteudo-principal')
<div class="d-flex flex-column">
  <div class="d-flex mb-4" id="cabecalho">
    <div class="d-flex flex-column mr-auto">
    	<h5 class= "mb-0">< {{ $user->email }} ></h5>
    	<h5>Empresa/Instituição: {{ $user->instituicao }}</h5>
    </div>
    <div class="d-flex flex-column align-items-end">
    </div>
   </div>
     <div class="d-flex flex-column mb-4" id="informacoes">
    <div class="d-flex flex-column">
      <ul class="nav nav-tabs ml-0 mb-0">
        <li class="active"><a data-toggle="tab" href="#apresentacao">Apresentação</a></li>
        <li><a data-toggle="tab" href="#dadosgerais">Dados Gerais</a></li>
        <li><a data-toggle="tab" href="#dadoscomplementares">Dados Complementares</a></li>
      </ul>
      <div class="tab-content">
        <div id="apresentacao" class="tab-pane fade in active">
          <div class="card">
            <div class="card-body">
              <div class="d-flex mb-5 flex-column">
                  @if($user->apresentation != null)
                    {!! $user->apresentation !!}
                  @else
                    <div class="text-muted">
                      Nada para informar.
                    </div>
                  @endif
              </div>
              <div class="d-flex">
                  {!! Form::open(array('route' => ['user.edit', $user->id],'method'=>'POST')) !!}
                  {!! Form::hidden('info', 'apresentation') !!}
                  {!! Form::hidden('old', $user->apresentation) !!}
                  {!! Form::submit('Editar campo', ['class'=>'btn btn-primary']) !!}
                  {!! Form::close() !!}
              </div>
            </div>
          </div>
        </div>
        <div id="dadosgerais" class="tab-pane fade">
          <div class="card">
            <div class="card-body">
              <div class="d-flex mb-5">
            	Nome: {{ $user->name }} </br>
            	E-mail: {{ $user->email }} </br>
            	Nacionalidade: {{ $user->nacionalidade }}</br>
            	Documento: {{ $user->documento }}</br>
            	Empresa/Instituição: {{ $user->instituicao }} </br>
            	Telefone Residencial: {{ $user->phone }}</br>
            	Telefone Celular: {{ $user->celular }}</br>
              </div>
              <div class="d-flex">
                {!! Form::open(array('route' => ['user.edit', $user->id],'method'=>'POST')) !!}
                {!! Form::hidden('info', 'users') !!}
                {!! Form::submit('Editar campo', ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
              </div>
            </div>
          </div>
        </div>
        <div id="dadoscomplementares" class="tab-pane fade">
          <div class="card">
            <div class="card-body">
              <div class="d-flex mb-5">
              CEP: {{ $endereco->cep }}</br>
              Logradouro: {{ $endereco->logradouro }}</br>
              Número: {{ $endereco->numero }}</br>
              Complemento: {{ $endereco->complemento }}</br>
              Bairro: {{ $endereco->bairro }}</br>
              Cidade: {{ $endereco->cidade }}</br>
              </div>
              <div class="d-flex">
                  {!! Form::open(array('route' => ['user.edit', $user->id],'method'=>'POST')) !!}

                  {!! Form::hidden('info', 'enderecos') !!}
                  {!! Form::hidden('old', $endereco->user_id) !!}
                  {!! Form::submit('Editar campo', ['class'=>'btn btn-primary']) !!}
                  {!! Form::close() !!}
              </div>
            </div>
          </div>
        </div>
      </div>    
    </div>
  </div>
</div>
@endsection
