<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <button @click="showForm()" type="submit" class="btn btn-primary top-space">Añadir Decreto</button>
        </div>
        <div class="col-md-8">
          <form v-if="show" @submit.prevent="saveDecreto">
            <!-- <div class="form-group">
              <label>Nombre</label>
              <input type="text" class="form-control form-control-sm" placeholder="Ingresar nombre del demandado" v-model="nombre">
            </div>-->
            <div class="form-group">
              <!-- <label>Decreto</label> -->
              <input
                type="file"
                ref="file"
                class="form-control-md top-space"
                placeholder="Ingresar CUIT del demandado"
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
    <hr>
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
      file: ""
      //msj: ''
    };
  },
  created() {},

  methods: {
    showForm() {
      this.show = !this.show;
      //this.alert = false;
    },
    saveDecreto: function() {
      let currentRoute = window.location.pathname;
      console.log(currentRoute);
      let formData = new FormData();
      formData.append("file", this.file);

      if (this.edit) {
        let currentRoute = window.location.pathname;
        console.log(currentRoute);
        axios
          .post(currentRoute + "/decretoupdate", {
            id: this.id,
            nombre: this.nombre
          })
          .then(function(res) {
            console.log(res);
            EventBus.$emit("decreto-updated", res.data.humanDefendant);
            console.log(res.data.humanDefendant);
          })
          .catch(function(err) {
            console.log(err.res);
            console.log("saludare");
          });
      } else {
        axios
          .post(currentRoute + "/decreto", formData, {
            headers: {
              "Content-Type": "multipart/form-data"
            }
          })
          .then(function(res) {
            console.log(res.data);
            EventBus.$emit("decreto-added", res.data.decreto);
            console.log(res.data.decreto);
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
