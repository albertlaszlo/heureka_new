<template>
    <div id="app">
        <input v-model="search" @change="onChange">
        <ul>
            <li v-for="host in hosts" v-bind:key="host.id">
                {{ host.name }} ({{ host.id }})
                <button @click="onRemove(host.id)">Remove</button>
            </li>
        </ul>
        <div>
            {{ search }}
        </div>

        <hr>
        <input v-model="form.name" /> <br>
        <input v-model="form.description" /> <br>
        <input v-model="form.city" /> <br>
        <button @click="onAdd">Add</button>
        {{ form }}
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
            form: {
                name: '',
                description: '',
                city: '',
            }
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
        async onAdd() {
            console.log('add', this.form)
            const response = await axios.post('/hosts/', this.form).catch(error => console.log(error))
            this.getData()
        },
        async onRemove(id) {
            console.log('remove', id)
            const response = await axios.delete('/hosts/'+id).catch(error => console.log(error))
            this.getData()
        },
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