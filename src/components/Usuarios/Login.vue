<template>
    <section class="hero is-fullheight fondo">
       
        <div class="hero-body">
           
            <div class="container">
        
            <div class="columns is-centered">
                
                <div class="column is-5-tablet is-6-desktop is-4-widescreen" >
                <form action="" class="box custom-margin">
                    <p class="titulo">
                        Sistema Comandas <br> Paquito<br><br>
                    </p> 
                    <img src="@/assets/img/logologin.png" alt="" height="120" width="120" style="display: block; margin:0 auto;">
                    <p class="divsubtitle">Iniciar sesión</p>
                    <b-field class="correo-electronico">Correo electrónico
                        <b-input placeholder="Ingresa tu correo electrónico"
                            type="email"
                            icon="email"
                            v-model="correo">
                        </b-input>
                    </b-field>

                    <b-field class="Contraseña">Contraseña
                        <b-input type="password"
                            placeholder="Ingresa tu contraseña"
                            v-model="password"
                            password-reveal>
                        </b-input>
                    </b-field>

                    <div class="field has-text-centered">
                    <b-button icon-left="login" type="is-primary" size="is-medium" @click="ingresar">Ingresar</b-button>
                    </div>
                </form>
                </div>
            </div>        
            <b-loading :is-full-page="true" v-model="cargando" :can-cancel="false"></b-loading>
            </div>
        </div>
    </section>
</template>
<script>
import HttpService from '../../Servicios/HttpService'
import '../../assets/css/Login.css';

export default {
    name: "Login",

    data: () => ({
        correo: "", 
        password: "",
        cargando:false
    }),

    methods: {
        ingresar(){
            if(!this.correo) {
                this.$buefy.toast.open({
                    message: 'Debes colocar el correo',
                    type: 'is-warning'
                })
                return
            }
            if(!this.password) {
                this.$buefy.toast.open({
                    message: 'Debes colocar la contraseña',
                    type: 'is-warning'
                })
                return
            }
            this.cargando = true
            let payload = {
                correo: this.correo,
                password: this.password
            }

            HttpService.obtenerConDatos(payload, "iniciar_sesion.php")
            .then(log => {
                if(log.resultado === "cambia"){
                   this.$buefy.toast.open({
                        message: 'Datos correctos. Debes cambiar tu contraseña',
                        type: 'is-info'
                    })
                    this.$emit("logeado", log)
                    this.cargando = false
                    return 
                }

                if(log.resultado) {
                    this.$buefy.toast.open({
                        message: 'Datos correctos. Bienvenido',
                        type: 'is-success'
                    })
                    this.$emit("logeado", log)
                    this.cargando = false
                } else {
                    this.$buefy.toast.open({
                        message: 'Datos incorrectos. Verifica tu información',
                        type: 'is-danger'
                    })
                    this.cargando = false
                }
            })
            
        }
    }

}
</script>