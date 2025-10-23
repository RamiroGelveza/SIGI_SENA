<?php

namespace App\Http\Controllers;

use App\Models\Cosecha;
use App\Models\finca;
use App\Models\Invernadero;
use Illuminate\Http\Request;

class dashboarController extends Controller
{

    public function welcome()
    {


        $cantidadFincas = finca::count();
        $cantidadInvernaderos = Invernadero::count();
        $cantidadCosechas=Cosecha::count();

        return view('welcome', compact('cantidadFincas','cantidadInvernaderos','cantidadCosechas'));
    }




}
