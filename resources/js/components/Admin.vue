<template>
  <div id="admin">
    <ul>
      <li v-for="host in hosts" v-bind:key="host.id">
        {{ host.name }} ({{ host.id }}) {{host.status}} 
        <button @click="onRemove(host.id)">Remove</button>
      </li>
    </ul>
    <hr />
    
    <label>Name</label>
    <input v-model="form.name" />
    <span v-if="errors.name">
      <span v-for="error in errors.name">{{ error }}</span>
    </span>
    <br />
    
    <label>Description</label>
    <input v-model="form.description" />
    <span v-if="errors.description">
      <span v-for="error in errors.description">{{ error }}</span>
    </span>
    <br />
    
    <label>City</label>
    <input v-model="form.city" />
    <span v-if="errors.city">
      <span v-for="error in errors.city">{{ error }}</span>
    </span>
    <br />
    <button @click="onAdd">Add Host</button>
    <br />

    <label>Logo</label>
    <input type="file" @change="onFileChanged" />
    <img v-if="form.logo" :src="'storage/'+form.logo" height="42" width="42" />
    <span v-if="errors.logo">
      <span v-for="error in errors.logo">{{ error }}</span>
    </span>

    <br />
    <label>Images</label>
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
    {{ errors }}
    </pre>
    <hr />
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
      form: {
        name: "",
        description: "",
        city: "",
        logo: "",
        images: []
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