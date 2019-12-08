<template>
  <!-- <div id="res">
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
  </div> -->
  <div id="description_page">
  <div class="app">

      <div class="search-form-section_2 section">
          <div class="pictures">
              <div class="image">
                <!-- <img src="http://informatiadeiasi.ro/wp-content/uploads/2018/07/restaurant.jpg" alt="image" width="100%" height="100%">  -->
                <!-- <img :src="'http://127.0.0.1:8000/storage/'+this.form.hosts[0].images[0].image" alt="image" width="100%" height="100%"> -->
                <img :src="'http://127.0.0.1:8000/storage/'+host.images[0].image" alt="image" width="100%" height="100%">
              </div>
              <div class="logo">
                <img :src="'http://127.0.0.1:8000/storage/'+host.logo" alt="image" width="94px" height="94px">
                <!-- {{form.hosts.logo}} -->
                
              </div>
            </div>

          <form action="">
              <div class="app-header">
                  <div class="home-button">
                      <button>  Back </button>
                  </div>
                  <h1>
                    {{host.name}}
                    <!-- {{this.form.hosts[0].name}} -->
                     </h1>
                </div>
            <h2>
              {{host.city}} <br/>
              {{host.description}}
              
              <!-- {{form.hosts}} -->
              <!-- {{this.form.hosts[0].name}} -->
              <!-- {{$route.params}} -->
            </h2>

            <!--div class="rate-wrapper">
              <div class="rate">
                  <input type="radio" id="star5" name="rate" value="5" />
                  <label for="star5" title="text">5 stars</label>
                  <input type="radio" id="star4" name="rate" value="4" />
                  <label for="star4" title="text">4 stars</label>
                  <input type="radio" id="star3" name="rate" value="3" />
                  <label for="star3" title="text">3 stars</label>
                  <input type="radio" id="star2" name="rate" value="2" />
                  <label for="star2" title="text">2 stars</label>
                  <input type="radio" id="star1" name="rate" value="1" />
                  <label for="star1" title="text">1 star</label>
                </div>
            </div -->



             <form v-on:submit.prevent="onSubmit">
            <!-- <h3> Type, Distance, $$$</h3> -->
            <!-- <div class="name-input">
              <input type="text" value="Nev">
            </div> -->
            <div class="email-input">
              <input type="text" placeholder="youradress@email.com">
            </div>
            <div class="time_and_date-wrapper_2">
              <div class="date-selector_2">
                <!-- {{form.day}} -->
                <input value="{{form.day}}" disabled>
              </div>
              <div class="time-selector_2">
                <div class="time-selector_start_2">
                  <input type="time">
                </div>
                <div class="time-selector_end_2">
                    <input type="time">
                </div>
              </div>
            </div>
            <div class="valaszt_2">
              <!-- <select>
                  <option name="2 vendeg" id=""> 2 vendeg</option>
                  <option name="3 vendeg" id=""> 3 vendeg</option>
                  <option name="4 vendeg" id=""> 4 vendeg</option>
                  <option name="5 vendeg" id=""> 5 vendeg</option>
                  <option name="5-10 vendeg"   id=""> 5-10 vendeg</option>
              </select> -->
            </div>
            <div class="button_2">
              <button>
               Foglalas

              </button>
            </div>
          </form>
          </form>
      </div>
    </div>

    <pre>
    {{ host }}
    </pre>

    </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      host: {},
      // summary: {
      //    host: {},
      // },
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
  async mounted() {
    this.form = { ...this.form, ...JSON.parse(localStorage.getItem('heureka_data'))};
    const res = await axios.get(`/hosts/${this.$route.params.id}`, this.hosts);
    this.host = res.data;
   
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

<style>

div#description_page{
    font-family: Nunito, sans-serif;
}

.app-header{

    position: absolute;
    top: 0;
    left: 0;
    width: 100vw;
    background: linear-gradient(180deg, rgba(255, 255, 255, 0.53) 28.13%, rgba(255, 255, 255, 0.26) 62.5%, rgba(255, 255, 255, 0) 89.06%);
    padding-bottom: 1.5em;
    box-sizing: border-box;
}

.home-button button{
    position: absolute;
    background-color: transparent;
    border: 0ch;
    padding-left: 0.5em;
    padding-top: 0.7em;
    font-weight: 750;
}

.app-header h1{
    text-align: center;
    margin: 0;
}

.pictures{
    position: relative;
    box-sizing: border-box;
}

.logo{
    position: absolute;
    text-align: center;
    bottom: -1.5rem;
    width: 100%;
}

.logo img{
    border-radius: 50px;
}

.search-form-section_2{
    position: absolute;
    width: 100vw;
    background-color: #fff;
}

.search-form-section_2 h2{
    text-align: center;
    color: #000000;
    font-size: 2em;
    margin: 0;
    margin-top: 0.5em;
}

.search-form-section_2 h3{
    text-align: center;
    color: #999999;
    font-size: 0.875em;
}
#description_page .rate-wrapper input{
    width: 0;
}

#description_page form{
    padding: 1em;
    margin: 0;
}

#description_page input,
#description_page select,
#description_page .button_2 button{
    width: 100%;
    margin-top: 0.5em;
    border: 0ch;
    border-radius: 10px;
}

#description_page input,
#description_page select{
    background: rgba(223, 222, 222, 0.1);
    background-color: #f4f4f4;
    padding: 1em 0em;
    color: #999;
    padding-left: 0.5em;
    box-sizing: border-box;
    border: 0.5px solid #999;
}

.time-selector_2{
    display: flex;
    justify-content: space-between;
}

.time-selector_start_2{
    width: 50%;
}

.time-selector_end_2{
    width: 50%;
    padding-left: 0.5em;
}


.search-form-section_2 .button_2 button{
    background: linear-gradient(99.47deg, #F8A170 14.73%, #FFCD61 97.52%);
    padding: 1.25em 0em;
    color: #fff;
    letter-spacing: -0.02em;
    font-weight: 800;
}

/*
.rate-wrapper{
    display: flex;
    justify-content: center;
}

.rate {
    display: inline-block;
    height: 46px;
    padding: 0 10px;
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}
*/
</style>
