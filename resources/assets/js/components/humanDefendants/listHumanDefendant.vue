<template>
    <div>
        <h4 v-if="show" class="text-center font-weight-bold">Demandados Humanos</h4>
        <table class="table table-striped table-sm">
        <thead>
        <tr v-if="show">
            <th scope="col">Apellido</th>
            <th scope="col">Nombre</th>
            <th scope="col">CUIT</th>
            <th scope="col">Opciones</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(humanDefendant,index) in humanDefendants">
            <td>{{humanDefendant.apellido}}</td>
            <td>{{humanDefendant.nombre}}</td>
            <td>{{humanDefendant.cuit}}</td>
            <td>
                <button class="btn btn-info btn-sm" @click="viewHumanDefendant(humanDefendant,index)"><i style="color:" class="fa fa-eye"></i></button>
                <button class="btn btn-warning btn-sm" @click="editHumanDefendant(humanDefendant,index)"><i style="color:" class="fa fa-edit"></i></button>
                <button class="btn btn-danger btn-sm" @click="deleteHumanDefendant(humanDefendant,index)"><i class="fas fa-trash" aria-hidden="true"></i></button>
            </td>
        </tr>
        </tbody>
        </table>
  </div>
</template>
<style scoped>

</style>
<script>
import EventBus from '../../event-bus';
export default {
    data() {
        return {
            humanDefendants: [],
            pageOfItems: [],
            loading: true,
            show: true,
            pagI: 0
        }
    },
    created() {
        EventBus.$on('humanDefendant-added', data => {
        this.humanDefendants.push(data)
        this.review();
      })
      EventBus.$on('humanDefendant-updated', data => {
        console.log("el id es: ",this.id)
        console.log("el id es: ",data.id)
        this.humanDefendants.splice(this.id,1,data)
      })
      this.review();
    },
    methods: {
        viewHumanDefendant(humanDefendant,index) {
        EventBus.$emit('view-humanDefendant', humanDefendant)
        //this.review();
      },
      editHumanDefendant(humanDefendant,index) {
        this.id = index
        //$('#editIdealActor').modal()
        EventBus.$emit('edit-humanDefendant', humanDefendant)
      },
      deleteHumanDefendant(humanDefendant,index) {
        EventBus.$emit('delete-humanDefendant', humanDefendant)
        let currentRoute = window.location.pathname
        console.log("El id es: ",humanDefendant.id)
        console.log(currentRoute)
        axios
        .delete(currentRoute+'/demandadohumanodelete/'+humanDefendant.id)
        .then((res) => {
          console.log(res)
          this.humanDefendants.splice(index,1)    
          this.review();   
        })
        .catch(err => {
          console.log(err)
          console.log("hubo error")
        })
        this.review();
      },
      review() {
        if(this.humanDefendants.length == 0){
          this.show = false;
        }
        else {
          this.show = true;          
        }
      },
      pageUp() {
        console.log("pagI: "+this.pagI)
        console.log("array: "+this.numedActors.length)
        console.log("length: "+this.humanDefendants.length)
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
        .get(currentRoute+'/demandadohumano')
        .then((res) => {
        //console.log(res)
        this.humanDefendants = res.data
        this.loading = false
        this.review();
        console.log("hay :"+this.humanDefendants.length)     
        })
        console.log('Component mounted.')
    }
}
</script>