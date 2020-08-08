<template>
    <div class="row dashboard">
        <div class="col-md-2">
            <main-menu></main-menu>
        </div>
        <div class="col-md-10">
            Dashboard
        </div>
    </div>
</template>

<script>
    import MainMenu from "../../sublayouts/MainMenu";

    export default {
        name: "Dashboard",
        components: {
            MainMenu
        }
    }
</script>

<style lang="scss" scoped>

</style>
