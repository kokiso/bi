<?php

namespace App\Http\Controllers\Placa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\RelatorioTrechoExport;
use App\Imports\RelatorioTrechoImport;
use Maatwebsite\Excel\Facades\Excel;

class PlacaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view ('placas.home.index');
    }

    public function importview(){
        return view ('placas.home.import');
    }

    public function export()
    {
        return Excel::download(new RelatorioTrechoExport, 'placa.xlsx');
    }

    public function import()
    {
        Excel::import(new RelatorioTrechoImport,request()->file('filePlaca'));

        return back();
    }

}
