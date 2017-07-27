<?php

namespace App\Http\Controllers;

use App\Periodicidad;
use Illuminate\Http\Request;

class PeriodicidadesController extends Controller
{
    public function index()
    {
        $data = Periodicidad::all();
        return view('periodicidades', ['datos'=>$data]);
    }

    public function create()
    {
        return view('insertformperiodicidades');
    }

    public function store(Request $request)
    {
        $period = new Periodicidad;
        $period->periodicidad = $request->input('period');
        $period->save();
        return redirect('periodicidades');
    }

    public function edit($id)
    {
        $data = Periodicidad::find($id);
        return view('editformperiodos', ['datos'=>$data]);
    }


    public function update(Request $request, $id)
    {
        $search = Periodicidad::find($id);
        $search->periodicidad = $request->input('periodo');
        $search->save();
        return redirect('periodicidades');
    }

    public function destroy($id)
    {
        Periodicidad::destroy($id);
        return redirect('periodicidades');   
    }
}
