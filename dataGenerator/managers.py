from faker import Faker
from pymongo import MongoClient
from gridfs import GridFS
import os
import random
from bson import ObjectId

#Configuración de Faker
fake = Faker("es_ES")
fake.seed_instance(288)

#Configuración de MongoDB
client = MongoClient('localhost', 27017)
db = client['salonesuvg']
collection = db['encargados']
fs = GridFS(db)

#Seed
random.seed(288)

photosFolder = 'dataGenerator\photos'

#Función para obtener una imagen aleatoria de la carpeta
def getPhoto():
    image_files = [f for f in os.listdir(photosFolder) if os.path.isfile(os.path.join(photosFolder, f))]
    random_image = random.choice(image_files)
    image_path = os.path.join(photosFolder, random_image)
    with open(image_path, 'rb') as image_file:
        return image_file.read()

# Función para eliminar datos existentes en la colección
def dropCollection():
    #Eliminar documentos de la colección
    collection.delete_many({})

#Función para insertar datos en la colección
def insertManager():
    facultades = [
        "Educacion", 
        "Ingenieria", 
        "Ciencias y Humanidades", 
        "Ciencias Sociales", 
        "Design Innovations & Arts",
        "Business and Managment",
        "Arquitectura"
    ]

    encargado = {
        "nombre": fake.name(),
        "facultad": fake.random_element(facultades),
        "correo": fake.user_name() + "@uvg.edu.gt",
        "celular": fake.phone_number(),
        "foto": None  # Se actualizará después con GridFS
    }
    
    #Insertar documento en la colección
    encargadoID = collection.insert_one(encargado).inserted_id
    
    #Actualizar el campo 'foto' utilizando GridFS
    photoData = getPhoto()
    photoID = fs.put(photoData, filename=f"{encargadoID}.jpg")
    
    collection.update_one({"_id": encargadoID}, {"$set": {"foto": photoID}})
    

def generator(n=50000, seed=288):
    random.seed(seed)

    #Eliminar datos existentes en la colección y colecciones relacionadas
    dropCollection()
    #Insertar datos en la colección
    for _ in range(n):
        insertManager()

    print("Datos insertados exitosamente.")