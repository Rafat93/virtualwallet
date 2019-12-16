<template>
    <div style="overflow: unset;">
        <navbar/>
        <div class="inside_content" >
            <div class="content_title">
                Register a new expense
            </div>

            <form class="container">
                <div class="card">
                    <div class="card-header">
                        Information about the expense
                    </div>
                    <div class="card-body" style="background-color: rgba(0,142,250,0.33)">
                        <div class="form-group">
                            <label for="typeOfMovement">Type of movement</label>
                            <select id="typeOfMovement" name="typeOfMovement" class="form-control" v-model="transferMovement">
                                <option value="" disabled selected>----Select a type----</option>
                                <option value="transfer" >Transfer to other VirtualWallet</option>
                                <option value = "payment">Payment to external entity</option>
                            </select>
                        </div>

                        <div v-if="transferMovement == payment">
                            <label for="typeOfMovement">Type of movement</label>
                            <select id="typeOfPayment" name="typeOfPayment" class="form-control" v-model="paymentMovement">
                                <option value="" disabled selected>----Select a type----</option>
                                <option value="mbPayment" >MB Payment</option>
                                <option value = "bank">Bank Transfer</option>
                            </select>
                        </div>

                        <div v-if="transferMovement == transfer">
                            <label>Email:</label>
                            <input type="email" class="form-control" placeholder="user@example.com">
                        </div>


                        <div v-if="paymentMovement == bank">
                            <div class="form-group">
                                <label for="inputIban">IBAN</label>
                                <input class="form-control" type="text" id="inputIban"  maxlength="25" placeholder="e.g. PT50 0000 0000 0000 0000 0000 0">
                            </div>
                        </div>

                        <div v-if="paymentMovement == mbPayment">
                            <div class="form-group">
                                <label for="inputEntity">Entity</label>
                                <input class="form-control" type="number" id="inputEntity" placeholder="e.g. 12345" maxlength="5">
                            </div>
                            <div class="form-group">
                                <label for="inputReference">Reference</label>
                                <input class="form-control" type="number" id="inputReference" placeholder="e.g. 123 456 789" maxlength="9">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputValue">Value</label>
                            <input class="form-control" type="number" id="inputValue" placeholder="0,01€ - 5000,00€">
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select class="form-control" id="category_id">
                                <option v-model="category" v-for="categoria in category" v-bind:value="categoria.id">{{categoria.name}}</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control"></textarea>
                        </div>
                        <div class="form-group" style="text-align: center;">
                            <input type="submit" class="btn btn-success">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button  class="btn btn-danger">Cancel</button>
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </div>
</template>

<script>
    export default {

        data:function(){
            return{
                category: '',
                transferMovement : '',
                transfer : "transfer",
                payment : "payment",
                paymentMovement : '',
                bank : "bank",
                mbPayment : "mbPayment"


            }

        },

        methods:{

        },
        mounted() {
            {{console.log("Olá")}}
            console.log(this.category);
            axios.get('api/categories').then(response=> {this.category = response;})
            console.log(this.category);
        },
        name: "register_expense"

    }
</script>

<style scoped>
    .inside_content{
        margin-top: 56px;
        margin-left: 60px;
        overflow-y: auto;
        height: 92vh;
    }
    .content_title{
        text-align: center;
        font-size: 30px;
        margin-bottom: 10px;
        font-family: "Roboto", sans-serif;
    }


</style>
