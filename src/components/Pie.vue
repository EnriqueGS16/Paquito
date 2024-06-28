<template>
    <section style="padding-top: 3em; bottom: 0;">
        <footer class="footer is-primary fondo">
            <div>
                <span class="is-pulled-right has-text-white">
                    <img src="@/assets/logo.png" alt="logo" class="logo-reducido">
                </span>
                <p class="titulo content has-text-centered title is-3 has-text-white">
                    <strong>{{ datosLocal.nombre }}</strong>. Teléfono <strong>{{ datosLocal.telefono }}</strong>
                </p>
            </div>
        </footer>
    </section>
</template>

<script>
import HttpService from '../Servicios/HttpService'
export default {
    name: "Pie",
    data: () => ({
        datosLocal: {}
    }),
    mounted() {
        this.obtenerDatos()
    },
    methods: {
        obtenerDatos() {
            HttpService.obtener("obtener_datos_local.php")
                .then(resultado => {
                    this.datosLocal = resultado
                })
        }
    }
}
</script>

<style scoped>
.logo-reducido {
    width: 250px;
    height: 150px;
    margin-top: -1cm; /* Mueve la imagen 1 cm hacia arriba */
    margin-left: -2cm; /* Mueve la imagen 1 cm a la izquierda */
}
</style>

