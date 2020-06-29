<template>
  <div>
    <h4 v-if="show" class="top-space text-center font-weight-bold">Tipos de Documentos</h4>
    <table class="table table-striped table-sm">
      <thead>
        <tr v-if="show">
          <th scope="col">Nombre</th>
          <th scope="col">Nombre Plural</th>
          <th scope="col">Opciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="tipodoc in tiposDocs" :key="tipodoc.id">
          <td>{{tipodoc.nombre}}</td>
          <td>{{tipodoc.slug_fd}}</td>
          <td>
            <!-- <button class="btn btn-info btn-sm" @click="viewDocType(tipodoc,tipodoc.id)">
              <i style="color:" class="fa fa-eye"></i>
            </button>-->
            <button class="btn btn-warning btn-sm" @click="editDocType(tipodoc,tipodoc.id-1)">
              <i style="color:" class="fa fa-edit"></i>
            </button>
            <button class="btn btn-danger btn-sm" @click="deleteDocType(tipodoc,tipodoc.id-1)">
              <i class="fas fa-trash" aria-hidden="true"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import EventBus from "../../../event-bus";
export default {
  data() {
    return {
      tiposDocs: [],
      loading: true,
      show: true,
      id: null
    };
  },

  created() {
    EventBus.$on("docType-added", data => {
      console.log(data.id);
      this.tiposDocs.push(data);
      this.review();
    });
    EventBus.$on("docType-updated", data => {
      console.log("el id es: ", this.id);
      console.log("el id es: ", data.id);
      this.tiposDocs.splice(this.id, 1, data);
    });
    this.review();
  },
  methods: {
    // viewDocumento(documento, index) {
    //   EventBus.$emit("view-document", documento);
    // },
    // downloadDocumento(documento, index) {
    //   console.log(documento);
    //   EventBus.$emit("download-document", documento);
    // },
    editDocType(tipodoc, index) {
      this.id = index;
      EventBus.$emit("edit-docType", tipodoc);
    },
    deleteDocType(tipodoc, index) {
      if (
        confirm(
          "¿Seguro deseas borrar el tipo de documento " + tipodoc.nombre + "?"
        )
      ) {
        EventBus.$emit("delete-docType", tipodoc);
        let currentRoute = window.location.pathname;
        console.log("El id es: ", tipodoc.id);
        console.log(currentRoute);
        axios
          .delete("api/tipodocumento/" + tipodoc.id)
          .then(res => {
            console.log(res);
            this.tiposDocs.splice(index, 1);
            this.review();
          })
          .catch(err => {
            console.log(err);
            console.log("hubo error");
          });
        this.review();
      }
    },
    review() {
      if (this.tiposDocs.length == 0) {
        this.show = false;
      } else {
        this.show = true;
      }
    }
  },
  mounted() {
    axios.get("/api/getTipoDocumento").then(
      function(response) {
        this.tiposDocs = response.data;
        console.log("hay tipos:" + this.tiposDocs.length);
        console.log(this.show);
        this.review();
      }.bind(this)
    );
    console.log("Component mounted.");
  }
};
</script>

<style>
.top-space {
  margin-top: 15px;
}
</style>