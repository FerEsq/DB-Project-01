<template>
    <div
        class="row h-100 py-4 justify-content-center align-items-center bg-light text-dark"
    >
    <h1>Hola Horarios</h1>
        </div>
</template>

<script>
export default {
    props: ['horarios'],
    data() {
        console.log(this.horarios)
        return {
            horarios: this.horarios
        }
    }
};
</script>
