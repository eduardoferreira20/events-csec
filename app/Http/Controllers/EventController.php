<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\InscricaoController; 
use App\Event;
use App\Palestrante;
use App\Palestra;
use App\Oficinas;
use App\Inscricao;
use DB;
Use DateTime;
use Validator;
use Calendar;
use Carbon\Carbon;

class EventController extends Controller
{

	public function calendario(){
		$events = [];
		$data = Event::all();

		if($data->count()) {
			foreach ($data as $key => $value) {
				$events[] = Calendar::event(
					$value->title,
					(boolean) $value->all_day,
					new DateTime($value->start_date),
					new DateTime($value->end_date),
					null,
					[
						'url' => route('events.show', ['id' => $value->id]),
					]
				);
			}
		}

		$calendar = Calendar::addEvents($events)->setOptions(
			[
				'timeFormat' => 'H:mm',
				'displayEventTime' => false,
			]
		);

		$userslist = DB::table('users')->get()->pluck('name', 'id'); 

		return view('calendario', compact('calendar'))->with('users', $userslist);
	}

	public function adicionar(Request $request){
		$sd = $request->input('start_date');
		$st = $request->input('start_time');
		$ed = $request->input('end_date');
		$et = $request->input('end_time');

		$start = date('Y-m-d H:i:s', strtotime("$sd $st"));
		$end = date('Y-m-d H:i:s', strtotime("$ed $et"));

		$perfil = $request->file('foto_perfil');
		$extensao = $request->perfil->getClientOriginalExtension();
		$path = url('storage/'.$perfil->storeAs('foto_perfil', $request['user_id'].'.' .$extensao));

		$event = new Event;
		$event->title = $request->input('event_name');
		$event->start_date = $start;
		$event->end_date = $end;
		$event->user_id = $request->input('user_id');
		$event->all_day = $request->has('all_day');
		$event->e_pago = $request->has('e_pago');
		$event->valor = $request->input('valor');
		$event->local = $request->input('local');
		$event->cidade = $request->input('cidade');
		$event->hora_comple = $request->input('hora_comple');
		$event->save();

		return Redirect::to(route('events.index'));
	}

	public function events($id){
		$event = DB::table('events')
		->where('id', $id)->first();

		$user = DB::table('users')
		->where('id', $event->user_id)->first();

		$userID = DB::table('users')->get();

		$event = array(
			'id'	=> $event->id,
			'title' => $event->title,
			'apresentation' => $event->apresentation,
			'inicio_inscricoes' => $event->inicio_inscricoes,
			'fim_inscricoes' => $event->fim_inscricoes,
			'start_date' => date('d-m', strtotime($event->start_date)),
			'end_date' => date('d-m', strtotime($event->start_date)),
			'all_day' => $event->all_day,
			'e_pago' => $event->e_pago,
			'valor' => $event->valor,
			'hora_comple' => $event->hora_comple,
			'local' => $event->local,
			'cidade' => $event->cidade,
			'start_time' => date('H:i', strtotime($event->start_date)),
			'end_time' => date('H:i', strtotime($event->end_date)),
		);

		$nome_palestrantes = DB::table('palestrantes')
		->where('event_id', $id)
		->get();

		$palestras = DB::table('palestras')->where('event_id',$id)->get();	

		$oficinas = DB::table('oficinas')->where('event_id',$id)->get();

		$inscricaos = Inscricao::where('event_id',$id)->get();

		$presenca = Inscricao::where('event_id',$id)->get();	

		$hora = Carbon::now();			

		return view('showevent',compact('hora'))->with('data', $event)->with('info', $user)->with('palestrantes', $nome_palestrantes)->with('palestras', $palestras)->with('oficinas',$oficinas)->with('inscricaos', $inscricaos)->with('presenca',$presenca);

	}

