<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodicidad extends Model
{
	protected $table = "periodicidades";
	protected $primarykey = "id";
	protected $fillable = ['periodicidad'];
}
