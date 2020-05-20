<template>
    <div>
        <div v-if="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
            Se eliminó al demandado con Razón Social: <strong>{{msj}}</strong>
            <button type="button" @click="clearValues()" class="close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <button @click="showForm()" type="submit" class="btn btn-primary top-space">Añadir Demandado Ideal</button>
        <hr>
        <form v-if="show" @submit.prevent="saveDefendant">
            <div class="form-group">
                <label>Razón Social</label>
                <input id="razonSocial" type="text" class="form-control form-control-sm" placeholder="Ingresar razón social del actor" v-model="razon_soc">
            </div>
            <div class="form-group">
                <label>CUIT</label>
                <input type="text" class="form-control form-control-sm" placeholder="Ingresar CUIT del actor" v-model="cuit">
            </div>
            <div class="form-group">
                <label>Domicilio Social</label>
                <input type="text" class="form-control form-control-sm" placeholder="Ingresar Domicilio del actor" v-model="domicilio">
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
            razon_soc: null,
            cuit: null,
            domicilio: null,
            msj: ''
        }
    },
    created() {

        EventBus.$on('edit-idealDefendant', data => {
            this.id = data.id;  
            this.razon_soc = data.razon_soc;
            this.cuit = data.cuit;
            this.domicilio = data.domicilio;
            this.show = true;
            this.edit = true;
      })
      EventBus.$on('delete-idealDefendant', data => {
            this.msj = data.razon_soc;
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
                axios.post(currentRoute+'/demandadoidealupdate',{
                    id: this.id,
                    razon_soc: this.razon_soc,
                    cuit: this.cuit,
                    domicilio: this.domicilio
                })
                .then(function(res) {
                    console.log(res)
                    EventBus.$emit('idealDefendant-updated', res.data.idealDefendant)
                    console.log(res.data.idealDefendant)
                })
                .catch(function(err) {
                        console.log(err.res)
                        console.log('saludare')
                })
            } else {
                axios.post(currentRoute+'/demandadoideal',{
                    razon_soc: this.razon_soc,
                    cuit: this.cuit,
                    domicilio: this.domicilio
                })
                .then(function(res) {
                    console.log(res)
                    EventBus.$emit('idealDefendant-added', res.data.idealDefendant)
                    console.log(res.data.idealDefendant)
                })
                .catch(function(err) {
                        console.log(err.res)
                        console.log('saludare')
                })
            }
             
            this.clearValues();   
        },
        clearValues() {
            this.razon_soc = "";
            this.cuit = "";
            this.domicilio = "";
            this.show = false;
            this.edit = false;
            this.alert = false;
        },
    }
}
</script>