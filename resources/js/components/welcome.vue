<template>
    <div>
        <div style="position: relative; z-index: 1;">
            <navbarwelcome/>
        </div>

        <div class="container-fluid">
            <div class="row" id="row" style="margin-top: 56px;">
                <div class="col">
                    <img id="imagem" src="./images/computerWallet.png" alt="virtual wallet" style="z-index: -1;" width="500" height="500">
                </div>
                <div class="col">
                    <div class="row">
                        <p id="title">VirtualWallet</p>
                    </div>
                    <div class="row">
                        <p id="minititle">The best online wallet app for everyday banking.</p>
                    </div>
                    <div class="row">
                        <p id="number">Number of wallets we are corrently serving:</p>
                    </div>
                    <div class="row">
                        <p id="subtitle">{{numberWallets}}</p>
                    </div>


                </div>
            </div>
            <div class="row justify-content-center" >
                <p id="about" >About Virtual  Wallet</p>
            </div>
            <div class="row">
                <div class="col" align="center" >
                    <p class="col_header">Payments</p>
                    <p class="col_body">With VirtualWallet you can do all your payments, with high safety, to other VirtualWallet users or
                    to any external entity in just a few seconds.</p>
                    <img src="./images/payments.png" width="120" height="120">
                </div>
                <div class="col" align="center">
                    <p class="col_header">Movements</p>
                    <p class="col_body">With VirtualWallet you can do all your payments, with high safety, to other VirtualWallet users or
                        to any external entity in just a few seconds.</p>
                </div>
                <div class="col" align="center">
                    <p class="col_header">Statistics</p>
                    <p class="col_body">With VirtualWallet you can do all your payments, with high safety, to other VirtualWallet users or
                        to any external entity in just a few seconds.</p>
                    <img src="./images/statistics.png" width="120" height="120">
                </div>
            </div>
        </div>
    </div>

</template>
<script>
    export default {
        data: function(){
            return {
                numberWallets: 0,
                wallets: {},
            }
        },
        methods: {
            getNumberWallets: function () {
                axios.get('api/wallets/number').then(response => {
                    this.numberWallets = response.data;
                });
            },
        },
        mounted(){
            this.getNumberWallets();
        }
    }
</script>
<style>

    .col_body{
        text-align: justify;
        margin-left: 50px;
        margin-right: 50px;

    }
    .col_header{
        font-size: 20px;
        color:  #0C6AB4;
    }

    #about{
        font-size: 50px;
        margin-top: 50px;
        color: #4b4b4b;
        font-family: "Roboto", sans-serif;
    }
    #minititle{
        text-align: center;
        margin-top: 200px;
        margin-left: 70px;
        font-size: 15px;
        font-family: "Roboto", sans-serif;
        font-weight: bold;
        color: #000000;
        position: absolute;
    }

    #number{
        text-align: center;
        margin-top: 270px;
        margin-left: 50px;
        font-size: 20px;
        font-family: "Roboto", sans-serif;
        color: #008EFA;
        position: absolute;
    }


    #row{
        margin-top: 200px;
        background-color: #0C6AB4;
    }
    #title{
        margin-right: 300px;
        margin-top: 80px;
        float: right;
        font-size: 80px;
        font-family: "Roboto", sans-serif;
        color: #cacaca;
        position: absolute;
    }
    #subtitle{
        text-align: center;
        margin-top: 300px;
        margin-left: 200px;
        font-size: 50px;
        font-family: "Roboto", sans-serif;
        color: #cacaca;
        position: absolute;
    }
</style>


