<template>
    <div class="row forgot">
        <div class="col-xl-4 col-lg-5 col-md-6">
            <div class="d-flex flex-column align-items-center justify-content-center h-100">
                <div class="logo">
                    <img src="/admin/img/logo.png" alt="Logo">
                </div>
                <h1 class="header mt-4 mb-0">Forgot password?</h1>
                <p class="sign_in__text">Input email to reset.</p>
                <div class="row w-100 justify-content-center mt-4">
                    <div class="col-6 col-md-8 d-flex justify-content-center">
                        <input-field
                            has-icon
                            has-label
                            placeholder="Enter email"
                            v-model="login"
                        >
                            <template v-slot:icon>
                                <img src="/admin/img/icons/email.svg" alt="Account">
                            </template>
                            <template v-slot:label>
                                Email
                            </template>
                        </input-field>
                    </div>
                </div>
                <div class="row w-100 justify-content-center mt-4">
                    <div class="col-6 d-flex justify-content-end">
                        <simple-button @click="fireResetPasswordEvent">Reset</simple-button>
                    </div>
                    <div class="col-6 d-flex justify-content-start">
                        <router-link :to="{ name : 'admin.auth.login' }" class="link link__login">Login</router-link>
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
    import {mapActions} from "vuex";

    export default {
        name: "Forgot",
        components : {
            InputField, CheckboxField,
            SimpleButton,
        },
        data: () => ({
            login : ''
        }),
        created() {
            this.setLoadingStatus(true)
        },
        methods: {
            ...mapActions(['setLoadingStatus']),
            ...mapActions('Admin/Auth', ['sendResetPasswordMail']),
            async fireResetPasswordEvent() {
                if (await this.sendResetPasswordMail(this.login)) {
                    this.setLoadingStatus(false).then( () => this.$router.push({ name: 'admin.auth.login' }));
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    .forgot {
        min-height: 100vh;

        .header {
            font-size: 1.2rem;
        }

        .sign_in__text {
            color: #74788d;
            font-size: .8rem;
        }

        .header {
            font-size: 1.2rem;
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

        .link__login {
            min-width: 110px;
            height: 40px;
            padding: .5rem .75rem;
            border-radius: .25rem;
            border: 1px solid #5664d2;
            color: #5664d2;
            text-align: center;
            transition: all .3s ease-in-out;

            &:hover {
                box-shadow: 0 0 5px 0 rgba(86, 100, 210, 0.5);
            }
        }
    }
</style>
