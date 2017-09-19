<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
  protected $table = "tareas";
  protected $primaryKey = "id";
  protected $fillable = [
    'id_item',
    'id_usuario',
    'tarea'
  ];
}
