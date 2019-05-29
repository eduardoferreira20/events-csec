<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Participante;
use App\Event;
use App\User;
use App\Inscricao;
use Carbon\Carbon;
use DB;
use PDF;

class ParticipanteController extends Controller
{
    public function index(){
    	$user=Participante::all();
    	return view('certificado.certificado' , compact('user'));
    }

    public function pdfexport($id){
    	$user=User::where('id',$id)->first();
        $pdf=PDF::loadView('certificado.pdf', compact('user'))->setPaper('A4','portrait');
    	$fileName= $user->name;
    	return $pdf->stream($fileName.'.pdf');
    }
}
