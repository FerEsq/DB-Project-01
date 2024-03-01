<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Horarios extends Model
{
    protected $connection ='mongodb';
    protected $collection = 'horarios';

    protected $primaryKey = '_id';

    protected $fillable = [
        'cantEst',
        'ciclo',
        'curso',
        'encargados',
        'inicio',
        'periodos',
        'salon_id',
        'seccion',
        'year'
    ];
}
