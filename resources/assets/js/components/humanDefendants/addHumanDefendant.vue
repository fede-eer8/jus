<template>
    <div>
        <div v-if="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
            Se eliminó al demandado con apellido: <strong>{{msj}}</strong>
            <button type="button" @click="clearValues()" class="close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <button @click="showForm()" type="submit" class="btn btn-primary top-space">Añadir Demandado Humano</button>
        <hr>
        <form v-if="show" @submit.prevent="saveDefendant">
            <div class="form-group">
                <label>Apellidos</label>
                <input id="razonSocial" type="text" class="form-control form-control-sm" placeholder="Ingresar apellidos del demandado" v-model="apellido">
            </div>
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control form-control-sm" placeholder="Ingresar nombre del demandado" v-model="nombre">
            </div>
            <div class="form-group">
                <label>CUIT</label>
                <input type="text" class="form-control form-control-sm" placeholder="Ingresar CUIT del demandado" v-model="cuit">
            </div>
            <button type="submit" class="btn btn-primary">Save changes</button>
            <button class="btn btn-dark" @click="clearValues()"><i class="fa fa-times" aria-hidden="true"></i></button>
            <hr>
        </form>
    </div>
    
</template>
<style scoped>
    .top-space{
        margin-top: 20px
    } 
</style>
<script>
import EventBus from '../../event-bus';
export default {
    data() {
        return {
            show: false,
            edit: false,
            alert: false,
            apellido: null,
            nombre: null,
            cuit: null,
            msj: ''
        }
    },
    created() {

        EventBus.$on('edit-humanDefendant', data => {
            this.id = data.id;  
            this.apellido = data.apellido;
            this.nombre = data.nombre;
            this.cuit = data.cuit;
            this.show = true;
            this.edit = true;
      })
      EventBus.$on('delete-humanDefendant', data => {
            this.msj = data.apellido;
            this.alert = true;
        })
      
    },
    methods: {
        showForm() {
            this.show = !this.show;
            this.alert = false;
        },
        saveDefendant: function() {
            let currentRoute = window.location.pathname;
            console.log(currentRoute)
            if(this.edit) {
                let currentRoute = window.location.pathname
                console.log(currentRoute)
                axios.post(currentRoute+'/demandadohumanoupdate',{
                    id: this.id,
                    apellido: this.apellido,
                    nombre: this.nombre,
                    cuit: this.cuit
                })
                .then(function(res) {
                    console.log(res)
                    EventBus.$emit('humanDefendant-updated', res.data.humanDefendant)
                    console.log(res.data.humanDefendant)
                })
                .catch(function(err) {
                        console.log(err.res)
                        console.log('saludare')
                })
            } else {
                axios.post(currentRoute+'/demandadohumano',{
                    apellido: this.apellido,
                    nombre: this.nombre,
                    cuit: this.cuit
                })
                .then(function(res) {
                    console.log(res)
                    EventBus.$emit('humanDefendant-added', res.data.humanDefendant)
                    console.log(res.data.humanDefendant)
                })
                .catch(function(err) {
                        console.log(err.res)
                        console.log('saludare')
                })
            }
             
            this.clearValues();   
        },
        clearValues() {
            this.apellido = "";
            this.nombre = "";
            this.cuit = "";
            this.show = false;
            this.edit = false;
            this.alert = false;
        },
    }
}
</script>