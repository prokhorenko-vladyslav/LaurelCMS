<template>
    <dashboard-layout layoutClass="settings"
                      title="Settings"
                      breadcrumb="Settings"
    >
        <template v-slot:actions>
            <simple-button primary type="router-link" :to="{
                name : 'admin.pages.create'
            }">Add</simple-button>
        </template>
        <settings-tabs></settings-tabs>
    </dashboard-layout>
</template>

<script>
    import DashboardLayout from "../../../sublayouts/DashboardLayout";
    import SimpleButton from "../../../elements/SimpleButton";
    import SettingsTabs from "./SettingsTabs";
    import {mapActions} from "vuex";

    export default {
        name: "Pages",
        components: {
            DashboardLayout,
            SimpleButton,
            SettingsTabs
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
