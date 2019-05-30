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
    public function certificado($id){
    	$certificado=Inscricao::where('event_id',$id)->get();
    	return view('events.show' , compact('certificado'));
    }

    public function pdfexport($id){
    	$user=User::where('id',$id)->get();
        $pdf=PDF::loadView('certificado.pdf', compact('user'))->setPaper('A4','portrait');
    	$fileName= $certificado->user->name;
    	return $pdf->stream($fileName.'.pdf');
    }
}
