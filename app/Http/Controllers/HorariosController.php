<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horarios;
use App\Models\Manager;

class HorariosController extends Controller
{
    public function index()
    {
        $horarios = Horarios::all()->take(1000);
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

            $nombresOriginales = collect($horario->encargados)->pluck('nombre')->all();
            $encargadosOriginales = $horario->encargados;


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

            foreach ($nombresOriginales as $nombreOriginal) {
                Horarios::where('encargados.nombre', $nombreOriginal)->each(function ($horario) use ($nombreOriginal, $request) {
                    foreach ($horario->encargados as $index => $encargado) {
                        if ($encargado['nombre'] == $nombreOriginal) {
                            // Actualiza la información del encargado en este horario
                            $encargadoActualizado = collect($request->encargados)->firstWhere('nombreOriginal', $nombreOriginal);
                            if ($encargadoActualizado) {
                                $horario->encargados[$index] = $encargadoActualizado;
                                $horario->save();
                            }
                        }
                    }
                });
            }

            foreach ($encargadosOriginales as $encargadoOriginal) {
                $encargado = Manager::where('nombre', $encargadoOriginal['nombre'])->first();
                if ($encargado) {
                    $encargadoActualizado = collect($request->encargados)
                        ->firstWhere('nombre', $encargadoOriginal['nombre']);
                    if ($encargadoActualizado) {
                        $encargado->update([
                            'nombre'  => $encargadoActualizado['nombre'],
                            'correo'  => $encargadoActualizado['correo'],
                        ]);
                    }
                }
            }

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
