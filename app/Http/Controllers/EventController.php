<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\InscricaoController; 
use App\Event;
use App\Palestrante;
use DB;
Use DateTime;
use Validator;
use Calendar;

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

		$event = array(
			'id'	=> $event->id,
			'title' => $event->title,
			'apresentation' => $event->apresentation,
			'inicio_inscricoes' => $event->inicio_inscricoes,
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

		return view('showevent')->with('data', $event)->with('info', $user)->with('palestrantes', $nome_palestrantes);

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
					'start_date' => date('Y-m-d', strtotime($check->start_date)),
					'end_date' => date('Y-m-d', strtotime($check->start_date)),
					'all_day' => $check->all_day,
					'start_time' => date('H:i:s', strtotime($check->start_date)),
					'end_time' => date('H:i:s', strtotime($check->end_date)),
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
				->update(['url' => $request['url']]);
	
				DB::table('palestrantes')
				->where('event_id', $id)
				->where('id', $request['id'])
				->update(['apresentacao' => $request['input']]);
	
				return Redirect::to(route('events.show', ['id' => $id]));
			}elseif($request['info'] == 'adicionar_palestrante'){
				Palestrante::create([
					'event_id' => $id,
					'nome' => $request['nome'],
					'instituicao' => $request['instituicao'],
					'url' => $request['url'],
					'apresentacao' => $request['input'],
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