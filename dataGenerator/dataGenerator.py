from classrooms import generator as classRoomsGenerator
from schedules import generator as schedulesGenerator
from managers import generator as managersGenerator
from pymongo import MongoClient
import os
from dotenv import load_dotenv

load_dotenv()
# mongoHost = os.environ.get('MONGODB_HOST')
# mongoPort = int(os.environ.get('MONGODB_PORT'))
# mongoDatabase = os.environ.get('MONGODB_DATABASE')
# mongoUsername = os.environ.get('MONGODB_USERNAME')
# mongoPassword = os.environ.get('MONGODB_PASSWORD')

if __name__ == "__main__":

    managersGenerator()
    salonesJson = classRoomsGenerator()
    horariosJson = schedulesGenerator()

    client = MongoClient('localhost', 27017)
    db = client['salonesuvg']

    collectionSalones = db['salones']
    collectionHorarios = db['horarios']

    collectionSalones.delete_many({})
    collectionHorarios.delete_many({})

    collectionSalones.insert_many(salonesJson)
    collectionHorarios.insert_many(horariosJson)

    client.close()