	public function aprovar($id){

		$aprovar =  Inscricao::find($id);

		if ($aprovar->status == '1'){

			$aprovar->update(['status' => '0']);

			return back();

    	}if ($aprovar->status == '0') {
        
        $aprovar->update(['status' => '1']);

       		 return back();
    	}
	}
	public function presenca($id){

		$presenca =  Inscricao::find($id);

		if ($presenca->presenca == '1'){

			$presenca->update(['presenca' => '0']);

			return back();

    	}if ($presenca->presenca == '0') {
        
        $presenca->update(['presenca' => '1']);

       		 return back();
    	}
	}
	public function deletarInscricao($id){
		$inscricao = Inscricao::find($id);
		$inscricao->delete();
		return back();
	}
	public function edit($id, Request $request){


		$check = null;
		if($request['info'] == 'general'){
			$check = DB::table('events')
			->where('id', $id)
			->first();

			$check = array(
				'title' => $check->title,
				'local' => $check->local,
				'cidade' => $check->cidade,
				'valor' => $check->valor, 
				'hora_comple' => $check->hora_comple,
				'start_date' => date('Y-m-d', strtotime($check->start_date)),
				'end_date' => date('Y-m-d', strtotime($check->start_date)),
				'all_day' => $check->all_day,
				'start_time' => date('H:i', strtotime($check->start_date)),
				'end_time' => date('H:i', strtotime($check->end_date)),
			);

			return view('editevent')
			->with('field', $request['info'])
			->with('old', $check)
			->with('id', $id);	

		}elseif($request['info'] == 'palestrantes'){
			$check = DB::table('palestrantes')
			->where('event_id', $id)
			->where('id', $request['old'])
			->first();

			return view('editevent')
			->with('field', $request['info'])
			->with('old', $check)
			->with('id', $id);	

		}elseif($request['info'] == 'palestras'){
			$check = DB::table('palestras')
			->where('event_id', $id)
			->where('id', $request['old'])
			->first();

			return view('editevent')
			->with('field', $request['info'])
			->with('old', $check)
			->with('id', $id);	

		}elseif($request['info'] == 'minicursos'){
			$check = DB::table('oficinas')
			->where('event_id', $id)
			->where('id', $request['old'])
			->first();

			return view('editevent')
			->with('field', $request['info'])
			->with('old', $check)
			->with('id', $id);	

		}elseif($request['info'] == 'editar_apresentacao'){
			DB::table('events')
			->where('id', $id)
			->update(['apresentation' => $request['input']]);

			return Redirect::to(route('events.show', ['id' => $id]));
		}elseif($request['info'] == 'editar_informacoes'){
			$sd = $request['start_date'];
			$st = $request['start_time'];
			$ed = $request['end_date'];
			$et = $request['end_time'];

			$start = date('Y-m-d H:i:s', strtotime("$sd $st"));
			$end = date('Y-m-d H:i:s', strtotime("$ed $et"));

			DB::table('events')
			->where('id', $id)
			->update(['title' => $request['title']]);

			DB::table('events')
			->where('id', $id)
			->update(['local' => $request['local']]);

			DB::table('events')
			->where('id', $id)
			->update(['cidade' => $request['cidade']]);

			DB::table('events')
			->where('id', $id)
			->update(['valor' => $request['valor']]);	

			DB::table('events')
			->where('id', $id)
			->update(['all_day' => $request->has('all_day')]);

			DB::table('events')
			->where('id', $id)
			->update(['start_date' => $start]);

			DB::table('events')
			->where('id', $id)
			->update(['end_date' => $end]);

			return Redirect::to(route('events.show', ['id' => $id]));
		}elseif($request['info'] == 'editar_palestrante'){


			DB::table('palestrantes')
			->where('event_id', $id)
			->where('id', $request['id'])
			->update(['nome' => $request['nome']]);

			DB::table('palestrantes')
			->where('event_id', $id)
			->where('id', $request['id'])
			->update(['instituicao' => $request['instituicao']]);

			DB::table('palestrantes')
			->where('event_id', $id)
			->where('id', $request['id'])
			->update(['cargo' => $request['cargo']]);

			DB::table('palestrantes')
			->where('event_id', $id)
			->where('id', $request['id'])
			->update(['foto_perfil' => $request['foto_perfil']]);

			DB::table('palestrantes')
			->where('event_id', $id)
			->where('id', $request['id'])
			->update(['url' => $request['url']]);

			DB::table('palestrantes')
			->where('event_id', $id)
			->where('id', $request['id'])
			->update(['apresentacao' => $request['input']]);

			return Redirect::to(route('events.show', ['id' => $id]));

		}elseif($request['info'] == 'editar_palestras'){
			$sd = $request['start_date'];
			$st = $request['start_time'];
			$ed = $request['end_date'];
			$et = $request['end_time'];

			$start = date('Y-m-d H:i:s', strtotime("$sd $st"));
			$end = date('Y-m-d H:i:s', strtotime("$ed $et"));

			DB::table('palestras')
			->where('event_id', $id)
			->where('id', $request['id'])
			->update(['title' => $request['title']]);

			DB::table('palestras')
			->where('event_id', $id)
			->where('id', $request['id'])
			->update(['palestrante_id' => $request['palestrante_id']]);


			DB::table('palestras')
			->where('event_id', $id)
			->where('id', $request['id'])
			->update(['apresentation' => $request['input']]);

			DB::table('palestras')
			->where('event_id',$id)
			->where('id',$request['id'])
			->update(['start_date' => $start]);

			DB::table('palestras')
			->where('event_id',$id)
			->where('id',$request['id'])
			->update(['end_date' => $end]);

			return Redirect::to(route('events.show', ['id' => $id]));

		}elseif($request['info'] == 'editar_oficinas'){

			$check = DB::table('oficinas')
			->where('id', $id)
			->first();

			$check = array(
				'titulo' => $check->titulo,
				'local' => $check->local,
				'apresentation' => $check->apresentation,
				'valor' => $check->valor, 
				'palestrante1' => $check->palestrante1,
				'palestrante2' => $check->palestrante2,
				'palestrante3' => $check->palestrante3,
				'palestrante4' => $check->palestrante4,
				'hora_comple' => $check->hora_comple,
				'start_date' => date('d-m', strtotime($check->start_date)),
				'end_date' => date('d-m', strtotime($check->start_date)),
				'start_time' => date('H:i', strtotime($check->start_date)),
				'end_time' => date('H:i', strtotime($check->end_date)),
			);

			$sd = $request['start_date'];
			$st = $request['start_time'];
			$et = $request['end_time'];

			$start = date('Y-m-d H:i:s', strtotime("$sd $st"));
			$end = date('H:i', strtotime("$et"));

			DB::table('oficinas')
			->where('event_id', $id)
			->where('id', $request['id'])
			->update(['titulo' => $request['titulo']]);

			DB::table('oficinas')
			->where('event_id', $id)
			->where('id', $request['id'])
			->update(['apresentation' => $request['input']]);

			DB::table('oficinas')
			->where('event_id', $id)
			->where('id', $request['id'])
			->update(['palestrante1' => $request['palestrante1']]);

			DB::table('oficinas')
			->where('event_id', $id)
			->where('id', $request['id'])
			->update(['palestrante2' => $request['palestrante2']]);

			DB::table('oficinas')
			->where('event_id', $id)
			->where('id', $request['id'])
			->update(['palestrante3' => $request['palestrante3']]);

			DB::table('oficinas')
			->where('event_id', $id)
			->where('id', $request['id'])
			->update(['palestrante4' => $request['palestrante4']]);

			DB::table('oficinas')
			->where('event_id',$id)
			->where('id',$request['id'])
			->update(['start_date' => $start ]);

			DB::table('oficinas')
			->where('event_id',$id)
			->where('id',$request['id'])
			->update(['end_date' => $end]);

			DB::table('oficinas')
			->where('event_id',$id)
			->where('id',$request['id'])
			->update(['valor' => $request['valor']]);

			DB::table('oficinas')
			->where('event_id',$id)
			->where('id',$request['id'])
			->update(['hora_comple' => $request['hora_comple']]);

			DB::table('oficinas')
			->where('event_id',$id)
			->where('id',$request['id'])
			->update(['local' => $request['local']]);

			return Redirect::to(route('events.show', ['id' => $id]));		
		}elseif($request['info'] == 'adicionar_palestrante'){

			$perfil = $request->file('foto_perfil');
			$extensao = $request->perfil->getClientOriginalExtension();
			$path = url('storage/'.$perfil->storeAs('foto_perfil', $request['user_id'].'.' .$extensao));

			Palestrante::create([
				'event_id' => $id,
				'nome' => $request['nome'],
				'instituicao' => $request['instituicao'],
				'cargo' => $request['cargo'],
				'foto_perfil' => $request['foto_perfil'],
				'url' => $request['url'],
				'apresentacao' => $request['input'],
			]);

			return Redirect::to(route('events.show', ['id' => $id]));

		}elseif($request['info'] == 'adicionar_minicurso'){

			Oficinas::create([
				'event_id' => $id,
				'titulo' => $request['titulo'],
				'apresentation' => $request['input'],
				'palestrante1' => $request['palestrante1'],
				'palestrante2' => $request['palestrante2'],
				'palestrante3' => $request['palestrante3'],
				'palestrante4' => $request['palestrante4'],
				'start_date' => $request['start_date'],
				'end_date' => $request['end_date'],
				'hora_comple' => $request['hora_comple'],
				'valor' => $request['valor'],
				'local' => $request['local'],
				
			]);

			return Redirect::to(route('events.show', ['id' => $id]));

		}elseif($request['info'] == 'adicionar_palestras'){
			Palestra::create([
				'event_id' => $id,
				'title' => $request['title'],
				'palestrante_id' => $request['palestrante_id'],
				'apresentation' => $request['input'],
				'start_date' => $request['start_date'],
				'end_date' => $request['end_date'],
			]);

			return Redirect::to(route('events.show', ['id' => $id]));

		}else{
			$check = DB::table('events')
			->where('id', $id)
			->first();

			return view('editevent')
			->with('field', $request['info'])
			->with('old', $check)
			->with('id', $id);
		}
		
		return abort(404);
	}
	
	public function deletar($id){
		$events = Event::find($id);

		if(!$events->deleta()){
			\Session::flash('flash_message',['msg'=>"Evento não foi deletado com sucesso",'class'=>"alert-danger"]);
		}

		$events->delete();

		\Session::flash('flash_message',['msg'=>"Evento deletado com sucesso!",'class'=>"alert-success"]);

		return redirect()->route('index');
	}

	public function inscricoes($id, Request $request){
		if($request['info'] == 'mostrar_edicao' || $request['info'] == 'mostrar_inscricao'){
			$evento = DB::table('events')
			->where('id', $id)
			->first();

			return view('inscricoes')
			->with('evento', $evento)
			->with('info', $request['info']);
		}elseif($request['info'] == 'add'){
			DB::table('events')
			->where('id', $id)
			->update(['inicio_inscricoes' => $request['inicio_inscricoes']]);

			DB::table('events')
			->where('id', $id)
			->update(['fim_inscricoes' => $request['fim_inscricoes']]);
			
			return Redirect::to(route('events.show', ['id' => $id]));
		}elseif($request['info'] == 'inscrever'){

			
		}
	}

	public function index(){
		$event= Event::all();
		return view('index',['events'=>$event]);

	}
}