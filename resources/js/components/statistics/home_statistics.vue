<template>
    <div>
        <navbar/>
        <div class="inside_content">
                Component Estatisticas
            {{this.$store.state.user}}
        </div>
    </div>
</template>

<script>
    export default {
        name: "home_statistics"
    }
</script>

<style scoped>



</style>
