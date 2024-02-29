/*
 * Nombre: aggregations.js
 * Lenguaje: JavaScript
 * Recursos: MongoDB, Studio 3T, Visual Studio Code
 * Historial: Finalizado el 27.02.2024
*/

db.horarios.find({})
db.salones.find({})

// A TODAS LAS AGREGACIONES SE LES PODRÍA AGREGAR EL LIMIT Y EL SKIP PARA LA PAGINACIÓN. o un match para buscar por categorías

//~~~~~~~~~~~~~~~~~~~~~~ AGREGACIONES SIMPLES ~~~~~~~~~~~~~~~~~~~~~~

// Cantidad promedio de estudiantes por curso
db.horarios.aggregate([
    {
        $group: {
        _id: "$curso",
        avg: {
            $avg: "$cantEst"
        }
        }
    },
    {
        $project: {
        curso: "$curso",
        avgStudents: {
            $round: ["$avg", 2]
        }
        }
    }
]);  

//Salones con más capacidad
db.salones.aggregate([
{
    $sort: {capacidad: -1}
},
{
    $limit: 10
}
]);


//Capacidad total de los edificios
db.salones.aggregate([
{
    $group: {
        _id: "$edificio",
        capacidadTotal: {$sum: "$capacidad"}
    }
}
]);


//~~~~~~~~~~~~~~~~~~~~~~ AGREGACIONES COMPLEJAS ~~~~~~~~~~~~~~~~~~~~~~

//Cursos por edificio
db.Horarios.aggregate([
    {
        $unwind: {
        path: "$encargados"
        }
    },
    {
        $group: {
        _id: "$encargados.nombre",
        conteo: {
            $addToSet: "$curso"
        }
        }
    },
    {
        $project: {
        _id: 0,
        encargado: "$_id",
        conteo: {
            $size: "$conteo"
        }
        }
    },
    {
        $sort: {
        conteo: -1
        }
    },
    {
        $limit: 10 // variable cambiante pa la paginacion
    },
    {
        $skip: 1 // variable cambiante pa la paginacion
    }
]);


// Cursos con alta demanda en laboratorios que no se dan abasto
db.Horarios.aggregate([
    {
        $lookup: {
        from: "salones",
        localField: "salon_id",
        foreignField: "id",
        as: "result"
        }
    },
    {
        $unwind: {
        path: "$result"
        }
    },
    {
        $match: {
        "result.laboratorio": true
        }
    },
    {
        $project: {
        _id: 0,
        curso: 1,
        cantEst: 1,
        salon_id: 1,
        capacidad: "$result.capacidad"
        }
    },
    {
        $match: {
        $expr: {
            $gte: ["$cantEst", "$cantidad"]
        }
        }
    },
    {
        $group: {
        _id: {
            salon_id: "$salon_id",
            curso: "$curso"
        },
        maxUso: {
            $max: "$cantEst"
        },
        capacidad: {
            $max: "$capacidad"
        }
        }
    },
    {
        $project: {
        _id: 0,
        salon_id: "$_id.salon_id",
        curso: "$_id.curso",
        maxUso: "$maxUso",
        capacidad: "$capacidad"
        }
    }
])
