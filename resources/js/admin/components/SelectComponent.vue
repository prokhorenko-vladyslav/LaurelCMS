<template>
    <div class="select">
        <div class="select__backdrop" v-if="dropdownVisible" @click="hideDropdown"></div>
        <label class="d-flex flex-column" @click="showDropdown">
            <span class="select__name">Single select</span>
            <input class="select__field" :class="{ 'dropdown-visible' : dropdownVisible }" type="text" placeholder="Select option" :value="value" readonly>
            <span class="select__description">Please choose your first name</span>
            <span class="select__dropdown__icon d-flex align-items-center">
                <svg width="15" height="15" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.07106 3.53553L4.88908 6.71751C4.69381 6.91278 4.37723 6.91278 4.18197 6.71751L0.999989 3.53553" stroke="#CBCBCB"/>
                </svg>
            </span>
        </label>
        <div class="select__dropdown__menu" v-show="dropdownVisible">
            <input class="dropdown__input" type="text" placeholder="Input to search...">
            <div class="dropdown__items">
                <div class="dropdown__item" @click="select(1)">Option 1</div>
                <div class="dropdown__item" @click="select(2)">Option 2</div>
                <div class="dropdown__item" @click="select(3)">Option 3</div>
                <div class="dropdown__item" @click="select(4)">Option 4</div>
            </div>
        </div>
        <div class="select__language__selected d-flex align-items-center">
            <img src="/admin/img/icons/settings/usa.png" alt="">
        </div>
        <div class="select__languages">
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
        name: "SelectComponent",
        data: () => ({
            dropdownVisible : false,
            value : null
        }),
        methods: {
            showDropdown() {
                this.dropdownVisible = true;
            },
            hideDropdown() {
                this.dropdownVisible = false;
            },
            select(value) {
                this.value = value;
                this.hideDropdown();
            }
        }
    }
</script>

<style lang="scss" scoped>
    .select {
        width: 100%;
        position: relative;

        .select__backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 2;
        }

        .select__name {
            margin-bottom: 6px;
            font-size: 17px;
            line-height: 17px;
            font-weight: normal;
            color: #475F7B;
        }

        .select__field {
            height: 40px;
            padding: 9px 9px 9px 50px;
            border: 0.5px solid #DFE3E7;
            box-sizing: border-box;
            border-radius: 2px;
            color: #475F7B;
            transition: all .3s ease-in-out;

            &::placeholder {
                color: #828D99;
                font-weight: lighter;
            }

            &.dropdown-visible,
            &:focus {
                border-color: #5A8DEE;

                & + .select__description + .select__dropdown__icon path {
                    stroke: #5A8DEE;
                }
            }
        }

        .select__dropdown__menu {
            position: absolute;
            left: 0;
            top: 80%;
            width: 100%;
            background: #FFFFFF;
            box-shadow: -5px 4px 15px rgba(0, 0, 0, 0.2);
            border-radius: 2px;
            z-index: 3;

            .dropdown__input {
                width: calc(100% - 18px);
                height: 30px;
                margin: 9px;
                padding: 9px;
                border: 0.5px solid #DFE3E7;
                box-sizing: border-box;
                border-radius: 2px;
                color: #475F7B;
                transition: all .3s ease-in-out;

                &::placeholder {
                    color: #828D99;
                    font-weight: lighter;
                }

                &:hover {
                    border-color: #5A8DEE;
                }
            }

            .dropdown__item {
                margin-bottom: 5px;
                padding: 5px 9px;
                transition: all .3s ease-in-out;
                cursor: pointer;

                &.current {
                    background: #F2F4F4;
                }

                &:hover {
                    background: rgba(90, 141, 238, 0.75);
                    color: #fff;
                }
            }
        }

        .select__description {
            margin-top: 6px;
            font-size: 12px;
            font-weight: 300;
            line-height: 12px;
            color: #828D99;
        }

        .select__dropdown__icon {
            position: absolute;
            right: 10px;
            top: 2px;
            height: 100%;

            path {
                transition: all .3s ease-in-out;
            }
        }

        .select__language__selected {
            position: absolute;
            left: 10px;
            top: 2px;
            height: 100%;
            width: 40px;
            cursor: pointer;

            img {
                width: 25px;
                height: 25px;
            }

            &:hover + .select__languages {
                visibility: visible;
                opacity: 1;
            }
        }

        .select__languages {
            position: absolute;
            left: 0;
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
