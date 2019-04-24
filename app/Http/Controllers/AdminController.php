<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AdminController extends Controller
{
	public function index($id){
		$comprovantes = DB::table('inscricaos')
						->where('status', false)
						->get();
						
		foreach ($comprovantes as $comprovante){

		}
						
		return view('administrador')->with('comprovantes', $comprovantes);
	}
}