<template>
    <div>
        <div>
            <div class="row" style="text-align: center">
                <div class="col-sm form-group">
                    <b-form-input
                        v-model="filter"
                        type="search"
                        id="filterInput"
                        placeholder="Type to Search"
                    ></b-form-input>
                </div>
                <div class="form-group" >
                    <label for="inputCategory">Category:</label>
                    <select v-model="filter.category"  id="inputCategory">
                        <option value="" selected disabled>----Select an option----</option>
                        <option  v-for="category in categories" v-bind:value="category.id">{{category.name}}</option>
                    </select>
                </div>
                <div class="col-sm">
                    <label>Type:</label>
                    <select   v-model="filter.type" id="inputType">
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


            <b-table striped hover :items="movements" :fields="fields" :per-page="perPage" :filter="filter" :current-page="currentPage">
                <template v-slot:cell(name)="row">
                    {{ row.value.first }} {{ row.value.last }}
                </template>

                <template v-slot:cell(actions)="row">
                    <b-btn size="sm" variant="info" @click="showModal(row)">Info</b-btn>

                </template>

            </b-table>

            <b-modal id="modal-1" v-model="modal" title="Movement's full information">

                <p class="font-weight-bold" style="margin-bottom: -5px;">Id:</p>
                <p class="font-weight-light">{{rowSelected.id}}</p>

                <p class="font-weight-bold" style="margin-bottom: -5px;">Type:</p>
                <p class="font-weight-light">{{rowSelected.type}}</p>

                <p class="font-weight-bold" style="margin-bottom: -5px;">Date:</p>
                <p class="font-weight-light">{{rowSelected.date}}</p>

                <div v-if="rowSelected.transfer_movement_id != null">
                    <p class="font-weight-bold" style="margin-bottom: -5px;">Transfer id:</p>
                    <p class="font-weight-light">{{rowSelected.transfer_movement_id}}</p>
                </div>
                <div v-if="(rowSelected.transfer_wallet_id != null && rowSelected.transfer_wallet_id != '-' )&& rowSelected.type == 'Income'">
                    <p class="font-weight-bold" style="margin-bottom: -5px;">Email (sender):</p>
                    <p class="font-weight-light">{{rowSelected.transfer_wallet_id}}</p>
                </div>
                <div v-if="(rowSelected.transfer_wallet_id != null && rowSelected.transfer_wallet_id != '-' ) && rowSelected.type == 'Expense'">
                    <p class="font-weight-bold" style="margin-bottom: -5px;">Email (receiver):</p>
                    <p class="font-weight-light">{{rowSelected.transfer_wallet_id}}</p>
                </div>
                <div v-if="rowSelected.iban != null ">
                    <p class="font-weight-bold" style="margin-bottom: -5px;">Iban:</p>
                    <p class="font-weight-light">{{rowSelected.iban}}</p>
                </div>
                <div v-if="rowSelected.mb_entity_code != null ">
                    <p class="font-weight-bold" style="margin-bottom: -5px;">Entity:</p>
                    <p class="font-weight-light">{{rowSelected.mb_entity_code}}</p>
                </div>
                <div v-if="rowSelected.mb_payment_reference != null ">
                    <p class="font-weight-bold" style="margin-bottom: -5px;">Reference:</p>
                    <p class="font-weight-light">{{rowSelected.mb_payment_reference}}</p>
                </div>

                <p class="font-weight-bold" style="margin-bottom: -5px;">Category:</p>
                <p class="font-weight-light">{{rowSelected.category_id}}</p>

                <p class="font-weight-bold" style="margin-bottom: -5px;">Start Balance:</p>
                <p class="font-weight-light">{{rowSelected.start_balance}}</p>

                <p class="font-weight-bold" style="margin-bottom: -5px;">End Balance:</p>
                <p class="font-weight-light">{{rowSelected.end_balance}}</p>

                <p class="font-weight-bold" style="margin-bottom: -5px;">Value:</p>
                <p class="font-weight-light">{{rowSelected.value}}</p>

                <div v-if="rowSelected.description != null">
                    <p class="font-weight-bold" style="margin-bottom: -5px;">Description:</p>
                    <p class="font-weight-light">{{rowSelected.description}}</p>
                </div>
                <div v-if="rowSelected.source_description != null">
                    <p class="font-weight-bold" style="margin-bottom: -5px;">Source Description:</p>
                    <p class="font-weight-light">{{rowSelected.source_description}}</p>
                </div>
            </b-modal>

            <b-row>
                <b-col sm="5" md="6" class="my-1" cols="3">
                    <b-form-group
                        label="Per page"
                        label-cols-sm="6"
                        label-cols-md="4"
                        label-cols-lg="3"
                        label-align-sm="right"
                        label-size="sm"
                        label-for="perPageSelect"
                        class="mb-0"
                    >
                        <b-form-select
                            v-model="perPage"
                            id="perPageSelect"
                            size="sm"
                            :options="pageOptions"
                            class="col-sm-2"
                        ></b-form-select>
                    </b-form-group>
                </b-col>
            </b-row>
            <b-row align-h="center">
                <b-col class="my-1" cols="6" >
                    <b-pagination
                        v-model="currentPage"
                        :total-rows="totalRows"
                        :per-page="perPage"
                        align="fill"
                        size="sm"
                        class="my-0"
                    ></b-pagination>
                </b-col>
            </b-row>
        </div>
    </div>
