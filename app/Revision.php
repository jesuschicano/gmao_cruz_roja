<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
  protected $table = 'revisiones';
  protected $primarykey = 'id';
  protected $fillable = ['grado','untima_rev','prox_rev','period','aviso'];
}
