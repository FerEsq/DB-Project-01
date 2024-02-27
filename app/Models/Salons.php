<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Salons extends Model
{
   protected $connection = 'mongodb';
   protected $collection = 'salones';

}
