<template>
    
    <div v-if="human" id="viewHumanActor">
        <h4 class="text-center font-weight-bold">Actor</h4>
        <table class="table table-striped table-sm">
            <tbody>
                <tr>
                    <td scope="col"><strong>Nombre</strong></td>
                    <td>{{nombre}}</td>
                </tr>
                <tr>
                    <td scope="col"><strong>Apellido</strong></td>
                    <td>{{apellido}}</td>
                </tr>
                <tr>
                    <td scope="col"><strong>Seudonimo</strong></td>
                    <td>{{seudonimo}}</td>
                </tr>
                <tr>
                    <td scope="col"><strong>Condición</strong></td>
                    <td>{{edad}}</td>
                </tr>
            </tbody>
        </table>
        <div v-if="rep" id="tablaRepLegal">
            <h5 class="text-center font-weight-bold">Representante Legal</h5>
            <table class="table table-striped table-sm">
            <!-- <thead>
                <tr>
                    <th scope="col">First</th>
                    <th>Last</th>
                </tr>
            </thead> -->
            <tbody>
                <tr>
                    <td scope="col"><strong>Nombre</strong></td>
                    <td>{{nombreRepLegal}}</td>
                </tr>
                <tr>
                    <td scope="col"><strong>Apellido</strong></td>
                    <td>{{apellidoRepLegal}}</td>
                </tr>
                <tr>
                    <td scope="col"><strong>Calidad</strong></td>
                    <td>{{condicionRepLegal}}</td>
                </tr>
            </tbody>
            </table>
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
            seudonimo: null,
            edad: null,
            nombreRepLegal: null,
            apellidoRepLegal: null,
            condicionRepLegal: null,
            loading: true,
            id: null,
            repLegal: null,
            human: false,
            rep: false
        }
    },
    created() {
        EventBus.$on('delete-humanActor', data => {
            this.human = false;
            this.rep = false;
        })
        EventBus.$on('view-humanActor', data => {
            this.human = true;
            if(data.replegal_id != 0) {
                let currentRoute = window.location.pathname
                axios
                .get(currentRoute+'/representantelegal/'+data.replegal_id)
                .then((res) => {
                    console.log("hola:"+res.data.representanteLegal.nombre)
                    this.nombreRepLegal = res.data.representanteLegal.nombre;
                    this.apellidoRepLegal = res.data.representanteLegal.apellido;
                    this.condicionRepLegal = res.data.representanteLegal.calidad;
                    this.loading = false;
                })
                this.rep = true;
            //     var y = document.getElementById("tablaRepLegal");
            //     if (y.style.display === "none") {
            //         y.style.display = "block";
            //     } else {
            //     //x.style.display = "none";
            //     }
            // }else {
            //     var y = document.getElementById("tablaRepLegal");
            //     if (y.style.display === "none") {
            //         //x.style.display = "block";
            //     } else {
            //         y.style.display = "none";
            //     }
            }
            else {
                this.rep = false;
            }
            
            console.log('Component mounted.')
            this.nombre = data.nombre;
            this.apellido = data.apellido;
            this.seudonimo = data.seudonimo;
            this.edad = data.edad;
                
            // var x = document.getElementById("viewHumanActor");
            //var optionText = event.target.value;
            // if (x.style.display === "none") {
            //     x.style.display = "block";
            // } else {
            //     //x.style.display = "none";
            // }
      })
      
      
    },
    methods: {

    }
    
}      
</script>