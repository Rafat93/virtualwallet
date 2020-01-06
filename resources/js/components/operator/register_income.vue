<template>
    <div>
        <navbar/>
        <div class="inside_content" >
            <div class="content_title">
                Register a new income
            </div>
            <div class="card" style="margin-left: 200px; margin-right: 200px;">
                <div class="card-header">
                    Information about the income
                </div>
                <div class="card-body" style="background-color: rgba(0,0,0,0.35)">
                    <div style="margin-right: 150px; margin-left: 150px;">
                        <div class="form-group">
                            <label>Email of VirtualWallet's client:</label>
                            <b-form-input v-model="email" class="mb-3">
                            </b-form-input>
                        </div>
                        <div class="form-group" :class="{ 'form-group--error': $v.value.$error }">
                            <label >Value:</label>
                            <b-form-input v-model="value" class="mb-3">
                            </b-form-input>
                        </div>

                        <div class="form-group">
                            <label>Type of payment:</label>
                            <b-form-select v-model="typeSelected" value-field="id"
                                           :options="typeOfPayment" class="mb-3">
                            </b-form-select>
                        </div>
                        <div class="form-group">
                            <label>Description:</label>
                            <b-form-input v-model="sourceDescription" class="mb-3">
                            </b-form-input>
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
    import { required, minLength, between } from 'vuelidate/lib/validators'

    export default {
        name: "register_income",
        data:function(){
            return{
                email:'',
                value:'',
                sourceDescription:'',
                typeSelected: null,
                typeOfPayment:[
                    {
                        text: 'Please select an option',
                        value: 'null'
                    },
                    {
                        text: 'Cash',
                        value: 0,
                    },
                    {
                        text: 'Bank transfer',
                        value: 1,
                    }
                ]
            }
        },
        validations: {
            value: {
                required,
                minLength: minLength(4)
            },
        },
        methods:{
            submit(){

            },
            cancel(){

            }
        }
    }
</script>

<style scoped>

</style>
