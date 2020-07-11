<template>
    <div class="input row" :class="{ classes, active : focusing, 'flex-row-reverse' : iconRight, 'has-border-bottom' : hasBorderBottom }" @click="focusOnInput">
        <div class="input__icon col-2" v-if="hasIcon" :style="{ height : iconSize, width : iconSize }">
            <slot name="icon"></slot>
        </div>
        <div class="input__wrapper col-10">
            <div class="input__label" v-if="hasLabel">
                <slot name="label"></slot>
            </div>
            <div class="input__input">
                <input
                    :type="type"
                    :placeholder="placeholder"
                    :value="value"
                    :disabled="disabled"
                    ref="input"
                    @focus="setFocus"
                    @blur="removeFocus"
                >
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "InputField",
        props : {
            classes : {
                type : String,
                default : ''
            },
            hasIcon : {
                type : Boolean,
                default : false
            },
            iconRight : {
                type : Boolean,
                default : false,
            },
            hasLabel : {
                type : Boolean,
                default : false
            },
            iconSize : {
                type : String,
                default : 'text'
            },
            type : {
                type : String,
                default : 'text'
            },
            placeholder : {
                type : String,
                default : ''
            },
            value : {
                type : String,
                default : ''
            },
            disabled : {
                type : Boolean,
                default : false
            },
            hasBorderBottom : {
                type : Boolean,
                default : false,
            }
        },
        data: () => ({
            focusing : false,
        }),
        methods : {
            focusOnInput() {
                this.$refs["input"].focus()
            },
            setFocus() {
                this.focusing = true;
            },
            removeFocus() {
                this.focusing = false;
            },
        }
    }
</script>

<style lang="scss" scoped>
    .input {
        display: flex;
        align-items: flex-end;
        width: 100%;
        height: 60px;
        padding: .25rem .5rem;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: all .3s ease-in-out;

        &.has-border-bottom {
            border: none;
            border-bottom: 1px solid #ced4da;
        }

        &:hover,
        &.active {
            border-color: rgba(86, 100, 210, 0.35);
            box-shadow: 0 0 3px 0 rgba(86, 100, 210, 0.5);
        }

        .input__icon {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 30px;
            height: 30px;
            margin-bottom: 10px;
            padding: 0;

            img, svg {
                width: 100%;
                height: 100%;
            }
        }

        .input__input {
            input {
                width: 100%;
                border: none;
                background: none;
                color: #505d69;

                &::placeholder {
                    color: #74788d
                }
            }
        }

        .input__label {
            font-weight: 600;
            color: #505d69;
            cursor: default;
        }
    }
</style>
