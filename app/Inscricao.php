<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model
{
	protected $fillable = ['id','user_id','event_id','comprovante_path', 'status'];

}
