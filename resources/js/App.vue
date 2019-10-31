<template>
    <div id="app">
        <input v-model="search" @change="onChange">
        <ul>
            <li v-for="host in hosts" v-bind:key="host.id">
                {{ host.name }} {{ host }}
            </li>
        </ul>
        <div>
            {{ search }}
        </div>
    </div>
</template>

<script>
// import Login from "./components/layout/Login.vue";
// const axios = require('axios')
import axios from 'axios'

export default {
    name: "app",
    data() {
        return {
            search: '',
            hosts: [],
        }
    },
    components: {
        // Login
    },
    mounted() {
        this.getData()
    },
    computed: {
    },
    // watch: {
    //     search(val) {
    //         console.log(val)
    //     }
    // },
    methods: {
        async onChange() {
            console.log('change', this.search)
            const response = await axios.get('/hosts/', {
                params: {
                    search: this.search
                }
            }).catch(error => console.log(error))
            this.hosts = response.data
        },
        async getData() {
            console.log('get data start')
            const response = await axios.get('/hosts/').catch(error => console.log(error))
            this.hosts = response.data
            console.log('get data end')
        }
    }
}
</script>

<style>
</style>