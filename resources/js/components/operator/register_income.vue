<template>
    <div>
        <navbar/>
        <div class="inside_content" >
            <div class="content_title">
                Register a new expense
            </div>

            <form class="container">
                <div class="card">
                    <div class="card-header">
                        Information about the income
                    </div>
                    <div class="card-body" style="background-color: rgba(0,0,0,0.35)">
                        <div style="margin-right: 150px; margin-left: 150px;">
                            <div class="form-group">
                                <label for="inputEmail">Email of receiver's VirtualWallet:</label>
                                <input class="form-control" id="inputEmail" type="email" >
                            </div>
                            <div class="form-group">
                                <label for="inputValue">Value:</label>
                                <input class="form-control" v-model="value" id="inputValue" type="number" min="0,01" max="5000.00">
                            </div>
                            <div class="form-group">
                                <label for="inputType">Type of payment:</label>
                                <select id="inputType" class="form-control">
                                    <option disabled selected>---Select one---</option>
                                    <option>Cash</option>
                                    <option>Transfer</option>
                                </select>
                            </div>

                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "register_income",
        data:function(){
            return{
                value: ''
            }
        },
    }
</script>

<style scoped>

</style>
