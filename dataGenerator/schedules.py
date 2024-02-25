import json
from faker import Faker
import random

fake = Faker()

# Función para generar datos aleatorios
def schedulesGenerator(referencedSalones):
    cursos = [
        "Ciencias de la Vida",
        "Algoritmos y Programación Básica",
        "Pensamiento Cuantitativo",
        "Comunicacion Efectiva",
        "Quimica General",
        "Introduccion a la Ingeniería",
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
        "Programacion Plataformas Móviles",
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

    salon = random.choice(referencedSalones)

    return {
        "salon_id": salon["id"],
        "curso": fake.random_element(cursos),
        "catedratico": [
            {
                "nombre": fake.name(),
                "correo": fake.user_name() + "@uvg.edu.gt"
            }
        ],
        "inicio": fake.random_element(horarios),
        "periodos": random.randint(1, 3),
        "seccion": str(random.randint(1,3)) + "0",
        "cantEst": salon["capacidad"] + random.randint(-10,10)
    }

def generator(n=100000):
    # Cargar datos referenciados desde un archivo JSON
    with open('./data/salones.json') as jsonFilePool:
        referencedSalones = json.load(jsonFilePool)
        
    # Generar una lista de datos aleatorios
    randomData = [schedulesGenerator(referencedSalones) for _ in range(n)]

    # Guardar datos en un archivo JSON
    with open('./data/horarios.json', 'w') as json_file:
        json.dump(randomData, json_file, indent=2)

    print("Se generaron {} horarios".format(len(randomData)))