</template>

<script type="text/javascript">
    export default {
        name: "movementList",
        data:function(){
            return{

                modal:false,
                rowSelected: '',
                categories: '',
                currentPage: 1,
                perPage: 10,
                filter: '',
                pageOptions:[5,10,15,20],
                totalRows: 1,
                infoModal:{
                    id: 'info-modal',
                    title: '',
                    content: ''
                },
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
                        key: 'transfer_wallet_id',
                        label: 'Email',
                        sortable: true,
                    },
                    {
                        key: 'type_payment',
                        sortable: true,
                    },
                    {
                        key: 'category_id',
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
                    },
                    {
                        key: 'actions',
                        sortable: true,
                    },
                    ],

            }
        },


        props: ['movements', 'numMovements'],
        computed:{
            sortOptions() {
                // Create an options list from our fields
                return this.fields
                    .filter(f => f.sortable)
                    .map(f => {
                        return { text: f.label, value: f.key }
                    })
            }
        },
        methods: {
            getDataPaginate: function (page = 1) {
                this.$emit('movements-paginate',page);
            },
            getCategories: function () {
                axios.get('api/categories',{'headers': {'Authorization': 'Bearer '+ this.$store.state.token}})
                    .then(response=> { this.categories = response.data.data;});
            },
            info(item, index, button) {
                this.infoModal.title = `Row index: ${index}`
                this.infoModal.content = JSON.stringify(item, null, 2)
                this.$root.$emit('bv::show::modal', this.infoModal.id, button)
            },
            resetInfoModal() {
                this.infoModal.title = ''
                this.infoModal.content = ''
            },
            onFiltered(filteredItems) {
                // Trigger pagination to update the number of buttons/pages due to filtering
                this.totalRows = filteredItems.length;
                this.currentPage = 1
            },
            itemsProvider: function (ctx, callback) {
                console.log(this.filters.search)
                console.log(this.filters.roleId)
            },
            showModal(row){
                this.rowSelected = row.item;
                this.modal = true;
            }

        },watch: {
            currentPage: {
                handler: function(value) {
                    this.fetchData().catch(error => {
                        console.error(error)
                    })
                }
            },
            filters: {
                handler: function () {
                    this.$refs.table.refresh()
                },
                deep: true
            }
        },
        mounted() {
            this.getCategories();
            this.totalRows = this.numMovements;
            console.log("Total Rows:"+this.totalRows);
        }


    }
</script>

<style scoped>

</style>
