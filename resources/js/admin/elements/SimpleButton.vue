<template>
    <div class="input" :class="{ classes, outlined, simple, primary, secondary }">
        <div class="input__button p-0">
            <component :is="type"
                       :disabled="disabled"
                       :to=" isLink ? to : '' "
                       @click="fireClick"
            >
                <slot></slot>
            </component>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SimpleButton",
        props : {
            type : {
                type : String,
                default : 'button'
            },
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
            },
            simple : {
                type : Boolean,
                default : false,
            },
            primary : {
                type : Boolean,
                default : false
            },
            secondary : {
                type : Boolean,
                default : false
            },
            to : {

            }
        },
        computed: {
            isLink() {
                return this.type == 'router-link';
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

        &.simple {
            .input__button {
                min-width: auto;

                button {
                    border: none;
                    background: none;
                    color: #5664d2;

                    &:hover {
                        box-shadow: none;
                    }
                }
            }
        }

        &.outlined {
            .input__button {
                button {
                    background: none;
                    color: #5664d2;

                    &:hover {
                        box-shadow: 0 0 5px 0 rgba(86, 100, 210, 0.5);
                    }
                }
            }
        }

        &.primary {
            .input__button {
                button {
                    border-color: #4EDE97;
                    background-color: #4EDE97;
                    box-shadow: 0 2px 4px 0 rgba(57,218,138,.5);

                    &:hover {
                        box-shadow: 0 4px 12px 0 rgba(57,218,138,.6);
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
                text-align: center;
                transition: all .3s ease-in-out;

                &:hover {
                    box-shadow: 0 0 5px 0 rgba(86, 100, 210, 0.5);
                }
            }
        }
    }
</style>
