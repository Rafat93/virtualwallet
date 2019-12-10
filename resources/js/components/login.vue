<template>
    <div id="page">
        <navbarwelcome></navbarwelcome>
        <div class="login-page" id="body">
            <div class="form">
                <div class="alert" :class="typeofmsg" v-if="showMessage">
                    <button type="button" class="close-btn" v-on:click="showMessage = false">
                        x
                    </button>
                    <strong>{{message}}</strong>
                </div>
                <form class="login-form">
                    <input
                        type="email"
                        placeholder="Email address"
                        id="inputEmail"
                        name="email"
                        class="form-control"
                        v-model.trim="user.email"
                    />
                    <input
                        type="password"
                        placeholder="Password"
                        class="form-control"
                        id="inputPassword"
                        name="password"
                        v-model="user.password"
                    />
                    <button v-on:click.prevent="login">Login</button>
                    <p class="message">Not registered? <router-link to="/register">Create an account</router-link></p>
                </form>
            </div>
        </div>
    </div>


</template>
<script type="text/javascript">
    export default {
        data: function() {
            return {
                user: {
                    email: "",
                    password: ""
                },
                typeofmsg: "alert-success",
                showMessage: false,
                message: ""
            };
        },
        methods: {
            login() {
                this.showMessage = false;
                axios
                    .post("api/login", this.user)
                    .then(response => {
                        this.$store.commit("setToken", response.data.access_token);
                        /*return axios.get("api/users/me");*/
                        this.$router.push('/home');
                    })
                    .then(response => {
                        this.$store.commit("setUser", response.data.data);
                        this.typeofmsg = "alert-success";
                        this.message = "user authenticated correctly";
                        this.showMessage = true;
                    })
                    .catch(error => {
                        this.$store.commit("clearUserAndToken");
                        this.typeofmsg = "alert-danger";
                        this.message = "Invalid credentials";
                        this.showMessage = true;
                        console.log(error);
                    });
            }
        }
    };
</script>
<style>

@import url(https://fonts.googleapis.com/css?family=Roboto:300);

#page{
    margin-top: 50px;
}
.login-page {
    width: 360px;
    padding: 8% 0 0;
    margin: auto;
}
.form {
    position: relative;
    z-index: 1;
    background: #FFFFFF;
    max-width: 360px;
    margin: 0 auto 100px;
    padding: 45px;
    text-align: center;
    box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input {
    font-family: "Roboto", sans-serif;
    outline: 0;
    background: #f2f2f2;
    width: 100%;
    border: 0;
    margin: 0 0 15px;
    padding: 15px;
    box-sizing: border-box;
    font-size: 14px;
}
.form button {
    font-family: "Roboto", sans-serif;
    text-transform: uppercase;
    outline: 0;
    background: #4CAF50;
    width: 100%;
    border: 0;
    padding: 15px;
    color: #FFFFFF;
    font-size: 14px;
    -webkit-transition: all 0.3 ease;
    transition: all 0.3 ease;
    cursor: pointer;
}
.form button:hover,.form button:active,.form button:focus {
    background: #43A047;
}
.form .message {
    margin: 15px 0 0;
    color: #b3b3b3;
    font-size: 12px;
}
.form .message a {
    color: #4CAF50;
    text-decoration: none;
}
.form .register-form {
    display: none;
}

</style>
