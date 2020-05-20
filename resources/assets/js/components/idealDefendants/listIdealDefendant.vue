<template>
    <div>
        <h4 v-if="show" class="text-center font-weight-bold">Demandados Ideales</h4>
        <table class="table table-striped table-sm">
        <thead>
        <tr v-if="show">
            <th scope="col">Razón Social</th>
            <th scope="col">CUIT</th>
            <th scope="col">Domicilio Social</th>
            <th scope="col">Opciones</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(idealDefendant,index) in idealDefendants">
            <td>{{idealDefendant.razon_soc}}</td>
            <td>{{idealDefendant.cuit}}</td>
            <td>{{idealDefendant.domicilio}}</td>
            <td>
                <button class="btn btn-info btn-sm" @click="viewIdealDefendant(idealDefendant,index)"><i style="color:" class="fa fa-eye"></i></button>
                <button class="btn btn-warning btn-sm" @click="editIdealDefendant(idealDefendant,index)"><i style="color:" class="fa fa-edit"></i></button>
                <button class="btn btn-danger btn-sm" @click="deleteIdealDefendant(idealDefendant,index)"><i class="fas fa-trash" aria-hidden="true"></i></button>
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
            idealDefendants: [],
            pageOfItems: [],
            loading: true,
            show: true,
            pagI: 0
        }
    },
    created() {
        EventBus.$on('idealDefendant-added', data => {
        this.idealDefendants.push(data)
        this.review();
      })
      EventBus.$on('idealDefendant-updated', data => {
        console.log("el id es: ",this.id)
        console.log("el id es: ",data.id)
        this.idealDefendants.splice(this.id,1,data)
      })
      this.review();
    },
    methods: {
        viewIdealDefendant(idealDefendant,index) {
        EventBus.$emit('view-idealDefendant', idealDefendant)
        //this.review();
      },
      editIdealDefendant(idealDefendant,index) {
        this.id = index
        //$('#editIdealActor').modal()
        EventBus.$emit('edit-idealDefendant', idealDefendant)
      },
      deleteIdealDefendant(idealDefendant,index) {
        EventBus.$emit('delete-idealDefendant', idealDefendant)
        let currentRoute = window.location.pathname
        console.log("El id es: ",idealDefendant.id)
        console.log(currentRoute)
        axios
        .delete(currentRoute+'/demandadoidealdelete/'+idealDefendant.id)
        .then((res) => {
          console.log(res)
          this.idealDefendants.splice(index,1)    
          this.review();   
        })
        .catch(err => {
          console.log(err)
          console.log("hubo error")
        })
        this.review();
      },
      review() {
        if(this.idealDefendants.length == 0){
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
        .get(currentRoute+'/demandadoideal')
        .then((res) => {
        //console.log(res)
        this.idealDefendants = res.data
        this.loading = false
        this.review();
        console.log("hay :"+this.idealDefendants.length)     
        })
        console.log('Component mounted.')
    }
}
</script>