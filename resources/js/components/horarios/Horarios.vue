<template>
    <div class="container mt-3">
        <div class="row-cols-8">
            <h1>Horarios</h1>
            <button class="btn btn-outline-dark float-end" @click="editarHorario(0)">Agregar</button>
        </div>
        <input v-model="filter" class="form-control mb-2" placeholder="Filtrar..." />

      <div class="table-responsive" @scroll="handleScroll">
        <table class="table">
          <thead>
            <tr>
              <th>Curso</th>
              <th>Seccion</th>
              <th>Catedratico Principal</th>
              <th>Correo</th>
              <th>Salon</th>
              <th>Ciclo</th>
              <th>Estudiantes</th>
              <th>Hora Inicio</th>
              <th>Hora Finalización</th>
              <th>Periodos</th>
              <th>Año</th>
                <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in items" :key="item._id">
              <td>{{ item.curso }}</td>
              <td>{{ item.seccion }}</td>
              <td>{{ item.encargados[0].nombre }}</td>
              <td>{{ item.encargados[0].correo }}</td>
              <td>{{ item.salon_id }}</td>
              <td>{{ item.ciclo }}</td>
              <td>{{ item.cantEst }}</td>
              <td>{{ item.inicio }}</td>
              <td>{{ item.inicio }}</td>
              <td>{{ item.periodos }}</td>
              <td>{{ item.year }}</td>
                <td>
                    <button @click="eliminarHorario(item._id)" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                    <button @click="editarHorario(item._id)" class="btn btn-primary"><i class="fa-solid fa-pencil"></i></button>
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
    props: ['horarios'],
    data() {
        let horarios = this.horarios
      return {
        items: horarios,
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
        eliminarHorario(id) {
            if (confirm('¿Estás seguro de que quieres eliminar este salón?')) {
                axios.post('/horarios/todos/' + id, { _method: 'delete' })
                    .then(response => {
                        location.reload()
                    })
                    .catch(error => {
                        console.error('Error al eliminar el horario:', error);
                    });
            }
        },
        editarHorario(id) {
            axios.get('/horarios/todos/' + id + '/edit', { _method: 'edit' })
                .then(response => {
                    window.location.href = '/horarios/todos/' + id + '/edit';
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
