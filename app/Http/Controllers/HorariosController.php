<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horarios;

class HorariosController extends Controller
{
    public function index()
    {
        $horarios = Horarios::all()->take(20);
        $params = [
            'horarios' => $horarios
        ];


        return view('component', [
            'component' => 'Horarios',
            'params'    => $params,
        ]);
    }
    public function store(Request $request)
    {
        if ($request->_id == 0){
            $horario = Horarios::create([
                'cantEst'    =>  $request->cantEst,
                'ciclo' => $request->ciclo,
                'curso' => $request->curso,
                'encargados' => $request->encargados,
                'inicio' => $request->inicio,
                'periodos' => $request->periodos,
                'salon_id' => $request->salon_id,
                'seccion' => $request->seccion,
                'year' => $request->year,
            ]);
            return response()->json(['message' => 'Horario creado correctamente', 'horario' => $horario], 201);
        }
        else {
            $horario = Horarios::find($request->_id);
            if (!$horario) {
                return response()->json(['error' => 'El horario no existe.'], 404);
            }

            $horario->update([
                'cantEst'    =>  $request->cantEst,
                'ciclo' => $request->ciclo,
                'curso' => $request->curso,
                'encargados' => $request->encargados,
                'inicio' => $request->inicio,
                'periodos' => $request->periodos,
                'salon_id' => $request->salon_id,
                'seccion' => $request->seccion,
                'year' => $request->year,
            ]);

            // Puedes devolver una respuesta adecuada, como un mensaje o el salón actualizado
            return response()->json(['message' => 'Horario actualizado correctamente', 'horario' => $horario], 200);
        }
    }

    public function edit(Request $request){
        $params = [
            'horario'=>Horarios::find($request->todo)
        ];
        return view('component',[
           'component'=>'horarios-edit',
           'params'=>$params,
        ]);
    }
    public function destroy(Request $request)
    {
        $horario = Horarios::find($request->todo);
//        dd($horario);
        if (!$horario) {
            return response()->json(['error' => 'El horario no existe.'], 404);
        }
        $horario->delete();

        return response()->json(['message' => 'Horario eliminado correctamente'], 200);
    }
}
