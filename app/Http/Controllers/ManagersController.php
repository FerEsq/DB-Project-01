<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;

class ManagersController extends Controller
{
    public function index()
    {
        $managers = Manager::all()->take(20);
        //dd($managers->first()->foto);
        $managers->each(function ($manager) {
            $manager->foto = $manager->getFotoAttribute();
        });
        $params = [
            'managers' => $managers
        ];

        return view('component', [
            'component' => 'managers',
            'params'    => $params,
        ]);
    }

    public function store(Request $request)
    {
        if ($request->_id == 0){
            $manager = Manager::create([
                'nombre'    =>  $request->nombre,
                'facultad' => $request->facultad,
                'correo' => $request->correo,
                'celular' => $request->celular,
            ]);
            return response()->json(['message' => 'Encargado creado correctamente', 'manager' => $manager], 201);
        }
        else {
            $manager = Manager::find($request->_id);
            if (!$manager) {
                return response()->json(['error' => 'El Encargado no existe.'], 404);
            }

            $manager->update([
                'nombre'    =>  $request->nombre,
                'facultad' => $request->facultad,
                'correo' => $request->correo,
                'celular' => $request->celular,
            ]);
            return response()->json(['message' => 'Manager actualizado correctamente', 'manager' => $manager], 200);
        }
    }


    public function edit(Request $request)
    {
        $params = [
            'manager' =>Manager::find($request->manager)
        ];

        return view('component', [
            'component' => 'manager-edit',
            'params'    => $params,
        ]);
    }

    public function destroy(Request $request) {
        $manager = Manager::find($request->manager);
        if (!$manager) {
            return response()->json(['error' => 'El encargado no existe.'], 404);
        }
        $manager->delete();

        return response()->json(['message' => 'Encargado eliminado correctamente'], 200);
    }
}
