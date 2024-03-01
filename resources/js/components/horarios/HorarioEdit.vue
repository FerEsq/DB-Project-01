<template>
    <div class="container mt-3">
        <h1 v-if="horario._id === 0">Nuevo Horario</h1>
        <h1 v-else>Editar Horario</h1>
        <form @submit.prevent="guardarHorario">
            <div class="mb-3">
                <label for="cantEst" class="form-label">Cantidad de estudiantes:</label>
                <input type="number" class="form-control" id="cantEst" v-model.number="formulario.cantEst">
            </div>
            <div class="mb-3">
                <label for="ciclo" class="form-label">Ciclo:</label>
                <input type="text" class="form-control" id="ciclo" v-model.number="formulario.ciclo">
            </div>
            <div class="mb-3">
                <label for="curso" class="form-label">Curso:</label>
                <input type="text" class="form-control" id="curso" v-model="formulario.curso">
            </div>
            <div class="mb-3">
                <label for="encargados" class="form-label">Encargados:</label>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Facultad</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(encargado, index) in formulario.encargados" :key="index">
                        <td><input type="text" v-model="encargado.nombre" class="form-control"></td>
                        <td><input type="email" v-model="encargado.correo" class="form-control"></td>
                        <td><input type="text" v-model="encargado.facultad" class="form-control"></td>
                        <td>
                            <button type="button" class="btn btn-danger" @click="removerEncargado(index)">Remover</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <button type="button" class="btn btn-success" @click="agregarEncargado">Agregar Encargado</button>
            </div>
            <div class="mb-3">
                <label for="inicio" class="form-label">Inicio:</label>
                <input type="text" class="form-control" id="inicio" v-model="formulario.inicio">
            </div>
            <div class="mb-3">
                <label for="periodos" class="form-label">Periodos:</label>
                <input type="number" class="form-control" id="periodos" v-model.number="formulario.periodos">
            </div>
            <div class="mb-3">
                <label for="salon_id" class="form-label">ID del salón:</label>
                <input type="text" class="form-control" id="salon_id" v-model.number="formulario.salon_id">
            </div>
            <div class="mb-3">
                <label for="seccion" class="form-label">Sección:</label>
                <input type="number" class="form-control" id="seccion" v-model.number="formulario.seccion">
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Año:</label>
                <input type="number" class="form-control" id="year" v-model.number="formulario.year">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: ['horario'],
    data() {
        return {
            formulario: {
                _id: this.horario._id,
                cantEst: this.horario.cantEst || 0,
                ciclo: this.horario.ciclo || '',
                curso: this.horario.curso || '',
                encargados: this.horario.encargados || [{ nombre: '', correo: '', facultad: '' }],
                inicio: this.horario.inicio || '',
                periodos: this.horario.periodos || 0,
                salon_id: this.horario.salon_id || '',
                seccion: this.horario.seccion || 0,
                year: this.horario.year || 0
            }
        };
    },
    methods: {
        guardarHorario() {
            axios.post('/horarios/todos', this.formulario)
                .then(response => {
                    // Manejar la respuesta si es necesario
                    console.log('Horario guardado exitosamente:', response.data);
                    // Redirigir a la página de lista de horarios
                    window.location.href = '/horarios/todos';
                })
                .catch(error => {
                    console.error('Error al guardar el horario:', error);
                });
        },
        agregarEncargado() {
            // Método para agregar un nuevo encargado
            this.formulario.encargados.push({ nombre: '', correo: '', facultad: '' });
        },
        removerEncargado(index) {
            // Método para remover un encargado
            this.formulario.encargados.splice(index, 1);
        }
    }
};
</script>
