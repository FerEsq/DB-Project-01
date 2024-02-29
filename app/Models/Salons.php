<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Salons extends Model
{
   protected $connection = 'mongodb';
   protected $collection = 'salones';
   protected $primaryKey = '_id';

    protected $fillable = [
        'id',
        'edificio',
        'nivel',
        'identificador',
        'capacidad',
        'laboratorio',
        'tipo',
    ];

}
