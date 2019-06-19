<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Inscricao;
use PDF;
use QrCode;

class QRController extends Controller
{
	public function qrcode($id,$user_id) {

		$i=Inscricao::where('user_id',$user_id)->first();
		$qr = QrCode::size(240)->generate($i->id);

    return view('qrcode',compact('qr','i'));
	}
}
