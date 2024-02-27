<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salons;
use Csgt\Crud\CrudController;
use Csgt\Cancerbero\Cancerbero;

class SalonsController extends CrudController
{
    public function index()
    {
        dd($salons);
        $salons = Salons::all();
        
        $params = [
            'salons' => $salons
        ];
            
        return view('component', [
            'component' => 'Salons',
            'params'    => $params,
        ]);
    }
}
