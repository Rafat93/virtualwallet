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
                    <b-col>
                        <b-card style="margin-right: 200px; margin-left: 200px;" align="center" header-bg-variant="info">
                            <template v-slot:header>
                                <h4 class="mb-2">Information about your wallet</h4>
                            </template>

                            <b-row>
                                <b-col cols="2" >
                                    <b-card
                                        border-variant="secondary"
                                        header="Current Balance"
                                        header-border-variant="secondary"
                                        align="center"
                                    >
                                        <b-card-text>{{wallet.balance}}€</b-card-text>
                                    </b-card>
                                </b-col>
                                <b-col>
                                    <b-card
                                        border-variant="secondary"
                                        header="Last Movements"
                                        header-border-variant="secondary"
                                        align="center"
                                    >
                                        <b-table striped hover :items="movements" :fields="fields" >
                                            <template v-slot:cell(name)="row">
                                                {{ row.value.first }} {{ row.value.last }}
                                            </template>
                                        </b-table>
                                    </b-card>
                                </b-col>
                            </b-row>

                                <!--information here-->

                        </b-card>
                    </b-col>
                </b-row>
            </div>
            <div v-if="type == 'Administrator'">
                <b-row style="margin-top: 20px">
                    <b-col style="text-align: center">
                        <h1>Welcome back Admin</h1>
                        <h4>{{user.name}}</h4>

                    </b-col>
                </b-row>
            </div>
            <div v-if="type == 'Operator'">
                <b-row style="margin-top: 20px">
                    <b-col style="text-align: center">
                        <h1>Welcome back Operator</h1>
                        <h4>{{user.name}}</h4>

                    </b-col>
                </b-row>
                <b-row>

                </b-row>
            </div>

        </div>
    </div>
</template>

<script>

    export default {
        data: function(){
            return {
                type: '',
                user: '',
                wallet: '',
                movements: [],
                fields: [
                    {
                        key: 'type',
                        sortable: true,
                    },
                    {
                        key: 'date',
                        sortable: true,
                    },
                    {
                        key: 'value',
                        sortable: true,
                    },
                    {
                        key: 'start_balance',
                        sortable: true,
                    },
                    {
                        key: 'end_balance',
                        sortable: true,
                    }
                ],
            }
        },
        name: "home",
        components:{
        },
        methods:{
            userType: function(){

                axios.get('api/users/me',{'headers': {'Authorization': 'Bearer '+this.$store.state.token}})
                    .then(response=>{this.user = response.data.data;
                    this.type = this.user.type;});

             },
            getWallet: function () {
                axios.get('api/users/'+this.user.id+'/wallet/my',{'headers': {'Authorization': 'Bearer '+this.$store.state.token}})
                    .then(response=>{this.wallet = response.data.data;
                        console.log("Wallet:");
                        console.log(this.wallet);
                        });
            },
            getLastMovements: function (){
                axios.get('api/users/'+this.$store.state.user.id+'/last',{'headers': {'Authorization': 'Bearer '+this.$store.state.token}})
                    .then(response=> {
                        this.movements = response.data.data;
                    });


            },
        },
        mounted() {
            this.userType();
            if(this.type === 'user') {
                this.getWallet();
                this.getLastMovements();
            }
        }
    }
</script>

<style scoped>

</style>
