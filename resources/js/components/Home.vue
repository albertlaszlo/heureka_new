<template>
  <div id="home">
    <input v-model="form.search" />
    <span v-if="errors.search">
      <span v-for="error in errors.search">{{ error }}</span>
    </span>
    <input v-model="form.day" type="date" placeholder="add day"/>
    <input v-model="form.start" type="time" placeholder="add start time"/>
    <span v-if="errors.start">
      <span v-for="error in errors.start">{{ error }}</span>
    </span>
    <input v-model="form.end" type="time" placeholder="add end time"/>
    <span v-if="errors.end">
      <span v-for="error in errors.end">{{ error }}</span>
    </span>
    <input v-model="form.persons" min="1" type="number" placeholder="persons"/>
    <span v-if="errors.persons">
      <span v-for="error in errors.persons">{{ error }}</span>
    </span>
    <br/>
    <button @click="onSearch">Search</button>
    <ul>
      <li v-for="host in hosts" v-bind:key="host.id">
        {{ host.name }} ({{ host.id }}) {{host.free_tables.length }} {{ host.free_tables.reduce( (sum, table) => sum + table.nr_of_chairs, 0 ) }}
        <button
            v-if="hasFreeTable(host)"
            @click="onReserve(host.id)">Reserve</button>
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
      hosts: [],
      form: {
        search: "Host",
        day: "2019-12-10",
        start: "14:00",
        end: "16:00",
        persons: 1,
      },
      errors: {}
    };
  },
  methods: {
    onReserve(id) {
        localStorage.setItem('heureka_data', JSON.stringify({... this.form, ...{
            start: `${this.form.day} ${this.form.start}:00`,
            end: `${this.form.day} ${this.form.end}:00`,
        }}));
        // this.$router.go('reservations');
        this.$router.push({name: "reservation", params: {id}});
    },
    hasFreeTable(host) {
        const goodTables = host.free_tables.filter(table => table.nr_of_chairs >= this.form.persons);
        return goodTables.length > 0;
    },
    async onSearch() {
      try {
      const response = await axios
        .get("/hosts/search", {
          params: {
            search: this.form.search,
            start: `${this.form.day} ${this.form.start}:00`,
            end: `${this.form.day} ${this.form.end}:00`,
            persons: this.form.persons,
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