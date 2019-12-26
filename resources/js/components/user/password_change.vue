<template>
    <div class="card" style="margin-left: 150px; margin-right: 150px;">
        <div class="card-header">
            Password Change
        </div>
        <div class="card-body ">
            <div class="form-group">
                <p class="font-weight-bold">Old Password:</p>
                <input type="password" v-model="old_password" name="name" value="" class="form-control" >
            </div>
            <div class="form-group">
                <p class="font-weight-bold">New Password:</p>
                <input type="password" v-model="new_password" name="name" value="" class="form-control" >
            </div>
            <div class="form-group">
                <p class="font-weight-bold">Password Confirmation:</p>
                <input type="password" v-model="password_confirmation" name="name" value="" class="form-control" >
            </div>
            <div class="form-group" style="text-align: center;">
                <button v-on:click.prevent="verify(user)" class="btn btn-success">Save</button>
                <button v-on:click.prevent="cancelEdit(user)" class="btn btn-danger">Cancel</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "password_change",
        data: function(){
            return {
                user: '',
                old_password: '',
                new_password: '',
                password_confirmation: '',
                hash: '',
            }
        },
        methods: {
            getUserInfo: function(){
                //console.log(this.$store.state.token);

                axios.get('api/users/me',{'headers': {'Authorization': 'Bearer '+this.$store.state.token}})
                    .then(response=>{this.user = response.data.data;
                        console.log(this.user)});


            },
            verify: function(user){
                console.log("ENTROU");

                this.hash = Hash(this.old_password);
                if (this.hash == this.user.password){
                    console.log("PASSOU");
                }
                if(this.new_password == this.password_confirmation){
                    console.log("IGUAIS")
                }
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
