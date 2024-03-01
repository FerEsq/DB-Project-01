<template>
    <div class="container mt-3">
        <h1 v-if="salon._id === 0">Nuevo Salon</h1>
        <h1 v-else>Editar Salon</h1>
        <form @submit.prevent="crearSalon">
            <div class="mb-3">
                <label for="edificio" class="form-label">Edificio:</label>
                <input type="text" class="form-control" id="edificio" v-model="formulario.edificio">
            </div>
            <div class="mb-3">
                <label for="nivel" class="form-label">Nivel:</label>
                <input type="number" class="form-control" id="nivel" v-model.number="formulario.nivel">
            </div>
            <div class="mb-3">
                <label for="identificador" class="form-label">Identificador:</label>
                <input type="number" class="form-control" id="identificador" v-model.number="formulario.identificador">
            </div>
            <div class="mb-3">
                <label for="capacidad" class="form-label">Capacidad:</label>
                <input type="number" class="form-control" id="capacidad" v-model.number="formulario.capacidad">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="laboratorio" v-model="formulario.laboratorio">
                <label class="form-check-label" for="laboratorio">Laboratorio</label>
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo:</label>
                <input type="text" class="form-control" id="tipo" v-model="formulario.tipo">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: ['salon'],
    data() {
        return {
            id : this.salon._id,
            formulario: {
                edificio: this.salon.edificio,
                nivel: this.salon.nivel,
                identificador: this.salon.identificador,
                capacidad: this.salon.capacidad,
                laboratorio: this.salon.laboratorio,
                tipo: this.salon.tipo
            }
        };
    },
    methods: {
        crearSalon() {
            let newSalon = {
                _id: this.salon._id,
                capacidad: this.formulario.capacidad,
                edificio: this.formulario.edificio,
                id: this.formulario.edificio + this.formulario.identificador.toString(),
                identificador: this.formulario.identificador.toString(),
                laboratorio: this.formulario.laboratorio,
                nivel: this.formulario.nivel,
                tipo: this.formulario.tipo
            }
            console.log(newSalon)
            axios.post('/horarios/salones', newSalon)
                .then(response => {
                    window.location.href = '/horarios/salones'
                })
                .catch(error => {
                    console.error('Error al crear el salón:', error);
                });
        }
    }
};
</script>
