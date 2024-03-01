import json
import random

def classRoomsGenerator(n, seed=None):
    random.seed(seed)  # Establecer la semilla

    edificios = ['A', 'C', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'CIT']
    classRooms = []
    used_ids = set()

    for _ in range(n):
        edificio = random.choice(edificios)
        if edificio == 'CIT':
            nivel = random.randint(1, 6)
        else:
            nivel = random.randint(1, 3)

        while True:
            identificador = str(nivel) + '{:02d}'.format(random.randint(1, 41))
            full_id = edificio + identificador
            if full_id not in used_ids:
                break

        used_ids.add(full_id)
        capacidad = random.randint(20, 35)
        laboratorio = random.random() > 0.5
        tipo = random.choice(['fisica', 'quimica', 'ciencias de la vida']) if laboratorio else 'comun'
        
        classRoom = {
            "id": full_id,
            "edificio": edificio,
            "nivel": nivel,
            "identificador": identificador,
            "capacidad": capacidad,
            "laboratorio": laboratorio,
            "tipo": tipo
        }
        classRooms.append(classRoom)

    return classRooms

def jsonGenerator(classrooms, file):
    with open(file, 'w') as f:
        json.dump(classrooms, f, indent=4)

def generator(n=2, seed=288):
    classrooms = classRoomsGenerator(n, seed)
    jsonGenerator(classrooms, './dataGenerator/data/salones.json')
    print("Se generaron {} salones".format(len(classrooms)))
    return classrooms