<template>
  <div>
    <label></label>
    <input type="file" @change="onFileChanged" />
    <img v-if="path" :src="'http://127.0.0.1:8000/storage/'+path" height="42" width="42" />
    <button @click="$emit('imageRemoved')">Remove</button>
    <br />
  </div>
</template>

<script>
import axios from "axios";

export default {
  props: ["image"],
  data: function() {
    return {
      path: this.image | ""
    };
  },
  methods: {
    async onFileChanged(event) {
      const formData = new FormData();
      formData.append("image", event.target.files[0]);
      const response = await axios.post(
        "http://127.0.0.1:8000/fileUpload",
        formData
      );
      console.log("PATH:", response.data.path);
      this.path = response.data.path;
      this.$emit("imageUploaded", this.path);
    }
  }
};
</script>