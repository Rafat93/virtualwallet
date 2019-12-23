<template>
    <div>
        <navbar/>
        <div class="inside_content">
            <div class="content_title">
                List of Movements
            </div>
            <div v-if="movements== 0">

                <div class="spinner-grow" role="status" style="position: absolute;   top: 50%;    left: 50%;">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div v-else>

                <movement-list :movements="movements" :numMovements="numMovements" @movements-paginate="getMovements" ref="movementsListRef"></movement-list>
            </div>

        </div>
    </div>
</template>
<script type="text/javascript">
    import MovementList from './movementList.vue';

    export default {
        data: function(){
            return {
                title: 'List Movements',
                movements: 0,
                numMovements: 0,

            }
        },
        methods: {
            getMovements: function(page = 0){


                axios.get('api/users/'+this.$store.state.user.id+'/movements',{'headers': {'Authorization': 'Bearer '+this.$store.state.token}})
                    .then(response=>{this.movements = response.data.data;
                    this.numMovements = this.movements.length;
                    console.log(response.data.data);
                    console.log(this.movements)});



                /*if (page == 0){
                    axios.get('api/movements',{'headers': {'Authorization': 'Bearer '+this.$store.commit('getToken')}})
                        .then(response=>{this.movements = response.data; });
                }else {
                    axios.get('api/movements?page=' + page)
                        .then(response => {
                            this.movements = response.data;})
                }*/
               /* axios.get('api/movements',{'headers': {'Authorization': 'Bearer '+this.$store.state.token}})
                    .then(response=>{this.movements = response.data; });
                */
            },
        },
        components: {
            'movement-list': MovementList,
        },
        mounted() {
            this.getMovements();
        }
    }
</script>

<style scoped>

</style>
