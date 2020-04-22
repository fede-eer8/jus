<template>
    <div class="row">
        <div class="col-md-8">
            <div v-for="humanActor in humanActors" v-bind:key="humanActor.id" class="card card-body mb-2 mr-2 product-item">
                <h4>{{humanActor.nombre}}</h4>
                <p>{{humanActor.apellido}}</p>
                <div class="row">
                    <div class="col-md-6">Seudonimo {{humanActor.seudonimo}}</div>
                    <div class="col-md-6 text-right">Condición {{humanActor.edad}}</div>    
                </div>
                <p class="text-right mt-2">
                    <button @click="editHumanActor(humanActor)" class="btn btn-warning">Editar</button>
                    <button @click="deleteHumanActor(humanActor)" class="btn btn-danger">Delete</button>
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <form>
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" v-model="humanActor.nombre">
                </div>
                <div class="form-group">
                    <label>Apellido</label>
                    <input type="text" class="form-control" v-model="humanActor.apellido">
                </div>
                <div class="form-group">
                    <label>Seudonimo</label>
                    <input type="text" class="form-control" v-model="humanActor.seudonimo">
                </div>
                <h6 class="modal-title">Edad Legal</h6>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="exampleRadios" @change="onChange()" id="exampleRadios1" v-model="humanActor.edad" v-bind:value="a">
                    <label class="form-check-label" for="exampleRadios1">
                        Menor de edad
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="exampleRadios" @change="onChange()" id="exampleRadios2" v-model="humanActor.edad" v-bind:value="b">
                    <label class="form-check-label" for="exampleRadios2">
                        Mayor de edad
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="exampleRadios" @change="onChange()" id="exampleRadios3" v-model="humanActor.edad" v-bind:value="c">
                    <label class="form-check-label" for="exampleRadios3">
                        Emancipado
                    </label>
                </div>
                <button v-if="add" @click.prevent="addHumanActor()" class="btn btn-primary">Añadir Actor Humano</button>
                <button v-if="edit" @click.prevent="updateHumanActor(humanActor.id)" class="btn btn-warning">Editar Actor Humano</button>
            </form>
        </div>
    </div>
</template>

<style scoped>
    .product-item{
        width: 300px;
        float: left;
    }
</style>

<script>
export default {
    props: [
        'propsSlug',

    ],
    data() {
        return {
            humanActors: [],
            humanActor: {
                id: '',
                nombre: '',
                apellido: '',
                seudonimo: '',
                edad: '',
                replegal_id: ''
            },
            add: true,
            edit: false,
            a: "menor de edad",
            b: "mayor de edad",
            c: "emancipado",
        }
    },
    created() {
        this.viewHumanActor()
        console.log(this.propsSlug)
    },
    methods: {
        //?foo=${encodeURIComponent(data.foo)}&bar=${encodeURICom
        viewHumanActor() {
            let currentRoute = window.location.pathname
            console.log(currentRoute)
            fetch(currentRoute+'/actorhumano')
            .then(res => res.json())
            .then(res => {
                this.humanActors = res.data
            })
            .catch(err => console.log(err))
        },
        addHumanActor() {
            fetch('api/actorhumano', {
                method: 'post',
                body: JSON.stringify(this.humanActor),
                headers: {
                    'content-type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(res => {
                alert('Actor Humano Añadido');
                this.viewHumanActor();
            })
            .catch(err => console.log(err))
        },
        editHumanActor(human) {
            this.add = false;
            this.edit = true;
            this.humanActor.id = human.id
            this.humanActor.nombre = human.nombre,
            this.humanActor.apellido = human.apellido,
            this.humanActor.seudonimo = human.seudonimo,
            this.humanActor.edad = human.edad,
            this.humanActor.replegal_id = human.replegal_id
        },
        updateHumanActor(id) {
            fetch('api/actorhumano', {
                method: 'put',
                body: JSON.stringify(this.humanActor),
                headers: {
                    'content-type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(res => {
                alert('Actor Humano Actualizado');
                this.add = true;
                this.edit = false;
                this.viewHumanActor();
            })
            .catch(err => console.log(err))
        },
        delteHumanActor($id) {
            fetch('api/actorhumano/'+$id, {
                method: 'delete'
            })
            .then(res => res.json())
            .then(data => {
                alert('Actor Humano Borrado');
                this.viewHumanActor();
            })
            .catch(err => console.log(err))
        }
    }
}
</script>