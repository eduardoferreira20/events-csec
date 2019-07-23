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
    </h4>
      <h6>Período:
        {{$data['start_date']}}  às  {{$data['start_time']}}
        @if($data['start_date'] != $data['end_date'])
        Até {{$data['end_date']}}
        @endif
        @if($data['all_day'])
        <br>
        <br>
        Durante todo o dia.
        @else
        até {{$data['end_date']}} às {{$data['end_time']}}
        @endif
      </h6>
      @if($data['link'] != null)
      <h6>Para mais informações:<a target="_blank" href="{{$data['link']}}">  {{$data['link']}}</a></h6>
      @else
      <!-- não aparece nada -->
      @endif
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
        <div id="programacao" class="tab-pane fade">
          <div class="card">
            <div class="card-body">
              <div class="d-flex mb-3 flex-column">
                a
              </div>
            </div>
          </div>
        </div>
        <div id="folder" class="tab-pane fade">
          <div class="card">
            <div class="card-body">
              <div class="d-flex mb-3 flex-column">
                a2
              </div>
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
                {!! $palestrante->apresentacao !!}
              @else
                <div class="text-muted">
                  Nada para informar.
                </div>
              @endif 
            </div>
          </div>
        @endforeach
        <div class="card-header">
          {!! Form::open(array('route' => ['events.edit', $data['id']],'method'=>'POST')) !!}
          {!! Form::hidden('info', 'add_palestrante') !!}
          {!! Form::submit('+ Adicionar palestrante', ['class'=>'btn btn-link']) !!}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
  <div class="d-flex flex-column" id="palestras">
    <div class="d-flex mr-auto mb-3">
      <h2>
        Inscrição evento:
      </h2>
    </div>
    
    <div class="tab-content">
      <div id="inscricao" class="tab-pane fade in active">
        <div class="card">
          <div class="card-body">
            @auth('admin-web')
            @if($data['inicio_inscricoes'] == null)
            Datas não definidas!
            <br>
            <br>
            {!! Form::open(array('route' => ['events.inscricoes', $data['id']],'method'=>'POST')) !!}
            {!! Form::hidden('info', 'mostrar_edicao') !!}
            {!! Form::submit('Definir datas', ['class'=>'btn btn-danger']) !!}
            {!! Form::close() !!}
            @elseif($data['inicio_inscricoes']  != null)
            Deseja mudar as datas?
            {!! Form::open(array('route' => ['events.inscricoes', $data['id']],'method'=>'POST')) !!}
            {!! Form::hidden('info', 'mostrar_edicao') !!}
            {!! Form::submit('Redefinir datas', ['class'=>'btn btn-danger']) !!}
            {!! Form::close() !!}
            @endauth
            @else
            @if(date('d-m', strtotime($hora)) > date('d-m',strtotime($data['fim_inscricoes'])))
            <div class="alert alert-danger" role="alert">
              Inscrições encerradas!
            </div>
            @else
            @auth('user-web')
            {!! Form::open(array('route' => ['events.inscricoes', $data['id']],'method'=>'POST')) !!}
            {!! Form::hidden('info', 'mostrar_inscricao') !!}
            {!! Form::submit('Inscrever-se', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
            @endauth
            @endif
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- <div class="d-flex flex-column" id="palestras">
    <div class="d-flex mr-auto mb-3">
      <h2>
        Minicursos:
      </h2>
    </div>
    <div class="card" style="width: 32.5%;">
      @foreach ($oficinas as $cursos)
      <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(1).jpg" class="card-img-top" alt="...">

      <div class="card-body">
        <h5 class="card-title">{{$cursos->titulo}}</h5>
        <p class="card-text">{{$cursos->apresentation}}</p>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">{{$cursos->palestrante1}}</li>
        @if($cursos->palestrante2 != null)
        <li class="list-group-item">{{$cursos->palestrante2}}</li>
        <li class="list-group-item">{{$cursos->palestrante3}}</li>
        <li class="list-group-item">{{$cursos->palestrante4}}</li>
        @endif
        <li class="list-group-item">{{$cursos->start_date}}</li>
        <li class="list-group-item">{{$cursos->valor}}</li>
      </ul>
      <div class="card-body">
        <div class="d-flex">
          @auth('admin-web')
          {!! Form::open(array('route' => ['events.edit', $data['id']],'method'=>'POST')) !!}
          {!! Form::hidden('info', 'oficinas') !!}
          {!! Form::hidden('old', $cursos->id) !!}
          {!! Form::submit('Editar campo', ['class'=>'btn btn-primary']) !!}
          {!! Form::close() !!}
          @endauth
        </div> 
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
  </div> -->
  @auth('admin-web')
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
        <li class="present">
          <a data-toggle="tab" href="#ata">Ata de presença</a>
        </li>
      </ul>
      <div class="tab-content">
        <div id="confirmacao" class="tab-pane fade in active">
          <div class="card">
            <div class="card-body">
              <div class="d-flex mb-5 flex-column">

                <table  class="table">
                  <thead>
                    <tr>
                      <th scope="col">Nome</th>
                      <th scope="col">Status inscrições</th>
                       @auth('admin-web')
                      <th scope="col">Ação</th>
                        @endauth
                    </tr>
                  </thead>
                  <tbody> 
                   @foreach ($inscricaos as $inscricaos)
                   <tr>
                    <td scope="row">{{$inscricaos->user->name}}</td>
                    @if($inscricaos->status == 0)
                    <td>Aguardando confirmação...</td>
                    @else
                    <td>Inscrição confirmada!</td>
                    @endif
                   @auth('admin-web')
                    <td>
                      @if($inscricaos->status == 0)
                     <a class="btn btn-success" href="javascript:(confirm('Confirmar status da inscrição de {{$inscricaos->user->name}}?') ? window.location.href='{{route('events.aprovar', $inscricaos->id)}}' : false)">Status</a>
                     @else
                      <a class="btn btn-warning" href="javascript:(confirm('Mudar status da inscrição de {{$inscricaos->user->name}}?') ? window.location.href='{{route('events.aprovar', $inscricaos->id)}}' : false)">Status</a>
                     @endif
                     <a class="btn btn-danger" href="javascript:(confirm('Deletar essa inscrição?') ? window.location.href='{{route('events.deletarIns', $inscricaos->id)}}' : false)">Deletar</a>
                   </td>
                   @endauth
                 </tr>
                 @endforeach
               </tbody>
             </table>
           </div>
         </div>
       </div>
     </div>
   <div id="ata" class="tab-pane fade">
    <div class="card">
      <div class="card-body">
        <div class="d-flex mb-5 flex-column">

          <table  class="table">
            <thead>
              <tr>
                <th scope="col">Nome</th>
                <th scope="col">Status presença</th>
                <th scope="col">Ação</th>
              </tr>
            </thead>
            <tbody> 
             @foreach ($presenca as $presenca)
             <tr>
              @if($presenca->status == 1)
              <td scope="row">{{$presenca->user->name}}</td>
              @if($presenca->presenca == 0)
              <td>Faltou</td>
              @else
              <td>Presente</td>
              @endif
            @auth('admin-web')
              <td>
                <a class="btn btn-success" href="{{route('events.presenca', $presenca->id)}}">Status</a>
             </td>
             @endauth
             @endif
           </tr>
           @endforeach
         </tbody>
       </table>
     </div>
   </div>
 </div>
</div>
</div>
</div>
@endauth
@auth('admin-web')
<div class="d-flex flex-column" id="credenciamento">
    <div class="d-flex mr-auto mb-3">
      <h2>
        Certificados:
      </h2>
    </div>
    <div class="d-flex flex-column text-justify" id="tabela">
      <div class="tab-content">
        <div id="confirmacao" class="tab-pane fade in active">
          <div class="card">
            <div class="card-body">
              <div class="d-flex mb-5 flex-column">

                <table  class="table">
                  <thead>
                    <tr>
                      <th scope="col">Nome</th>
                      <th scope="col">Email</th>
                      <th scope="col">Status</th>
                      <th scope="col">Ação</th>
                    </tr>
                  </thead>
                  <tbody> 
                  <tr   >
                    <td>
                     @foreach($certificado as $certificado)
                     @if($certificado->presenca == 1)
                     <tr>
                      <td class="nome">{{$certificado->user->name}}</td>
                      <td class="nome">{{$certificado->user->email}}</td>
                      @if($certificado->envio == 0)
                      <td class="nome" id="nome"><strong>Não enviado</strong></td>
                      @else
                      <td class="nome" id="nome"><strong>Enviado</strong></td>
                      @endif
                      <td>
                      <a target="_blank" href="{{(url('/certificado/download/'.$certificado->evento->id.'/usuario/'.$certificado->user->id) )}}" class="btn btn-success" >Abrir</a>
                      <a href="{{url('/send/certificado/'.$certificado->evento->id.'/evento/'.$certificado->user->id).'/presenca'}}" class="btn btn-info">Enviar</a>
                    </td>
                    @endif
                    </tr>
                    @endforeach
                    </td>
                  </tr>
               </tbody>
             </table>
           </div>
         </div>
       </div>
     </div>
   </div>
</div>
@endauth
<div class="d-flex flex-column" id="relatorio">
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
<script type="text/javascript">
  var tempo = window.setInterval(carrega, 1000);
function carrega()
{
$('#tabela').load("showevent.blade.php");
}
</script>
<!-- Pagina organizador evento -->

@endsection

