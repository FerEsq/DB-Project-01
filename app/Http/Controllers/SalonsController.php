<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salons;

class SalonsController extends Controller
{
    public function index()
    {
        $salons = Salons::all();

        dd($salons);

        $params = [
            'salons' => $salons
        ];
            

        return view('component', [
            'component' => 'horario-todos',
            'params'    => $params,
        ]);
    }
}
