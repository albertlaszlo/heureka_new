import Vue from "vue";
import Router from "vue-router";

import Admin from "./components/Admin.vue";
import Home from "./components/Home.vue";
import Reservation from "./components/Reservation.vue";

Vue.use(Router);

export default new Router({
    mode: "history",
    base: process.env.BASE_URL,
    routes: [
        { path: "/admin", name: "admin", component: Admin },
        { path: "/", name: "search", component: Home },
        { path: "/reservation", name: "reservation", component: Reservation }
    ]
});
