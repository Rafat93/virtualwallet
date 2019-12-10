require('../../../../../Users/Joana/Desktop/PROJETO_CERTO/resources/js/bootstrap');
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import { library } from '@fortawesome/fontawesome-svg-core'
import { faUserSecret } from '@fortawesome/free-solid-svg-icons'
import { faWallet } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faUserSecret);
library.add(faWallet);
Vue.component('font-awesome-icon', FontAwesomeIcon);

import store from "../../../../../Users/Joana/Desktop/PROJETO_CERTO/resources/js/stores/global-store";

import NavBarComponent from '../../../../../Users/Joana/Desktop/PROJETO_CERTO/resources/js/components/user/navbar.vue';
const navbar = Vue.component('navbar', NavBarComponent);

import LoginComponent from '../../../../../Users/Joana/Desktop/PROJETO_CERTO/resources/js/components/login.vue';
const login = Vue.component('login', LoginComponent);

import WelcomeComponent from '../../../../../Users/Joana/Desktop/PROJETO_CERTO/resources/js/components/welcome.vue';
const welcome = Vue.component('welcome', WelcomeComponent);

import RegisterComponent from '../../../../../Users/Joana/Desktop/PROJETO_CERTO/resources/js/components/register.vue';
const register  = Vue.component('register', RegisterComponent);

import NavBarWelcomeComponent from '../../../../../Users/Joana/Desktop/PROJETO_CERTO/resources/js/components/navbar_welcome.vue';
const navbarwelcome  = Vue.component('navbarwelcome', NavBarWelcomeComponent);

import HomePage from '../../../../../Users/Joana/Desktop/PROJETO_CERTO/resources/js/components/user/home.vue';
const homePage = Vue.component('homePage',HomePage);

Vue.config.productionTip = false;


const routes = [
    { path: '/', redirect: '/welcome' },
    { path: '/login', component: login},
    { path: '/welcome', component: welcome},
    { path: '/register', component: register},
    { path: '/navbar', component: navbar},
    { path: '/home', component: homePage},
];

const router = new VueRouter({
    routes:routes
});


const app = new Vue({
    router,
    store,
}).$mount('#app');
