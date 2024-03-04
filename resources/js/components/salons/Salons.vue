<template>
    <div class="container mt-3">
        <div class="row-cols-8">
            <h1>Salones</h1>
            <button class="btn btn-outline-dark float-end" @click="editarSalon(0)">Agregar</button>
        </div>
        <input v-model="filter" class="form-control mb-2" placeholder="Filtrar..." />

        <div class="table-responsive" @scroll="handleScroll">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Edificio</th>
                    <th>Nivel</th>
                    <th>Tipo</th>
                    <th>Capacidad</th>
                    <th>Laboratorio</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in filteredItems" :key="item._id">
                    <td>{{ item.id }}</td>
                    <td>{{ item.edificio }}</td>
                    <td>{{ item.nivel }}</td>
                    <td>{{ item.tipo }}</td>
                    <td>{{ item.capacidad }}</td>
                    <td :style="{ color: item.laboratorio ? 'green' : 'red' }">{{ item.laboratorio ? 'Sí' : 'No' }}</td>
                    <td>
                        <button @click="eliminarSalon(item._id)" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        <button @click="editarSalon(item._id)" class="btn btn-primary"><i class="fa-solid fa-pencil"></i></button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: ['salons'],
    data() {
        let salons = this.salons
        return {
            items: salons,
            filter: '',
        };
    },
    computed: {
        filteredItems() {
            return this.salons.filter((item) => {
                return item.id.toLowerCase().includes(this.filter.toLowerCase()) ||
                    item.tipo.toLowerCase().includes(this.filter.toLowerCase()) ||
                    (item.laboratorio.toString().toLowerCase().includes(this.filter.toLowerCase()) && this.filter.toLowerCase() === 'sí' || this.filter.toLowerCase() === 'no');
            });
        },
    },
    methods: {
        handleScroll(e) {
            const { scrollTop, clientHeight, scrollHeight } = e.target;
            if (scrollTop + clientHeight >= scrollHeight) { // Si el usuario llega al final
                this.showAll = true; // Mostrar todos los elementos
            }
        },
        eliminarSalon(id) {
            if (confirm('¿Estás seguro de que quieres eliminar este salón?')) {
                axios.post('/horarios/salones/' + id, { _method: 'delete' })
                    .then(response => {
                        location.reload()
                    })
                    .catch(error => {
                        console.error('Error al eliminar el salón:', error);
                    });
            }
        },
        editarSalon(id) {
            axios.get('/horarios/salones/' + id + '/edit', { _method: 'edit' })
                .then(response => {
                    window.location.href = '/horarios/salones/' + id + '/edit';
                })
                .catch(error => {
                    console.error('Error al eliminar el salón:', error);
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
