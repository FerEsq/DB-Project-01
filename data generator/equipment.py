import json
import random

def equipmentGenerator():
    equipoQuimica = ["quimica", "tubos de ensayo", "pipeta", "bureta", "microscopio", "centrifuga", "termometro"]
    equipoFisica = ["fisica", "amperimetro", "calorimetro", "iman", "CAPSCO", "multimetro", "reglas"]
    equipoCiencias = ["ciencias de la vida", "microscopio", "tubos de ensayo", "bureta", "placas de petri"]
    equipos = [equipoQuimica, equipoFisica, equipoCiencias]
    equipments = []

    for lista in equipos:
        for i in range(1, len(lista)):
            equipo = {
                "id": str(i) + lista[0],
                "name": lista[i],
                "quantity": random.randint(20, 30),
                "tipo": lista[0]
            }
            equipments.append(equipo)

    return equipments

def jsonGenerator(equipment, file):
    with open(file, 'w') as f:
        json.dump(equipment, f, indent=4)

equipment = equipmentGenerator()
jsonGenerator(equipment, './data/equipment.json')
print("Se generaron {} equipos para laboratorio".format(len(equipment)))
