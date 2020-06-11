<template>
    <div>
        <div v-if="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
            Se eliminó al actor con razón social: <strong>{{msj}}</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <button @click="showForm()" type="submit" class="btn btn-primary top-space">Añadir Actor Ideal</button>
        <hr>
        <form v-if="show" @submit.prevent="saveActor">
            <div class="form-group">
                <label>Razón Social</label>
                <input id="razonSocial" type="text" class="form-control form-control-sm" placeholder="Ingresar razón social del actor" v-model="razonSocial">
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
        margin-top: 15px
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
            razonSocial: null,
            cuit: null,
            domicilio: null,
            msj: ''
        }
    },
    created() {

        EventBus.$on('edit-idealActor', data => {
            this.id = data.id;  
            this.razonSocial = data.razon_soc;
            this.cuit = data.cuit;
            this.domicilio = data.domicilio;
            this.show = true;
            this.edit = true;
      })
      EventBus.$on('delete-idealActor', data => {
            this.msj = data.razon_soc;
            this.alert = true;
        })
      
    },
    methods: {
        showForm() {
            this.show = !this.show;
            this.alert = false;
        },
        saveActor: function() {
            let currentRoute = window.location.pathname;
            console.log(currentRoute)
            if(this.edit) {
                let currentRoute = window.location.pathname
                console.log(currentRoute)
                axios.post(currentRoute+'/actoridealupdate',{
                    id: this.id,
                    razonSocial: this.razonSocial,
                    cuit: this.cuit,
                    domicilio: this.domicilio
                })
                .then(function(res) {
                    console.log(res)
                    EventBus.$emit('idealActor-updated', res.data.idealActor)
                    console.log(res.data.idealActor)
                })
                .catch(function(err) {
                        console.log(err.res)
                        console.log('saludare')
                })
            } else {
                axios.post(currentRoute+'/actorideal',{
                razonSocial: this.razonSocial,
                cuit: this.cuit,
                domicilio: this.domicilio,
                })
                .then(function(res) {
                    console.log(res)
                    EventBus.$emit('idealActor-added', res.data.idealActor)
                    console.log(res.data.idealActor)
                })
                .catch(function(err) {
                        console.log(err.res)
                        console.log('saludare')
                })
            }
             
            this.clearValues();   
        },
        clearValues() {
            this.razonSocial = "";
            this.cuit = "";
            this.domicilio = "";
            this.show = false;
            this.edit = false;
            this.alert = false;
        },
    }
}
</script>