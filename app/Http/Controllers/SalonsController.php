<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salons;

class SalonsController extends Controller
{
    public function index()
    {
        $salons = Salons::all();
        $params = [
            'salons' => $salons
        ];

        return view('component', [
            'component' => 'salons',
            'params'    => $params,
        ]);
    }

    public function store(Request $request)
    {
        if ($request->_id == 0){
            $salon = Salons::create([
                'id'    =>  $request->id,
                'edificio' => $request->edificio,
                'nivel' => $request->nivel,
                'identificador' => $request->identificador,
                'capacidad' => $request->capacidad,
                'laboratorio' => $request->laboratorio,
                'tipo' => $request->tipo,
            ]);
            return response()->json(['message' => 'Salón creado correctamente', 'salon' => $salon], 201);
        }
        else {
            $salon = Salons::find($request->_id);
            if (!$salon) {
                return response()->json(['error' => 'El salón no existe.'], 404);
            }

            $salon->update([
                'id'    =>  $request->id,
                'edificio' => $request->edificio,
                'nivel' => $request->nivel,
                'identificador' => $request->identificador,
                'capacidad' => $request->capacidad,
                'laboratorio' => $request->laboratorio,
                'tipo' => $request->tipo,
            ]);

            // Puedes devolver una respuesta adecuada, como un mensaje o el salón actualizado
            return response()->json(['message' => 'Salón actualizado correctamente', 'salon' => $salon], 200);
        }
    }


    public function edit(Request $request)
    {
        $params = [
            'salon' =>Salons::find($request->salone)
        ];

        return view('component', [
            'component' => 'salons-edit',
            'params'    => $params,
        ]);
    }

    public function destroy(Request $request) {
        $salon = Salons::find($request->salone);
        if (!$salon) {
            return response()->json(['error' => 'El salón no existe.'], 404);
        }
        $salon->delete();

        return response()->json(['message' => 'Salon eliminado correctamente'], 200);
    }
}
