<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Inventario;
use App\Fileentry;

class ArchivosController extends Controller
{
  public function index(){
    $archivos = Fileentry::all();
    return view('ficheros.listado', compact('archivos'));
  }

  public function create($id){
    $item = Inventario::find($id);
    return view('ficheros.subir', ['item' => $item]);
  }

  public function store(Request $request, $id){
    $item = Inventario::find($id);
    $file = $request->file('fichero');
    $extension = $file->getClientOriginalExtension();
    $file->storeAs($item->id.'/', $file->getFilename().'.'.$extension);

    $entry = new Fileentry();
    $entry->id_item = $item->id;
    $entry->mime = $file->getClientMimeType();
    $entry->original_filename = $file->getClientOriginalName();
    $entry->filename = $file->getFilename() . '.' . $extension;

    $entry->save();

    return redirect('inventario');
  }

  public function get($filename){
    $entry = Fileentry::where('filename', '=', $filename)->FirstOrFail();

    $file = base_path() . "\storage\app\public\\" . $entry->id_item . "\\" . $entry->filename;

    if(file_exists($file)){
      header('Content-Type: '.$entry->mime);
      header('Content-Disposition: attachment; filename="'.basename($entry->original_filename).'"');
      readfile($file);
    }else{
      dd('File does not exist');
    }
  }
}
