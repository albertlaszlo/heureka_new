<template>
  <div id="admin">    
    <ul>
      <li v-for="host in hosts" v-bind:key="host.id">
        {{ host.name }} ({{ host.id }}) {{ host.tables.length }} {{ host.tables.reduce( (sum, table) => sum + table.nr_of_chairs, 0 ) }}
        <button @click="onRemove(host.id)">Remove</button>
        <button @click="onReservations(host.id)">Reservations</button>
      </li>
    </ul>
    <hr />

    <ul>
      <li v-for="res in reservations">
        <div>
          {{ res.email }} {{ res.start }} {{ res.end }} {{ res.table.nr_of_chairs }}
          <button v-if="res.status =='pending'">Accept</button>
          <button v-if="res.status =='pending'">Decline</button>
          <div v-if="res.status !=='pending'">{{res.status}}</div>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
import ImageUploader from "./ImageUploader.vue";
import axios from "axios";

export default {
  name: "app",
  data() {
    return {
      hosts: [],
      reservations: [],
      form: {
        name: "",
        description: "",
        city: "",
        logo: "",
        images: ['']
      },
      errors: {}
    };
  },
  mounted() {
    this.getData();
  },
  components: {
    ImageUploader
  },
  methods: {
    async getData() {
      const response = await axios
        .get("/hosts/")
        .catch(error => console.log(error));
      this.hosts = response.data;
    },
    async onFileChanged(event) {
      const formData = new FormData();
      formData.append("logo", event.target.files[0]);
      const response = await axios.post(
        "http://127.0.0.1:8000/fileUpload",
        formData
      );
      this.form.logo = response.data.path;
    },
    async onAdd() {
      console.log("add", this.form);
      const response = await axios
        .post("/hosts/", this.form)
        .catch(error => this.errors = error.response.data.errors);
      this.getData();
    },
    async onRemove(id) {
      console.log("remove", id);
      const response = await axios
        .delete("/hosts/" + id)
        .catch(error => console.log(error));
      this.getData();
    },
    async onReservations(id) {
      console.log("reservations", id);
      const response = await axios.get(`/hosts/${id}/reservations/`)
      this.reservations = response.data
    },
    imageUploaded($path, index) {
      this.$set(this.form.images, index, $path);
      console.log("=== iu", $path, index);
    },
    imageRemoved(index) {
      this.form.images.splice(index, 1);
      console.log("=== ir", index);
    }
  }
};
</script>

<style>
</style>