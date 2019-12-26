<template>
    <div>
        <navbar/>
        <div class="inside_content">
            <div v-if="type == 'user'">
                <b-row style="margin-top: 20px">
                    <b-col style="text-align: center">
                        <h1>Welcome back</h1>
                        <h4>{{user.name}}</h4>

                    </b-col>
                </b-row>
                <b-row>
                    <b-col cols="3" >
                        <div class="card ">
                            <div class="card-header bg-info">Current Balance</div>
                            <div class="card-body">{{wallet.balance}}€
                            </div>


                        </div>
                    </b-col>
                </b-row>
            </div>
            <div v-if="type == 'Administrator'">
                hey
            </div>
            <div v-if="type == 'Operator'">

            </div>


        </div>


    </div>

</template>

<script>

    import CommitChart from '../graphs/test';

    export default {
        data: function(){
            return {
                type: '',
                user: '',

                wallet: '',

            }
        },
        name: "home",
        components:{
            CommitChart,
        },

        methods:{
            userType: function(){

                axios.get('api/users/me',{'headers': {'Authorization': 'Bearer '+this.$store.state.token}})
                    .then(response=>{this.user = response.data.data;
                    this.getWallet();
                    this.type = this.user.type;});

             },
            getWallet: function () {
                axios.get('api/users/'+this.user.id+'/wallet/my',{'headers': {'Authorization': 'Bearer '+this.$store.state.token}})
                    .then(response=>{this.wallet = response.data.data;
                        console.log("Wallet:");
                        console.log(this.wallet);
                        });
            }
        },
        mounted() {
            this.userType();

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
