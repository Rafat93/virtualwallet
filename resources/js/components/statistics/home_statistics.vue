<template>
    <div>
        <navbar/>
        <div class="inside_content">
                Component Estatisticas
            <b-button @click="toast('b-toaster-top-center')" class="mb-2">b-toaster-top-center</b-button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                counter: 0
            }
        },
        methods: {
            toast(toaster, append = false) {
                this.$bvToast.toast(`Toast ${this.counter} body content`, {
                    title: `Toaster ${toaster}`,
                    toaster: toaster,
                    solid: true,
                    appendToast: append
                })
            }
        }
    }
</script>

<style scoped>

</style>
