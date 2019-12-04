<template>
  <div id="home">
    <input v-model="search" />
    <input v-model="day" type="date" placeholder="add day"/>
    <input v-model="start" type="time" placeholder="add start time"/>
    <input v-model="end" type="time" placeholder="add end time"/>
    <br/>
    <button @click="onSearch">Search</button>
    <ul>
      <li v-for="host in hosts" v-bind:key="host.id">
        {{ host.name }} ({{ host.id }}) {{host.status}} 
        <button @click="onRemove(host.id)">Remove</button>
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
      }
    };
  },
  mounted() {
    this.getData();
  },
  methods: {
    async onSearch() {
      const response = await axios
        .get("/hosts/", {
          params: {
            search: this.search,
            start: `${this.day} ${this.start}:00`,
            end: `${this.day} ${this.end}:00`,
          }
        })
        .catch(error => console.log(error));
      this.hosts = response.data;
    },
  }
}
</script>

<style>
</style>