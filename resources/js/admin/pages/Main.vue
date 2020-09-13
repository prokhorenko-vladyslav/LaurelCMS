<template>
    <div class="container-fluid p-0">
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: "Main",
        data: () => ({
            loaded : true
        }),
    }
</script>

<style scoped>

</style>
