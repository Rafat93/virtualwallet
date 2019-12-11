<template>
    <div style="overflow: unset;">
        <navbar/>
        <div class="inside_content" >
            <h1 class="display-4">Register a new expense</h1>

            <form class="container">
                <div class="card">
                    <div class="card-header">
                        Information about the expense
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="typeOfMovement">Type of movement</label>
                            <div class="form-check" id="typeOfMovement">
                                <input class="form-check-input" type="radio" name="typeOfExpense" id="transfer" value="transfer" checked>
                                <label class="form-check-label" for="transfer">
                                    Transfer
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="typeOfExpense" id="payment" value="payment">
                                <label class="form-check-label" for="typeOfMovement">
                                    Payment to external entity
                                </label>
                            </div>
                        </div>
                        INSERIR CLAUSULA IF
                        ----> SE FOR payment
                        <div class="form-group">
                            <label for="typeOfPayment">Type of Payment</label>
                            <div class="form-check" id="typeOfPayment">
                                <input class="form-check-input" type="radio" name="typeOfPayment" id="bankTransfer" value="transfer" checked>
                                <label class="form-check-label" for="transfer">
                                    Bank Transfer
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="typeOfPayment" id="mBPayment" value="payment">
                                <label class="form-check-label" for="typeOfMovement">
                                    MB Payment
                                </label>
                            </div>
                        </div>

                        ----> SE FOR BANK TRANSFER
                        <div class="form-group">
                            <label for="inputIban">IBAN</label>
                            <input class="form-control" type="text" id="inputIban"  maxlength="25" placeholder="e.g. PT50 0000 0000 0000 0000 0000 0">
                        </div>

                        -----> SE FOR MBPAYMENT
                        <div class="form-group">
                            <label for="inputEntity">Entity</label>
                            <input class="form-control" type="number" id="inputEntity" placeholder="e.g. 12345" maxlength="5">
                        </div>
                        <div class="form-group">
                            <label for="inputReference">Reference</label>
                            <input class="form-control" type="number" id="inputReference" placeholder="e.g. 123 456 789" maxlength="9">
                        </div>

                        -----> SE FOR PAYMENT
                        <div class="form-group">
                            <label for="inputEntity">Entity</label>
                            <input class="form-control" type="number" id="inputEntity" placeholder="e.g. 12345" maxlength="5">
                        </div>
                        <div class="form-group">
                            <label for="inputValue">Value</label>
                            <input class="form-control" type="number" id="inputValue" placeholder="0,01€ - 5000,00€">
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control"></textarea>
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
                categories: {},
            }
        },
        methods:{
            getCategories: function () {
                axios.get().then(response =>{
                    this.categories = response.data;
                });
            }
        },
        mounted() {
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


</style>
