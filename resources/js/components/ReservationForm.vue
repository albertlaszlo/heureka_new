<template>
  <form v-on:submit.prevent="onSubmit">
    <label></label>
    <input v-model="form.email" />
    <br />
    <span v-if="errors.email">
      <span v-for="error in errors.email">{{ error }}</span>
    </span>
    <br />
    <input v-model="form.nrOfChairs" />
    <br />
    <span v-if="errors.nrOfChairs">
      <span v-for="error in errors.nrOfChairs">{{ error }}</span>
    </span>
    <br />
    <input v-model="form.start" />
    <br />
    <span v-if="errors.start">
      <span v-for="error in errors.start">{{ error }}</span>
    </span>
    <input v-model="form.end" />
    <button>Reserve</button>
    <br />
    <span v-if="errors.end">
      <span v-for="error in errors.end">{{ error }}</span>
    </span>
  </form>
</template>

<script>
import axios from "axios";

export default {
  name: "app",
  data() {
    return {
      form: {
        email: "",
        nrOfChairs: "",
        start: "",
        end: ""
      },
      errors: {}
    };
  },
  methods: {
    async onSubmit() {
      try {
        const res = await axios.post("/hosts/1/reserve", this.form);
        console.log("RES:", res);
      } catch (error) {
        this.errors = error.response.data.errors;
      }
    }
  }
};
</script>

<style>
</style>