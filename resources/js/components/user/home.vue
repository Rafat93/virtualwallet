<template>
    <div>
        <navbar/>
        <div class="inside_content">
            Component Home
        </div>

    </div>

</template>

<script>
    export default {
        name: "home"
    }
</script>

<style scoped>
    .inside_content{
        margin-top: 56px;
        margin-left: 60px;
        overflow-y: auto;
        height: 92vh;
    }
</style>
