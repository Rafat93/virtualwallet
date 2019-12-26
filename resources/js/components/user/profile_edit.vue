<template>
    <div class="card" style="margin-left: 150px; margin-right: 150px;">
        <div class="card-header">
            Personal Information
        </div>
        <div class="card-body ">
            <div class="form-group">
                <!--
                                        <img src="/database/seeds/fotos/{{user.photo}}">
                -->
            </div>
            <div class="form-group">
                <p class="font-weight-bold">Name:</p>
                <input type="text" v-model="user.name" name="name" value="" class="form-control" >
            </div>

            <div class="form-group">
                <p class="font-weight-bold">Email:</p>
                <p class="font-weight-light">{{user.email}}</p>
            </div>
            <div class="form-group">
                <p class="font-weight-bold">Password:</p>
                <input type="password" class="form-control">
            </div>
            <div class="form-group">
                <p class="font-weight-bold">NIF:</p>
                <input type="text" v-model="user.nif"  class="form-control" >
            </div>
            <div class="form-group">
                <p class="font-weight-bold">Type:</p>
                <p class="font-weight-light" >{{user.type}}</p>
            </div>

            <div class="form-group" style="text-align: center;">
                <button v-on:click.prevent="saveUser(user)" class="btn btn-success">Save</button>
                <button v-on:click.prevent="cancelEdit(user)" class="btn btn-danger">Cancel</button>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                user: '',
            }
        },
        methods: {
            getUserInfo: function(){
                //console.log(this.$store.state.token);

                axios.get('api/users/me',{'headers': {'Authorization': 'Bearer '+this.$store.state.token}})
                    .then(response=>{this.user = response.data.data;
                    console.log(this.user)});


            },
            saveUser: function () {
                axios.put('api/users/'+this.user.id, this.user, {'headers': {'Authorization': 'Bearer '+ this.$store.state.token}})
                    .then(response=>{
                        // Copies response.data.data properties to this.user
                        // without changing this.user reference
                        Object.assign(this.user, response.data.data);
                        this.$emit('done');
                    });


            },
            cancelEdit: function (user) {
                axios.get('api/users/'+this.user.id,{'headers': {'Authorization': 'Bearer '+ this.$store.state.token}})
                    .then(response=>{
                        Object.assign(this.user, response.data.data);
                        this.$emit('done');
                    });


            }
        },

        mounted() {
            this.getUserInfo();
        }
    }
</script>

<style scoped>

</style>
