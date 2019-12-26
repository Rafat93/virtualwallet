require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import Toasted from 'vue-toasted';
import BootstrapVue from 'bootstrap-vue';

import components from "./components";

Vue.use(BootstrapVue);
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.config.productionTip = false;

Vue.use(VueRouter);
Vue.use(Toasted, {
    position: "bottom-center",
    duration: 5000,
    type: "info"
});

import store from "./stores/global-store";
import frontend from "./frontend_functions.js";

const routes = [
    { path: '/', redirect: '/welcome' },
    { path: '/login', component: login},
    { path: '/welcome', component: welcome},
    { path: '/register', component: components.values.register},
    { path: '/navbar', component: navbar},
    { path: '/home', component: homePage},
    { path: '/movements', component: movements },
    { path: '/register_expense', component: registerExpense },
    { path: '/statistics', component: statisticsHomePage },
    { path: '/profile', component: profile },
    { path: '/profile_edit', component: profileEdit },
    { path: '/create_user', component: createUser},


];

const router = new VueRouter({
    //mode: 'history',
    routes:routes
});

router.beforeEach((to, from, next) => {
    if (to.name == "logout") {
        if (!store.state.user) {
            next("/login");
            return;
        }
    }
    next();
});


const app = new Vue({
    router,
    store,
    frontend,
    created() {
        console.log("-----");
        console.log(this.$store.state.user);
        this.$store.commit("loadTokenAndUserFromSession");
        console.log(this.$store.state.user);
    }
}).$mount('#app');
