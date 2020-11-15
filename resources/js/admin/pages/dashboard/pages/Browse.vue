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
        <extended-table :rows="pages"
                        :pagination="pagePagination"
                        @pageChanging="changePage"
        ></extended-table>
    </dashboard-layout>
</template>

<script>
    import DashboardLayout from "../../../sublayouts/DashboardLayout";
    import ExtendedTable from "../../../elements/ExtendedTable";
    import SimpleButton from "../../../elements/SimpleButton";
    import {mapActions, mapState} from "vuex";

    export default {
        name: "Browse",
        components: {
            DashboardLayout,
            ExtendedTable,
            SimpleButton
        },
        data: () => ({
            defaultPage : 1,
            defaultLimit : 10
        }),
        async created() {
            if (!await this.hasToken()) {
                this.setLoadingStatus(false).then(() => this.$router.push({name: 'admin.auth.login'}));
            } else {
                this.setLoadingStatus(true);
            }
            this.changePage(
                this.$route.query.page || this.defaultPage,
                this.$route.query.limit || this.defaultLimit,
            )
        },
        computed: {
            ...mapState('Admin/Page', ['pages', 'pagePagination'])
        },
        methods: {
            ...mapActions(['setLoadingStatus']),
            ...mapActions('Admin/Auth', [
                'loadTokenFromLocalStorage', 'hasToken'
            ]),
            ...mapActions('Admin/Page', [
                'fetchPages'
            ]),
            changePage(page, limit) {
                page = Number(page);
                limit = Number(limit);
                let status = this.fetchPages({ page, limit });
                if (status) {
                    let query = {};
                    if (page !== this.defaultPage) {
                        query.page = page;
                    }

                    if (limit !== this.defaultLimit) {
                        query.limit = limit;
                    }

                    this.$router.push({ query });
                }
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
