<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Event;
use App\User;
use App\Inscricao;
use Carbon\Carbon;
use DB;
use View;

class SendEmailUserController extends Controller
{
	public function send($id,$user_id){
	$user=Inscricao::where('user_id',$user_id)->first();
	$evento=Event::where('id',$id)->first();
	$to_name = $user->user->name;
	$to_email = $user->user->email;
	$evento_id = $evento->id;
	$user_id = $user->user->id;
	$evento_name = $evento->title;
	$user_name = $user->user->name;
	
	$data1 = array('name'=>$user_name, 'title'=>$evento_name,'user_id'=>$user_id,'evento_id'=>$evento_id, "body" => "Certificado do evento");
    
	Mail::send('mail',$data1, function($message) use ($to_name, $to_email) {
    	$message->to($to_email, $to_name)
            ->subject('Certificado');
    	$message->from('animedudu12345@gmail.com','CSEC');
	});
	// return Redirect::to(route('events.show', ['id' => $evento->id]));
	return back();
	}
}
