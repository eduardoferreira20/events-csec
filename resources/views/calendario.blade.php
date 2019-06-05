@extends('layouts.padrao')

@section('estilos')
<link rel="stylesheet" href="{{ asset('css/fullcalendar/fullcalendar.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/clockpicker/bootstrap-clockpicker.min.css') }}"/>
@endsection

@section('titulo-principal')
Calendário de eventos
@endsection

@section('conteudo-principal')
{!! $calendar->calendar() !!}
@endsection

@section('sidebar')
@auth('admin-web')
<aside class="widget">
    <h3 class="widgettitle">
        <span>Elaborar evento</span>
    </h3>
    <div>
        <div class="d-flex flex-column">    
            {!! Form::open(array('route' => 'events.add','method'=>'POST')) !!}
            <div class="d-flex flex-column mb-4">
                {!! Form::label('event_name','Nome do evento:') !!}
                {!! Form::text('event_name', null, ['class' => 'form-control']) !!}
            </div>
            <div class="d-flex flex-column mb-4">
                {!! Form::label('start_date','Data de início:') !!}
                {!! Form::date('start_date', null, ['class' => 'form-control', 'style' => 'width:170px']) !!}
            </div>
            <div class="d-flex flex-column mb-4">
                {!! Form::label('end_date','Data de término:') !!}
                {!! Form::date('end_date', null, ['class' => 'form-control', 'style' => 'width:170px']) !!}
            </div>
            <div class="d-flex flex-fill mb-4">
                <div class="d-flex flex-column mr-4">
                    {!! Form::label('all_day','Dia todo?') !!}
                    {!! Form::checkbox('all_day', true) !!}
                </div>
                <div class="d-flex flex-column mr-4 clockpicker">
                    {!! Form::label('start_time','Horário inicial:') !!}
                    {!! Form::text('start_time', null, ['class' => 'form-control', 'placeholder' => '--:--']) !!}
                </div>
                <div class="d-flex flex-column clockpicker">
                    {!! Form::label('end_time','Horário final:') !!}
                    {!! Form::text('end_time', null, ['class' => 'form-control', 'placeholder' => '--:--']) !!}
                </div>
            </div>
            <div class="d-flex flex-fill mb-4">
                <div class="d-flex flex-column mr-4">
                    {!! Form::label('e_pago','É pago?') !!}
                    {!! Form::checkbox('all_day', true) !!}
                </div>
                <div class="d-flex flex-column mr-4">
                    {!! Form::label('valor','Valor do evento:') !!}
                {!! Form::text('valor', null, ['class' => 'form-control','placeholder' => 'Ex.: 20,00']) !!}
                </div>
            </div>
            <div class="d-flex flex-column mb-4">
                {!! Form::label('hora_comple','Horas complementares:') !!}
                {!! Form::text('hora_comple', null, ['class' => 'form-control', 'placeholder' => 'Ex.: 8 (oito)']) !!}
            </div>
            <div class="d-flex flex-column mb-4">
                {!! Form::label('local','Local do evento:') !!}
                {!! Form::text('local', null, ['class' => 'form-control','placeholder' => 'Ex.: POLI(Escola Politecnica de Pernambuco)']) !!}
            </div>
            <div class="d-flex flex-column mb-4">
                {!! Form::label('rua','Rua do evento:') !!}
                {!! Form::text('rua', null, ['class' => 'form-control','placeholder' => 'Ex.: AV. Pedro Allain,88 ']) !!}
            </div>
            <div class="d-flex flex-column mb-4">
                {!! Form::label('cidade','Bairro:') !!}
                {!! Form::text('cidade', null, ['class' => 'form-control', 'placeholder' => 'Ex.: Recife']) !!}
            </div>
            <div class="d-flex flex-fill">
                <div class="d-flex mr-4">
                    {!! Form::select('user_id', $users, null, ['placeholder' => 'Escolher usuário', 'class' => 'form-control']) !!}
                </div>
                <div class="d-flex">
                    {!! Form::submit('Criar Evento',['class'=>'btn btn-primary']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</aside>
@endauth
@endsection

@section('script')
@auth('admin-web')
<script src="{{ asset('js/clockpicker/bootstrap-clockpicker.min.js') }}"></script>
@endauth
<script src="{{ asset('js/lib/moment.min.js') }}"></script>
<script src="{{ asset('js/fullcalendar/fullcalendar.min.js') }}"></script>
<script src="{{ asset('js/fullcalendar/locale/pt-br.js') }}"></script>

@auth('admin-web')
<script>
    $('.clockpicker').clockpicker({
        placement: 'bottom',
        default: 'now',
        align: 'left',
        autoclose: true,
    });
</script>

<script>
    function myFunction() {
        if(document.querySelector('all_day').checked == true){
            document.getElementById('start_time').disabled = this.checked;
            document.getElementById('end_time').disabled = this.checked;
        }
    }
</script>
@endauth

{!! $calendar->script() !!}
@endsection