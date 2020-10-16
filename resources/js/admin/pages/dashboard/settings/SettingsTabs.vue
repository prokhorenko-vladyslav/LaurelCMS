<template>
    <div class="settings__tabs">
        <div class="settings__tabs__header">Settings</div>
        <div class="row">
            <div class="col-md-3">
                <div class="settings__tabs__sections">
                    <router-link :to="{ name : 'admin.settings.section', params : { slug : 'general' } }"
                                 class="section d-flex align-items-center"
                                 :class="{ active : $route.params.slug === 'general' }"
                    >
                        <div class="section__icon active">
                            <img src="/admin/img/icons/settings/gear-active.png" alt="">
                        </div>
                        <div class="section__icon default">
                            <img src="/admin/img/icons/settings/gear.png" alt="">
                        </div>
                        <div class="section__info">
                            <div class="section__info__name">General</div>
                            <div class="section__info__description">General settings of system</div>
                        </div>
                    </router-link>
                    <router-link :to="{ name : 'admin.settings.section', params : { slug : 'design' } }"
                                 class="section d-flex align-items-center"
                                 :class="{ active : $route.params.slug === 'design' }"
                    >
                        <div class="section__icon active">
                            <img src="/admin/img/icons/settings/compose-active.png" alt="">
                        </div>
                        <div class="section__icon default">
                            <img src="/admin/img/icons/settings/compose.png" alt="">
                        </div>
                        <div class="section__info">
                            <div class="section__info__name">Design</div>
                            <div class="section__info__description">Choose theme for your site and personalize it</div>
                        </div>
                    </router-link>
                    <router-link :to="{ name : 'admin.settings.section', params : { slug : 'mail' } }"
                                 class="section d-flex align-items-center"
                                 :class="{ active : $route.params.slug === 'mail' }"
                    >
                        <div class="section__icon active">
                            <img src="/admin/img/icons/settings/mail-active.png" alt="">
                        </div>
                        <div class="section__icon default">
                            <img src="/admin/img/icons/settings/mail.png" alt="">
                        </div>
                        <div class="section__info">
                            <div class="section__info__name">Mail</div>
                            <div class="section__info__description">Settings for sending mails</div>
                        </div>
                    </router-link>
                    <router-link :to="{ name : 'admin.settings.section', params : { slug : 'seo' } }"
                                 class="section d-flex align-items-center"
                                 :class="{ active : $route.params.slug === 'seo' }"
                    >
                        <div class="section__icon active">
                            <img src="/admin/img/icons/settings/seo-increase-active.png" alt="">
                        </div>
                        <div class="section__icon default">
                            <img src="/admin/img/icons/settings/seo-increase.png" alt="">
                        </div>
                        <div class="section__info">
                            <div class="section__info__name">SEO</div>
                            <div class="section__info__description">Settings for optiimize site for searchs engines</div>
                        </div>
                    </router-link>
                    <router-link :to="{ name : 'admin.settings.section', params : { slug : 'shop' } }"
                                 class="section d-flex align-items-center"
                                 :class="{ active : $route.params.slug === 'shop' }"
                    >
                        <div class="section__icon active">
                            <img src="/admin/img/icons/settings/shop-active.png" alt="">
                        </div>
                        <div class="section__icon default">
                            <img src="/admin/img/icons/settings/shop.png" alt="">
                        </div>
                        <div class="section__info">
                            <div class="section__info__name">Shop</div>
                            <div class="section__info__description">Settings for ecommerce</div>
                        </div>
                    </router-link>
                    <router-link :to="{ name : 'admin.settings.section', params : { slug : 'notification' } }"
                                 class="section d-flex align-items-center"
                                 :class="{ active : $route.params.slug === 'notification' }"
                    >
                        <div class="section__icon active">
                            <img src="/admin/img/icons/settings/notification-active.png" alt="">
                        </div>
                        <div class="section__icon default">
                            <img src="/admin/img/icons/settings/notification.png" alt="">
                        </div>
                        <div class="section__info">
                            <div class="section__info__name">Notifications</div>
                            <div class="section__info__description">Choose events, when you will get notifications from the system</div>
                        </div>
                    </router-link>
                    <router-link :to="{ name : 'admin.settings.section', params : { slug : 'server' } }"
                                 class="section d-flex align-items-center"
                                 :class="{ active : $route.params.slug === 'server' }"
                    >
                        <div class="section__icon active">
                            <img src="/admin/img/icons/settings/server-active.png" alt="">
                        </div>
                        <div class="section__icon default">
                            <img src="/admin/img/icons/settings/server.png" alt="">
                        </div>
                        <div class="section__info">
                            <div class="section__info__name">Server</div>
                            <div class="section__info__description">Server settings</div>
                        </div>
                    </router-link>
                    <router-link :to="{ name : 'admin.settings.section', params : { slug : 'dashboard' } }"
                                 class="section d-flex align-items-center"
                                 :class="{ active : $route.params.slug === 'dashboard' }"
                    >
                        <div class="section__icon active">
                            <img src="/admin/img/icons/settings/dashboard-active.png" alt="">
                        </div>
                        <div class="section__icon default">
                            <img src="/admin/img/icons/settings/dashboard.png" alt="">
                        </div>
                        <div class="section__info">
                            <div class="section__info__name">Dashboard</div>
                            <div class="section__info__description">Personalise admin panel for you</div>
                        </div>
                    </router-link>
                    <router-link :to="{ name : 'admin.settings.section', params : { slug : 'security' } }"
                                 class="section d-flex align-items-center"
                                 :class="{ active : $route.params.slug === 'security' }">
                        <div class="section__icon active">
                            <img src="/admin/img/icons/settings/security-active.png" alt="">
                        </div>
                        <div class="section__icon default">
                            <img src="/admin/img/icons/settings/security.png" alt="">
                        </div>
                        <div class="section__info">
                            <div class="section__info__name">Security</div>
                            <div class="section__info__description">Increase security level for CMS</div>
                        </div>
                    </router-link>
                    <router-link :to="{ name : 'admin.settings.section', params : { slug : 'localization' } }"
                                 class="section d-flex align-items-center"
                                 :class="{ active : $route.params.slug === 'localization' }"
                    >
                        <div class="section__icon active">
                            <img src="/admin/img/icons/settings/localization-active.png" alt="">
                        </div>
                        <div class="section__icon default">
                            <img src="/admin/img/icons/settings/localization.png" alt="">
                        </div>
                        <div class="section__info">
                            <div class="section__info__name">Localization</div>
                            <div class="section__info__description">Translate system to different languages</div>
                        </div>
                    </router-link>
                </div>
            </div>
            <div class="col-md-9">
                <setting-fields></setting-fields>
            </div>
        </div>
    </div>
