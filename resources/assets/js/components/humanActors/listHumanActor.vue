<template>
  <div>
    <h4 class="text-center font-weight-bold">Actores Humanos</h4>
    <table class="table table-striped table-sm">
      <thead>
      <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Seudonimo</th>
        <th scope="col">Condición</th>
        <th scope="col">Opciones</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(humanActor,index) in humanActors">
        <td>{{humanActor.nombre}}</td>
        <td>{{humanActor.apellido}}</td>
        <td>{{humanActor.seudonimo}}</td>
        <td>{{humanActor.edad}}</td>
        <td>
            <button class="btn btn-info btn-sm" @click="viewHumanActor(humanActor,index)"><i style="color:" class="fa fa-eye"></i></button>
            <button class="btn btn-warning btn-sm" @click="editHumanActor(humanActor,index)"><i style="color:" class="fa fa-edit"></i></button>
            <button class="btn btn-danger btn-sm" @click="deleteHumanActor(humanActor,index)"><i class="fa fa-trash" aria-hidden="true"></i></button>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
  import EventBus from '../../event-bus';
  export default {
    data() {
      return {
        humanActors: [],
        loading: true,
        id: null
      }
    },
    created() {
      EventBus.$on('humanActor-added', data => {
        this.humanActors.push(data)
      })
      EventBus.$on('humanActor-updated', data => {
        console.log("el id es: ",this.id)
        console.log("el id es: ",data.id)
        this.humanActors.splice(this.id,1,data)
        //this.humanActors.splice(this.id,1,data)
        //this.humanActors.push(data)
        //this.humanActors.sort()
      })
    },
    methods: {
      viewHumanActor(humanActor,index) {
        EventBus.$emit('view-humanActor', humanActor)
      },
      editHumanActor(humanActor,index) {
        this.id = index
        $('#editHumanActor').modal()
        EventBus.$emit('edit-humanActor', humanActor)
      },
      deleteHumanActor(humanActor,index) {
        let currentRoute = window.location.pathname
        console.log("El id es: ",humanActor.id)
        console.log(currentRoute)
        axios
        .delete(currentRoute+'/actorhumanodelete/'+humanActor.id)
        .then((res) => {
          console.log(res)
          this.humanActors.splice(index,1)       
        })
        .catch(err => {
          console.log(err)
          console.log("hubo error")
        })
      }
      },
    
      mounted() {
      let currentRoute = window.location.pathname
      axios
      .get(currentRoute+'/actorhumano')
      .then((res) => {
        console.log(res)
        this.humanActors = res.data
        this.loading = false
      })
      console.log('Component mounted.')
      }
  }
</script> 