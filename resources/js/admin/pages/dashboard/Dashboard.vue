<template>
    <div class="row dashboard">
        <div class="col-md-2 pr-0">
            <main-menu></main-menu>
        </div>
        <div class="col-md-10 pl-0">
            <dashboard-header></dashboard-header>
            <div class="main">
                Main
            </div>
        </div>
    </div>
</template>

<script>
    import DashboardHeader from "../../sublayouts/DashboardHeader";
    import MainMenu from "../../sublayouts/MainMenu";

    import {mapActions} from "vuex";

    export default {
        name: "Dashboard",
        components: {
            MainMenu,
            DashboardHeader
        },
        created() {
            this.setLoadingStatus(true);
        },
        methods: {
            ...mapActions(['setLoadingStatus']),
        }
    }
</script>

<style lang="scss" scoped>
    .main {
        min-height: calc(100% - 100px);
        margin-left: 1rem;
        margin-right: 1rem;
        padding: 1rem;
        border: 1px solid #DFE3E7;
        border-radius: .25rem;
    }
</style>
