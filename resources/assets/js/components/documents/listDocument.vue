<template>
  <div>
    <h4 v-if="show" class="text-center font-weight-bold">Documentos</h4>
    <!-- <select v-model="selected">
      <option v-for="(documento,index) in documentos" v-bind:value="documento.tipo">{{ option.text }}</option>
    </select>
    <span>Seleccionado: {{ selected }}</span> -->
    <table class="table table-striped table-sm">
      <thead>
        <tr v-if="show" class="text-center">
          <th scope="col">Nombre</th>
          <th scope="col">Tipo</th>
          <th scope="col">Fecha creado</th>
          <th scope="col">Opciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(documento,index) in documentos" class="text-center">
          <td>{{ documento.nombre | reduce }}</td>
          <td>{{ types[documento.tipodoc_id - 1].nombre }}</td>
          <td>{{ documento.created_at }}</td>
          <td>
            <button class="btn btn-primary btn-sm" @click="viewDocumento(documento, index)">
              <i style="color:" class="fas fa-eye" aria-hidden="true"></i>
            </button>
            <button class="btn btn-secondary btn-sm" @click="downloadDocumento(documento,index)">
              <i style="color:" class="fas fa-download"></i>
            </button>
            <!-- <button class="btn btn-danger btn-sm" @click="deleteDecreto(decreto,index)"><i class="fas fa-trash"></i></button>-->
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import EventBus from "../../event-bus";
export default {
  data() {
    return {
      documentos: [],
      loading: true,
      show: true,
      types: [],
    };
  },
  filters: {
    reduce: function(value) {
      value = value.toString();
      value = value.slice(11);
      return value;
    },
  },
  created() {
    EventBus.$on("document-added", data => {
      this.documentos.push(data);
      this.review();
    });
    EventBus.$on("document-updated", data => {
      console.log("el id es: ", this.id);
      console.log("el id es: ", data.id);
      this.documentos.splice(this.id, 1, data);
    });
    this.review();
  },
  methods: {
    viewDocumento(documento, index) {
      EventBus.$emit("view-document", documento);
    },
    downloadDocumento(documento, index) {
      console.log(documento);
      EventBus.$emit("download-document", documento);
    },
    // editDecreto(decreto, index) {
    //   this.id = index;
    //   //$('#editIdealActor').modal()
    //   EventBus.$emit("edit-decreto", decreto);
    // },
    // deleteDecreto(decreto, index) {
    //   EventBus.$emit("delete-decreto", decreto);
    //   let currentRoute = window.location.pathname;
    //   console.log("El id es: ", decreto.id);
    //   console.log(currentRoute);
    //   axios
    //     .delete(currentRoute + "/decretodelete/" + decreto.id)
    //     .then(res => {
    //       console.log(res);
    //       this.decretos.splice(index, 1);
    //       this.review();
    //     })
    //     .catch(err => {
    //       console.log(err);
    //       console.log("hubo error");
    //     });
    //   this.review();
    // },
    review() {
      if (this.documentos.length == 0) {
        this.show = false;
      } else {
        this.show = true;
      }
    }
  },
  getTipoDocumento: function() {
      
    },
  mounted() {
    let currentRoute = window.location.pathname;
    axios.get(currentRoute + "/documento").then(res => {
      //console.log(res)
      this.documentos = res.data;
      this.loading = false;
      this.review();
      console.log("hay :" + this.documentos.length);
    });
    axios.get("/api/getTipoDocumento")
      .then(
        function(response) {
          this.types = response.data;
          console.log("hay tipos:" + this.types.length);
        }.bind(this)
      );
    console.log("Component mounted.");
  }
};
</script>

<style>
</style>