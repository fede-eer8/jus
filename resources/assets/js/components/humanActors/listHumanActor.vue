<template>
  <div>
    <div class="notification-wrapper">
      <div
        :class="'notification alert ' + alertClass"
        v-show="show"
        v-text="notification"
        @click="destroyNotification"
      >Some random notification</div>
    </div>
    <h4 v-if="add" class="text-center font-weight-bold">Actores Humanos</h4>
    <table class="table table-striped table-sm">
      <thead>
        <tr v-if="add">
          <th scope="col">Nombre</th>
          <th scope="col">Apellido</th>
          <th scope="col">Seudonimo</th>
          <th scope="col">Condición</th>
          <th v-if="indicator" scope="col">Opciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(humanActor, index) in humanActors">
          <td>{{ humanActor.nombre }}</td>
          <td>{{ humanActor.apellido }}</td>
          <td>{{ humanActor.seudonimo }}</td>
          <td>{{ humanActor.edad }}</td>
          <td v-if="indicator">
            <button class="btn btn-info btn-sm" @click="viewHumanActor(humanActor, index)">
              <i style="color:" class="fas fa-eye"></i>
            </button>
            <button class="btn btn-warning btn-sm" @click="editHumanActor(humanActor, index)">
              <i style="color:" class="fas fa-edit"></i>
            </button>
            <button class="btn btn-danger btn-sm" @click="deleteHumanActor(humanActor, index)">
              <i style="color:" class="fas fa-trash" aria-hidden="true"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<style scoped>
.notification-wrapper {
  position: fixed;
  left: 50%;
  top: 2rem;
  z-index: 10000;
}

.notification {
  position: relative;
  left: -50%;
}
</style>

<script>
import EventBus from "../../event-bus";
export default {
  props: ["indicator"],
  data() {
    return {
      humanActors: [],
      loading: true,
      id: null,
      add: true,
      show: false,
      notification: this.message,
      alertClass: this.type,
      hideTimeout: false
    };
  },
  created() {
    if (this.notification) {
      this.showNotification();
    }
    window.events.$on("showNotification", (message, type) => {
      this.notification = message;
      this.alertClass = type;
      this.showNotification();
    });
    EventBus.$on("humanActor-added", data => {
      this.humanActors.push(data);
      this.review();
      showNotification(data.nombre + " Añadido", "alert-success");
    });
    EventBus.$on("humanActor-updated", data => {
      console.log("el id es: ", this.id);
      console.log("el id es: ", data.id);
      this.humanActors.splice(this.id, 1, data);
      //this.humanActors.splice(this.id,1,data)
      //this.humanActors.push(data)
      //this.humanActors.sort()
    });
    EventBus.$on("delete-humanActor", data => {
      this.humanActors.splice(data, 1);
      this.review();
    });
    this.review();
  },
  methods: {
    viewHumanActor(humanActor, index) {
      console.log(humanActor)
      EventBus.$emit("view-humanActor", humanActor);
      this.review();
    },
    editHumanActor(humanActor, index) {
      this.id = index;
      $("#editHumanActor").modal();
      EventBus.$emit("edit-humanActor", humanActor);
    },
    deleteHumanActor(humanActor, index) {
      if (
        confirm(
          "¿Seguro deseas borrar al actor humano " + humanActor.nombre + "?"
        )
      ) {
        EventBus.$emit("delete-humanActor", index);
        let currentRoute = window.location.pathname;
        console.log("El id es: ", humanActor.id);
        console.log(currentRoute);
        axios
          .delete(currentRoute + "/actorhumanodelete/" + humanActor.id)
          .then(res => {
            console.log(res);
            showNotification(humanActor.nombre + " Eliminado", "alert-danger");
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
      if (this.humanActors.length == 0) {
        this.add = false;
      } else {
        this.add = true;
      }
    },
    showNotification() {
      this.show = true;
      this.hideNotification();
    },
    hideNotification() {
      this.hideTimeout = setTimeout(() => {
        this.show = false;
      }, 5000);
    },
    destroyNotification() {
      this.show = false;
      clearTimeout(this.hideTimeout);
    }
  },
  mounted() {
    let currentRoute = window.location.pathname;
    axios.get(currentRoute + "/actorhumano").then(res => {
      //console.log(res)
      this.humanActors = res.data;
      this.loading = false;
      this.review();
      console.log("hay :" + this.humanActors.length);
    });
    console.log("Component mounted.");
  }
};
</script>
