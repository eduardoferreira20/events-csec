<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Filesystem\Filesystem;
use App\Inscricao;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Event;
use DB;

class InscricaoController extends Controller
{
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
			$comprovante = $request->file('comprovante');
			$extensao = $request->comprovante->getClientOriginalExtension();
			$name = time(). ".".$extensao;
			$path = url('storage/'.$comprovante->storeAs('comprovantes', $request['user_id'].'.'.$extensao));


			if (empty($comprovante)) {
				abort(400, 'Nenhum arquivo foi enviado.');
			}

			$user = Auth::user()->id;

			Inscricao::create([
				'user_id' => $user,
				'event_id' => $id,
				'status'=> false,
				'comprovante_path' => $path,
				'presenca' => false,
				'envio' => false,
			]);

			return Redirect::to(route('events.show', ['id' => $id]));
		}
	}

	public function pagamento(){
		$pagar = DB::table('events')->get();
		return view('pagamento',compact('pagar'));
	}

	public function lista($id){
		$boletos = DB::table('inscricaos')->where('event_id',$id)->get();
		return view('lista',compact('boletos'));
	}

	public function deletar(){
		foreach ($this->id as $inscri){
			$inscri->delete();
		}
		return true;
	}

	public function teste(){
		return view('layouts.padrao');
	}
}