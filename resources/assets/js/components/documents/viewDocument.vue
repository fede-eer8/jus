<template>
  
</template>

<script>
import EventBus from '../../event-bus';
export default {
	data() {
		return {

		}
	},
  created() {
    let currentRoute = window.location.pathname
    EventBus.$on("view-document", data => {     
      // console.log("El id es: ",data.id)     
      // console.log(currentRoute)
      // console.log(data);
      
      axios
      .get(currentRoute + '/documento/'+data.id, {responseType: 'arraybuffer'})
        .then(response => {
        window.open(currentRoute + '/documento/'+data.id) 
      });
    });

    EventBus.$on("download-document", data => {
      axios
      .get(currentRoute + '/documento/'+data.id, {responseType: 'arraybuffer'})
        .then(response => {
        let blob = new Blob([response.data], { type: 'application/pdf' })
        let link = document.createElement('a')
        link.href = window.URL.createObjectURL(blob)
        link.download = data.nombre
        link.click()
      });
    })
    //   axios
    //     .get(currentRoute+'/representantelegal/'+data.replegal_id)
    //     .then((res) => {
    //         console.log("hola:"+res.data.representanteLegal.nombre)
    //         this.nombreRepLegal = res.data.representanteLegal.nombre;
    //         this.apellidoRepLegal = res.data.representanteLegal.apellido;
    //         this.condicionRepLegal = res.data.representanteLegal.calidad;
    //         this.loading = false;
    //     })
    
  },
  mounted() {   
    // let currentRoute = window.location.pathname
    // axios.get(currentRoute + '/decreto/'+2, {responseType: 'arraybuffer'})
    //   .then(response => {
    //   let blob = new Blob([response.data], { type: 'application/pdf' })
    // });
	}
};
</script>

<style>
</style>