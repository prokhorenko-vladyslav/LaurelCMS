<template>
    <v-app id="auth">
        <v-main>
            <router-view></router-view>
        </v-main>
    </v-app>
</template>

<script>
    export default {
        name: "Auth"
    }
</script>

<style lang="scss" scoped>
    .v-main {
        background-image: url("/assets/admin/img/auth/background.jpg");
    }
</style>
