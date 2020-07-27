<template>
    <div class="row login">
        <div class="col-xl-4 col-lg-5 col-md-6">
            <div class="d-flex flex-column align-items-center justify-content-center h-100">
                <div class="logo">
                    <img src="/admin/img/logo.png" alt="Logo">
                </div>
                <h1 class="header mt-4 mb-0">We have detected another ip address!</h1>
                <p class="secondary__text">To confirm this ip address input code. Mail has been sent to user email.</p>
                <div class="row w-100 justify-content-center mt-4">
                    <div class="col-md-8 d-flex justify-content-center">
                        <input-field
                            has-icon
                            has-label
                            type="password"
                            placeholder="Enter code from mail"
                        >
                            <template v-slot:icon>
                                <img src="/admin/img/icons/lock.svg" alt="Lock">
                            </template>
                            <template v-slot:label>
                                Code
                            </template>
                        </input-field>
                    </div>
                </div>
                <div class="row w-100 justify-content-center mt-4">
                    <div class="col-6 d-flex justify-content-end">
                        <simple-button outlined>Confirm</simple-button>
                    </div>
                    <div class="col-6 d-flex justify-content-start">
                        <simple-button @click="resendMail">Resend <span v-if="resendTime">({{ resendTime }})</span></simple-button>
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
    import InputField from "../../fields/InputField";
    import CheckboxField from "../../fields/CheckboxField";
    import SimpleButton from "../../fields/SimpleButton";

    export default {
        name: "IpAddressConfirm",
        components : {
            InputField, CheckboxField,
            SimpleButton,
        },
        data: () => ({
            settingsResendTime : 60,
            resendTime : 0,
            resendTimer : false,
        }),
        created() {
            this.startResendTimer();
        },
        methods : {
            startResendTimer() {
                this.resendTime = this.settingsResendTime;
                this.resendTimer = setInterval(() => {
                    if (this.resendTime > 0) {
                        this.resendTime--;
                    } else {
                        clearInterval(this.resendTimer);
                        this.resendTime = 0;
                        this.resendTimer = false;
                    }
                }, 1000);
            },
            resendMail() {
                if (!this.resendTime) {
                    this.startResendTimer()
                }
            }
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
                background: url("/admin/img/icons/lock-filled.svg");
                background-size: cover;
            }
        }
    }
</style>
