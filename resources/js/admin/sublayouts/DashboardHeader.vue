<template>
    <div class="dashboard-header row">
        <div class="col-md-3 d-flex">
            <router-link to="#" class="header__item"><img src="/admin/img/icons/header/mail.svg" alt=""></router-link>
            <router-link to="#" class="header__item"><img src="/admin/img/icons/header/chat.svg" alt=""></router-link>
            <router-link to="#" class="header__item"><img src="/admin/img/icons/header/todo.svg" alt=""></router-link>
            <router-link to="#" class="header__item"><img src="/admin/img/icons/header/calendar.svg" alt=""></router-link>
        </div>
        <div class="col-md-3 offset-md-6 d-flex align-items-center">
            <div class="header__item language">
                <img src="/admin/img/icons/flags/usa.svg" alt=""> English
            </div>
            <router-link to="#" class="header__item"><img src="/admin/img/icons/header/fullscreen.svg" alt=""></router-link>
            <router-link to="#" class="header__item"><img src="/admin/img/icons/header/search.svg" alt=""></router-link>
            <router-link to="#" class="header__item"><img src="/admin/img/icons/header/notification.svg" alt=""></router-link>
            <div class="account d-flex align-items-center">
                <div class="account__info">
                    <div class="account__name">John Doe</div>
                    <div class="account__position">Manager</div>
                </div>
                <div class="account__photo">
                    <img src="/admin/img/photos/user.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "DashboardHeader"
    }
</script>

<style lang="scss" scoped>
    .dashboard-header {
        display: flex;
        align-items: center;
        height: 60px;
        margin: 0 1rem 1rem 1rem;

        .header__item {
            margin-right: 1rem;

            img {
                width: 20px;
                max-height: 20px;
            }

            &.language {
                color: #8494A7;
            }
        }

        .account {
            .account__info {
                color: #8494A7;

                .account__name {
                    line-height: 100%;
                }

                .account__position {
                    margin-top: .25rem;
                    font-size: .75rem;
                    line-height: 100%;
                    text-align: right;
                }
            }

            .account__photo {
                height: 40px;
                width: 40px;
                margin-left: 1rem;
                border-radius: 50%;
                overflow: hidden;

                img {
                    width: 100%;
                    height: 100%;
                }
            }
        }
    }
</style>