</template>

<script>
    import SettingFields from "../../../sublayouts/SettingFields";

    export default {
        name: "SettingsTabs",
        components: {
            SettingFields
        }
    }
</script>

<style lang="scss" scoped>
    .settings__tabs {
        min-height: 83vh;
        padding: 24px;
        border-radius: 2px;
        background: #fff;
        box-shadow: -10px 9px 30px rgba(0, 0, 0, 0.15);

        .settings__tabs__header {
            margin-bottom: 20px;
            font-size: 18px;
            line-height: 18px;
            color: #475F7B;
        }

        .settings__tabs__sections {
            padding-right: .5rem;
            border-right: 1px solid #DFE3E7;

            .section {
                margin-top: 4px;
                margin-bottom: 4px;
                padding: 8px;
                border-radius: 2px;
                cursor: pointer;

                &, * {
                    transition: all .3s ease-in-out;
                }

                .section__icon {
                    max-width: 45px;
                    height: 45px;

                    > * {
                        width: auto;
                        height: 100%;
                    }

                    &.active {
                        display: none;
                    }
                }

                .section__info {
                    margin-left: 13px;
                    font-weight: 300;
                    font-size: 17px;
                    line-height: 16px;
                    color: #828D99;

                    .section__info__description {
                        padding-top: 5px;
                        font-size: 12px;
                    }
                }

                &.active {
                    cursor: default;
                }

                &.active, &:hover {
                    background: #F2F4F4;

                    .section__icon {
                        &.active {
                            display: block;
                        }

                        &.default {
                            display: none;
                        }
                    }
                }
            }
        }
    }
</style>
