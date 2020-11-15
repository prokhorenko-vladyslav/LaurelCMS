<template>
    <dashboard-layout layoutClass="dashboard">
        Main
    </dashboard-layout>
</template>

<script>
    import DashboardLayout from "../../sublayouts/DashboardLayout";

    import {mapActions} from "vuex";

    export default {
        name: "Dashboard",
        components: {
            DashboardLayout
        },
        async created() {
            if (!await this.hasToken()) {
                this.setLoadingStatus(false).then(() => this.$router.push({ name: 'admin.auth.login' }));
            } else {
                this.setLoadingStatus(true);
            }

            Echo.private('users.1')
                .notification((notification) => {
                    this.$notify({
                        group: 'foo',
                        type: 'success',
                        title: notification.title,
                        text: notification.text
                    });
                });
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
    .main {
        min-height: calc(100% - 100px);
        margin-left: 1rem;
        margin-right: 1rem;
        padding: 1rem;
        border: 1px solid #DFE3E7;
        border-radius: .25rem;
    }
</style>
