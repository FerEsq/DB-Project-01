<template>
    <h1>Estadisticas Importantes</h1>
    <div class="container mt-3">
        <!-- Tabla para avgestcurso -->
        <h2>Promedio de Estudiantes por Curso</h2>
        <table class="table">
            <thead>
            <tr>
                <th>ID Curso</th>
                <th>Curso</th>
                <th>Promedio de Estudiantes</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in avgestcurso" :key="item._id">
                <td>{{ item._id }}</td>
                <td>{{ item.curso }}</td>
                <td>{{ item.avgStudents }}</td>
            </tr>
            </tbody>
        </table>

        <!-- Tabla para salonesmascap -->
        <h2>Salones con Mayor Capacidad</h2>
        <table class="table">
            <thead>
            <tr>
                <th>ID Salón</th>
                <th>Capacidad Total</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="salon in salonmascap" :key="salon._id">
                <td>{{ salon.id }}</td>
                <td>{{ salon.capacidad}}</td>
            </tr>
            </tbody>
        </table>

        <!-- Tabla para cursoencargado -->
        <h2>Cursos por Encargado</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Encargado</th>
                <th>Número de Cursos</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="curso in cursoencargado" :key="curso._id">
                <td>{{ curso._id }}</td>
                <td>{{ curso.conteo }}</td>
            </tr>
            </tbody>
        </table>

        <!-- Tabla para labdemanda -->
        <h2>Laboratorios con Alta Demanda</h2>
        <table class="table">
            <thead>
            <tr>
                <th>ID Salón</th>
                <th>Capacidad</th>
                <th>Máximo Uso</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="lab in labdemanda" :key="lab.salon_id">
                <td>{{ lab.salon_id }}</td>
                <td>{{ lab.capacidad }}</td>
                <td>{{ lab.maxUso }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: ['avgestcurso','salonmascap','captotaledi','cursoencargado','labdemanda'],
    data() {
        return {
            // Aquí se asume que estos arrays son proporcionados como ejemplo
            // Deberías reemplazar estos con tus datos reales, posiblemente como props o haciendo una solicitud API
            avgestcurso: this.avgestcurso,
            salonmascap: this.salonmascap,
            cursoencargado: this.cursoencargado,
            labdemanda: this.labdemanda
        };
    }
}
</script>

<style>
/* Estilos básicos */
.table {
    width: 100%;
    margin-bottom: 20px;
}
</style>

