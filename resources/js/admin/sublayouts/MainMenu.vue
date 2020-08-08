<template>
    <div class="main-menu">
        <div class="main-menu__header">

        </div>
        <div class="main-menu__section">
            <div class="main-menu__section__header">Apps</div>
            <router-link to="#" class="main-menu__section__item">Email</router-link>
            <router-link to="#" class="main-menu__section__item">Chat</router-link>
            <router-link to="#" class="main-menu__section__item">Todo</router-link>
            <router-link to="#" class="main-menu__section__item">Calendar</router-link>
            <router-link to="#" class="main-menu__section__item">Kanban</router-link>
            <router-link to="#" class="main-menu__section__item">Invoice</router-link>
        </div>
        <div class="main-menu__section">
            <div class="main-menu__section__header">Ui elements</div>
            <router-link to="#" class="main-menu__section__item">Content</router-link>
            <router-link to="#" class="main-menu__section__item">Colors</router-link>
            <router-link to="#" class="main-menu__section__item">Icons</router-link>
            <router-link to="#" class="main-menu__section__item">Card</router-link>
            <router-link to="#" class="main-menu__section__item">Widgets</router-link>
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
                display: block;
                width: 100%;
                margin-top: .2rem;
                padding: .6rem 1rem;
                border-radius: .25rem;
                color: #8494A7;
                font-size: 15px;
                transition: all .3s ease-in-out;

                &.router-link-active,
                &:hover {
                    background: rgba(90,141,238,.15);
                    color: #5A8DEE;
                }
            }
        }
    }
</style>
