<template>
  <div id="app">
    <input v-model="search" @change="onChange" />

    <ul>
      <li v-for="host in hosts" v-bind:key="host.id">
        {{ host.name }} ({{ host.id }}) {{host.status}} 
        <button @click="onRemove(host.id)">Remove</button>
      </li>
    </ul>
     <br/>
    <input v-model="day" type="date" placeholder="add day"/>
    <input v-model="start" type="time" placeholder="add start time"/>
    <input v-model="end" type="time" placeholder="add end time"/>
    <br/>
    <button @click="SearchTimeClick()">SearchTime</button>
    <br/>
    <!-- <div>{{ search }}</div> -->
    <reservation-form />


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
    async SearchTimeClick(){
      console.log("getStartTime: ", this.day, this.start, this.end);
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
  }
};
</script>

<style>
</style>