<template>
    <section>
        <br>
        <p class="title is-1 has-text-weight-bold">
            <b-icon
                icon="account-group"
                size="is-large"
                type="is-primary"
                tag="router-link"
                to="/registrar-rol">
            </b-icon>
            Roles

            <b-button 
            type="is-success" 
            size="is-large"
            icon-left="account-multiple-plus"
            class="is-pulled-right"
            tag="router-link"
            to="/registrar-rol">
            Añadir rol
            </b-button>
        </p>
        <b-breadcrumb align="is-left" >
            <b-breadcrumb-item tag='router-link' to="/">Inicio</b-breadcrumb-item>
            <b-breadcrumb-item tag='router-link' to="/usuarios">Usuarios</b-breadcrumb-item>
        </b-breadcrumb>
        <datos-usuario @registrado="onRegistrado" :usuario="usuario"></datos-usuario> 
        <b-loading :is-full-page="true" v-model="cargando" :can-cancel="false"></b-loading>

        <b-select v-model="perPage" >
            <option value="5">5 por página</option>
            <option value="10">10 por página</option>
            <option value="15">15 por página</option>
            <option value="20">20 por página</option>
        </b-select>

        <b-table
            :data="roles"
            :paginated="isPaginated"
            :per-page="perPage"
            :bordered="true"
            :current-page.sync="currentPage"
            :pagination-simple="isPaginationSimple"
            :pagination-position="paginationPosition"
            :default-sort-direction="defaultSortDirection"
            :pagination-rounded="isPaginationRounded"
            :sort-icon="sortIcon"
            :sort-icon-size="sortIconSize"
            aria-next-label="Next page"
            aria-previous-label="Previous page"
            aria-page-label="Page"
            aria-current-label="Current page">

            <b-table-column field="id" label="ID" sortable v-slot="props">
                {{ props.row.id }}
            </b-table-column>

            <b-table-column field="nombre" label="Nombre" sortable v-slot="props">
                {{ props.row.nombre }}
            </b-table-column>

            <b-table-column field="descripcion" label="Descripción" sortable v-slot="props">
                {{ props.row.descripcion }}
            </b-table-column>

            <b-table-column field="acciones" label="Acciones"  v-slot="props">
                <div class="field is-grouped">
                    <p class="control">
                        <b-button 
                        type="is-danger"
                        icon-left="delete"
                        @click="eliminar(props.row)">
                            Eliminar
                        </b-button>
                    </p>
                    <p class="control">
                        <b-button 
                        type="is-info"
                        icon-left="pen"
                        @click="editar(props.row.id)">
                            Editar
                        </b-button>
                    </p>
                </div>    
            </b-table-column>
        </b-table>
        <!--<b-loading :is-full-page="true" v-model="cargando" :can-cancel="false"></b-loading>-->

    </section>
</template>

<script>
import DatosUsuario from './DatosUsuario.vue'
import HttpService from '../../Servicios/HttpService'

export default {
    name: "RolesUsuario",

    data: ()=> ({
        roles: [],
        cargando: false,
        isPaginated: true,
        isPaginationSimple: false,
        isPaginationRounded: true,
        paginationPosition: 'bottom',
        defaultSortDirection: 'asc',
        sortIcon: 'arrow-up',
        sortIconSize: 'is-small',
        currentPage: 1,
        perPage: 10,
    }),

    mounted(){
        this.obtenerRoles()
    },

    methods: {
        eliminar(rol){
            this.$buefy.dialog.confirm({
                title: 'Eliminar el rol ' + rol.nombre,
                message: '¿Seguro que deseas eliminar el rol? Esta acción no se puede deshacer',
                confirmText: 'Sí, eliminar',
                cancelText: 'No, salir',
                type: 'is-danger',
                hasIcon: true,
                onConfirm: () => {
                    HttpService.eliminar("eliminar_rol.php", rol.id)
                    .then(eliminado => {
                        if(eliminado) {
                            this.obtenerRoles()
                            this.$buefy.toast.open('Rol eliminado')
                        }
                    })
                        
                }
            })
        },

        editar(idRol) {
            this.$router.push({
                name: "EditarRol",
                params: { id: idRol },
            })
        },

        obtenerRoles(){
            this.cargando = true
            HttpService.obtener("obtener_roles.php")
            .then(resultado=> {
                this.roles = resultado
                this.cargando = false
            })
        }   
    }
}
</script>
