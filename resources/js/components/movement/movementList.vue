<template>
    <div>
        <div>
            <div class="row" style="text-align: center">
                <div class="col-sm form-group">
                    <label for="inputId">ID:</label>
                    <input type="number" min="0" id="inputId" name="id" ref="id">
                </div>
                <div class="form-group" >
                    <label for="inputCategory">Category:</label>
                    <select  id="inputCategory">
                        <option value="" selected disabled>----Select an option----</option>
                        <option  v-for="category in categories" v-bind:value="category.id">{{category.name}}</option>
                    </select>
                </div>
                <div class="col-sm">
                    <label>Type:</label>
                    <select  id="inputType">
                        <option value="" selected disabled>----Select an option----</option>
                        <option value="i">Income</option>
                        <option value="e">Expense</option>
                    </select>
                </div>
                <div class="col-sm">
                    <label>Email:</label>
                    <input type="text" name="email">
                </div>
            </div>
            <!--<table class="table table-striped">
                <thead>
                    <tr>
                        <th>Wallet</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Payment Type</th>
                        <th>Iban</th>
                        <th>Start Balance</th>
                        <th>End Balance</th>
                        <th>Value</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="movement in movements" :key="movement.id">
                        <td>{{movement.wallet_id}}</td>
                        <td>{{movement.date}}</td>
                        <td>{{movement.type}}</td>
                        <td>{{movement.type_payment}}</td>
                        <td>{{movement.iban}}</td>
                        <td>{{movement.start_balance}}</td>
                        <td>{{movement.end_balance}}</td>
                        <td>{{movement.value}}</td>
                        <td>
                            <a class="btn btn-sm btn-success">Details</a>
                            <a class="btn btn-sm " >-</a>
                        </td>
                    </tr>
                </tbody>
            </table>-->
            <b-table striped hover :items="movements" :fields="fields" :per-page="perPage"></b-table>
        </div>
       <!-- <div class="card-footer" style="margin:auto">
            <pagination :data="movements" @pagination-change-page="getDataPaginate">
                <span slot="prev-nav">&lt; Previous</span>
                <span slot="next-nav">Next &gt;</span>
            </pagination>
        </div>-->
    </div>
</template>

<script type="text/javascript">
    export default {
        name: "movementList",
        data:function(){
            return{
                categories: '',
                perPage: 10,
                fields: [
                    {
                        key: 'id',
                        sortable : true,
                    },
                    {
                        key: 'type',
                        sortable: true,
                    },
                    {
                        key: 'type_payment',
                        sortable: true,
                    },
                    {
                        key: 'category',
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

        props: ['movements'],
        methods: {
            getDataPaginate: function (page = 1) {
                this.$emit('movements-paginate',page);
            },
            getCategories: function () {
                axios.get('api/categories',{'headers': {'Authorization': 'Bearer '+ this.$store.state.token}})
                    .then(response=> { this.categories = response.data.data;});
            },

        },mounted() {
            this.getCategories();
        }


    }
</script>

<style scoped>

</style>
