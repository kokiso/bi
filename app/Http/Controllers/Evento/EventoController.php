<?php

namespace App\Http\Controllers\Evento;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\RelatorioEventosExport;
use App\Imports\RelatorioEventosImport;
use Maatwebsite\Excel\Facades\Excel;

class EventoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view ('eventos.home.index');
    }

    public function importview(){
        return view ('eventos.home.import');
    }

    public function export2()
    {
        return Excel::download(new RelatorioEventosExport, 'evento.xlsx');
    }

    public function import2()
    {
        Excel::import(new RelatorioEventosImport,request()->file('fileEvento'));

        return back();
    }
}
