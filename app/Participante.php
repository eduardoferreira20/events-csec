<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
	protected $table = 'users';
	protected $fillable = ['name', 'email','cpf'];
}