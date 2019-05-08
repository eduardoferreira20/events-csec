@extends('layouts.padrao')

@section('titulo-principal')
<div class="d-flex">
  <div class="d-flex flex-fill">
    {{ $data['title'] }}
  </div>
  <div class="d-flex align-self-center">
    <a href="{{ route('events.index') }}" class="btn btn-primary">Voltar</a>
  </div>
</div>
@endsection
@section('conteudo-principal')
<div class="d-flex mb-4">
  <div class="d-flex flex-column mr-auto">
    <h4>
      Organizador:
      <a class="btn btn-link" href="{{ route('user.index', ['id' => $info->id]) }}">
        {{ $info->name }}
      </a>
      <h6>Período:
        {{$data['start_date']}}  às  {{$data['start_time']}}
        @if($data['start_date'] != $data['end_date'])
        Até {{$data['end_date']}}
        @endif
        @if($data['all_day'])
        <br>
        Durante todo o dia.
        @else
        até {{$data['end_date']}} as {{$data['end_time']}}
        @endif
      </h6>
      @auth('admin-web')
      <div class="d-flex mt-4">
        {!! Form::open(array('route' => ['events.edit', $data['id']],'method'=>'POST')) !!}
        {!! Form::hidden('info', 'general') !!}
        {!! Form::submit('Editar informações', ['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}
      </div>
      @endauth
    </div> 
  </div>
  <div class="d-flex flex-column mb-4">
    <div class="d-flex flex-column mb-3">
      <h2>Informações:</h2>
    </div>
    <div class="d-flex flex-column">
      <ul class="nav nav-tabs ml-0 mb-0">
        <li class="active"><a data-toggle="tab" href="#descricao">Descrição</a></li>
        <li class=""><a data-toggle="tab" href="#programacao">Programação</a></li>
        <li class=""><a data-toggle="tab" href="#folder">Folder</a></li>
      </ul>
      <div class="tab-content">
        <div id="descricao" class="tab-pane fade in active">
          <div class="card">
            <div class="card-body">
              <div class="d-flex mb-3 flex-column">
                @if($data['apresentation'] != null)
                {!! $data['apresentation'] !!}
                @else
                <div class="text-muted">
                  Nada para informar.
                </div>
                @endif
              </div>
              @auth('admin-web')
              <div class="d-flex">
                {!! Form::open(array('route' => ['events.edit', $data['id']],'method'=>'POST')) !!}
                {!! Form::hidden('info', 'apresentation') !!}
                {!! Form::submit('Editar campo', ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
              </div>
              @endauth
            </div>
          </div>
        </div>
      </div>    
    </div>
  </div>
  <div class="d-flex flex-column">
    <div class="d-flex mr-auto mb-3">
      <h2>Palestrantes:</h2>
    </div>
    <div id="accordion d-flex text-justify">
      <div class="card">
        @foreach ($palestrantes as $palestrante)
        <div class="card-header d-flex" id="heading{{$palestrante->id}}">
          <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$palestrante->id}}" aria-expanded="false" aria-controls="collapse{{$palestrante->id}}">
            {{$palestrante->nome}}
          </button>
          @if($palestrante->instituicao != null)
          <a class="btn btn-link d-flex mr-auto" href="{{$palestrante->url}}">
            {{$palestrante->instituicao}}
          </a>
          @endif
          <div class="d-flex">
            @auth('admin-web')
            {!! Form::open(array('route' => ['events.edit', $data['id']],'method'=>'POST')) !!}
            {!! Form::hidden('info', 'palestrantes') !!}
            {!! Form::hidden('old', $palestrante->id) !!}
            {!! Form::submit('Editar campo', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
            @endauth
          </div>
        </div>
        <div id="collapse{{$palestrante->id}}" class="collapse" aria-labelledby="heading{{$palestrante->id}}" data-parent="#accordion">
          <div class="card-body">
            @if($palestrante->apresentacao != null)
            <div class="modal-body">
              <div class="row">
                <div class="col-3 text-center">
                  <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(1).jpg" alt="{{$palestrante->nome}}"
                  class="img-fluid z-depth-1-half rounded-circle">
                  <div style="height: 10px"></div>
                  <p class="title mb-0">{{$palestrante->nome}}</p>
                  <p class="text-muted " style="font-size: 13px">{{$palestrante->cargo}}</p>
                </div>
                <div class="col-9">
                  <p>{!! $palestrante->apresentacao !!}</p>
                </div>
              </div>
            </div>
            @else
            <div class="modal-body">
              <div class="row">
                <div class="col-3 text-center">
                  <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(1).jpg" alt="IMG of Avatars"
                  class="img-fluid z-depth-1-half rounded-circle">
                  <div style="height: 10px"></div>
                  <p class="title mb-0">{{$palestrante->nome}}</p>
                  <p class="text-muted " style="font-size: 13px">{{$palestrante->cargo}}</p>
                </div>
                <div class="col-9">
                  <p></p>
                </div>
              </div>
            </div>
            @endif 
          </div>
        </div>
        @endforeach
        @auth('admin-web')
        <div class="card-header">
          {!! Form::open(array('route' => ['events.edit', $data['id']],'method'=>'POST')) !!}
          {!! Form::hidden('info', 'add_palestrante') !!}
          {!! Form::submit('+ Adicionar palestrante', ['class'=>'btn btn-link']) !!}
          {!! Form::close() !!}
        </div>
        @endauth
      </div>
    </div>
  </div>
  <div class="d-flex flex-column" id="palestras">
    <div class="d-flex mr-auto mb-3">
      <h2>
        Palestras:
      </h2>
    </div>
    
  <div class="tab-content">
    <div id="inscricao" class="tab-pane fade in active">
      <div class="card">
        <div class="card-body">
          @if($data['inicio_inscricoes'] == null)
          @auth('admin-web')
          Datas não definidas!
          {!! Form::open(array('route' => ['events.inscricoes', $data['id']],'method'=>'POST')) !!}
          {!! Form::hidden('info', 'mostrar_edicao') !!}
          {!! Form::submit('Definir datas', ['class'=>'btn btn-danger']) !!}
          {!! Form::close() !!}
          @elseif($data['inicio_inscricoes'] && $data['fim_inscricoes'] != null)
          Deseja mudar as datas?
          {!! Form::open(array('route' => ['events.inscricoes', $data['id']],'method'=>'POST')) !!}
          {!! Form::hidden('info', 'mostrar_edicao') !!}
          {!! Form::submit('Redefinir datas', ['class'=>'btn btn-danger']) !!}
          {!! Form::close() !!}
          @endauth
          @else
          @auth('user-web')
          {!! Form::open(array('route' => ['events.inscricoes', $data['id']],'method'=>'POST')) !!}
          {!! Form::hidden('info', 'mostrar_inscricao') !!}
          {!! Form::submit('Inscrever-se', ['class'=>'btn btn-primary']) !!}
          {!! Form::close() !!}
          @endauth
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
<div class="d-flex flex-column" id="palestras">
    <div class="d-flex mr-auto mb-3">
      <h2>
        Minicursos:
      </h2>
    </div>
    <div class="card" style="width: 32.5%;">
    @foreach ($palestrantes as $palestrante)
  <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(1).jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">{{$palestrante->nome}}</h5>
    <p class="card-text">{{$palestrante->apresentacao}}</p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">{{$palestrante->nome}}</li>
    <li class="list-group-item">{{$palestrante->instituicao}}</li>
    <li class="list-group-item">Vestibulum at eros</li>
  </ul>
  <div class="card-body">
    <a href="#" class="card-link">Editar Minicurso</a>
    <a href="#" class="card-link">Inscreva-se</a>
  </div>
  @endforeach 
  @auth('admin-web')
        <div class="card-header">
          {!! Form::open(array('route' => ['events.edit', $data['id']],'method'=>'POST')) !!}
          {!! Form::hidden('info', 'add_minicurso') !!}
          {!! Form::submit('+ Adicionar minicurso', ['class'=>'btn btn-link']) !!}
          {!! Form::close() !!}
        </div>
        @endauth
</div>
</div>

<div class="d-flex flex-column" id="credenciamento">
  <div class="d-flex mr-auto mb-3">
    <h2>
      Credenciamento:
    </h2>
  </div>
  <div class="d-flex flex-column text-justify">
    <ul class="nav nav-tabs ml-0 mb-0">
      <li class="active">
        <a data-toggle="tab" href="#confirmacao">Confirmação da Inscrição</a>
      </li>
      <li class="">
        <a data-toggle="tab" href="#ata">Ata de presentes</a>
      </li>
    </ul>
    <div class="tab-content">
      <div id="confirmacao" class="tab-pane fade in active">
        <div class="card">
          <div class="card-body">

          </div>
        </div>
      </div>
    </div>
  </div>
</div><div class="d-flex flex-column" id="relatorio">
  <div class="d-flex mr-auto mb-3">
    <h2>
      Relatório final:
    </h2>
  </div>
  <div class="d-flex flex-column text-justify">
    <div class="card">
      @auth('admin-web')
      <div class="card-body">
        {!! Form::submit('Enviar fotos', ['class'=>'btn btn-danger']) !!}
        {!! Form::submit('Preencher relatório', ['class'=>'btn btn-danger']) !!}
      </div>
      @endauth
    </div>
  </div>
</div>

@endsection

