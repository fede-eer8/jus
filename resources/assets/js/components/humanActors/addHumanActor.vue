<template>

    <div class="modal fade" id="addActorHumano" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Actor Humano</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="saveActor">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input id="nombre" type="text" class="form-control form-control-sm" placeholder="Ingresa el nombre del actor" v-model="nombre">
                        </div>
                        <div class="form-group">
                            <label>Apellido</label>
                            <input type="text" class="form-control form-control-sm" placeholder="Ingresa el apellido del actor" v-model="apellido">
                        </div>
                        <div class="form-group">
                            <label>Seudonimo</label>
                            <input type="text" class="form-control form-control-sm" placeholder="Ingresa el seudonimo del actor" v-model="seudonimo">
                        </div>  
                        <h6 class="modal-title">Edad Legal</h6>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="exampleRadios" @change="onChange()" id="exampleRadios1" v-model="edadLegal" v-bind:value="a">
                            <label class="form-check-label" for="exampleRadios1">
                                Menor de edad
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="exampleRadios" @change="onChange()" id="exampleRadios2" v-model="edadLegal" v-bind:value="b">
                            <label class="form-check-label" for="exampleRadios2">
                                Mayor de edad
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="exampleRadios" @change="onChange()" id="exampleRadios3" v-model="edadLegal" v-bind:value="c">
                            <label class="form-check-label" for="exampleRadios3">
                                Emancipado
                            </label>
                        </div>
                        <div id="forma" style="display:none">
                            <hr>
                            <div class="form-group" >
                                <h5 class="modal-title">Representante Legal</h5>
                                <label>Nombre</label>
                                <input type="text" class="form-control form-control-sm" placeholder="Ingresa el nombre del representante legal" v-model="nombreRepLegal">
                            </div>  
                            <div class="form-group">
                                <label>Apellido</label>
                                <input type="text" class="form-control form-control-sm" placeholder="Ingresa el apellido del representante legal" v-model="apellidoRepLegal">
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="calidad" id="repLegal1" v-model="calidadRepLegal" v-bind:value="d">
                                <label class="form-check-label" for="repLegal1">
                                    Padre
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="calidad" id="repLegal2" v-model="calidadRepLegal" v-bind:value="e">
                                <label class="form-check-label" for="repLegal2">
                                    Apoderado
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="calidad" id="repLegal3" v-model="calidadRepLegal" v-bind:value="f">
                                <label class="form-check-label" for="repLegal3">
                                    Tutor
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="calidad" id="repLegal4" v-model="calidadRepLegal" v-bind:value="g">
                                <label class="form-check-label" for="repLegal4">
                                    Otro
                                </label>
                            </div>
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
            nombre: null,
            apellido: null,
            seudonimo : null,
            edadLegal: null,
            a: "menor de edad",
            b: "mayor de edad",
            c: "emancipado",
            nombreRepLegal: null,
            apellidoRepLegal: null,
            calidadRepLegal: null,
            d: "Padre",
            e: "Apoderado",
            f: "Tutor",
            g: "Otro",
            replegal_id: null
        }
    },
    methods: {
        onChange() {
            var x = document.getElementById("forma");
            var optionText = event.target.value;
            this.edadLegal = optionText;
            if (x.style.display === "none" && optionText == "menor de edad") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        },
        saveActor: function() {
            let currentRoute = window.location.pathname
            let idRepLegal;
            console.log(currentRoute)
            console.log("la edad del actor :"+this.edadLegal)
            if (this.edadLegal == "menor de edad") {
                this.saveRepLegal(currentRoute)
                .then(data => {
                    console.log("res es: "+data);
                    this.saveActor2(data, currentRoute)
                })
            }        
            else {
                this.saveActor2(0,currentRoute)
            }
              
        },
        saveActor2(dato,currentRoute) {
            console.log("data: "+dato)
            axios.post(currentRoute+'/actorhumano',{
                nombre: this.nombre,
                apellido: this.apellido,
                seudonimo: this.seudonimo,
                edadLegal: this.edadLegal,  
                replegal_id: dato
            })
            .then(function(res) {
                $('#addActorHumano').modal('hide');
                console.log(res)
                //$('#addActorHumano').modal('hide')   
                EventBus.$emit('humanActor-added', res.data.humanActor)
                console.log(res.data.humanActor)
                // $('#addActorHumano').on('hidden.bs.modal', function () {
                //     $(this).find('form').trigger('reset');
                // })
            })
            .catch(function(err) {
                    console.log(err.res)
                    console.log('saludare')
            }) 
            this.clearValues();
        },
        saveRepLegal(currentRoute) {
            return axios.post(currentRoute+'/representantelegal',{
                    nombreRepLegal: this.nombreRepLegal,
                    apellidoRepLegal: this.apellidoRepLegal,
                    calidadRepLegal: this.calidadRepLegal
                })
                .then(response => {
                    //console.log("el id devuelto es: "+ this.id)
                    this.response = response.data
                    console.log("repLegal: "+this.response.representanteLegal.nombre)
                    return this.response.id       
                    // return res.data.representanteLegal.id;
                })
                .catch(function(err) {
                        console.log(err.res)
                        console.log('saludare1')
                })
        },
        clearValues() {
            this.nombre="";
            this.apellido="";
            this.seudonimo="";
            this.edadLegal="";
            this.nombreRepLegal="";
            this.apellidoRepLegal="";
            var x = document.getElementById("forma");
            if (x.style.display === "none") {
                //x.style.display = "block";
            } else {
                x.style.display = "none";
            }
            //$('#addActorHumano').modal('hide');
            $('#addActorHumano').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();

        }
        
    }
        
}
</script>