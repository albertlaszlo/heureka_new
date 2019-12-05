import Vue from "vue";
import Router from "vue-router";

import Admin from "./components/Admin.vue";
import Create from "./components/Create.vue";
import Home from "./components/Home.vue";
import Reservation from "./components/Reservation.vue";
import Summary from "./components/Summary.vue";

Vue.use(Router);

export default new Router({
    mode: "history",
    base: process.env.BASE_URL,
    routes: [
        { path: "/admin/create", name: "create", component: Create },
        { path: "/admin", name: "admin", component: Admin },
        { path: "/", name: "search", component: Home },
        { path: "/reservation/:id", name: "reservation", component: Reservation },
        { path: "/summary/:id", name: "summary", component: Summary },
    ]
});
