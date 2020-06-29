<template>
  <div>
        <div v-if="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
            Se eliminó el tipo de documento: <strong>{{msj}}</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <button @click="showForm()" type="submit" class="btn btn-primary top-space">Añadir Tipo Documento</button>
        <hr>
        <form v-if="show" @submit.prevent="saveTipoDoc">
            <div class="form-group">
                <label>Nombre</label>
                <input @change="change()" id="nombre" type="text" class="form-control form-control-sm" placeholder="Ingresar nombre del tipo de documento" v-model="nombre">
            </div>
            <div class="form-group">
                <label>Nombre Plural</label>
                <input type="text" class="form-control form-control-sm" placeholder="Ingresar nombre plural del tipo de documento" v-model="slug_fd">
            </div>
            <!-- <div class="form-group">   
                <label>Domicilio Social</label>
                <input type="text" class="form-control form-control-sm" placeholder="Ingresar Domicilio del actor" v-model="domicilio">
            </div> -->
            <button type="submit" class="btn btn-primary">Save changes</button>
            <button class="btn btn-dark" @click="clearValues()"><i class="fa fa-times" aria-hidden="true"></i></button>
            <hr>
        </form>
    </div>
</template>

<script>
import EventBus from '../../../event-bus';
export default {
    data() {
        return {
            show: false,
            edit: false,
            alert: false,
            id: null,
            nombre: null,
            slug_fd: null,
            msj: ''
        }
    },
    created() {

        EventBus.$on('edit-docType', data => {
            this.id = data.id;  
            this.nombre = data.nombre;
            this.slug_fd = data.slug_fd;
            this.show = true;
            this.edit = true;
      })
      EventBus.$on('delete-docType', data => {
            this.msj = data.nombre;
            this.alert = true;
        })
      
    },
    methods: {
        change() {
            this.slug_fd='';
            this.slug_fd.toString();
            this.slug_fd = this.slug_fd.concat(this.nombre,'s');
            //this.nombres=this.nombre;
        },
        showForm() {
            this.show = !this.show;
            this.alert = false;
        },
        saveTipoDoc: function() {
            let currentRoute = window.location.pathname;
            console.log(currentRoute)
            if(this.edit) {
                let currentRoute = window.location.pathname
                console.log(currentRoute)
                axios.patch('api/tipodocumento/'+this.id,{
                    id: this.id,
                    name: this.nombre,
                    slug: this.slug_fd,
                    _method: 'patch'
                })
                .then(function(res) {
                    console.log(res)
                    EventBus.$emit('docType-updated', res.data.docType)
                    console.log(res.data.docType)
                })
                .catch(function(err) {
                        console.log(err.res)
                        console.log('saludare')
                })
            } else {
                axios.post('api/tipodocumento',{
                name: this.nombre,
                slug: this.slug_fd,
                })
                .then(function(res) {
                    console.log(res)
                    EventBus.$emit('docType-added', res.data.docType)
                    console.log(res.data.docType)
                })
                .catch(function(err) {
                        console.log(err.res)
                        console.log('saludare')
                })
            }
             
            this.clearValues();   
        },
        clearValues() {
            this.nombre = "";
            this.slug_fd = "";
            this.show = false;
            this.edit = false;
            this.alert = false;
        },
    }
}
</script>

<style>
.top-space {
  margin-top: 15px;
}
</style>