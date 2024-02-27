/*
 * Nombre: aggregations.js
 * Lenguaje: JavaScript
 * Recursos: MongoDB, Studio 3T, Visual Studio Code
 * Historial: Finalizado el 27.02.2024
*/

db.horarios.find({})
db.salones.find({})

//~~~~~~~~~~~~~~~~~~~~~~ AGREGACIONES SIMPLES ~~~~~~~~~~~~~~~~~~~~~~

//Agrupar Horarios por Ciclo
db.horarios.aggregate([
{
    $group: {
        _id: "$ciclo",
        count: {$sum: 1}
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

//Contar cursos por facultad
db.horarios.aggregate([
{
    $unwind: "$encargados"
},
{
    $group: {
        _id: "$encargados.facultad",
        totalCursos: {$sum: 1}
    }
}
]);

//Cursos por edificio
db.Horarios.aggregate([
{
    $lookup: {
        from: "Salones",
        localField: "salon_id",
        foreignField: "id",
        as: "infoSalon"
    }
},
{
    $match: {
        "infoSalon.edificio": { $exists: true } // Filtra solo los documentos que tienen información de salones
    }
},
{
    $project: {
        curso: 1,
        "infoSalon.edificio": 1
    }
    }
]);

