// require('./bootstrap');
import Vue from "vue"
import App from "./App.vue"

window.Vue = new Vue({
    // router,
    // store,
    render: h => h(App),
}).$mount("#app");