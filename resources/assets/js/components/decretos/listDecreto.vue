<template>
  <div>
        <h4 v-if="show" class="text-center font-weight-bold">Decretos</h4>
        <table class="table table-striped table-sm">
        <thead>
        <tr v-if="show">
            <th scope="col">Nombre</th>
            <th scope="col">Opciones</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(decreto,index) in decretos">
            <td>{{decreto.nombre}}</td>
            <td>
                <button class="btn btn-info btn-sm" @click="viewDecreto(decreto,index)"><i style="color:" class="fa fa-eye"></i></button>
                <button class="btn btn-warning btn-sm" @click="editDecreto(decreto,index)"><i style="color:" class="fa fa-edit"></i></button>
                <button class="btn btn-danger btn-sm" @click="deleteDecreto(decreto,index)"><i class="fas fa-trash" aria-hidden="true"></i></button>
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
            decretos: [],
            pageOfItems: [],
            loading: true,
            show: true,
            pagI: 0
        }
    },
    created() {
      EventBus.$on('decreto-added', data => {
      this.decretos.push(data)
      this.review();
      })
      EventBus.$on('decreto-updated', data => {
        console.log("el id es: ",this.id)
        console.log("el id es: ",data.id)
        this.decretos.splice(this.id,1,data)
      })
      this.review();
    },
    methods: {
      viewDecreto(decreto,index) {
        EventBus.$emit('view-decreto', decreto)
        //this.review();
      },
      editDecreto(decreto,index) {
        this.id = index
        //$('#editIdealActor').modal()
        EventBus.$emit('edit-decreto', decreto)
      },
      deleteDecreto(decreto,index) {
        EventBus.$emit('delete-decreto', decreto)
        let currentRoute = window.location.pathname
        console.log("El id es: ",decreto.id)
        console.log(currentRoute)
        axios
        .delete(currentRoute+'/decretodelete/'+decreto.id)
        .then((res) => {
          console.log(res)
          this.decretos.splice(index,1)    
          this.review();   
        })
        .catch(err => {
          console.log(err)
          console.log("hubo error")
        })
        this.review();
      },
      review() {
        if(this.decretos.length == 0){
          this.show = false;
        }
        else {
          this.show = true;          
        }
      },
    },
    mounted() {
      let currentRoute = window.location.pathname
      axios
      .get(currentRoute+'/decreto')
      .then((res) => {
      //console.log(res)
      this.decretos = res.data
      this.loading = false
      this.review();
      console.log("hay :"+this.decretos.length)     
      })
      console.log('Component mounted.')
    }
}    
</script>

<style>

</style>