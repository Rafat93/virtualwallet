<template>
    <div>
        <div>
            <table class="table table-striped">
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
                    <tr v-for="movement in movements.data" :key="movement.id">
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
            </table>
        </div>
        <div class="card-footer" style="margin:auto">
            <pagination :data="movements" @pagination-change-page="getDataPaginate">
                <span slot="prev-nav">&lt; Previous</span>
                <span slot="next-nav">Next &gt;</span>
            </pagination>
        </div>
    </div>
</template>

<script type="text/javascript">
    export default {
        name: "movementList",

        props: ['movements'],
        methods: {
            getDataPaginate: function (page = 1) {
                this.$emit('movements-paginate',page);
            }
        }
    }
</script>

<style scoped>

</style>
