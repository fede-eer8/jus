<template>
    <div>
        <h4 v-if="show" class="text-center font-weight-bold">Actores Ideales</h4>
        <table class="table table-striped table-sm">
        <thead>
        <tr v-if="show">
            <th scope="col">Razón Social</th>
            <th scope="col">CUIT</th>
            <th scope="col">Domicilio</th>
            <th scope="col">Opciones</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in pageOfItems" :key="item.id">
            <td>{{item.razon_soc}}</td>
            <td>{{item.cuit}}</td>
            <td>{{item.domicilio}}</td>
            <td>
                <button class="btn btn-info btn-sm" @click="viewIdealActor(item,item.id)"><i style="color:" class="fa fa-eye"></i></button>
                <button class="btn btn-warning btn-sm" @click="editIdealActor(item,item.id)"><i style="color:" class="fa fa-edit"></i></button>
                <button class="btn btn-danger btn-sm" @click="deleteIdealActor(item,item.id)"><i class="fas fa-trash" aria-hidden="true"></i></button>
            </td>
        </tr>
        </tbody>
        </table>
        <jw-pagination :items="idealActors" @changePage="onChangePage"></jw-pagination>
  </div>
</template>
<style scoped>

</style>
<script>
import EventBus from '../../event-bus';
export default {
    data() {
        return {
            idealActors: [],
            pageOfItems: [],
            loading: true,
            show: true,
            pagI: 0
        }
    },
    created() {
        EventBus.$on('idealActor-added', data => {
        this.idealActors.push(data)
        this.review();
      })
      EventBus.$on('idealActor-updated', data => {
        console.log("el id es: ",this.id)
        console.log("el id es: ",data.id)
        this.idealActors.splice(this.id,1,data)
      })
      this.review();
    },
    methods: {
        viewIdealActor(idealActor,index) {
        EventBus.$emit('view-idealActor', idealActor)
        //this.review();
      },
      editIdealActor(idealActor,index) {
        this.id = index
        //$('#editIdealActor').modal()
        EventBus.$emit('edit-idealActor', idealActor)
      },
      deleteIdealActor(idealActor,index) {
        EventBus.$emit('delete-idealActor', idealActor)
        let currentRoute = window.location.pathname
        console.log("El id es: ",idealActor.id)
        console.log(currentRoute)
        axios
        .delete(currentRoute+'/actoridealdelete/'+idealActor.id)
        .then((res) => {
          console.log(res)
          this.idealActors.splice(index,1)    
          this.review();   
        })
        .catch(err => {
          console.log(err)
          console.log("hubo error")
        })
        this.review();
      },
      review() {
        if(this.idealActors.length == 0){
          this.show = false;
        }
        else {
          this.show = true;          
        }
      },
      pageUp() {
        console.log("pagI: "+this.pagI)
        console.log("array: "+this.numedActors.length)
        console.log("length: "+this.idealActors.length)
        if (this.idealActors.length > (this.pagI)*10){
          let j=0;
          for (let index = this.pagI*10; index < (this.pagI*10)+ 10; index++) {
            this.numedActors[j] = this.idealActors[index];  
            j = j + 1;   
            }
            this.pagI = this.pagI + 1;
        }
          console.log("pagI: "+this.pagI)
        console.log("array: "+this.numedActors)
      },
      pageDown() {
        if (this.idealActors.length > (this.pagI+1)*10){
          for (let index = this.pagI; index < this.pagI + 10; index++) {
            this.numedActors[index] = this.idealActors[index];     
            }
            this.pagI = this.pagI--;
        }
      },
      onChangePage(pageOfItems) {
            // update page of items
            this.pageOfItems = pageOfItems;
        }
    },
    mounted() {
        let currentRoute = window.location.pathname
        axios
        .get(currentRoute+'/actorideal')
        .then((res) => {
        //console.log(res)
        this.idealActors = res.data
        this.loading = false
        this.review();
        console.log("hay :"+this.idealActors.length)     
        })
        console.log('Component mounted.')
    }
}
</script>