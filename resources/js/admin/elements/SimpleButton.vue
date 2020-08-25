<template>
    <div class="input" :class="{ classes, outlined }">
        <div class="input__button p-0">
            <button
                :disabled="disabled"
                @click="fireClick"
            >
                <slot></slot>
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SimpleButton",
        props : {
            classes : {
                type : String,
                default : ''
            },
            disabled : {
                type : Boolean,
                default : false
            },
            outlined : {
                type : Boolean,
                default : false
            }
        },
        methods : {
            fireClick() {
                this.$emit('click');
            }
        }
    }
</script>

<style lang="scss" scoped>
    .input {
        display: flex;
        align-items: center;
        width: auto;
        height: 40px;

        &.outlined {
            .input__button {
                button {
                    border: 1px solid #5664d2;
                    border-radius: .25rem;
                    background: none;
                    color: #5664d2;
                    text-align: center;
                    transition: all .3s ease-in-out;

                    &:hover {
                        box-shadow: 0 0 5px 0 rgba(86, 100, 210, 0.5);
                    }
                }
            }
        }

        .input__button {
	        min-width: 110px;
            height: 100%;

            button {
                width: 100%;
                height: 100%;
                padding: .5rem .75rem;
                border-radius: .25rem;
                border: 1px solid #5664d2;
                background: #5664d2;
                color: #fff;
                transition: all .3s ease-in-out;

                &:hover {
                    box-shadow: 0 0 5px 0 rgba(86, 100, 210, 0.5);
                }
            }
        }
    }
</style>
