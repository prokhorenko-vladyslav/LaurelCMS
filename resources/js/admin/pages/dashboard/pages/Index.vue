<template>
    <dashboard-layout layoutClass="pages"
                      title="Pages"
                      breadcrumb="Pages"
    >
        <template v-slot:actions>
            <simple-button primary type="router-link" :to="{
                name : 'admin.pages.create'
            }">Add</simple-button>
        </template>
        <extended-table></extended-table>
    </dashboard-layout>
</template>

<script>
    import DashboardLayout from "../../../sublayouts/DashboardLayout";
    import ExtendedTable from "../../../elements/ExtendedTable";
    import SimpleButton from "../../../elements/SimpleButton";
    import {mapActions} from "vuex";

    export default {
        name: "Pages",
        components: {
            DashboardLayout,
            ExtendedTable,
            SimpleButton
        },
        data: () => ({}),
        async created() {
            if (!await this.hasToken()) {
                this.setLoadingStatus(false).then(() => this.$router.push({name: 'admin.auth.login'}));
            } else {
                this.setLoadingStatus(true);
            }
        },
        methods: {
            ...mapActions(['setLoadingStatus']),
            ...mapActions('Admin/Auth', [
                'loadTokenFromLocalStorage', 'hasToken'
            ])
        }
    }
</script>

<style lang="scss" scoped>

</style>
