<template>
  <div id="res">
    Reservation
     <form v-on:submit.prevent="onSubmit">
        <label>Email</label>
        <input v-model="form.email" />
        <span v-if="errors.email">
        </span>
        <pre>
        {{ form }}
        </pre>
        <button>Reserve</button>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      hosts: [],
      form: {
        search: "Host",
        day: "2019-12-10",
        start: "14:00",
        end: "16:00",
        sdf: 'dsf',
        email: "email@email.com",
        persons: 1,
      },
      errors: {}
    };
  },
  mounted() {
    this.form = { ...this.form, ...JSON.parse(localStorage.getItem('heureka_data'))};
  },
  methods: {
    async onSubmit() {
      try {
        const res = await axios.post(`/hosts/${this.$route.params.id}/reserve`, this.form);
        this.$router.push({name: "summary", params: {id:res.data.id}});
      } catch (error) {
        this.errors = error.response.data.errors;
      }
    }
  }
}

</script>