<template>
  <div>
    <div class="container top-space">
      <div class="row">
        <div class="col-md-4">
          <button
            @click="showForm()"
            type="submit"
            class="btn btn-primary"
          >Cargar Documento</button>
        </div>
        <div class="col-md-8">
          <form v-if="show" @submit.prevent="saveDocumento">
            <!-- <div class="form-group">
              <label>Nombre</label>
              <input type="text" class="form-control form-control-sm" placeholder="Ingresar nombre del demandado" v-model="nombre">
            </div>-->
            <label>Tipo de Documento</label>
            <select v-model="type">
              <option disabled value="0">Seleccione un tipo</option>
              <option v-for="data in types" v-bind:value="data.nombre" >{{ data.nombre }}</option>
            </select>
            <span>Seleccionado: {{ type }}</span>
            <!-- <span>Seleccionado: {{ type }}</span> -->
            <div class="form-group">
              <!-- <label>Decreto</label> -->
              <input
                type="file"
                ref="file"
                accept=".docx, .pdf, .doc"
                class="form-control-md top-space"
                placeholder=""
                @change="onChangeFileUpload()"
              />
            </div>
            <button type="submit" class="btn btn-primary">Save changes</button>
            <button class="btn btn-dark" @click="clearValues()">
              <i class="fa fa-times" aria-hidden="true"></i>
            </button>
          </form>
        </div>
      </div>
    </div>
    <hr />
  </div>
</template>

<script>
import EventBus from "../../event-bus";

export default {
  data() {
    return {
      show: false,
      edit: false,
      //alert: false,
      file: "",
      type: 0,
      types: [],
      //msj: ''
    };
  },
  created() {
    this.getTipoDocumento();
  },

  methods: {
    showForm() {
      this.show = !this.show;
      //this.alert = false;
    },
    getTipoDocumento: function() {
      axios.get("/api/getTipoDocumento")
      .then(
        function(response) {
          this.types = response.data;
        }.bind(this)
      );
    },
    saveDocumento: function() {
      let currentRoute = window.location.pathname;
      console.log(currentRoute);
      let formData = new FormData();
      formData.append("file", this.file);
      formData.append("type", this.type);

      if (this.edit) {
        let currentRoute = window.location.pathname;
        console.log(currentRoute);
        axios
          .post(currentRoute + "/documentoupdate", {
            id: this.id,
            nombre: this.nombre
          })
          .then(function(res) {
            console.log(res);
            EventBus.$emit("document-updated", res.data.humanDefendant);
            console.log(res.data.humanDefendant);
          })
          .catch(function(err) {
            console.log(err.res);
            console.log("saludare");
          });
      } else {
        axios
          .post(currentRoute + "/documento", formData, {
            headers: {
              "Content-Type": "multipart/form-data"
            },
          })
          .then(function(res) {
            console.log(res.data);
            EventBus.$emit("document-added", res.data.documento);
            console.log(res.data.documento);
          })
          .catch(function(err) {
            console.log(err.res);
            console.log("Fallo");
          });
      }

      this.clearValues();
    },
    clearValues() {
      this.nombre = "";
      this.show = false;
      this.edit = false;
      this.alert = false;
    },
    onChangeFileUpload() {
      this.file = this.$refs.file.files[0];
    }
  }
};
</script>

<style>
.top-space {
  margin-top: 15px;
}
</style>
