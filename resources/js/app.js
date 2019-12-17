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

import store from "./stores/global-store";
import frontend_functions from "./frontend_functions";

import MovementCompenent from './components/movement/movement.vue';
const movements = Vue.component('movements',MovementCompenent);

import ProfileComponent from './components/user/profile.vue';
const profile = Vue.component('profile', ProfileComponent);

import RegisterExpenseComponent from './components/user/register_expense.vue';
const registerExpense = Vue.component('registerExpense', RegisterExpenseComponent);

import NavBarComponent from './components/navbar.vue';
const navbar = Vue.component('navbar', NavBarComponent);

import LoginComponent from './components/all_users/login.vue';
const login = Vue.component('login', LoginComponent);

import WelcomeComponent from './components/all_users/welcome.vue';
const welcome = Vue.component('welcome', WelcomeComponent);

import RegisterComponent from './components/all_users/register.vue';
const register  = Vue.component('register', RegisterComponent);

import NavBarWelcomeComponent from './components/all_users/navbar_welcome.vue';
const navbarwelcome  = Vue.component('navbarwelcome', NavBarWelcomeComponent);

import HomePage from './components/user/home.vue';
const homePage = Vue.component('homePage',HomePage);

Vue.config.productionTip = false;

import StatisticsHomePage from './components/statistics/home_statistics.vue';
const statisticsHomePage = Vue.component('statisticsHomePage', StatisticsHomePage);

import ProfileEdit from './components/user/profile_edit.vue';
const profileEdit = Vue.component('profileEdit', ProfileEdit);

const routes = [
    { path: '/', redirect: '/welcome' },
    { path: '/login', component: login},
    { path: '/welcome', component: welcome},
    { path: '/register', component: register},
    { path: '/navbar', component: navbar},
    { path: '/home', component: homePage},
    { path: '/movements', component: movements },
    { path: '/register_expense', component: registerExpense },
    { path: '/statistics', component: statisticsHomePage },
    { path: '/profile', component: profile },
    { path: '/profile_edit', component: profileEdit },

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
    frontend_functions,
    created() {
        console.log("-----");
        console.log(this.$store.state.user);
        this.$store.commit("loadTokenAndUserFromSession");
        console.log(this.$store.state.user);
    }
}).$mount('#app');
