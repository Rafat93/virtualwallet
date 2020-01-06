require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import Toasted from 'vue-toasted';
import BootstrapVue from 'bootstrap-vue';
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import store from "./stores/global-store";
import frontend from "./frontend_functions.js";
import Vuelidate from 'vuelidate'
import components from "./components";


Vue.use(BootstrapVue);
Vue.config.productionTip = false;
Vue.use(Vuelidate);
Vue.use(VueRouter);
Vue.use(Toasted, {
    position: "bottom-center",
    duration: 5000,
    type: "info"
});

const routes = [
    { path: '/', redirect: '/welcome' },
    { path: '/login',
        component: components.values.login},
    { path: '/welcome', component: components.values.welcome},
    { path: '/register', component: components.values.register},
    { path: '/navbar', component: components.values.navbar},
    { path: '/home', component: components.values.homePage},
    { path: '/movements', component: components.values.movements },
    { path: '/register_expense', component: components.values.registerExpense },
    { path: '/statistics', component: components.values.statisticsHomePage },
    { path: '/profile', component: components.values.profile },
    { path: '/profile_edit', component: components.values.profileEdit },
    { path: '/create_user', component: components.values.createUser},
    { path: '/change_password', component: components.values.changePassword},
    { path: '/register_income', component: components.values.registerIncome},


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
        //console.log("-----");
        //console.log(this.$store.state.user);
        this.$store.commit("loadTokenAndUserFromSession");
       // console.log(this.$store.state.user);
    }
}).$mount('#app');
