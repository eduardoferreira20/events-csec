<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use PDF;
use App\Endereco;
use App\Inscricao;

class UserController extends Controller
{
	public function index($id){
		$user = DB::table('users')
			->where('id', $id)->first();

		$endereco = DB::table('enderecos')
			->where('user_id', $id)->first();

		$evento = Inscricao::where('user_id',$id)->get();	
		
		if(is_null($endereco)){
			Endereco::create([
				'user_id' => $id,
				'cep' => null,
				'logradouro' => null,
				'numero' => null,
				'complemento' => null,
				'bairro' => null,
				'cidade' => null,
			]);

			$endereco = DB::table('enderecos')
			->where('user_id', $id)->first();
		}

		return view('showuser')->with('user', $user)->with('endereco', $endereco)->with('evento',$evento);
	}

	public function edit($id, Request $request){
		$check = $request['old'];

		if($request['info'] == "enderecos"){
			$check = DB::table('enderecos')
				->where('user_id', $id)->first();

			if(is_null($check)){
				Endereco::create([
		            'user_id' => $id,
		            'cep' => $request['cep'],
		            'logradouro' => $request['logradouro'],
		            'numero' => $request['numero'],
		            'complemento' => $request['complemento'],
		            'bairro' => $request['bairro'],
		            'cidade' => $request['cidade'],
				]);
				
				$check = DB::table('enderecos')
					->where('user_id', $id)->first();
			}
			return view('edituser')
			->with('field', $request['info'])
			->with('old', $check)
			->with('id', $id);

		}elseif($request['info'] == "users"){
			$check = DB::table('users')
				->where('id', $id)->first();

			return view('edituser')
				->with('field', $request['info'])
				->with('old', $check)
				->with('id', $id);
				
		}elseif($request['info'] == "add_apresentation"){
			DB::table('users')
			->where('id', $id)
			->update(['apresentation' => $request['input']]);

			return Redirect::to(route('user.index', ['id' => $id]));

		}elseif($request['info'] == "add_endereco"){
			DB::table('enderecos')
			->where('user_id', $id)
			->update(['cep' => $request['cep']]);

		DB::table('enderecos')
			->where('user_id', $id)
			->update(['logradouro' => $request['logradouro']]);

		DB::table('enderecos')
			->where('user_id', $id)
			->update(['numero' => $request['numero']]);

		DB::table('enderecos')
			->where('user_id', $id)
			->update(['complemento' => $request['complemento']]);

		DB::table('enderecos')
			->where('user_id', $id)
			->update(['bairro' => $request['bairro']]);

		DB::table('enderecos')
			->where('user_id', $id)
			->update(['cidade' => $request['cidade']]);

		return Redirect::to(route('user.index', ['id' => $id]));

		}elseif($request['info'] == "apresentation"){
			return view('edituser')
			->with('field', $request['info'])
			->with('old', $check)
			->with('id', $id);

		}elseif($request['info'] == "editar_geral"){
			DB::table('users')
			->where('id', $id)
			->update(['name' => $request['name']]);

		DB::table('users')
			->where('id', $id)
			->update(['email' => $request['email']]);

		DB::table('users')
			->where('id', $id)
			->update(['nacionalidade' => $request['nacionalidade']]);

		DB::table('users')
			->where('id', $id)
			->update(['tipo' => $request['tipo']]);

		DB::table('users')
			->where('id', $id)
			->update(['documento' => $request['documento']]);

		DB::table('users')
			->where('id', $id)
			->update(['phone' => $request['phone']]);

		DB::table('users')
			->where('id', $id)
			->update(['celular' => $request['celular']]);

		return Redirect::to(route('user.index', ['id' => $id]));
		}
	}

}