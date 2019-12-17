<template>
    <div>
        <navbar/>
        <div class="inside_content">
            <div class="content_title">
                Profile
            </div>

            <div class="card" style="margin-left: 80px; margin-right: 80px;" v-if="editingUser == 0">
                <div class="card-header">
                    Personal Information
                    <button class="btn btn-sm btn-dark" style="float: right;" v-on:click="editingUser = 1">Edit</button>
                </div>
                <div class="card-body ">
                    <div class="form-group">
<!--
                        <img src="/database/seeds/fotos/{{user.photo}}">
-->
                    </div>

                    <p class="font-weight-normal">Name:</p>
                    <p class="font-weight-light" >{{user.name}}</p>
                    <p class="font-weight-normal">Email:</p>
                    <p class="font-weight-light" >{{user.email}}</p>
                    <p class="font-weight-normal">NIF:</p>
                    <p class="font-weight-light" >{{user.nif}}</p>
                    <p class="font-weight-normal">Type:</p>
                    <p class="font-weight-light" >{{user.type}}</p>

                </div>
            </div>
            <div v-if="editingUser == 1">
                <profileEdit></profileEdit>
            </div>
        </div>


    </div>
</template>

<script>
       export default {
        data: function(){
            return {
                user: '',
                editingUser : 0,
            }
        },
        methods: {
            getUserInfo: function(){
                //console.log(this.$store.state.token);

                axios.get('api/users/me',{'headers': {'Authorization': 'Bearer '+this.$store.state.token}})
                    .then(response=>{this.user = response.data.data; });


            },
        },

        mounted() {
            this.getUserInfo();
        }
    }
</script>

<style scoped>

</style>
