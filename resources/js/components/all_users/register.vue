<template>
    <div id="page" >
       <navbarwelcome></navbarwelcome>
        <div class="login-page">
            <div class="form">
                <form>
                    <input type="text" placeholder="name" required/>
                    <input type="password" placeholder="password" required/>
                    <input type="email" placeholder="email address" required/>
                    <input type="text" placeholder="NIF" required/>
                    <label for="inputPhoto" class="message" style="color: #333333">Please enter a photographie:</label>
                    <input id="inputPhoto" type="file" placeholder="Photo" required>
                    <button>create</button>
                    <p class="message">Already registered? <router-link to="/login">Sign In</router-link></p>
                </form>
            </div>
        </div>
    </div>
</template>
<style>
    #page{
        margin-top: 50px;
    }
</style>

