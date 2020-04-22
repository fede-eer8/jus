<template>
    <div class="modal fade" id="editHumanActor" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Actor Humano</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="saveActor">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" placeholder="Ingresa el nombre del actor" v-model="nombre">
                        </div>
                        <div class="form-group">
                            <label>Apellido</label>
                            <input type="text" class="form-control" placeholder="Ingresa el apellido del actor" v-model="apellido">
                        </div>
                        <div class="form-group">
                            <label>Seudonimo</label>
                            <input type="text" class="form-control" placeholder="Ingresa el seudonimo del actor" v-model="seudonimo">
                        </div>  
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import EventBus from '../../event-bus';
export default {
    data() {
        return {
            id: null,
            nombre: null,
            apellido: null,
            seudonimo : null
        }
    },
    created() {
      EventBus.$on('edit-humanActor', data => {
        this.id = data.id;  
        this.nombre = data.nombre;
        this.apellido = data.apellido;
        this.seudonimo = data.seudonimo;
      })
    },
    methods: {
        saveActor: function() {
            let currentRoute = window.location.pathname
            console.log(currentRoute)
            axios.post(currentRoute+'/actorhumanoupdate',{
                id: this.id,
                nombre: this.nombre,
                apellido: this.apellido,
                seudonimo: this.seudonimo
            })
            .then(function(res) {
                console.log(res)
                $('#editHumanActor').modal('hide')
                EventBus.$emit('humanActor-updated', res.data.humanActor)
                console.log(res.data.humanActor)
            })
            .catch(function(err) {
                    console.log(err.res)
                    console.log('saludare')
            })    
        }
    },
    mounted() {
    
    }
       
}
</script>
