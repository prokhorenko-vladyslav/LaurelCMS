<template>
    <dashboard-layout layoutClass="pages"
                      title="Pages"
                      breadcrumb="Pages"
    >
            Pages content
    </dashboard-layout>
</template>

<script>
    import DashboardLayout from "../../sublayouts/DashboardLayout";
    import {mapActions} from "vuex";

    export default {
        name: "Pages",
        components: {
            DashboardLayout
        },
        data: () => ({

        }),
        async created() {
            if (!await this.hasToken()) {
                this.setLoadingStatus(false).then(() => this.$router.push({ name: 'admin.auth.login' }));
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
