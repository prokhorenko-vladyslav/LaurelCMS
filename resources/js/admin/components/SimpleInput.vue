<template>
    <div class="simple-input">
        <label class="d-flex flex-column">
            <span class="input__name">{{ name }}</span>
            <input class="input__field" type="text" :placeholder="attributes.placeholder">
            <span class="input__description">{{ description }}</span>
        </label>
        <div class="input__language__selected d-flex align-items-center justify-content-end">
            <img src="/admin/img/icons/settings/usa.png" alt="">
        </div>
        <div class="input__languages" v-if="attributes.translatable">
            <div class="language d-flex align-items-center">
                <div class="language__img">
                    <img src="/admin/img/icons/settings/usa.png" alt="">
                </div>
                <div class="language__name">
                    English
                </div>
            </div>
            <div class="language d-flex align-items-center">
                <div class="language__img">
                    <img src="/admin/img/icons/settings/russia.png" alt="">
                </div>
                <div class="language__name">
                    Russian
                </div>
            </div>
            <div class="language d-flex align-items-center">
                <div class="language__img">
                    <img src="/admin/img/icons/settings/ukraine.png" alt="">
                </div>
                <div class="language__name">
                    Ukrainian
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SimpleInput",
        props: {
            name : {
                type : String,
                required : true
            },
            description : {
                type : String,
                default : ''
            },
            value : {
                default : null
            },
            attributes : {
                type : Object,
                default: () => {}
            }
        }
    }
</script>

<style lang="scss" scoped>
    .simple-input {
        width: 100%;
        position: relative;

        .input__name {
            margin-bottom: 6px;
            font-size: 17px;
            line-height: 17px;
            font-weight: normal;
            color: #475F7B;
        }

        .input__field {
            height: 40px;
            padding: 9px 60px 9px 9px;
            border: 0.5px solid #DFE3E7;
            box-sizing: border-box;
            border-radius: 2px;
            color: #475F7B;
            transition: all .3s ease-in-out;

            &::placeholder {
                color: #828D99;
                font-weight: lighter;
            }

            &:focus {
                border-color: #5A8DEE;
            }

            &:disabled {
                background: #F2F4F4;
                cursor: not-allowed;
            }
        }

        .input__description {
            margin-top: 6px;
            font-size: 12px;
            font-weight: 300;
            line-height: 12px;
            color: #828D99;
        }

        .input__language__selected {
            position: absolute;
            right: 10px;
            top: 2px;
            height: 100%;
            width: 50px;
            cursor: pointer;

            img {
                width: 25px;
                height: 25px;
            }

            &:hover + .input__languages {
                visibility: visible;
                opacity: 1;
            }
        }

        .input__languages {
            position: absolute;
            right: 0;
            top: 80%;
            padding-top: 5px;
            padding-bottom: 5px;
            background: #FFFFFF;
            box-shadow: -5px 4px 15px rgba(0, 0, 0, 0.2);
            border-radius: 2px;
            opacity: 0;
            visibility: hidden;
            transition: all .3s ease-in-out;
            z-index: 3;

            &:hover {
                visibility: visible;
                opacity: 1;
            }

            .language {
                height: 35px;
                padding: 0 15px;
                cursor: pointer;
                transition: all .3s ease-in-out;

                .language__img {
                    width: 25px;
                    height: 25px;
                    margin-bottom: 2px;
                    margin-right: 10px;

                    * {
                        width: 100%;
                        height: 100%;
                    }
                }

                .language__name {
                    font-size: 13px;
                    line-height: 13px;
                    color: #8494A7;
                }

                &:hover {
                    background: #F2F4F4;
                }
            }
        }
    }
</style>
