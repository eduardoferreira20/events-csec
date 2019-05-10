<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'nacionalidade' => $data['nacionalidade'],
            'instituicao' => $data['instituicao'],
            'documento' => $data['documento'],
            'tipo' => $data['tipo'],
            'phone' => $data['phone'],
            'celular' => $data['celular'],
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        //$this->validator($request->all())->validate();

        event(
            new Registered(
            $user = $this->create($request->input())
            )
        );

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect()->intended(route('index'));
    }

    protected function registered(Request $request, $user)
    {
        //
    }

    protected function guard()
    {
        return Auth::guard('user-web');
    }

    
}
