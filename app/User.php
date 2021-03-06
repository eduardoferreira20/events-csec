<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Inscricao;
use App\Event;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'apresentation', 'nacionalidade', 'passport', 'phone', 'celular', 'documento', 'tipo', 'instituicao',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    public function evento(){
        return $this->hasOne('App\Event','user_id');
    }

    public function certificado(){
        return $this->hasMany('App\Inscricao','user_id','event_id');
    }

    public function inscricao(){
        
        return $this->belongsTo('App\Inscricao');
    }

}
