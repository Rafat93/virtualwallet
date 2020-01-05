<template>
    <div>
        <navbar/>
        <div class="inside_content" >
            <div class="content_title">
                Registe a new expense
            </div>
            <div class="card" style="margin-left: 200px; margin-right: 200px;">
                <div class="card-header">
                    Information about the expense
                </div>
                <div class="card-body" style="background-color: rgba(0,0,0,0.35)">
                    <div style="margin-right: 150px; margin-left: 150px;">
                        <div class="form-group">
                            <label>Type of movement</label>
                            <b-form-select v-model="typeOfMovementSelected" :options="typeOfMovement" class="mb-3">
                            </b-form-select>
                        </div>

                        <div v-if="typeOfMovementSelected == 'transfer'" class="form-group">
                            <label>Email:</label>
                            <b-form-input  type="email" v-model="email" placeholder="Enter the email"></b-form-input>
                        </div>
                        <div v-if="typeOfMovementSelected == 'payment'" class="form-group">
                            <label>Type of payment (to external entity):</label>
                            <b-form-select v-model="typeOfPaymentSelected" :options="typeOfPayment" class="mb-3">
                            </b-form-select>
                        </div>

                        <div v-if="typeOfPaymentSelected == 'transfer'" class="form-group">
                            <div class="form-group">
                                <label>IBAN</label>
                                <b-form-input v-model="iban" placeholder="e.g. PT50 0000 0000 0000 0000 0000 0"></b-form-input>

                            </div>
                        </div>

                        <div v-if="typeOfPaymentSelected == 'payment'" class="form-group">
                            <div class="form-group">
                                <label>Entity:</label>
                                <b-form-input v-model="entity" ></b-form-input>
                            </div>
                            <div class="form-group">
                                <label>Reference:</label>
                                <b-form-input v-model="reference" ></b-form-input>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Value:</label>
                            <b-form-input v-model="value" type="number" ></b-form-input>
                        </div>

                        <div class="form-group">
                            <label>Category</label>
                            <b-form-select v-model="categorySelected"
                            value-field="id"
                            text-field="name"
                            :options="categories"  class="mb-3"></b-form-select>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <b-form-input v-model="description" max="200"></b-form-input>
                        </div>
                        <div class="form-group" style="text-align: center;">
                            <b-btn variant="success" @submit>Submit</b-btn>
                            <b-btn variant="danger" @click="cancel">Cancel</b-btn>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data:function(){
            return{
                categories: [],
                categorySelected: '',

                typeOfMovementSelected: null,
                typeOfMovement:[
                    {
                        text: 'Please select an option',
                        value: 'null'
                    },
                    {
                        text: 'Transfer to other VirtualWallet',
                        value: 'transfer'
                    },
                    {
                        text: 'Payment to external entity',
                        value: 'payment'
                    },
                ],

                typeOfPaymentSelected: null,
                typeOfPayment:[
                    {
                        text: 'Please select an option',
                        value: 'null'
                    },
                    {
                        text: 'Bank transfer',
                        value: 'transfer'
                    },
                    {
                        text: 'MB payment',
                        value: 'payment'
                    },
                ],

                email:'',
                iban:'',
                entity:'',
                reference:'',
                value:'',
                description:'',

            }
        },

        methods:{
            getCategories(){
                axios.get('api/categories',{'headers': {'Authorization': 'Bearer '+ this.$store.state.token}})
                    .then(response=> {this.categories = response.data.data; });
            },
            cancel(){
                this.$router.push('/home');
            },
            submit(){

            }
        },
        mounted() {
            this.getCategories();

        },

    }
</script>

<style scoped>
</style>
