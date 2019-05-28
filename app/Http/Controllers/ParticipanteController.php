<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Participante;
use App\Event;
use App\Inscricao;
use Carbon\Carbon;            
use PDF;

class ParticipanteController extends Controller
{
    public function index(){
    	$user=Participante::all();
    	return view('certificado.certificado' , ['user'=>$user]);
    }

    public function events(){
        return hasMany(Event::class);
    }

    public function pdfexport($id){
    	$user=Participante::find($id);
    	$pdf=PDF::loadView('certificado.pdf', ['user' => $user])->setPaper('A4','portrait');
    	$fileName= $user->name;
    	return $pdf->stream($fileName.'.pdf');
    }
}
