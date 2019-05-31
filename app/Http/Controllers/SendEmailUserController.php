<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class SendEmailUserController extends Controller
{
    $this->validate($request, [
            'email' => 'required'
        ]);
     Mail::to($request->input('email'))->send(new SendMail());
     return redirect()->back()->with('success', 'Email sent successfully. Check your email.');
    }
}
