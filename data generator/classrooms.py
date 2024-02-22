import json
import random

def cargar_equipos(archivo):
    with open(archivo, 'r') as f:
        return json.load(f)

def classRoomsGenerator(n):
    edificios = ['A', 'C', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'CIT']
    classRooms = []

    for _ in range(n):
        edificio = random.choice(edificios)
        if edificio == 'CIT':
            nivel = random.randint(1, 6)
        else:
            nivel = random.randint(1, 3)
        
        identificador = str(nivel) + '{:02d}'.format(random.randint(1, 41))
        capacidad = random.randint(20, 35)
        laboratorio = random.random() > 0.5
        tipo = random.choice(['fisica', 'quimica', 'ciencias de la vida']) if laboratorio else 'comun'

        equipos = cargar_equipos('./data/equipment.json')
        equipos_tipo = [equipo for equipo in equipos if equipo['tipo'] == tipo]
        cantidad_equipos = random.randint(0, len(equipos_tipo))
        ids_equipos = random.sample([equipo['id'] for equipo in equipos_tipo], cantidad_equipos)
        
        classRoom = {
            "id": edificio + identificador,
            "edificio": edificio,
            "nivel": nivel,
            "identificador": identificador,
            "capacidad": capacidad,
            "laboratorio": laboratorio,
            "tipo": tipo,
            "equipos": ids_equipos
        }
        classRooms.append(classRoom)

    return classRooms

def jsonGenerator(classrooms, file):
    with open(file, 'w') as f:
        json.dump(classrooms, f, indent=4)

classrooms = classRoomsGenerator(100)
sortedclassrooms = sorted(classrooms, key=lambda x: x['id'])
jsonGenerator(sortedclassrooms, './data/salones.json')
print("Se generaron {} salones".format(len(sortedclassrooms)))
