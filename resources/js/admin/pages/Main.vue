<template>
    <div class="container-fluid p-0">
        <admin-preloader></admin-preloader>
        <router-view></router-view>
        <notifications group="default" position="bottom right"/>
    </div>
</template>

<script>
    import {mapActions, mapState} from "vuex";
    import AdminPreloader from "../sublayouts/AdminPreloader"

    export default {
        name: "Main",
        components: {
            AdminPreloader
        },
        computed: {
            ...mapState('Admin/Auth', ['token', 'isLocked'])
        },
        created() {
            this.fireLockCheckingEvent();
        },
        beforeRouteUpdate(to, from, next) {
            this.fireLockCheckingEvent();
            next();
        },
        watch: {
            token() {
                this.fireLockCheckingEvent();
            },
            isLocked() {
                if (this.isLocked) {
                    this.stopLockChecking();
                    this.setLoadingStatus(false).then(() => this.$router.push({ name: 'admin.auth.lock' }));
                }
            }
        },
        methods: {
            ...mapActions(['setLoadingStatus']),
            ...mapActions('Admin/Auth', ['startLockChecking', 'stopLockChecking']),
            fireLockCheckingEvent() {
                if (this.token) {
                    this.startLockChecking();
                } else {
                    this.stopLockChecking();
                }
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
