<template>
    <div id="changePassword">
        <img class="logo" src="/assets/admin/img/logo.png">
        <h1 class="heading text-grey">Password changing</h1>
        <p class="text-grey">Enter credentials for password changing:</p>
        <div class="input__wrapper">
            <input class="input" placeholder="Email" v-model.trim="$v.login.$model" :disabled="requestProcessing">
            <div class="errors">
                <transition name="fade">
                    <div class="simple-error" v-if="$v.login.$dirty && !$v.login.required">Email is required</div>
                    <div class="simple-error" v-for="error in validation.login">{{ error }}</div>
                </transition>
            </div>
            <input class="input" placeholder="Code" type="password" v-model.trim="$v.newPassword.$model" :disabled="requestProcessing">
            <div class="errors">
                <transition name="fade">
                    <div class="simple-error" v-if="$v.newPassword.$dirty && !$v.newPassword.required">New password is required</div>
                    <div class="simple-error" v-for="error in validation.newPassword">{{ error }}</div>
                </transition>
            </div>
            <input class="input" placeholder="Password confirmation" type="password" v-model.trim="$v.newPasswordConfirm.$model" :disabled="requestProcessing">
            <div class="errors">
                <transition name="fade">
                    <div class="simple-error" v-if="$v.newPasswordConfirm.$dirty && !$v.newPasswordConfirm.required">Password confirmation is required</div>
                    <div class="simple-error" v-for="error in validation.newPasswordConfirm">{{ error }}</div>
                </transition>
            </div>
            <input class="input" placeholder="Code" v-model.trim="$v.token.$model" :disabled="requestProcessing">
            <div class="errors">
                <transition name="fade">
                    <div class="simple-error" v-if="$v.token.$dirty && !$v.token.required">Code is required</div>
                    <div class="simple-error" v-for="error in validation.token">{{ error }}</div>
                </transition>
            </div>
        </div>
        <div class="buttons__section">
            <v-btn class="submit-button"
                   :loading="requestProcessing"
                   @click="triggerResettingPassword"
            >Change</v-btn>
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
                login : '',
                newPassword : '',
                newPasswordConfirm : '',
                token : '',
                validation : {}
            }
        },
        validations: {
            login : {
                required
            },
            newPassword : {
                required
            },
            newPasswordConfirm : {
                required
            },
            token : {
                required
            }
        },
        methods: {
            ...mapActions('Admin/Auth', ['resetPassword']),
            async triggerResettingPassword()
            {
                this.$v.$touch();
                if (this.$v.$invalid) {
                    return;
                }

                this.requestProcessing = true;
                let response = await this.resetPassword({
                    login : this.login,
                    newPassword : this.newPassword,
                    newPasswordConfirm : this.newPasswordConfirm,
                    token : this.token
                });
                if (response && response.alias === 'auth.password_changed') {
                    this.requestProcessing = false;
                    this.$router.push({ name : 'admin.auth.login' })
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

    #changePassword {
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
