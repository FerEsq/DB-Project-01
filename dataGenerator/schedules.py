import json
from faker import Faker
import random
from datetime import datetime
from pymongo import MongoClient

fake = Faker()

# Función para conectarse a la base de datos y obtener los encargados
def getEncargados(num_encargados):
    # Conexión a la base de datos MongoDB
    client = MongoClient('localhost', 27017)
    db = client['salonesuvg']
    collection = db['encargados']
    
    #Obtener una muestra aleatoria de encargados de la colección
    encargados = list(collection.aggregate([
        {"$sample": {"size": num_encargados}},
        {"$project": {"_id": 0, "encargado_id": {"$toString": "$_id"}, "nombre": 1, "correo": 1}}  # Convertir ObjectId a string y proyectar los campos necesarios
    ]))

    return encargados

# Función para generar datos aleatorios
def schedulesGenerator(n, seed=None):
    random.seed(seed)

    cursos = [
        "Ciencias de la Vida",
        "Algoritmos y Programacion Basica",
        "Pensamiento Cuantitativo",
        "Comunicacion Efectiva",
        "Quimica General",
        "Introduccion a la Ingenieria",
        "Coaching para la Excelencia",
        "Programacion Orientada a Objetos",
        "Estadistica 1",
        "Ciudadania Global e Intercultural",
        "Fisica 1",
        "Calculo 1",
        "Algebra Lineal 1",
        "Organizacion de Computadoras y Assembler",
        "Fisica 2",
        "Calculo 2",
        "Algoritmos y Estructuras de Datos",
        "Guatemala en el Contexto Mundial",
        "Retos Ambientales y Sostenibilidad",
        "Fisica 3",
        "Matematica Discreta 1",
        "Ecuaciones Diferenciales 1",
        "Investigacion y Pensamiento Cientifico",
        "Programacion de Microprocesadores",
        "Programacion Plataformas Moviles",
        "Bases de Datos 1",
        "Ingenieria de Software 1",
        "Sistemas y Tecnologias Web",
        "Interaccion Humano Computador",
        "Teoria de Probabilidades",
        "Emprendimiento e Innovacion",
        "Ingenieria de Software 2",
        "Graficas por Computadora",
        "Logica Matemática",
        "Teoria de la Computacion",
        "Inteligencia Artificial",
        "Mineria de Datos",
        "Bases de Datos 2",
        "Diseno de Lenguajes de Programacion",
        "Sistemas Operativos",
        "Analisis y Diseno de Algoritmos",
        "Computacion Paralela y Distribuida",
        "Data Science",
        "Deep Learning y Sistemas Inteligentes",
        "Redes",
        "Construccion de Compiladores",
        "Modelacion y Simulacion",
        "Diseno e Innovacion en Ingenieria 1",
        "Administracion de Proyectos de TI",
        "Practica profesional",
        "Seguridad en Sistemas de Computacion",
        "Administracion y Mantenimiento Sistemas",
        "Arquitectura Empresarial",
        "Gestion y Administracion de Talento",
        "Planeacion Estrategica y Operacional",
        "Trabajo de graduacion"
    ]   
    horarios = [
        "7:00",
        "7:50",
        "8:40",
        "9:30",
        "10:40",
        "11:30",
        "12:20",
        "13:10",
        "14:00",
        "14:50",
        "15:40",
        "16:30",
        "17:20",
        "18:10",
        "19:00",
        "19:50",
        "20:40"
    ]

    facultades = [
        "Educacion", 
        "Ingenieria", 
        "Ciencias y Humanidades", 
        "Ciencias Sociales", 
        "Design Innovations & Arts",
        "Business and Managment",
        "Arquitectura"
    ]

    schedules = []
    ocupados = {}
    salonesOcupados = {}

    # Cargar datos referenciados desde un archivo JSON
    with open('./data/salones.json') as jsonFilePool:
        referencedSalones = json.load(jsonFilePool)

    for _ in range(n):
        salon = random.choice(referencedSalones)
        año = random.randint(2010, 2024)
        hora = fake.random_element(horarios)
        ciclo = str(random.randint(1,2))
        if ciclo == 1:
            inicio_ciclo = datetime(year=año, month=1, day=1)
        else:
            inicio_ciclo = datetime(year=año, month=7, day=1)
        ciclo = ciclo

        
        temp = str(año) + ciclo + hora
        if temp not in ocupados:
            ocupados[temp] = set()

        temp2 = str(año) + ciclo
        if temp2 not in salonesOcupados:
            salonesOcupados[temp2] = set()

        while (salon["id"], hora) in ocupados[temp]:
            salon = random.choice(referencedSalones)
            hora = fake.random_element(horarios)

        if salon["id"] not in salonesOcupados[temp2]:
            if random.random() < 0.30:
                continue
        
        ocupados[temp].add((salon["id"], hora))
        salonesOcupados[temp2].add(salon["id"])
        
        numCatedraticos = random.randint(1, 5)
        catedraticos = getEncargados(numCatedraticos)  # Obtener catedráticos de la base de datos

        schedule = {
            "salon_id": salon["id"],
            "curso": fake.random_element(cursos),
            "facultad": fake.random_element(facultades),
            "encargados": catedraticos,  # Usar los catedráticos obtenidos de la base de datos
            "inicio": hora,
            "periodos": random.randint(1, 3),
            "seccion": str(random.randint(1,3)) + "0",
            "cantEst": salon["capacidad"] + random.randint(-15,15),
            "ciclo": ciclo,
            "inicio_ciclo": inicio_ciclo.strftime("%Y-%m-%dT%H:%M:%SZ")
        }

        schedules.append(schedule)

    return schedules

def generator(n=100000, seed=288):
    # Generar una lista de datos aleatorios
    randomData = schedulesGenerator(n)

    # Guardar datos en un archivo JSON
    with open('./data/horarios.json', 'w') as json_file:
        json.dump(randomData, json_file, indent=2)

    print("Se generaron {} horarios".format(len(randomData)))
    return randomData

