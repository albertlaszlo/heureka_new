<template>
  <div>
    <label></label>
    <input type="file" @change="onFileChanged"/>
    <button>RemoveImage</button>
    <br />
  </div>
</template>

<script>
import axios from "axios";

export default {

props: [
    "name"
],

  methods: {
    async onFileChanged(event) {
      const formData = new FormData();
      formData.append(this.name, event.target.files[0]);
      const response = await axios.post(
        "http://127.0.0.1:8000/fileUpload",
        formData
      );
      this.form.logo = response.data.path;
    }
  }
};
</script>