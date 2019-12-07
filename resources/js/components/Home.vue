<template>
  <!-- <div id="home">
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
          @click="onReserve(host.id)">
          Reserve
        </button>
      </li>
    </ul>
     <br/>
    <br/>
  </div> -->

  <div id="welcome_page">
    <div class="app">
      <div class="hero-section section">
        <h1>Find a perfect place to stay</h1>
      </div>
      <div class="search-form-section section">
          <form v-on:submit.prevent="onSearch" action="">
            <p>Keress es foglalj asztalt!</p>
            <div class="search_bar">
              <input v-model="form.search" type="text" placeholder="Keress ra erre: “Kalapos, Szekelyudvarhely”">
            </div>
            <div class="time_and_date-wrapper">
              <div class="date-selector">
                <input v-model="form.day" type="date"/>
              </div>
              <div class="time-selector">
                <div class="time-selector_start">
                  <input v-model="form.start" type="time" />
                </div>
                <div class="time-selector_end">
                  <input v-model="form.end" type="time" />
                </div>
              </div>
            </div>
            <div class="valaszt">
              <input v-model="form.persons" min="1" type="number" placeholder="persons"/>
            </div>
            <div class="button">
              <button> Find a place </button>
            </div>
          </form>
      </div>
    </div>
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
    async onSearch() {
      console.log('search')
      localStorage.setItem('heureka_data', JSON.stringify({... this.form, ...{
          start: `${this.form.day} ${this.form.start}:00`,
          end: `${this.form.day} ${this.form.end}:00`,
      }}));
      // this.$router.go('reservations');
      this.$router.push({ name: "hosts_list" });
    },
  }
}
</script>

<style>

div#welcome_page{ 
    font-family: Nunito, sans-serif;
    background-image: url("https://www.northkentcleaning.co.uk/wp-content/uploads/2019/09/gerson-repreza-CepDpEiALqM-unsplash.jpg");
    background-size: 100vw;
    background-repeat: no-repeat;
}
.app{
    position: relative;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.6);
}

.hero-section{
    padding-top: 3em;
}

.hero-section h1{
    font-size: 2.25em;
    color: #fff;
    letter-spacing: -0.02em;
    font-style: normal;
    font-weight: bold;
    text-align: center;
}

.search-form-section{
    position: absolute;
    bottom: 0;
    width: 100vw;
    background-color: #2C2C2C;
    border-radius: 25px 25px 0px 0px;
}

.search-form-section p{
    text-align: center;
    color: #999999;
    font-size: 1em;
}
#welcome_page form{
    padding: 1em;
    margin: 0;
}
#welcome_page input, 
#welcome_page select,
#welcome_page button{
    width: 100%;
    margin-top: 0.5em;
    border: 0ch;
    border-radius: 10px;
}

#welcome_page input, 
#welcome_page select{
    background: rgba(223, 222, 222, 0.1);
    color: #999;
    padding: 1em 0em;
    padding-left: 0.5em;
    box-sizing: border-box;
}

.time-selector{
    display: flex;
    justify-content: space-between;
}

.time-selector_start{
    width: 50%;
}

.time-selector_end{
    width: 50%;
    padding-left: 0.5em;
}

.search-form-section button{
    background: linear-gradient(99.47deg, #F8A170 14.73%, #FFCD61 97.52%);
    padding: 1.25em 0em;
    color: #fff;
    letter-spacing: -0.02em;
    font-weight: 800;
}
</style>