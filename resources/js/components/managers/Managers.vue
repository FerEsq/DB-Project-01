<template>
    <div class="container mt-3">
        <div class="row-cols-8">
            <h1>Encargados</h1>
            <button class="btn btn-outline-dark float-end" @click="editarManager(0)">Agregar</button>
        </div>
        <input v-model="filter" class="form-control mb-2" placeholder="Filtrar..." />

        <div class="table-responsive" @scroll="handleScroll">
            <table class="table">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Facultad</th>
                    <th>Correo</th>
                    <th>Celular</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in items" :key="item._id">
                    <td>{{ item.nombre }}</td>
                    <td>{{ item.facultad }}</td>
                    <td>{{ item.correo}}</td>
                    <td>{{ item.celular }}</td>
                    <td>
                        <button @click="eliminarManager(item._id)" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        <button @click="editarManager(item._id)" class="btn btn-primary"><i class="fa-solid fa-pencil"></i></button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    props: ['managers'],
    data() {
        let managers = this.managers
        return {
            items: managers,
            filter: '',
            visibleCount: 200, // Cantidad inicial de elementos visibles
            showAll: false, // Indica si se deben mostrar todos los elementos
        };
    },
    methods: {
        handleScroll(e) {
            const { scrollTop, clientHeight, scrollHeight } = e.target;
            if (scrollTop + clientHeight >= scrollHeight) { // Si el usuario llega al final
                this.showAll = true; // Mostrar todos los elementos
            }
        },
        eliminarManager(id) {
            if (confirm('¿Estás seguro de que quieres eliminar este salón?')) {
                axios.post('/horarios/managers/' + id, { _method: 'delete' })
                    .then(response => {
                        location.reload()
                    })
                    .catch(error => {
                        console.error('Error al eliminar el Encargado:', error);
                    });
            }
        },
        editarManager(id) {
            axios.get('/horarios/managers/' + id + '/edit', { _method: 'edit' })
                .then(response => {
                    window.location.href = '/horarios/managers/' + id + '/edit';
                })
                .catch(error => {
                    console.error('Error al editar el encargado:', error);
                });
        },
    },
};
</script>

<style scoped>
.table-responsive {
    max-height: 400px;
    overflow-y: auto;
}
</style>
