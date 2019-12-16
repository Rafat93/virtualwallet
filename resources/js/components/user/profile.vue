<template>
    <div>
        <navbar/>
        <div class="inside_content">
            <div class="content_title">
                Profile
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "profile"
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
