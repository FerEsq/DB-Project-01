<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Horarios extends Model
{
    protected $connection ='mongodb';
    protected $collection = 'horarios';
}
