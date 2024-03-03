<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Client;

class Manager extends Model
{
    protected $connection ='mongodb';
    protected $collection = 'encargados';

    protected $guarded = ['_id'];

    protected $fillable = [
        'nombre',
        'facultad',
        'correo',
        'celular'
        ];

    protected $primaryKey = '_id';

    public function getFotoAttribute() {
        if (!$this->attributes['foto']) {
            return null; // Retorna null o un valor predeterminado si foto no está establecido
        }
        $fotoId = $this->attributes['foto'];

        $client = new Client("mongodb://host.docker.internal:27017/salonesuvg");

        $db = $client->selectDatabase('salonesuvg');

        $bucket = $db->selectGridFSBucket();



        try {
            $stream = $bucket->openDownloadStream($fotoId);
            $contents = stream_get_contents($stream);
            return base64_encode($contents); // Retorna la imagen codificada en base64
        } catch (\Exception $e) {
            return null; // Retorna null o maneja el error de alguna manera
        }
    }

}

