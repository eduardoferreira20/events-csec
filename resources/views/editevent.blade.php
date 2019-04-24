@extends('layouts.padrao')

@section('style')
@if($field == "apresentation" || $field == "palestrantes" || $field == "add_palestrante")
<link rel="stylesheet" type="text/css" href="{{ asset('css/simeditor/simditor.css') }}" />
@elseif($field == "general")
<link rel="stylesheet" href="{{ asset('css/clockpicker/bootstrap-clockpicker.min.css') }}"/>
@endif
@endsection

@section('titulo-principal')
@if($field == "apresentation")
Editar descrição
@elseif($field == "general")
Editar informações
@elseif($field == "palestrantes")
Editar informações de palestrante
@elseif($field == "add_palestrante")
Adicionar palestrante
@endif
@endsection

@section('conteudo-principal')
@if($field == "apresentation")
<div class="d-flex my-4">
  {!! Form::open(array('route' => ['events.edit', $id],'method'=>'POST')) !!}
  {!! Form::textarea('input', $old->apresentation, ['id' => 'editor']) !!}
  <div class="mt-4">
    <a href="{{ route('events.show', ['id' => $id]) }}" class="btn btn-primary mr-3">
      Voltar
    </a>
    {!! Form::hidden('info', 'editar_apresentacao') !!}
    {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
  </div>
  {!! Form::close() !!}
</div>
@elseif($field == "general")
{!! Form::open(array('route' => ['events.edit', $id],'method'=>'POST')) !!}
<div class="d-flex flex-column panel-body">    
  <div class="d-flex flex-column mb-4">
    {!! Form::label('title','Nome do evento:') !!}
    {!! Form::text('title', $old['title'], ['class' => 'form-control']) !!}
  </div>
  <div class="d-flex flex-column mb-4">
    {!! Form::label('local','Local do evento:') !!}
    {!! Form::text('local', $old['local'], ['class' => 'form-control']) !!}
  </div>
  <div class="d-flex flex-column mb-4">
    {!! Form::label('cidade','Cidade do evento:') !!}
    {!! Form::text('cidade', $old['cidade'], ['class' => 'form-control']) !!}
  </div>
  <div class="d-flex flex-column mb-4">
    {!! Form::label('valor','Valor do evento:') !!}
    {!! Form::text('valor', $old['valor'], ['class' => 'form-control']) !!}
  </div>
  <div class="d-flex flex-fill mb-4">
    <div class="d-flex flex-column mr-4">
      {!! Form::label('start_date','Data de início:') !!}
      {!! Form::date('start_date', $old['start_date'], ['class' => 'form-control']) !!}
    </div>
    <div class="d-flex flex-column">
      {!! Form::label('end_date','Data de término:') !!}
      {!! Form::date('end_date', $old['end_date'], ['class' => 'form-control']) !!}
    </div>
  </div>
  <div class="d-flex flex-fill mb-4">
    <div class="d-flex flex-column mr-4">
      {!! Form::label('all_day','Dia todo?') !!}
      {!! Form::checkbox('all_day', $old['all_day'], false) !!}
    </div>
    <div class="d-flex flex-column mr-4 clockpicker">
      {!! Form::label('start_time','Horário inicial:') !!}
      {!! Form::text('start_time', $old['start_time'], ['class' => 'form-control', 'placeholder' => '--:--']) !!}
    </div>

    <div class="d-flex flex-column clockpicker">
      {!! Form::label('end_time','Horário final:') !!}
      {!! Form::text('end_time', $old['end_time'], ['class' => 'form-control', 'placeholder' => '--:--']) !!}
    </div>
  </div>
  <div class="mt-4">
    <a href="{{ route('events.show', ['id' => $id]) }}" class="btn btn-primary mr-3">
      Voltar
    </a>
    {!! Form::hidden('info', 'editar_informacoes') !!}
    {!! Form::submit('Salvar',['class'=>'btn btn-primary']) !!}
  </div>
  {!! Form::close() !!}
</div>
@elseif($field == "palestrantes")
<div class="d-flex my-4">
  {!! Form::open(array('route' => ['events.edit', $id],'method'=>'POST')) !!}
  {!! Form::label('nome','Nome completo do palestrante:') !!}
  {!! Form::text('nome', $old->nome, ['class' => 'form-control mb-4']) !!}
  {!! Form::label('instituicao','Instituição responsável:') !!}
  {!! Form::text('instituicao', $old->instituicao, ['class' => 'form-control mb-4']) !!}
  {!! Form::label('url','Endereço web da Instituição:') !!}
  {!! Form::text('url', $old->url, ['class' => 'form-control mb-4']) !!}
  <div class="d-flex flex-column">
    {!! Form::label('input','Descrição do palestrante:') !!}
    {!! Form::textarea('input', $old->apresentacao, ['id' => 'editor']) !!}   
  </div>
  <div class="mt-4">
    <a href="{{ route('events.show', ['id' => $id]) }}" class="btn btn-primary mr-3">
      Voltar
    </a>
    {!! Form::hidden('id', $old->id) !!}
    {!! Form::hidden('info', 'editar_palestrante') !!}
    {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
  </div>
  {!! Form::close() !!}
</div>
@elseif($field == "add_palestrante")
<div class="d-flex my-4">
  {!! Form::open(array('route' => ['events.edit', $id],'method'=>'POST')) !!}
  {!! Form::label('nome','Nome completo do palestrante:') !!}
  {!! Form::text('nome', null, ['class' => 'form-control mb-4']) !!}
  {!! Form::label('instituicao','Instituição responsável:') !!}
  {!! Form::text('instituicao', null, ['class' => 'form-control mb-4']) !!}
  {!! Form::label('url','Endereço web da Instituição:') !!}
  {!! Form::text('url', null, ['class' => 'form-control mb-4']) !!}
  <div class="d-flex flex-column">
    {!! Form::label('input','Descrição do palestrante:') !!}
    {!! Form::textarea('input', null, ['id' => 'editor']) !!} 
  </div> 
  <div class="mt-4">
    <a href="{{ route('events.show', ['id' => $id]) }}" class="btn btn-primary mr-3">
      Voltar
    </a>
    {!! Form::hidden('info', 'adicionar_palestrante') !!}
    {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
  </div>
  {!! Form::close() !!}
</div>
@endif
@endsection

@section('script')
@if($field == "general")
<script src="{{ asset('js/clockpicker/bootstrap-clockpicker.min.js') }}"></script>
<script src="{{ asset('js/lib/moment.min.js') }}"></script>
<script>
  $('.clockpicker').clockpicker({
    placement: 'bottom',
    default: 'now',
    align: 'left',
    autoclose: true,
  });
</script>
<script>
  document.getElementById('all_day').onchange = function() {
    document.getElementById('start_time').disabled = this.checked;
    document.getElementById('end_time').disabled = this.checked;
  };
</script>
@endif
@endsection
