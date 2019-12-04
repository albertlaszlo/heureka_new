<template>
  <div id="home">
    <input v-model="search" />
    <span v-if="errors.search">
      <span v-for="error in errors.search">{{ error }}</span>
    </span>
    <input v-model="day" type="date" placeholder="add day"/>
    <input v-model="start" type="time" placeholder="add start time"/>
    <span v-if="errors.start">
      <span v-for="error in errors.start">{{ error }}</span>
    </span>
    <input v-model="end" type="time" placeholder="add end time"/>
    <span v-if="errors.end">
      <span v-for="error in errors.end">{{ error }}</span>
    </span>
    <br/>
    <button @click="onSearch">Search</button>
    <ul>
      <li v-for="host in hosts" v-bind:key="host.id">
        {{ host.name }} ({{ host.id }}) {{host.free_table }}
        <button v-if="host.free_tables.length > 0" @click="onReserve(host.id)">Reserve</button>
      </li>
    </ul>
     <br/>
    <br/>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      search: "",
      hosts: [],
      day: "",
      start: "",
      end: "",
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
  methods: {
    async onSearch() {
      try {
      const response = await axios
        .get("/hosts/", {
          params: {
            search: this.search,
            start: `${this.day} ${this.start}:00`,
            end: `${this.day} ${this.end}:00`,
          }
        })
        this.hosts = response.data;
        this.errors = {};
      } catch (error) {
        this.errors = error.response.data.errors;
      }
    },
  }
}
</script>

<style>
</style>