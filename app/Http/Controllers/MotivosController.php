<?php

namespace App\Http\Controllers;

use App\Motivo;
use Illuminate\Http\Request;

class MotivosController extends Controller
{
    public function index()
    {
        $data = Motivo::get();
        return view('motivos', ['motivos'=>$data]);
    }

    public function create()
    {
        return view('insertformmotivo');
    }

    public function store(Request $request)
    {
        $motivo = new Motivo;
        $motivo->motivo = $request->input('motivo');
        $motivo->save();
        return redirect('motivos');
    }


    public function edit($id)
    {
        $item = Motivo::find($id);
        return view('editformmotivo', ['item'=>$item]);
    }

    public function update(Request $request, $id)
    {
        $search = Motivo::find($id);
        $search->motivo = $request->input('motivo');
        $search->save();
        return redirect('motivos');
    }

    public function destroy($id)
    {
        Motivo::destroy($id);
        return redirect('motivos');
    }
}
