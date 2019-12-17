<template>
    <div>
        <navbar/>
        <div class="inside_content">
            <div class="card" style="margin-left: 80px; margin-right: 80px; margin-top: 20px;">
                <div class="card-header">
                    Personal Information

                </div>
                <div class="card-body ">
                    <div class="form-group">
                        <!--
                                                <img src="/database/seeds/fotos/{{user.photo}}">
                        -->
                    </div>

                    <p class="font-weight-normal">Name:</p>
                    <input type="text" v-model="user.name"  class="form-control" >
                    <p class="font-weight-normal">Email:</p>
                    <p class="font-weight-light" >{{user.email}}</p>
                    <p class="font-weight-normal">NIF:</p>
                    <input type="text" v-model="user.nif"  class="form-control" >
                    <p class="font-weight-normal">Type:</p>
                    <p class="font-weight-light" >{{user.type}}</p>

                </div>
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
                    .then(response=>{this.user = response.data.data; });


            },
        },

        mounted() {
            this.getUserInfo();
        }
    }
</script>

<style scoped>
    .inside_content{
        margin-top: 56px;
        margin-left: 60px;
        overflow-y: auto;
        height: 92vh;
    }
</style>
