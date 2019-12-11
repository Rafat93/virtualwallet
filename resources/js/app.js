require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import Toasted from 'vue-toasted';

Vue.use(VueRouter);
Vue.use(Toasted, {
    position: "bottom-center",
    duration: 5000,
    type: "info"
});

/*import { library } from '@fortawesome/fontawesome-svg-core'
import { faUserSecret } from '@fortawesome/free-solid-svg-icons'
import { faWallet } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faUserSecret);
library.add(faWallet);
Vue.component('font-awesome-icon', FontAwesomeIcon);*/

import store from "./stores/global-store";

import MovementCompenent from './components/movement/movement.vue';
const movements = Vue.component('movements',MovementCompenent);

import NavBarComponent from './components/user/navbar.vue';
const navbar = Vue.component('navbar', NavBarComponent);

import LoginComponent from './components/login.vue';
const login = Vue.component('login', LoginComponent);

import WelcomeComponent from './components/welcome.vue';
const welcome = Vue.component('welcome', WelcomeComponent);

import RegisterComponent from './components/register.vue';
const register  = Vue.component('register', RegisterComponent);

import NavBarWelcomeComponent from './components/navbar_welcome.vue';
const navbarwelcome  = Vue.component('navbarwelcome', NavBarWelcomeComponent);

import HomePage from './components/user/home.vue';
const homePage = Vue.component('homePage',HomePage);

Vue.config.productionTip = false;


const routes = [
    { path: '/', redirect: '/welcome' },
    { path: '/login', component: login},
    { path: '/welcome', component: welcome},
    { path: '/register', component: register},
    { path: '/navbar', component: navbar},
    { path: '/home', component: homePage},
    { path: '/movements', component: movements },
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
    created() {
        console.log("-----");
        console.log(this.$store.state.user);
        this.$store.commit("loadTokenAndUserFromSession");
        console.log(this.$store.state.user);
    }
}).$mount('#app');
