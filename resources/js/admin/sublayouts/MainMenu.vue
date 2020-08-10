<template>
    <div class="main-menu">
        <div class="main-menu__header">

        </div>
        <div class="main-menu__section">
            <div class="has-subsection">
                <input id="checkbox_1" class="main-menu__section__item toggle_checkbox" type="checkbox">
                <label for="checkbox_1" class="main-menu__section__item parent">Dashboard <span class="counter">2</span></label>
                <div class="main-menu__subsection">
                    <router-link to="#" class="main-menu__section__item main-menu__section__subitem">eCommerce</router-link>
                    <router-link to="#" class="main-menu__section__item main-menu__section__subitem">Analytics</router-link>
                </div>
            </div>
        </div>
        <div class="main-menu__section">
            <div class="main-menu__section__header">Apps</div>
            <router-link to="#" class="main-menu__section__item">Email</router-link>
            <router-link to="#" class="main-menu__section__item">Chat</router-link>
            <router-link to="#" class="main-menu__section__item">Todo</router-link>
            <router-link to="#" class="main-menu__section__item">Calendar</router-link>
            <div class="has-subsection">
                <input id="checkbox_2" class="main-menu__section__item toggle_checkbox" type="checkbox">
                <label for="checkbox_2" to="#" class="main-menu__section__item parent">Kanban</label>
                <div class="main-menu__subsection">
                    <router-link to="#" class="main-menu__section__item main-menu__section__subitem">Invoice List</router-link>
                    <router-link to="#" class="main-menu__section__item main-menu__section__subitem">Invoice</router-link>
                    <router-link to="#" class="main-menu__section__item main-menu__section__subitem">Invoice Add</router-link>
                    <router-link to="#" class="main-menu__section__item main-menu__section__subitem">Invoice Edit</router-link>
                </div>
            </div>
            <router-link to="#" class="main-menu__section__item">Invoice</router-link>
        </div>
        <div class="main-menu__section">
            <div class="main-menu__section__header">Ui elements</div>
            <div class="has-subsection">
                <input id="checkbox_3" class="main-menu__section__item toggle_checkbox" type="checkbox">
                <label for="checkbox_3" class="main-menu__section__item parent">Content</label>
                <div class="main-menu__subsection">
                    <router-link to="#" class="main-menu__section__item main-menu__section__subitem">Grid</router-link>
                    <router-link to="#" class="main-menu__section__item main-menu__section__subitem">Typography</router-link>
                    <router-link to="#" class="main-menu__section__item main-menu__section__subitem">Text Utilities</router-link>
                    <router-link to="#" class="main-menu__section__item main-menu__section__subitem">Syntax Highlighter</router-link>
                    <router-link to="#" class="main-menu__section__item main-menu__section__subitem">Helper Classes</router-link>
                </div>
            </div>
            <router-link to="#" class="main-menu__section__item">Colors</router-link>
            <router-link to="#" class="main-menu__section__item">Icons</router-link>
            <router-link to="#" class="main-menu__section__item">Card</router-link>
            <router-link to="#" class="main-menu__section__item">Widgets <div class="counter info">New</div></router-link>
            <router-link to="#" class="main-menu__section__item">Components</router-link>
            <router-link to="#" class="main-menu__section__item">Extra components</router-link>
        </div>
        <div class="main-menu__section">
            <div class="main-menu__section__header">Forms & Tables</div>
            <router-link to="#" class="main-menu__section__item">Form elements</router-link>
            <router-link to="#" class="main-menu__section__item">Form layout</router-link>
            <router-link to="#" class="main-menu__section__item">Form wizzard</router-link>
            <router-link to="#" class="main-menu__section__item">Form validation</router-link>
            <router-link to="#" class="main-menu__section__item">Form repeater</router-link>
            <router-link to="#" class="main-menu__section__item">Table</router-link>
            <router-link to="#" class="main-menu__section__item">Table extended</router-link>
            <router-link to="#" class="main-menu__section__item">Datatable</router-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MainMenu"
    }
</script>

