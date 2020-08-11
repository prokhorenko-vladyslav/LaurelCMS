<template>
    <div class="main-menu">
        <div class="main-menu__content">
        <div class="main-menu__header">

        </div>
        <div class="main-menu__section">
            <div class="has-subsection">
                <input id="checkbox_1" class="main-menu__section__item toggle_checkbox" type="checkbox">
                <label for="checkbox_1" class="main-menu__section__item parent"><img src="/admin/img/icons/menu/dashboard.svg" alt=""> Dashboard <span class="counter">2</span></label>
                <div class="main-menu__subsection">
                    <router-link to="#" class="main-menu__section__item main-menu__section__subitem">eCommerce</router-link>
                    <router-link to="#" class="main-menu__section__item main-menu__section__subitem">Analytics</router-link>
                </div>
            </div>
        </div>
        <div class="main-menu__section">
            <div class="main-menu__section__header">Apps</div>
            <router-link to="#" class="main-menu__section__item"><img src="/admin/img/icons/menu/email.svg" alt="">Email</router-link>
            <router-link to="#" class="main-menu__section__item"><img src="/admin/img/icons/menu/chat.svg" alt="">Chat</router-link>
            <router-link to="#" class="main-menu__section__item"><img src="/admin/img/icons/menu/todo.svg" alt="">Todo</router-link>
            <router-link to="#" class="main-menu__section__item"><img src="/admin/img/icons/menu/calendar.svg" alt="">Calendar</router-link>
            <router-link to="#" class="main-menu__section__item"><img src="/admin/img/icons/menu/kanban.svg" alt="">Kanban</router-link>
            <div class="has-subsection">
                <input id="checkbox_2" class="main-menu__section__item toggle_checkbox" type="checkbox">
                <label for="checkbox_2" to="#" class="main-menu__section__item parent"><img src="/admin/img/icons/menu/invoice.svg" alt=""> Invoice</label>
                <div class="main-menu__subsection">
                    <router-link to="#" class="main-menu__section__item main-menu__section__subitem">Invoice List</router-link>
                    <router-link to="#" class="main-menu__section__item main-menu__section__subitem">Invoice</router-link>
                    <router-link to="#" class="main-menu__section__item main-menu__section__subitem">Invoice Add</router-link>
                    <router-link to="#" class="main-menu__section__item main-menu__section__subitem">Invoice Edit</router-link>
                </div>
            </div>
            <router-link to="#" class="main-menu__section__item"><img src="/admin/img/icons/menu/file_manager.svg" alt=""> File Manager</router-link>
        </div>
        <div class="main-menu__section">
            <div class="main-menu__section__header">Content</div>
            <router-link to="#" class="main-menu__section__item"><img src="/admin/img/icons/menu/page.svg" alt=""> Pages</router-link>
            <router-link to="#" class="main-menu__section__item">Categories</router-link>
            <router-link to="#" class="main-menu__section__item">Posts</router-link>
            <router-link to="#" class="main-menu__section__item">Comments</router-link>
            <router-link to="#" class="main-menu__section__item">Reviews</router-link>
        </div>
        <div class="main-menu__section">
            <div class="main-menu__section__header">Shop</div>
            <router-link to="#" class="main-menu__section__item main-menu__section__subitem">Categories</router-link>
            <router-link to="#" class="main-menu__section__item main-menu__section__subitem">Products</router-link>
            <router-link to="#" class="main-menu__section__item main-menu__section__subitem">Attributes</router-link>
            <div class="has-subsection">
                <input id="sales" class="main-menu__section__item toggle_checkbox" type="checkbox">
                <label for="sales" class="main-menu__section__item parent">Sales</label>
                <div class="main-menu__subsection">
                    <router-link to="#" class="main-menu__section__item main-menu__section__subitem">Orders <div class="counter">99+</div></router-link>
                    <router-link to="#" class="main-menu__section__item main-menu__section__subitem">Clients</router-link>
                </div>
            </div>
        </div>
        <div class="main-menu__section">
            <div class="main-menu__section__header">Design</div>
            <div class="has-subsection">
                <input id="ui_elements" class="main-menu__section__item toggle_checkbox" type="checkbox">
                <label for="ui_elements" class="main-menu__section__item parent">UI elements</label>
                <div class="main-menu__subsection">
                    <router-link to="#" class="main-menu__section__item main-menu__section__subitem">Widgets <div class="counter info">New</div></router-link>
                    <router-link to="#" class="main-menu__section__item main-menu__section__subitem">Components <div class="counter info">New</div></router-link>
                    <router-link to="#" class="main-menu__section__item main-menu__section__subitem">Contact forms <div class="counter info">New</div></router-link>
                </div>
            </div>
            <router-link to="#" class="main-menu__section__item">Themes <div class="counter">1</div></router-link>
        </div>
        <div class="main-menu__section">
            <div class="main-menu__section__header">Settings</div>
            <router-link to="#" class="main-menu__section__item">General</router-link>
            <router-link to="#" class="main-menu__section__item">Server</router-link>
            <router-link to="#" class="main-menu__section__item">Localization</router-link>
        </div>
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
        position: relative;
        height: 100vh;
        width: 100%;
        padding: 0;
        border-right: 1px solid #DFE3E7;
        background-image: url('/admin/img/images/menu.jpg');
        background-size: cover;

        .main-menu__content {
            height: 100vh;
            padding: 1rem;
            overflow-y: auto;

            &:after {
                content: "";
                display: block;
                height: 2rem;
            }
        }

        & > * {
            position: relative;
            z-index: 2;
        }

        &:before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100vh;
            background: rgba(54, 90, 126, 0.4);
            z-index: 1;
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
                position: relative;
                left: 0;
                display: flex;
                align-items: center;
                width: 100%;
                margin-top: .2rem;
                padding: .6rem 1rem;
                border-radius: .25rem;
                color: #8494A7;
                font-size: 15px;
                transition: all .3s ease-in-out;

                &.router-link-active,
                &:hover {
                    left: 1rem;
                }

                img {
                    max-width: 30px;
                    height: 30px;
                    margin-right: 1rem;
                }

                .counter {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    position: relative;
                    left: 0;
                    margin-right: 1rem;
                    width: 20px;
                    height: 20px;
                    margin-left: auto;
                    border-radius: 50%;
                    font-size: 10px;
                    line-height: 100%;
                    background: #ffdede;
                    color: #ff5b5c;
                    transition: all .3s ease-in-out;

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

                &:after {
                    position: relative;
                    left: 0;
                }

                &:hover {
                    &:after,
                    .counter {
                        left: -1rem;
                    }
                }
            }

            .has-subsection {
                max-height: max-content;
                margin-top: .5rem;
                border-radius: .25rem;
                overflow: hidden;
                transition: all .6s ease-in-out;

                .main-menu__section__item {
                    margin: 0;
                    border: none;
                    border-radius: 0;

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
                            margin-left: auto;
                            border-right: 2px solid rgba(255,255,255,.8);
                            border-bottom: 2px solid rgba(255,255,255,.8);
                            cursor: pointer;
                            transition: all .3s ease-in-out;
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
                        border-radius: .25rem;

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
                            /*background: #DFE3E7;*/
                            background: #8494A7;
                            transition: all .3s ease-in-out;
                        }
                    }
                }
            }
        }
    }
</style>
