<template>
  <div id="app">
    <input v-model="search" @change="onChange" />
    <ul>
      <li v-for="host in hosts" v-bind:key="host.id">
        {{ host.name }} ({{ host.id }})
        <button @click="onRemove(host.id)">Remove</button>
      </li>
    </ul>
    <!-- <div>{{ search }}</div> -->
    <reservation-form />

    <hr />
    <input v-model="form.name" />
    <br />
    <input v-model="form.description" />
    <br />
    <input v-model="form.city" />
    <br />
    <button @click="onAdd">Add</button>
    <br />

    <input type="file" @change="onFileChanged" />
    <img v-if="form.logo" :src="'storage/'+form.logo" height="42" width="42" />

    <br />
    <button @click="form.images.push('')">Add Image</button>
    <div v-for="(image, index) in form.images">
      <image-uploader
        @imageUploaded="(path) => imageUploaded(path, index)"
        @imageRemoved="imageRemoved(index)"
        :image="image"
        :index="index"
        :key="index"
      />
    </div>

    <pre>
    {{ form }}
    </pre>
    <hr />
  </div>
</template>

<script>
import ReservationForm from "./components/ReservationForm.vue";
import ImageUploader from "./components/ImageUploader.vue";
import axios from "axios";

export default {
  name: "app",
  data() {
    return {
      search: "",
      hosts: [],
      form: {
        name: "",
        description: "",
        city: "",
        logo: "",
        images: []
      }
    };
  },
  components: {
    ReservationForm,
    ImageUploader
  },
  mounted() {
    this.getData();
  },
  computed: {},
  // watch: {
  //     search(val) {
  //         console.log(val)
  //     }
  //},
  methods: {
    async onAdd() {
      console.log("add", this.form);
      const response = await axios
        .post("/hosts/", this.form)
        .catch(error => console.log(error));
      this.getData();
    },
    async onRemove(id) {
      console.log("remove", id);
      const response = await axios
        .delete("/hosts/" + id)
        .catch(error => console.log(error));
      this.getData();
    },
    async onChange() {
      console.log("change", this.search);
      const response = await axios
        .get("/hosts/", {
          params: {
            search: this.search
          }
        })
        .catch(error => console.log(error));
      this.hosts = response.data;
    },
    async getData() {
      console.log("get data start");
      const response = await axios
        .get("/hosts/")
        .catch(error => console.log(error));
      this.hosts = response.data;
      console.log("get data end");
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