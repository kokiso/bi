<?php

namespace App\Http\Controllers\bc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\BcFrotaImport;
use App\Imports\BcMotoristaImport;
use App\Models\bcFrota;
use App\Models\bcMotorista;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class BcController extends Controller
{
    public function motoristaImport()
    {
        bcMotorista::query()->delete();

        Excel::import(new BcMotoristaImport,request()->file('fileMotorista'));

        return redirect('/admin');
    }

    public function frotaImport()
    {
        bcFrota::query()->delete();
        Excel::import(new BcFrotaImport,request()->file('fileFrota'));

        return redirect('/admin');
    }

    public function frotaview(){
        return view ('bc.frota');
    }

    public function motoristaview(){
        return view ('bc.motorista');
    }

}
