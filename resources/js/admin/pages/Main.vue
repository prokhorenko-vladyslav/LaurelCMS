<template>
    <div class="container-fluid p-0">
            <admin-preloader></admin-preloader>
        <router-view></router-view>
    </div>
</template>

<script>
    import {mapActions} from "vuex";
    import AdminPreloader from "../sublayouts/AdminPreloader"

    export default {
        name: "Main",
        components: {
            AdminPreloader
        }
    }
</script>

<style lang="scss" scoped>

</style>
