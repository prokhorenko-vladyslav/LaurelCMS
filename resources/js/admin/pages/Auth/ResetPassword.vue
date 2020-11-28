<template>
    <div id="confirmIpAddress">
        <img class="logo" src="/assets/admin/img/logo.png">
        <h1 class="heading text-grey">Password resetting</h1>
        <p class="text-grey">Enter account email for password resetting:</p>
        <div class="input__wrapper">
            <input class="input" placeholder="Email" v-model.trim="$v.login.$model" :disabled="requestProcessing">
            <div class="errors">
                <transition name="fade">
                    <div class="simple-error" v-if="$v.login.$dirty && !$v.login.required">Email is required</div>
                    <div class="simple-error" v-for="error in validation.login">{{ error }}</div>
                </transition>
            </div>
        </div>
        <div class="buttons__section">
            <v-btn class="submit-button"
                   :loading="requestProcessing"
                   @click="triggerResettingPassword"
            >Reset</v-btn>
            <v-btn class="cancel-button"
                   link
                   :to="{ name : 'admin.auth.login' }"
            >Cancel</v-btn>
        </div>
    </div>
</template>

<script>
    import {mapActions} from "vuex";
    import { required } from 'vuelidate/lib/validators';

    export default {
        name: "ResetPassword",
        data() {
            return {
                requestProcessing : false,
                login : this.$route.query.login,
                validation : {}
            }
        },
        validations: {
            login : {
                required
            }
        },
        methods: {
            ...mapActions('Admin/Auth', ['sendResetPasswordMail']),
            async triggerResettingPassword()
            {
                this.$v.$touch();
                if (this.$v.$invalid) {
                    return;
                }

                this.requestProcessing = true;
                let response = await this.sendResetPasswordMail(this.login);
                if (response && response.alias === 'auth.email_for_reset_password_sent') {
                    this.requestProcessing = false;
                    this.$router.push({ name : 'admin.auth.password.change' });
                } else if (response && response.code === 422) {
                    this.validation = response.data;
                    this.requestProcessing = false;
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

    #confirmIpAddress {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 100vh;

        .logo {
            height: 75px;
            margin-bottom: 1.5rem;
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

        .submit-button,
        .cancel-button, {
            height: 40px;
            padding-left: 3rem;
            padding-right: 3rem;
            border-radius: 1.5rem;
            text-transform: capitalize;
            font-size: .85rem;
            font-weight: 400;
            color: #fff;
        }

        .submit-button {
            border: none;
            background: #6993ff;
        }

        .cancel-button {
            background: transparent;
            border: 1px solid rgba(255,255,255,.4);

            &:before {
                background: none;
                transition: all .3s ease-in-out;
            }

            &:hover {
                &:before {
                    background: currentColor;
                }
            }
        }
    }
</style>
