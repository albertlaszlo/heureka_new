<template>
<div id="feedback_page">
<!--     <div>
        Summary {{ $route.params.id }}

        <pre>
            {{ summary }}
        </pre>
    </div>-->
 <div class="app">
      <div class="find-pubs">
        <div class="app-header">
          <div class="home-button">
              <a href="http://127.0.0.1:8000/"> <img src="Combined Shape.png" alt="home-button" width="20px" height="20px"> </a>
          </div>

            <h1> Pubee </h1>

        </div>
        <div class="logo">
          <img :src="'http://127.0.0.1:8000/storage/'+summary.host.logo" alt="logo" width="94px" height="94px">
          <!-- <img src="https://via.placeholder.com/94.png" alt="logo"> -->
        </div>
        <h2>
          {{summary.host.name}}
          <!-- Host neve  -->
        </h2>
        <br>
        <h2> Koszunjuk! </h2>
        <h3> Az asztalfoglalasi kerelmet sikeresen elkuldtuk.

        </h3>
        <div class="box">
          <div class="texts">
            <!-- <h4>Nev:

            </h4> -->
            <h4>
              Email:
              {{summary.email}}
              </h4>

            <h4>
            Nap: {{summary.start.substring(0,10)}}
            </h4>
            <h4>Erkezesi ido:
              {{summary.start.substring(11,16)}}
            </h4>

            <h4>Tavozasi ido:
               {{summary.end.substring(11,16)}}
            </h4>
            <h4>Vendegek szama:
              {{summary.table.nr_of_chairs}}
            </h4>
          </div>
        </div>
      </div>

    </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
  name: "app",
  data() {
    return {
        summary: {
          table: {},
          host: {},
          start: '',
          end: '',
        },
    }
  },
  async mounted() {
    const res = await axios.get(`/reservations/${this.$route.params.id}`, this.form);
    this.summary = res.data;

    console.log(this.summary.email);
  },
  components: {
  },
  methods: {
  },
}
</script>

<style>
div#feedback_page{
    font-family: Nunito, sans-serif;
    background-size: 100vw;
    background-color: #fff;
}

.find-pubs{
    position: absolute;
    width: 100vw;
    height: 100vh;
    background-color: #fff;
    border-bottom: 0.1em;
}

.app-header{
    position: relative;
    width: 100vw;
    padding-left: 1em;
    padding-top: 1em;
    box-sizing: border-box;
}

.home-button{
    position: absolute;
    top: 40%;

}



h1{
    text-align: center;
    margin: 0;
}

.logo{
    text-align: center;
    margin-top: 3em;
}

.logo img{
    border-radius: 50px;
}

h2,h3{
    text-align: center;
}

.box{
    border-radius: 10px;
    box-sizing: border-box;
    background-color: rgb(153, 153, 153, 0.2);
    margin: 1em;
}

.texts{
    padding: 1em 0em;
    padding-left: 1em;
}

h4{
    margin: 0;
}
</style>
