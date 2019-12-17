<template>
    <div id="navbarwelcome">
        <nav  class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            </div>
            <div class="mx-auto order-0">
                <a class="navbar-brand mx-auto" style="color: white">VirtualWallet</a>
            </div>
            <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">

            </div>
        </nav>
        <div class="area" ></div>
        <nav class="main-menu">
            <ul>
                <li>
                    <router-link class="nav-link" to="/home">
                        <i class="fa fa-home fa-2x"></i>
                        <span class="nav-text">
                                    Home
                                </span>
                    </router-link>
                </li>
                <li class="has-subnav">
                    <router-link class="nav-link" to="/register_expense">
                        <i class="fa fa-shopping-cart fa-2x"></i>
                        <span class="nav-text">
                                    Register Expense
                                </span>
                    </router-link>

                </li>
                <li class="has-subnav">
                    <router-link class="nav-link" to="/movements">
                        <i class="fa fa-list fa-2x"></i>
                        <span class="nav-text">
                                    Movements
                                </span>
                    </router-link>

                </li>
                <li>
                    <router-link class="nav-link" to="/statistics">
                        <i class="fa fa-bar-chart-o fa-2x"></i>
                        <span class="nav-text">
                                    Graphs and Statistics
                                </span>
                    </router-link>
                </li>
                <li>
                    <router-link class="nav-link" to="/profile">
                        <i class="fa fa-user fa-2x"></i>
                        <span class="nav-text">
                                    Profile
                                </span>
                    </router-link>
                </li>
                <div v-if="type === 'Administrator'">
                    <li>
                        <router-link class="nav-link" to="/profile">
                            <i class="fa fa-suitcase fa-2x"></i>
                            <span class="nav-text">
                                    Create Account
                                </span>
                        </router-link>
                    </li>
                </div>

            </ul>

            <ul class="logout">
                <li>
                    <a v-on:click.prevent="logout">
                        <i class="fa fa-power-off fa-2x"></i>
                        <span class="nav-text">
                                    Logout
                        </span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

</template>
<script type="text/javascript">
    export default {
        data: function(){
            return {
                type: '',
                user: '',

            }
        },

        methods: {
            typeOfUser: function(){

                axios.get('api/users/me',{'headers': {'Authorization': 'Bearer '+this.$store.state.token}})
                    .then(response=>{this.user = response.data.data;
                        console.log(this.user);
                        this.type = this.user.type;});

            },
            logout() {
                axios
                    .post("api/logout")
                    .then(response => {
                        this.$store.commit("clearUserAndToken");
                        this.$toasted.show("Logout Success!");
                        this.$router.push('/welcome');
                        console.log("User Logged Out");
                    })
                    .catch(error => {
                        this.$store.commit("clearUserAndToken");
                        console.log(error);
                    });
            },

        },
        mounted() {
            this.typeOfUser();
        }
    };
</script>
<style>
    @import url(//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css);

    @import url(https://fonts.googleapis.com/css?family=Titillium+Web:300);
    .fa-2x {
        font-size: 2em;
    }
    .fa {
        position: relative;
        display: table-cell;
        width: 60px;
        height: 36px;
        text-align: center;
        vertical-align: middle;
        font-size:20px;
    }


    .main-menu:hover,nav.main-menu.expanded {
        width:250px;
        overflow:visible;
    }

    .main-menu {
        background:#343A40;
        border-right:1px solid #e5e5e5;
        position:absolute;
        top:0;
        bottom:0;
        height:100%;
        left:0;
        width:60px;
        overflow:hidden;
        -webkit-transition:width .05s linear;
        transition:width .05s linear;
        -webkit-transform:translateZ(0) scale(1,1);
        z-index:1000;
    }

    .main-menu>ul {
        margin:7px 0;
    }

    .main-menu li {
        position:relative;
        display:block;
        width:250px;
    }

    .main-menu li>a {
        position:relative;
        display:table;
        border-collapse:collapse;
        border-spacing:0;
        color:#999;
        font-family: arial;
        font-size: 14px;
        text-decoration:none;
        -webkit-transform:translateZ(0) scale(1,1);
        -webkit-transition:all .1s linear;
        transition:all .1s linear;

    }

    .main-menu .nav-icon {
        position:relative;
        display:table-cell;
        width:60px;
        height:36px;
        text-align:center;
        vertical-align:middle;
        font-size:18px;
    }

    .main-menu .nav-text {
        position:relative;
        display:table-cell;
        vertical-align:middle;
        width:190px;
        font-family: 'Titillium Web', sans-serif;
    }

    .main-menu>ul.logout {
        position:absolute;
        left:0;
        bottom:0;
    }

    .no-touch .scrollable.hover {
        overflow-y:hidden;
    }

    .no-touch .scrollable.hover:hover {
        overflow-y:auto;
        overflow:visible;
    }

    a:hover,a:focus {
        text-decoration:none;
    }

    nav {
        -webkit-user-select:none;
        -moz-user-select:none;
        -ms-user-select:none;
        -o-user-select:none;
        user-select:none;
    }

    nav ul,nav li {
        outline:0;
        margin:0;
        padding:0;
    }
    .main-menu li:hover>a,nav.main-menu li.active>a,.dropdown-menu>li>a:hover,.dropdown-menu>li>a:focus,.dropdown-menu>.active>a,.dropdown-menu>.active>a:hover,.dropdown-menu>.active>a:focus,.no-touch .dashboard-page nav.dashboard-menu ul li:hover a,.dashboard-page nav.dashboard-menu ul li.active a {
        color:#fff;
        background-color:#5fa2db;
    }
    .area {

        float: left;
        background: #e2e2e2;
        width: 100%;
        height: 100%;
    }
    @font-face {
        font-family: 'Titillium Web';
        font-style: normal;
        font-weight: 300;
        src: local('Titillium WebLight'), local('TitilliumWeb-Light'), url(http://themes.googleusercontent.com/static/fonts/titilliumweb/v2/anMUvcNT0H1YN4FII8wpr24bNCNEoFTpS2BTjF6FB5E.woff) format('woff');
    }


    /*#navbarwelcome{
        display: block;
    }*/
    .navbar{
        overflow: hidden;
        position: fixed; /* Set the navbar to fixed position */
        top: 0; /* Position the navbar at the top of the page */
        width: 100%; /* Full width */

    }
    .sidemenu{
        margin-top: 55px;
        background-color: #343A40;
        color:white;
        height: auto !important;

    }

</style>
