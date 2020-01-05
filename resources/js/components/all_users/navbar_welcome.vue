<template>
    <div id="navbarwelcome">
        <nav  class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
                <ul class="navbar-nav mr-auto">
                    <li class="">
                        <router-link to="/welcome" class="nav-link">Home</router-link>
                    </li>
                </ul>
            </div>
            <div class="mx-auto order-0">
                <a class="navbar-brand mx-auto" style="color: white">VirtualWallet</a>

            </div>
            <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <router-link to="/login" class="nav-link">Login</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/register" class="nav-link">Register</router-link>
                    </li>
                </ul>
            </div>
        </nav>
    </div>


</template>
<style>
    #navbarwelcome{
        display: block;
    }
    .navbar{
        overflow: hidden;
        position: fixed; /* Set the navbar to fixed position */
        top: 0; /* Position the navbar at the top of the page */
        width: 100%; /* Full width */

    }
</style>
