<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Manager extends Model
{
    protected $connection ='mongodb';
    protected $collection = 'encargados';

    protected $guarded = ['_id'];

    protected $primaryKey = '_id';
}
