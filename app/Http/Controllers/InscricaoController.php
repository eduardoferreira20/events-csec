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
use App\Http\Middleware\VerifyCsrfToken;
use App\Event;
use DB;
use Illuminate\Http\File;

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

			$nameFile = null;
			//pega o id do ususario logado
			$user = uniqid(Auth::user()->id);


    		// Verifica se informou o arquivo e se é válido
			if ($request->hasFile('comprovante') && $request->file('comprovante')->isValid()) {

        		// Define um aleatório para o arquivo baseado no timestamps atual
				$name =  Auth::user()->id;;

        		// Recupera a extensão do arquivo
				$extension = $request->comprovante->extension();

        		// Define finalmente o nome
				$nameFile = "{$name}.{$extension}";

        		// Faz o upload:
				$upload = $request->comprovante->storeAs('comporvantes', $nameFile);
        		// Se tiver funcionado o arquivo foi armazenado em storage/app/public/comporvantes/nomedinamicoarquivo.extensao

        		// Verifica se NÃO deu certo o upload (Redireciona de volta)
				if ( !$upload )
					return redirect()
				->back()
				->with('error', 'Falha ao fazer upload')
				->withInput();

			}
			// $comprovante = $request->file('comprovante');
			// $extensao = $request->comprovante->getClientOriginalExtension();
			// $name = time(). ".".$extensao;
			// $path = url('storage/'.$comprovante->storeAs('comprovantes', $request['user_id'].'.'.$extensao));


			// if (empty($comprovante)) {
			// 	abort(400, 'Nenhum arquivo foi enviado.');
			// }

			//pega o id do ususario logado
			$user = Auth::user()->id;
			//insero os dados no banco
			Inscricao::create([
				'user_id' => $user,
				'event_id' => $id,
				'status'=> false,
				'comprovante_path' => $nameFile,
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
	public function download($id){

		$boleto =DB::table('inscricaos')->where('event_id',$id)->get();

		foreach($boleto as $b){

		// $nome = var_dump($b->comprovante_path);
		$a = storage_path('app/public/comporvantes/'.$b->comprovante_path);
		// echo $boleto['comprovante_path'];
		return response()->download($a);
	}

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