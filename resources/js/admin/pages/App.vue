<template>
    <div id="app-layout">
        <router-view></router-view>
        <notifications group="dashboard"
                       classes="dashboard"
                       position="top right"
                       :max="5"
                       ignoreDuplicates
        />
    </div>
</template>

<script>
    export default {
        name: "App"
    }
</script>

<style lang="scss" scoped>

</style>
