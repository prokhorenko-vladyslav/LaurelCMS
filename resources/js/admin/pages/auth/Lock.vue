<template>
    <div class="lock">
        <div class="background">
            <div class="background-overlay"></div>
            <div class="row h-100 justify-content-center align-items-center lock__block__wrapper">
                <div class="col-xl-3 col-md-5 col-10 lock__block">
                    <div class="d-flex justify-content-center flex-column pt-3 pb-3">
                        <img src="/admin/img/icons/lock-big.svg" alt="" class="lock__block__logo">
                        <div class="header text-center">Hey, Vladislav.</div>
                        <div class="secondary__text text-center">You have not any activity during 10 minutes. <br>Login to continue...</div>
                        <div class="row w-100 justify-content-center mt-4">
                            <div class="col-md-8 d-flex justify-content-center">
                                <input-field
                                    has-icon
                                    icon-right
                                    has-label
                                    has-border-bottom
                                    icon-size="15px"
                                    type="password"
                                    placeholder="Enter password"
                                >
                                    <template v-slot:icon>
                                        <img class="lock__block__field-icon" src="/admin/img/icons/lock-filled.svg" alt="Lock">
                                    </template>
                                    <template v-slot:label>
                                        Password
                                    </template>
                                </input-field>
                            </div>
                        </div>
                        <div class="row w-100 justify-content-center mt-4">
                            <div class="col-md-8 d-flex justify-content-center">
                                <router-link :to="{ name : 'admin.auth.forgot' }" class="link link_forgot-password">Forgot your password?</router-link>
                            </div>
                        </div>
                        <div class="row w-100 justify-content-center mt-4">
                            <div class="col-md-8 d-flex justify-content-center">
                                <simple-button>Unlock</simple-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import InputField from "../../elements/InputField";
    import SimpleButton from "../../elements/SimpleButton";

    export default {
        name: "Lock",
        components : {
            InputField,
            SimpleButton,
        }
    }
</script>

<style lang="scss" scoped>
    .lock {
        min-height: 100vh;

        .header {
            font-size: 1.2rem;
        }

        .sign_in__text {
            color: #74788d;
            font-size: .8rem;
        }

        .background {
            position: relative;
            min-height: 100vh;
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

        .lock__block__wrapper {
            min-height: 100vh;

            .lock__block {
                padding: 1rem 1.5rem;
                box-shadow: 0 5px 15px 0 rgba(0,0,0,.3);
                border-radius: .25rem;
                background: #e7e8e9;
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
