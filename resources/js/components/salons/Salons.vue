<template>
    <div class="container mt-3">
        <div>
            <h1>Salones</h1>
        </div>
        <input v-model="filter" class="form-control mb-2" placeholder="Filtrar por ID..." />

        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Laboratorio</th>
                    <th>Acciones</th> <!-- Nueva columna para los botones de eliminar y editar -->
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in filteredItems" :key="item._id">
                    <td>{{ item.id }}</td>
                    <td>{{ item.tipo }}</td>
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
        return {
            items: this.salons,
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
        eliminarSalon(id) {
            if (confirm('¿Estás seguro de que quieres eliminar este salón?')) {
                axios.post('/eliminar-salon', {id})
                    .then(response => {
                        // Actualizar la lista de salones después de eliminar uno
                        this.salons = this.salons.filter(salon => salon._id !== id);
                    })
                    .catch(error => {
                        console.error('Error al eliminar el salón:', error);
                    });
            }
        },
        editarSalon(id) {
            // Aquí puedes redirigir a la página de edición o realizar alguna otra acción según tu aplicación
            console.log('Editar salón con ID:', id);
        },
    },
};
</script>
