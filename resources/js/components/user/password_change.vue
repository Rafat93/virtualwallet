<template>
    <div>
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
                    <input type="password" v-model="password" name="name" value="" class="form-control" >
                </div>
                <div class="form-group">
                    <p class="font-weight-bold">Password Confirmation:</p>
                    <input type="password" v-model="password_confirmation" name="name" value="" class="form-control" >
                </div>
                <div class="form-group" style="text-align: center;">
                    <b-btn v-on:click.prevent="verify(user)" :disabled="password === '' || old_password === '' || password_confirmation === ''" class="btn btn-success">Save</b-btn>
                    <button v-on:click.prevent="cancelEdit(user)" class="btn btn-danger">Cancel</button>
                </div>
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
                request: '',
                old_password: '',
                password: '',
                password_confirmation: '',
                hash: '',

                /*Dados Toast*/
                message_toast:"",
                title_toast:'',
                variant: '',
            }
        },
        methods: {
            makeToast(toaster, append = false) {
                console.log("Entrou toast");
                console.log(this.variant+"/"+this.toaster);
                this.$bvToast.toast(this.message_toast, {
                    title: this.title_toast,
                    solid: true,
                    toaster: toaster,
                    variant: this.variant,
                    autoHideDelay: 5000,
                    appendToast: append,
                })
            },
            getUserInfo: function(){
                //console.log(this.$store.state.token);
                axios.get('api/users/me',{'headers': {'Authorization': 'Bearer '+this.$store.state.token}})
                    .then(response=>{this.user = response.data.data;
                        console.log(this.user)});


            },
            verify: function(user){
                console.log("ENTROU");
                let bcrypt = require('bcryptjs');
                let salt = bcrypt.genSaltSync(10);
                this.hash = bcrypt.hashSync(this.old_password,salt);
                console.log("Nova:"+this.hash);
                console.log (this.user.password);
                if (!bcrypt.compareSync(this.old_password,this.user.password)){
                    console.log("PASSOU");
                    this.message_toast = "Old Password doesn't match!";
                    this.title_toast = "Wrong old Password";
                    this.variant = 'warning';
                    this.old_password = '';
                    this.makeToast('b-toaster-top-center');
                    return;
                }
                if(!this.password === this.password_confirmation){
                    console.log("Diferentes")
                    this.message_toast = "Confirm and New Password doesn't match each other !";
                    this.title_toast = "Wrong Confirmation";
                    this.variant = 'warning';
                    this.password = '';
                    this.password_confirmation = '';
                    this.makeToast('b-toaster-top-center');
                    return;
                }
                this.message_toast = "Successfull change password!";
                this.title_toast = "Success";
                this.variant = 'success';
                this.makeToast('b-toaster-top-center');
                this.saveUser();
            },
            saveUser: function () {
                this.request = {
                    old_password: this.old_password,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                };
                console.log(this.request);
                axios
                    .put('api/users/'+this.user.id+'/password', this.request, {'headers': {'Authorization': 'Bearer '+ this.$store.state.token}})
                    .then(response=>{
                        // Copies response.data.data properties to this.user
                        // without changing this.user reference
                        Object.assign(this.user, response.data.data);
                        this.$emit('done');
                    });
            },
            cancelEdit: function () {
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
