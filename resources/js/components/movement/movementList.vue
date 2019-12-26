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
                    <b-button size="sm" @click="info(row.item, row.index, $event.target)" class="mr-1">
                        Info modal
                    </b-button>
                    <b-button size="sm" @click="row.toggleDetails">
                        {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
                    </b-button>
                </template>

                <template v-slot:row-details="row">
                    <b-card>
                        <ul>
                            <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value }}</li>
                        </ul>
                    </b-card>
                </template>
            </b-table>
            <b-modal :id="infoModal.id" :title="infoModal.title" ok-only @hide="resetInfoModal">
                <pre>{{ infoModal.content }}</pre>
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
                    }
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
            console.log(this.totalRows);
        }


    }
</script>

<style scoped>

</style>
