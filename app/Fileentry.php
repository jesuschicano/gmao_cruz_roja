<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fileentry extends Model
{
  protected $table = "fileentries";
  protected $primaryKey = "id";
  protected $fillable = [
    "filename",
    "mime",
    "original_filename"
  ];
}
