<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;

class ManagersController extends Controller
{
    public function index()
    {
        $managers = Manager::all();
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
        dd($request->all());
//        if ($request->_id == 0){
//            $salon = Salons::create([
//                'id'    =>  $request->id,
//                'edificio' => $request->edificio,
//                'nivel' => $request->nivel,
//                'identificador' => $request->identificador,
//                'capacidad' => $request->capacidad,
//                'laboratorio' => $request->laboratorio,
//                'tipo' => $request->tipo,
//            ]);
//            return response()->json(['message' => 'Salón creado correctamente', 'salon' => $salon], 201);
//        }
//        else {
//            $salon = Salons::find($request->_id);
//            if (!$salon) {
//                return response()->json(['error' => 'El salón no existe.'], 404);
//            }
//
//            $salon->update([
//                'id'    =>  $request->id,
//                'edificio' => $request->edificio,
//                'nivel' => $request->nivel,
//                'identificador' => $request->identificador,
//                'capacidad' => $request->capacidad,
//                'laboratorio' => $request->laboratorio,
//                'tipo' => $request->tipo,
//            ]);
//
//            // Puedes devolver una respuesta adecuada, como un mensaje o el salón actualizado
//            return response()->json(['message' => 'Manager actualizado correctamente', 'salon' => $manager], 200);
//        }
    }


    public function edit(Request $request)
    {
        dd($request->all());
//        $params = [
//            'salon' =>Salons::find($request->salone)
//        ];
//
//        return view('component', [
//            'component' => 'salons-edit',
//            'params'    => $params,
//        ]);
    }

    public function destroy(Request $request) {
        dd($request->all());

//        $salon = Salons::find($request->salone);
//        if (!$salon) {
//            return response()->json(['error' => 'El salón no existe.'], 404);
//        }
//        $salon->delete();
//
//        return response()->json(['message' => 'Salon eliminado correctamente'], 200);
    }
}
