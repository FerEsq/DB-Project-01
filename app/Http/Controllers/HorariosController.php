<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horarios;

class HorariosController extends Controller
{
    public function index()
    {
        $horarios = Horarios::all();
        $params = [
            'horarios' => $horarios
        ];
            

        return view('component', [
            'component' => 'Horarios',
            'params'    => $params,
        ]);
    }
}