<style lang="scss" scoped>
    .main-menu {
        height: 100vh;
        width: 100%;
        padding: 1rem;
        border-right: 1px solid #DFE3E7;
        background: #F2F4F4;
        overflow-y: auto;

        &:after {
            content: "";
            display: block;
            height: 2rem;
        }

        .main-menu__header {

        }

        .main-menu__section {
            margin-top: 1rem;

            .main-menu__section__header {
                text-transform: uppercase;
                color: #BAC0C7;
                font-size: 12px;
                letter-spacing: 1px;
            }

            .main-menu__section__item {
                display: flex;
                align-items: center;
                justify-content: space-between;
                width: 100%;
                margin-top: .2rem;
                padding: .6rem 1rem;
                border-radius: .25rem;
                color: #8494A7;
                font-size: 15px;
                transition: all .3s ease-in-out;

                &.router-link-active,
                &:hover {
                    background: rgba(90, 141, 238, .15);
                    color: #5A8DEE;
                }

                .counter {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    width: 20px;
                    height: 20px;
                    margin-left: auto;
                    border-radius: 50%;
                    font-size: 12px;
                    background: #ffdede;
                    color: #ff5b5c;

                    &.info {
                        height: 24px;
                        width: max-content;
                        padding-left: .7rem;
                        padding-right: .7rem;
                        border-radius: 25%;
                        background: #E2ECFF;
                        color: #5A8DEE;
                        box-shadow: 0 4px 12px 0 rgba(90,141,238,.3);
                        animation-name: pulse;
                        animation-iteration-count: infinite;
                        animation-duration: 1s;
                        text-rendering: geometricPrecision;
                    }
                }
            }

            .has-subsection {
                max-height: max-content;
                margin-top: .5rem;
                border: 1px solid #DFE3E7;
                border-radius: .25rem;
                background: #FAFBFB;
                overflow: hidden;
                transition: all .6s ease-in-out;

                .main-menu__section__item {
                    margin: 0;
                    border: none;
                    border-radius: 0;

                    &.router-link-active,
                    &:hover {
                        background: none;
                        color: #8494A7;
                    }

                    &.parent {
                        width: auto;
                        margin-left: 1rem;
                        margin-right: 1rem;
                        padding-left: 0;
                        padding-right: 0;
                        cursor: pointer;
                        user-select: none;

                        &:after {
                            content: '';
                            display: block;
                            width: 8px;
                            height: 8px;
                            margin-top: -4px;
                            border-right: 2px solid #8494A7;
                            border-bottom: 2px solid #8494A7;
                            cursor: pointer;
                            transition: all .3s ease-in-out;
                        }

                        .counter {
                            margin-right: 1rem;
                        }
                    }

                    &.toggle_checkbox {
                        display: none;

                        & + .parent {
                            &:after {
                                margin-top: -4px;
                                transform: rotate(45deg);
                            }
                        }

                        &:checked + .parent {
                            &:after {
                                margin-top: 2px;
                                transform: rotate(-135deg);
                            }
                        }

                        &:checked + .parent + .main-menu__subsection {
                            height: 100%;
                            max-height: 100vh;
                            transform: scaleY(1);
                            transition:
                                all .45s ease-in-out,
                                max-height .9s ease-in-out;
                        }
                    }
                }


                .main-menu__subsection {
                    height: 0;
                    max-height: 0;
                    width: 100%;
                    transform: scaleY(0);
                    transform-origin: top;
                    transition:
                        all .9s ease-in-out,
                        max-height .45s ease-in-out;

                    .main-menu__section__subitem {
                        display: flex;
                        justify-content: flex-start;
                        position: relative;
                        margin-top: .2rem;

                        &:before {
                            content: '';
                            background-image: url("/admin/img/icons/right-arrow.svg");
                            background-size: contain;
                            width: 14px;
                            height: 14px;
                            margin-top: 1px;
                            margin-right: .3rem;
                            transition: all .3s ease-in-out;
                        }

                        &:first-of-type {
                            margin-top: 0;
                        }

                        &.router-link-active,
                        &:hover {
                            color: #5A8DEE;
                            background: rgba(90, 141, 238, .15);

                            &:before {
                                background-image: url("/admin/img/icons/right-arrow-blue.svg");
                            }

                            &:first-of-type:after {
                                background: none;
                            }
                        }

                        &:hover {
                            padding-left: 2rem;
                        }

                        &.router-link-active {
                            background: rgba(90, 141, 238, .15);
                            color: #5A8DEE;

                            &:first-of-type:after {
                                background: none;
                            }
                        }

                        &:first-of-type:after {
                            content: '';
                            position: absolute;
                            top: 0;
                            left: 5%;
                            right: 5%;
                            display: block;
                            width: 90%;
                            height: 1px;
                            background: #DFE3E7;
                            transition: all .3s ease-in-out;
                        }
                    }
                }
            }
        }
    }
</style>
