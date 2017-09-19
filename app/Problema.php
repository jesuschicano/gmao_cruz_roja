<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problema extends Model
{
  protected $table = "problemas";
  protected $primaryKey = 'id';
  protected $fillable = [
    'comentario',
    'id_item'
  ];
}
