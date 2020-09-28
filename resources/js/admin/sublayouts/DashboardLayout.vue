<template>
    <div class="row" :class="layoutClass">
        <div class="col-md-2 pr-0">
            <main-menu></main-menu>
        </div>
        <div class="col-md-10 pl-0">
            <dashboard-header></dashboard-header>
            <div class="main">
                <page-breadcrumbs></page-breadcrumbs>
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
    import DashboardHeader from "./DashboardHeader";
    import MainMenu from "./MainMenu";
    import PageBreadcrumbs from "./PageBreadcrumbs";

    export default {
        name: "DashboardLayout",
        components: {
            MainMenu,
            DashboardHeader,
            PageBreadcrumbs
        },
        props: {
            layoutClass : {
                type : String,
                default : ''
            }
        }
    }
</script>

<style scoped>

</style>
