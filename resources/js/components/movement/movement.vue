<template>
    <div>
        <navbar/>
        <div class="inside_content">
            <div class="content_title">
                List of Movements
            </div>
            <movement-list :movements="movements" @movements-paginate="getMovements" ref="movementsListRef"></movement-list>
        </div>
    </div>
</template>
<script type="text/javascript">
    import MovementList from './movementList.vue';

    export default {
        data: function(){
            return {
                title: 'List Movements',
                movements: {},
            }
        },
        methods: {
            getMovements: function(page = 0){
                console.log(this.$store.state.token);
                /*if (page == 0){
                    axios.get('api/movements',{'headers': {'Authorization': 'Bearer '+this.$store.commit('getToken')}})
                        .then(response=>{this.movements = response.data; });
                }else {
                    axios.get('api/movements?page=' + page)
                        .then(response => {
                            this.movements = response.data;})
                }*/
                axios.get('api/movements',{'headers': {'Authorization': 'Bearer '+this.$store.state.token}})
                    .then(response=>{this.movements = response.data; });

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
