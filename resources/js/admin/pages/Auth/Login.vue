<template>
    <div id="login">
        <img class="logo" src="/assets/admin/img/logo.png">
        <h1 class="heading text-grey">Sign In to Admin</h1>
        <p class="text-grey">Enter your details to login to your account:</p>
        <div class="input__wrapper">
            <input class="input" placeholder="Email" v-model.trim="$v.login.$model" :disabled="requestProcessing">
            <div class="errors">
                <transition name="fade">
                    <div class="simple-error" v-if="$v.login.$dirty && !$v.login.required">Login is required</div>
                    <div class="simple-error" v-for="error in validation.login">{{ error }}</div>
                </transition>
            </div>
            <input class="input" placeholder="Password" type="password" v-model.trim="$v.password.$model" :disabled="requestProcessing">
            <div class="errors">
                <transition name="fade">
                    <div class="simple-error" v-if="$v.password.$dirty && $v.password.required !== true">Password is required</div>
                    <div class="simple-error" v-for="error in validation.password">{{ error }}</div>
                </transition>
            </div>
        </div>
        <div class="forget__section">
            <div class="checkbox">
                <input id="rememberMe" class="checkbox__input" type="checkbox" v-model="rememberMe" :disabled="requestProcessing">
                <label for="rememberMe">
                    <span class="checkbox__icon"></span>
                    <span class="checkbox__label">Remember me</span>
                </label>
            </div>
            <router-link :to="{ name : 'admin.auth.password.reset' }" class="forget__link">Forget Password?</router-link>
        </div>
        <v-btn class="submit-button"
               :loading="requestProcessing"
               @click="triggerSignIn"
        >Sign in</v-btn>
    </div>
</template>

<script>
    import {mapActions} from "vuex";
    import { required } from 'vuelidate/lib/validators';

    export default {
        name: "Login",
        data: () => ({
            requestProcessing : false,
            login : '',
            password : '',
            rememberMe : false,
            validation : {}
        }),
        validations: {
            login : {
                required
            },
            password : {
                required
            },
        },
        methods: {
            ...mapActions('Admin/Auth', ['signIn']),
            async triggerSignIn()
            {
                this.$v.$touch();
                if (this.$v.$invalid) {
                    return;
                }

                this.requestProcessing = true;
                let response = await this.signIn({ login : this.login, password : this.password, rememberMe : this.rememberMe });
                if (response && response.alias === 'auth.logged_in') {
                    this.requestProcessing = false;
                    this.$router.push({ name : 'admin.dashboard' })
                } else if (response && response.code === 422) {
                    this.validation = response.data;
                    this.requestProcessing = false;
                } else if (response && response.alias === 'auth.ip_confirm_mail_sent') {
                    this.$router.push({
                        name : 'admin.auth.ip_confirm',
                        query : {
                            login : this.login,
                            ipAddress : response.data.ipAddress
                        }
                    });
                } else {
                    this.requestProcessing = false;

                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }

    .errors {
        margin-bottom: 1.3rem;

        .simple-error {
            margin-top: .25rem;
            background: none;
            color: #f64e60;
            text-align: center;
            font-size: .7rem;
            font-weight: 400;
        }
    }

    #login {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 100vh;

        .logo {
            height: 75px;
            margin-bottom: 2.5rem;
        }

        .text-grey {
            color: #fff;
            opacity: .4;
            font-size: 13px;

            &.heading {
                font-size: 1.5rem;
                font-weight: 400;
            }
        }

        .input__wrapper {
            display: flex;
            flex-direction: column;
            margin-top: 1.5rem;

            .input {
                width: 400px;
                padding: .7rem 2rem;
                border: none;
                border-radius: 50rem;
                background: rgba(255,255,255,.02);
                font-size: .9rem;
                color: rgba(255,255,255,.6);

                &::placeholder {
                    color: #b5b5c3;
                }
            }
        }

        .forget__section {
            display: flex;
            justify-content: space-between;
            width: 340px;
            margin-bottom: 2rem;

            .checkbox {
                .checkbox__input {
                    display: none;

                    &:checked {
                        & + label .checkbox__icon {
                            &:before {
                                opacity: 1;
                                transform: rotate(45deg);
                                transition:
                                    opacity .3s ease-in-out,
                                    transform .1s ease-in-out;
                            }
                        }
                    }
                }

                label {
                    display: flex;
                    align-items: center;
                    user-select: none;
                    cursor: pointer;

                    .checkbox__icon {
                        position: relative;
                        display: inline-block;
                        width: 16px;
                        height: 16px;
                        margin-right: .5rem;
                        border: 1px solid rgba(255,255,255,.4);
                        border-radius: 2px;

                        &:before {
                            content: '';
                            left: 4px;
                            top: 1px;
                            position: absolute;
                            display: block;
                            width: 6px;
                            height: 9px;
                            border-bottom: 1px solid #fff;
                            border-right: 1px solid #fff;
                            opacity: 0;
                            transition:
                                opacity .3s ease-in-out,
                                transform .7s ease-in-out;
                        }
                    }

                    .checkbox__label {
                        color: rgba(255,255,255,.4);
                        font-size: .8rem;
                    }
                }
            }

            .forget__link {
                color: #fff;
                opacity: 0.4;
                text-decoration: none;
                font-size: .85rem;
                font-weight: 500;
            }
        }

        .submit-button {
            height: 40px;
            padding-left: 3rem;
            padding-right: 3rem;
            border: none;
            border-radius: 1.5rem;
            background: #6993ff;
            color: #fff;
            text-transform: capitalize;
            font-size: .85rem;
            font-weight: 400;
        }
    }
</style>
