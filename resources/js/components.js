import Vue from "vue";

import RegisterComponent from './components/all_users/register.vue';
const register  = Vue.component('register', RegisterComponent);

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


import NavBarWelcomeComponent from './components/all_users/navbar_welcome.vue';
const navbarwelcome  = Vue.component('navbarwelcome', NavBarWelcomeComponent);

import HomePage from './components/user/home.vue';
const homePage = Vue.component('homePage',HomePage);

import StatisticsHomePage from './components/statistics/home_statistics.vue';
const statisticsHomePage = Vue.component('statisticsHomePage', StatisticsHomePage);

import ProfileEdit from './components/user/profile_edit.vue';
const profileEdit = Vue.component('profileEdit', ProfileEdit);

import CreateUser from './components/administrator/create_user.vue';
const createUser = Vue.component('createUser', CreateUser);

import ChangePassword from './components/user/password_change.vue';
const changePassword = Vue.component('changePassword', ChangePassword);


 export default {

     values:{
         register,
         movements,
         profile,
         registerExpense,
         navbar,
         login,
         welcome,
         navbarwelcome,
         homePage,
         statisticsHomePage,
         profileEdit,
         createUser,
         changePassword,

     }
 }
