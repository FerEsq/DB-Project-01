<?php

namespace App\Http\Controllers;

use App\Models\Horarios;
use App\Models\Salons;
use Illuminate\Http\Request;


class AggregationController extends Controller
{
    public function index()
    {

        $params = [
            'avgestcurso' => $this->avgEstCurso(),
            'salonmascap' => $this->salonMasCap(),
            'captotaledi' => $this->capTotalEdi(),
            'cursoencargado'=> $this->cursoEncargado(),
            'labdemanda' => $this->labDemanda()->take(10),
        ];

        return view('component', [
            'component' => 'agregaciones',
            'params' => $params
        ]);
    }

    private function buildAggregations(){

        return[
            'avgestcurso' => $this->avgEstCurso(),
            'salonmascap' => $this->salonMasCap(),
            'captotaledi' => $this->capTotalEdi(),
            'cursoencargado'=> $this->cursoEncargado(),
            'labdemanda' => $this->labDemanda()->take(10),
        ];
    }

    private function avgEstCurso()
    {
        $horarios = Horarios::raw(function($collection) {
            return $collection->aggregate([
                [
                    '$group' => [
                        '_id' => '$curso',
                        'avg' => ['$avg' => '$cantEst']
                    ]
                ],
                [
                    '$project' => [
                        'curso' => '$_id',
                        'avgStudents' => ['$round' => ['$avg', 2]]
                    ]
                ]
            ]);
        });
        return $horarios->take(10);
    }

    private function salonMasCap()
    {
        return Salons::raw(function($collection) {
            return $collection->aggregate([
                [
                    '$sort' => ['capacidad' => -1]
                ],
                [
                    '$limit' => 10
                ]
            ]);
        });
    }

    private function capTotalEdi()
    {
        return Salons::raw(function($collection) {
            return $collection->aggregate([
                [
                    '$group' => [
                        '_id' => '$edificio',
                        'capacidadTotal' => ['$sum' => '$capacidad']
                    ]
                ]
            ]);
        });
    }

    private function cursoEncargado()
    {
        return Horarios::raw(function($collection) {
            return $collection->aggregate([
                [
                    '$unwind' => '$encargados'
                ],
                [
                    '$group' => [
                        '_id' => '$encargados.nombre',
                        'conteo' => ['$addToSet' => '$curso']
                    ]
                ],
                [
                    '$project' => [
                        'encargado' => '$_id',
                        'conteo' => ['$size' => '$conteo']
                    ]
                ],
                [
                    '$sort' => ['conteo' => -1]
                ],
                [
                    '$limit' => 10 // Ajusta según la paginación
                ],
                [
                    '$skip' => 1 // Ajusta según la paginación
                ]
            ]);
        });

    }

    private function labDemanda()
    {
        return Horarios::raw(function($collection) {
            return $collection->aggregate([
                [
                    '$lookup' => [
                        'from' => 'salones',
                        'localField' => 'salon_id',
                        'foreignField' => 'id',
                        'as' => 'result'
                    ]
                ],
                [
                    '$unwind' => '$result'
                ],
                [
                    '$match' => ['result.laboratorio' => true]
                ],
                [
                    '$project' => [
                        'curso' => 1,
                        'cantEst' => 1,
                        'salon_id' => 1,
                        'capacidad' => '$result.capacidad'
                    ]
                ],
                [
                    '$match' => ['$expr' => ['$gte' => ['$cantEst', '$cantidad']]]
                ],
                [
                    '$group' => [
                        '_id' => ['salon_id' => '$salon_id', 'curso' => '$curso'],
                        'maxUso' => ['$max' => '$cantEst'],
                        'capacidad' => ['$max' => '$capacidad']
                    ]
                ],
                [
                    '$project' => [
                        'salon_id' => '$_id.salon_id',
                        'curso' => '$_id.curso',
                        'maxUso' => '$maxUso',
                        'capacidad' => '$capacidad'
                    ]
                ]
            ]);
        });

    }

}
