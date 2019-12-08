<template>
  <div id="list_page">
    <div class="app">
      <div class="map"></div>
      <div class="find-pubs">
        <div class="app-header">
          <div class="home-button">
              <a href=""> <img src="Combined Shape.png" alt="home-button" width="20px" height="20px"> </a>
          </div>
          <h1> Pubee </h1>
        </div>
        <div class="search-box">
          <form v-on:submit.prevent="onSearch" action="">
            <div class="search-bar">
              <input @blur="onSearch" v-model="form.search" type="text" placeholder="Keress ra erre: “Kalapos, Szekelyudvarhely”">
            </div>
            <div class="time-and-date_wrapper">
              <div class="date-box">
                <input @blur="onSearch"  v-model="form.day" type="date"/>
              </div>
              <div class="time-selector">
                <div class="time-box_start">
                  <input @blur="onSearch"  v-model="form.start" type="time" />
                </div>
                <div class="time-box_end">
                  <input @blur="onSearch"  v-model="form.end" type="time" />
                </div>
              </div>
            </div>
            <div class="vendeg-select">
              <!-- <select>
                  <option name="2 vendeg" id=""> 2 vendeg</option>
                  <option name="3 vendeg" id=""> 3 vendeg</option>
                  <option name="4 vendeg" id=""> 4 vendeg</option>
                  <option name="5 vendeg" id=""> 5 vendeg</option>
                  <option name="5-10 vendeg"   id=""> 5-10 vendeg</option>
              </select> -->
              <input @change="onSearch" v-model="form.persons" min="1" type="number" placeholder="persons"/>
            </div>

            <!-- <button>Search</button>   -->

            <div class="place">
              <div v-for="host in hosts" :key="host.id" class="box">
                <div class="pictures">
                  <div class="image" v-if="host.images[0]">
                    <img :src="'http://127.0.0.1:8000/storage/'+host.images[0].image" alt="image" width="100%" height="100%"> 
                  </div>
                  <div class="logo">
                    <img v-if="host.images[0] != false" width="94" height="94" :src="'http://127.0.0.1:8000/storage/'+host.logo" alt="logo">
                  </div>
                </div>
                <div class="info-wrapper">
                  <h2> {{ host.name }} </h2>
                    <h3> {{ host.description }} </h3>
                    <div class="reserve-button">
                    <button
                      v-if="hasFreeTable(host)"
                      @click="onReserve(host.id)">
                      Reserve
                    </button>
                    </div>
                </div>
              </div>

            </div>
          </form>
        </div>
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
    onReserve(id) {
        localStorage.setItem('heureka_data', JSON.stringify({... this.form, ...{
            start: `${this.form.day} ${this.form.start}:00`,
            end: `${this.form.day} ${this.form.end}:00`,
           
        }}));
        // this.$router.go('reservations');
        this.$router.push({name: "reservation", params: {id}});
        // this.$router.push({name: "reservation", hosts: {id}});

    },
    hasFreeTable(host) {
        if (this.form.persons < 1) {
          return false;
        }
        const goodTables = host.free_tables.filter(table => table.nr_of_chairs >= this.form.persons);
        return goodTables.length > 0;
    },
    async onSearch() {
      try {
        // console.log(host.images)
        const response = await axios
          .get("/hosts/search", {
            params: {
              search: this.form.search,
              start: `${this.form.day} ${this.form.start}:00`,
              end: `${this.form.day} ${this.form.end}:00`,
              persons: this.form.persons,
              // images: 'http://127.0.0.1:8000/storage/'+host.images[0].image,
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
div#list_page{ 
    font-family: Nunito, sans-serif;
    background-size: 100vw;
}

.find-pubs{
    position: absolute;
    width: 100vw;
    background-color: #fff;
    border-bottom: 0.1em;
    
}

.app-header{
    position: relative;
    width: 100vw;
    padding-left: 1em;
    padding-top: 1em;
}

.home-button{
    position: absolute;
    top: 50%;
}

h1{
    text-align: center;
    margin: 0;
}

#list_page form{
    padding: 1em;
    margin: 0;
}

#list_page input, 
#list_page select{
    width: 100%;
    margin-top: 0.5em;
    border: 0ch;
    border-radius: 10px;
}

#list_page input, 
#list_page select{
    background: rgba(223, 222, 222, 0.2);
    color: #000;
    padding: 1em 0em;
    padding-left: 0.5em;
    box-sizing: border-box;
    border: 0.5px solid #999;
}

.time_and_date_wrapper{
    display: flex;
    justify-content: space-between;
}

.time-box_start{
    width: 50%;
}

.time-box_end{
    width: 50%;
    padding-left: 0.5em;
}

.place{
    position: absolute;
    width: 100vw;
    background: #fff;
    margin-top: 18px;
    left: 0;
    padding: 1em;
    padding-top: 0em;
    box-sizing: border-box;
}

.box{
    position: relative;
    border-radius: 10px;
    background: #fff;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    box-sizing: border-box;
    margin-top: 1em;
}

.pictures{
    position: relative;
    box-sizing: border-box;
}

.image{
    border-radius: 10px 10px 0px 0px;
    overflow: hidden;
}

.logo{
    position: absolute;
    border-radius: 50px;
    bottom: -1.5rem;
    left: 0.6em;
    overflow: hidden;
}
 .info-wrapper{
    margin-top: 1.5em;
    position: relative;
 }

.place h2,h3{
    text-align: left;
    margin: 0 auto;
    padding-left: 0.5em;
}
.reserve-button{
    padding: 1em 0.5em 1em 0.5em;
}

.place button{
    background: linear-gradient(99.47deg, #F8A170 14.73%, #FFCD61 97.52%);
    padding: 0.5em 0em;
    color: #fff;
    letter-spacing: -0.02em;
    font-weight: 800;
    border-radius: 10px;
    border: 0ch;
    width: 100%;
    display: block;
    margin: 0 auto;
}
</style>