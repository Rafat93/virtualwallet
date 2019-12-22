<template>
    <div id="page" >
       <navbarwelcome></navbarwelcome>
        <div class="login-page">
            <div class="form">
                <form>
                    <input type="text" placeholder="name" v-model="user.name" required/>
                    <input type="password" placeholder="password" v-model.trim="user.password"required/>
                    <input type="password" placeholder="confirm password" v-model.trim="user.confirm_password"required/>
                    <input type="email" placeholder="email address" v-model.trim="user.email" required/>
                    <input type="text" placeholder="NIF" v-model.trim="user.nif" required/>
                    <label for="inputPhoto" class="message" v-model="user.file_photo" style="color: #333333">Please enter a photographie:</label>
                    <input id="inputPhoto" type="file" placeholder="Photo">
                    <a class="btn btn-primary" v-on:click.prevent="register">Create</a>
                    <p class="message">Already registered? <router-link to="/login">Sign In</router-link></p>
                </form>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
    export default {
        data: function () {
            return {
                user: {
                    name: "",
                    email: "",
                    password:"",
                    confirm_password:"",
                    nif: "",
                    file_photo: "",
                },
                typeofmsg: "alert-success",
                showMessage: false,
                message: ""
            };
        },
        methods: {
            register(){
                this.showMessage = false;
                axios
                .post("api/register,",this.user)
                .then (response => {
                    this.$store.commit("setToken", response.data.access_token);
                    return axios.get("api/users/me");
                }).then(response => {
                    this.$store.commit("setUser", response.data.data);
                    this.typeofmsg = "alert-success";
                    this.message = "User Register Correctly";
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
    }
</script>
<style>
    #page{
        margin-top: 50px;
    }
</style>

