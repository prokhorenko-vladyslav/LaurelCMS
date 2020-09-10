<template>
    <div class="input d-flex" :class="{ classes, checked : dataValue }">
        <div class="input__input p-0">
            <label class="input__fake-checkbox">
                <input
                    class="d-none"
                    type="checkbox"
                    :disabled="disabled"
                    :checked="dataValue"
                    v-model="dataValue"
                >
            </label>
        </div>
        <div class="input__label ml-2 p-0" @click="check">
            <slot name="label"></slot>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CheckboxField",
        props : {
            classes : {
                type : String,
                default : ''
            },
            value : {
                type : Boolean,
                default : ''
            },
            disabled : {
                type : Boolean,
                default : false
            },
        },
        data() {
            return {
                dataValue : this.value
            }
        },
        watch : {
            value() {
                this.dataValue = this.value;
            },
            dataValue() {
                this.$emit('input', this.dataValue);
            }
        },
        methods : {
            check() {
                if (!this.disabled) {
                    this.dataValue = !this.dataValue;
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    .input {
        display: flex;
        align-items: center;
        width: 100%;

        .input__input {
            .input__fake-checkbox {
                position: relative;
                display: block;
                width: 1rem;
                height: 1rem;
                margin-bottom: 0;
                border: 1px solid #ced4da;
                border-radius: .25rem;
                transition: all .3s ease-in-out;

                &:before {
                    content: '';
                    position: absolute;
                    left: 3px;
                    bottom: 3px;
                    display: block;
                    visibility: hidden;
                    width: .5rem;
                    height: .8rem;
                    border-bottom: 1px solid #5664d2;
                    border-right: 1px solid #5664d2;
                    transform: rotate(45deg) scale(0);
                    transition: all .1s ease-in-out;
                }
            }
        }

        &.checked {
            .input__input {
                .input__fake-checkbox {
                    border-color: #5664d2;

                    &:before {
                        visibility: visible;
                        transform: rotate(45deg) scale(1);
                    }
                }
            }
        }

        .input__label {
            font-weight: bold;
            color: #505d69;
            cursor: pointer;
            user-select: none;
        }
    }
</style>
