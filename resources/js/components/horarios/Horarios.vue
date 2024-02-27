<template>
    <div class="container mt-3">
      <div>
        <h1>Horarios</h1>
      </div>

      <div class="table-responsive" @scroll="handleScroll">
        <table class="table">
          <thead>
            <tr>
              <th>Curso</th>
              <th>Seccion</th>
              <th>Catedratico</th>
              <th>Correo</th>
              <th>Salon</th>
              <th>Ciclo</th>
              <th>Estudiantes</th>
              <th>Hora Inicio</th>
              <th>Hora Finalización</th>
              <th>Periodos</th>
              <th>Año</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in items" :key="item._id">
              <td>{{ item.curso }}</td>
              <td>{{ item.seccion }}</td>
              <td>{{ item.catedratico[0].nombre }}</td>
              <td>{{ item.catedratico[0].correo }}</td>
              <td>{{ item.salon_id }}</td>
              <td>{{ item.ciclo }}</td>
              <td>{{ item.cantEst }}</td>
              <td>{{ item.inicio }}</td>
              <td>{{ item.inicio }}</td>
              <td>{{ item.periodos }}</td>
              <td>{{ item.year }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: ['horarios'],
    data() {
      return {
        items: this.horarios,
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
    },
  };
  </script>
  
  <style scoped>
  .table-responsive {
    max-height: 400px;
    overflow-y: auto;
  }
  </style>
  