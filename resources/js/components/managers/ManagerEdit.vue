<template>
    <div class="container mt-3">
        <h1 v-if="manager._id === 0">Nuevo Encargado</h1>
        <h1 v-else>Editar Encargado</h1>
        <form @submit.prevent="guardarManager">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" v-model="formulario.nombre">
            </div>
            <div class="mb-3">
                <label for="facultad" class="form-label">Facultad:</label>
                <input type="text" class="form-control" id="facultad" v-model="formulario.facultad">
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="email" class="form-control" id="correo" v-model="formulario.correo">
            </div>
            <div class="mb-3">
                <label for="celular" class="form-label">Celular:</label>
                <input type="text" class="form-control" id="celular" v-model="formulario.celular">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</template>


<script>
        import axios from 'axios';

        export default {
            props: ['manager'],
            data() {
                return {
                id: this.manager._id,
                formulario: {
                    nombre: this.manager.nombre,
                    facultad: this.manager.facultad,
                    correo: this.manager.correo,
                    celular: this.manager.celular
                }
        };
    },
        methods: {
            guardarManager() {
                let newManager = {
                _id: this.id,
                nombre: this.formulario.nombre,
                facultad: this.formulario.facultad,
                correo: this.formulario.correo,
                celular: this.formulario.celular
            }
            console.log(newManager)
            axios.post('/horarios/managers', newManager)
            .then(response => {
            window.location.href = '/horarios/managers'
        })
        .catch(error => {
            console.error('Error al guardar el encargado:', error);
                });
            }
        }
    };
</script>

