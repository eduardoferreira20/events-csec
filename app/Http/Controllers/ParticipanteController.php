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
    public function pdfexport($id,$user_id){
        $evento=Event::find($id);
    	$user=Inscricao::where('user_id',$user_id)->first();
        $pdf=PDF::loadView('certificado.pdf', compact('user','evento'))->setPaper('A4','portrait');
    	$fileName= $user->user->name;
    	return $pdf->stream($fileName.'.pdf');
    }
}
