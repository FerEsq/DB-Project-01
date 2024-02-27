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
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in filteredItems" :key="item._id">
              <td>{{ item.id }}</td>
              <td>{{ item.tipo }}</td>
              <td :style="{ color: item.laboratorio ? 'green' : 'red' }">{{ item.laboratorio ? 'Sí' : 'No' }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </template>
  
  <script>
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
  };
  </script>
  
  <style scoped>
  .table-responsive {
    max-height: 400px;
    overflow-y: auto;
  }
  </style>
  
