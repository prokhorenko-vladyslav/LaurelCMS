<template>
    <div class="row login">
        <div class="col-xl-4 col-lg-5 col-md-6">
            <div class="d-flex flex-column align-items-center justify-content-center h-100">
                <div class="logo">
                    <img src="/admin/img/logo.png" alt="Logo">
                </div>
                <h1 class="header mt-4 mb-0">Welcome Back!</h1>
                <p class="secondary__text">Sign in to continue.</p>
                <div class="row w-100 justify-content-center mt-4">
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
                <div class="row w-100 justify-content-center mt-4">
                    <div class="col-md-8 d-flex justify-content-center">
                        <checkbox-field
                            type="password"
                        >
                            <template v-slot:label>
                                Remember me
                            </template>
                        </checkbox-field>
                    </div>
                </div>
                <div class="row w-100 justify-content-center mt-4">
                    <div class="col-md-8 d-flex justify-content-center">
                        <simple-button>Log In</simple-button>
                    </div>
                </div>
                <div class="row w-100 justify-content-center mt-4">
                    <div class="col-md-8 d-flex justify-content-center">
                        <router-link :to="{ name : 'admin.auth.forgot' }" class="link link_forgot-password">Forgot your password?</router-link>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-7 col-md-6 d-none d-md-block p-0">
            <div class="background">
                <div class="background-overlay"></div>
            </div>
        </div>
    </div>
</template>

<script>
    import InputField from "../../elements/InputField";
    import CheckboxField from "../../elements/CheckboxField";
    import SimpleButton from "../../elements/SimpleButton";

    export default {
        name: "Login",
        components : {
            InputField, CheckboxField,
            SimpleButton,
        }
    }
</script>

<style lang="scss" scoped>
    .login {
        min-height: 100vh;

        .header {
            font-size: 1.2rem;
        }

        .header {
            font-size: 1.2rem;
        }

        .sign_in__text {
            color: #74788d;
            font-size: .8rem;
        }

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

        .link_forgot-password {
            position: relative;
            display: flex;
            align-items: center;

            &:before {
                content: '';
                display: block;
                width: 14px;
                height: 14px;
                margin-right: .4rem;
                background: url("/admin/img/icons/unlock-filled.svg");
                background-size: cover;
            }
        }
    }
</style>
