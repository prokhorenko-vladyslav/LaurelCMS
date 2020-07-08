<template>
    <div class="row login">
        <div class="col-md-4">
            <div class="d-flex flex-column align-items-center justify-content-center h-100">
                <div class="logo">
                    <img src="/admin/img/logo.png" alt="Logo">
                </div>
                <h1 class="header">Welcome Back!</h1>
                <p class="sign_in__text">Sign in to continue.</p>
                <div class="row w-100 justify-content-center mt-5">
                    <div class="col-md-8 d-flex justify-content-center">
                        <input-field
                            has-icon
                            has-label
                            placeholder="Enter username"
                        >
                            <template v-slot:icon>
                                <img src="/admin/img/icons/account.svg" alt="Account">
                            </template>
                            <template v-slot:label>
                                Username
                            </template>
                        </input-field>
                    </div>
                </div>
                <div class="row w-100 justify-content-center mt-4">
                    <div class="col-md-8 d-flex justify-content-center">
                        <input-field
                            has-icon
                            has-label
                            type="password"
                            placeholder="Enter password"
                        >
                            <template v-slot:icon>
                                <img src="/admin/img/icons/lock.svg" alt="Lock">
                            </template>
                            <template v-slot:label>
                                Password
                            </template>
                        </input-field>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 p-0">
            <div class="background">
                <div class="background-overlay"></div>
            </div>
        </div>
    </div>
</template>

<script>
    import InputField from "../../fields/InputField";

    export default {
        name: "Login",
        components : {
            InputField
        }
    }
</script>

<style lang="scss" scoped>
    .login {
        min-height: 100vh;

        .background {
            position: relative;
            height: 100%;
            width: 100%;
            background-image: url("/admin/img/auth/login/background.jpg");
            background-size: cover;

            .background-overlay {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                opacity: .7;
                background-color: #292626;
            }
        }
    }
</style>
