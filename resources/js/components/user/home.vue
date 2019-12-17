<template>
    <div>
        <navbar/>
        <div class="inside_content">
            Component Home
            {{type}}

        </div>


    </div>

</template>

<script>
    export default {
        data: function(){
            return {
                type: '',
                user: '',

            }
        },
        name: "home",

        methods:{
             isAdministrator: function(){

                axios.get('api/users/me',{'headers': {'Authorization': 'Bearer '+this.$store.state.token}})
                    .then(response=>{this.user = response.data.data;
                    console.log(this.user);
                    this.type = this.user.type;});

            },
        },
        mounted() {
            this.isAdministrator();
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
