<template>
    <v-app id="admin">
        <v-app-bar
            app
            absolute
            :elevation="0"
        >
            <v-btn icon>
                <v-img
                    width="25"
                    height="25"
                    max-width="25"
                    src="/assets/admin/img/icons/menu/email.svg"
                ></v-img>
            </v-btn>
            <v-btn icon>
                <v-img
                    width="25"
                    height="25"
                    max-width="25"
                    src="/assets/admin/img/icons/menu/chat.svg"
                ></v-img>
            </v-btn>
            <v-btn icon>
                <v-img
                    width="25"
                    height="25"
                    max-width="25"
                    src="/assets/admin/img/icons/menu/todo.svg"
                ></v-img>
            </v-btn>
            <v-btn icon>
                <v-img
                    width="25"
                    height="25"
                    max-width="25"
                    src="/assets/admin/img/icons/menu/calendar.svg"
                ></v-img>
            </v-btn>
            <v-btn icon>
                <v-img
                    width="25"
                    height="25"
                    max-width="25"
                    src="/assets/admin/img/icons/menu/email.svg"
                ></v-img>
            </v-btn>

            <v-spacer></v-spacer>

            <v-btn icon>
                <v-img
                    width="25"
                    height="25"
                    max-width="25"
                    src="/assets/admin/img/icons/header/search.svg"
                ></v-img>
            </v-btn>

            <v-btn icon>
                <v-img
                    width="25"
                    height="25"
                    max-width="25"
                    src="/assets/admin/img/icons/header/fullScreen.svg"
                ></v-img>
            </v-btn>

            <v-badge
                offset-x="20"
                offset-y="20"
                content="12"
            >
                <v-btn icon>
                    <v-img
                        width="25"
                        height="25"
                        max-width="25"
                        src="/assets/admin/img/icons/header/notification.svg"
                    ></v-img>
                </v-btn>
            </v-badge>

            <v-menu
                :close-on-content-click="false"
                bottom
                nudge-bottom="50"
            >
                <template v-slot:activator="{ on, attrs }">
                    <v-btn
                        icon
                        v-bind="attrs"
                        v-on="on"
                        width="auto"
                    >
                        <v-avatar
                            color="teal"
                            size="36"
                        >
                            <img
                                src="https://cdn.vuetifyjs.com/images/john.jpg"
                                alt="John"
                            >
                        </v-avatar>
                    </v-btn>
                    <div class="user">
                        <div class="user__name d-flex justify-end">John Doe</div>
                        <div class="user__position d-flex justify-end">Administrator</div>
                    </div>
                </template>

                <v-card>
                    <v-list>
                        <v-list-item>
                            <v-row dense>
                                <v-col md="3" class="justify-content-center d-flex">
                                    <v-img
                                        width="20"
                                        height="20"
                                        max-width="20"
                                        src="/assets/admin/img/icons/profile/editProfile.svg"
                                    ></v-img>
                                </v-col>
                                <v-col class="d-flex align-items-center">
                                    <v-list-item-title>Edit profile</v-list-item-title>
                                </v-col>
                            </v-row>
                        </v-list-item>
                        <v-list-item>
                            <v-row dense>
                                <v-col md="3" class="justify-content-center d-flex">
                                    <v-img
                                        width="25"
                                        height="25"
                                        max-width="25"
                                        src="/assets/admin/img/icons/profile/email.svg"
                                    ></v-img>
                                </v-col>
                                <v-col class="d-flex align-items-center">
                                    <v-list-item-title>My inbox</v-list-item-title>
                                </v-col>
                            </v-row>
                        </v-list-item>
                        <v-list-item>
                            <v-row dense>
                                <v-col md="3" class="justify-content-center d-flex">
                                    <v-img
                                        width="25"
                                        height="25"
                                        max-width="25"
                                        src="/assets/admin/img/icons/profile/todo.svg"
                                    ></v-img>
                                </v-col>
                                <v-col class="d-flex align-items-center">
                                    <v-list-item-title>Tasks</v-list-item-title>
                                </v-col>
                            </v-row>
                        </v-list-item>
                        <v-list-item>
                            <v-row dense>
                                <v-col md="3" class="justify-content-center d-flex">
                                    <v-img
                                        width="25"
                                        height="25"
                                        max-width="25"
                                        src="/assets/admin/img/icons/profile/chat.svg"
                                    ></v-img>
                                </v-col>
                                <v-col class="d-flex align-items-center">
                                    <v-list-item-title>Chats</v-list-item-title>
                                </v-col>
                            </v-row>
                        </v-list-item>
                    </v-list>

                    <v-divider></v-divider>

                    <v-card-actions>
                        <v-spacer></v-spacer>

                        <v-btn
                            text
                        >
                            Lock
                        </v-btn>
                        <v-btn
                            color="primary"
                            text
                        >
                            Logout
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-menu>
        </v-app-bar>
        <v-navigation-drawer app
                             dark
                             width="280"
        >
            <template v-slot:img>
                <v-img
                    height="100%"
                    src="/assets/admin/img/images/menu.jpg"
                    gradient="to top right, rgba(25,32,52,.7), rgba(25,32,52,.7)"
                    position="center left"
                ></v-img>
            </template>
            <v-app-bar-nav-icon></v-app-bar-nav-icon>
            <v-list
                nav
                dense
            >
                <v-list-item-group

                >
                    <v-list-item>
                        <v-row dense>
                            <v-col md="3" class="justify-content-center d-flex">
                                <v-img
                                    width="25"
                                    height="25"
                                    max-width="25"
                                    src="/assets/admin/img/icons/menu/dashboard.svg"
                                ></v-img>
                            </v-col>
                            <v-col class="d-flex align-items-center">
                                <v-list-item-title>Dashboard</v-list-item-title>
                            </v-col>
                        </v-row>
                    </v-list-item>

                    <v-list-item>
                        <v-row dense>
                            <v-col class="d-flex align-items-center">
                                <v-list-item-title>APPS</v-list-item-title>
                            </v-col>
                        </v-row>
                    </v-list-item>
                    <v-list-item>
                        <v-row dense>
                            <v-col md="3" class="justify-content-center d-flex">
                                <v-img
                                    width="25"
                                    height="25"
                                    max-width="25"
                                    src="/assets/admin/img/icons/menu/email.svg"
                                ></v-img>
                            </v-col>
                            <v-col class="d-flex align-items-center">
                                <v-list-item-title>Email</v-list-item-title>
                            </v-col>
                        </v-row>
                    </v-list-item>
                    <v-list-item>
                        <v-row dense>
                            <v-col md="3" class="justify-content-center d-flex">
                                <v-img
                                    width="25"
                                    height="25"
                                    max-width="25"
                                    src="/assets/admin/img/icons/menu/chat.svg"
                                ></v-img>
                            </v-col>
                            <v-col class="d-flex align-items-center">
                                <v-list-item-title>Chat</v-list-item-title>
                            </v-col>
                        </v-row>
                    </v-list-item>
                    <v-list-item>
                        <v-row dense>
                            <v-col md="3" class="justify-content-center d-flex">
                                <v-img
                                    width="25"
                                    height="25"
                                    max-width="25"
                                    src="/assets/admin/img/icons/menu/todo.svg"
                                ></v-img>
                            </v-col>
                            <v-col class="d-flex align-items-center">
                                <v-list-item-title>Todo</v-list-item-title>
                            </v-col>
                        </v-row>
                    </v-list-item>
                    <v-list-item>
                        <v-row dense>
                            <v-col md="3" class="justify-content-center d-flex">
                                <v-img
                                    width="25"
                                    height="25"
                                    max-width="25"
                                    src="/assets/admin/img/icons/menu/calendar.svg"
                                ></v-img>
                            </v-col>
                            <v-col class="d-flex align-items-center">
                                <v-list-item-title>Calendar</v-list-item-title>
                            </v-col>
                        </v-row>
                    </v-list-item>
                    <v-list-item>
                        <v-row dense>
                            <v-col md="3" class="justify-content-center d-flex">
                                <v-img
                                    width="25"
                                    height="25"
                                    max-width="25"
                                    src="/assets/admin/img/icons/menu/kanban.svg"
                                ></v-img>
                            </v-col>
                            <v-col class="d-flex align-items-center">
                                <v-list-item-title>Kanban</v-list-item-title>
                            </v-col>
                        </v-row>
                    </v-list-item>
                    <v-list-item>
                        <v-row dense>
                            <v-col md="3" class="justify-content-center d-flex">
                                <v-img
                                    width="25"
                                    height="25"
                                    max-width="25"
                                    src="/assets/admin/img/icons/menu/invoice.svg"
                                ></v-img>
                            </v-col>
                            <v-col class="d-flex align-items-center">
                                <v-list-item-title>Invoice</v-list-item-title>
                            </v-col>
                        </v-row>
                    </v-list-item>
                    <v-list-item>
                        <v-row dense>
                            <v-col md="3" class="justify-content-center d-flex">
                                <v-img
                                    width="25"
                                    height="25"
                                    max-width="25"
                                    src="/assets/admin/img/icons/menu/file_manager.svg"
                                ></v-img>
                            </v-col>
                            <v-col class="d-flex align-items-center">
                                <v-list-item-title>File Manager</v-list-item-title>
                            </v-col>
                        </v-row>
                    </v-list-item>

                    <v-list-item>
                        <v-row dense>
                            <v-col class="d-flex align-items-center">
                                <v-list-item-title>CONTENT</v-list-item-title>
                            </v-col>
                        </v-row>
                    </v-list-item>
                    <v-list-item :to="{ name : 'admin.pages.browse' }" link>
                        <v-row dense>
                            <v-col md="3" class="justify-content-center d-flex">
                                <v-img
                                    width="25"
                                    height="25"
                                    max-width="25"
                                    src="/assets/admin/img/icons/menu/page.svg"
                                ></v-img>
                            </v-col>
                            <v-col class="d-flex align-items-center">
                                <v-list-item-title>Pages</v-list-item-title>
                            </v-col>
                        </v-row>
                    </v-list-item>
                    <v-list-item link>
                        <v-row dense>
                            <v-col md="3" class="justify-content-center d-flex">
                                <v-img
                                    width="25"
                                    height="25"
                                    max-width="25"
                                    src="/assets/admin/img/icons/menu/category.svg"
                                ></v-img>
                            </v-col>
                            <v-col class="d-flex align-items-center">
                                <v-list-item-title>Rubric</v-list-item-title>
                            </v-col>
                        </v-row>
                    </v-list-item>
                    <v-list-item link>
                        <v-row dense>
                            <v-col md="3" class="justify-content-center d-flex">
                                <v-img
                                    width="25"
                                    height="25"
                                    max-width="25"
                                    src="/assets/admin/img/icons/menu/post.svg"
                                ></v-img>
                            </v-col>
                            <v-col class="d-flex align-items-center">
                                <v-list-item-title>Posts</v-list-item-title>
                            </v-col>
                        </v-row>
                    </v-list-item>
                    <v-list-item link>
                        <v-row dense>
                            <v-col md="3" class="justify-content-center d-flex">
                                <v-img
                                    width="25"
                                    height="25"
                                    max-width="25"
                                    src="/assets/admin/img/icons/menu/comment.svg"
                                ></v-img>
                            </v-col>
                            <v-col class="d-flex align-items-center">
                                <v-list-item-title>Comments</v-list-item-title>
                            </v-col>
                        </v-row>
                    </v-list-item>
                    <v-list-item link>
                        <v-row dense>
                            <v-col md="3" class="justify-content-center d-flex">
                                <v-img
                                    width="25"
                                    height="25"
                                    max-width="25"
                                    src="/assets/admin/img/icons/menu/review.svg"
                                ></v-img>
                            </v-col>
                            <v-col class="d-flex align-items-center">
                                <v-list-item-title>Reviews</v-list-item-title>
                            </v-col>
                        </v-row>
                    </v-list-item>

                    <v-list-item>
                        <v-row dense>
                            <v-col class="d-flex align-items-center">
                                <v-list-item-title>SHOP</v-list-item-title>
                            </v-col>
                        </v-row>
                    </v-list-item>
                    <v-list-item link>
                        <v-row dense>
                            <v-col md="3" class="justify-content-center d-flex">
                                <v-img
                                    width="25"
                                    height="25"
                                    max-width="25"
                                    src="/assets/admin/img/icons/menu/category.svg"
                                ></v-img>
                            </v-col>
                            <v-col class="d-flex align-items-center">
                                <v-list-item-title>Categories</v-list-item-title>
                            </v-col>
                        </v-row>
                    </v-list-item>
                    <v-list-item link>
                        <v-row dense>
                            <v-col md="3" class="justify-content-center d-flex">
                                <v-img
                                    width="25"
                                    height="25"
                                    max-width="25"
                                    src="/assets/admin/img/icons/menu/product.svg"
                                ></v-img>
                            </v-col>
                            <v-col class="d-flex align-items-center">
                                <v-list-item-title>Products</v-list-item-title>
                            </v-col>
                        </v-row>
                    </v-list-item>
                    <v-list-item link>
                        <v-row dense>
                            <v-col md="3" class="justify-content-center d-flex">
                                <v-img
                                    width="25"
                                    height="25"
                                    max-width="25"
                                    src="/assets/admin/img/icons/menu/attributes.svg"
                                ></v-img>
                            </v-col>
                            <v-col class="d-flex align-items-center">
                                <v-list-item-title>Attributes</v-list-item-title>
                            </v-col>
                        </v-row>
                    </v-list-item>
                    <v-list-item link>
                        <v-row dense>
                            <v-col md="3" class="justify-content-center d-flex">
                                <v-img
                                    width="25"
                                    height="25"
                                    max-width="25"
                                    src="/assets/admin/img/icons/menu/sales.svg"
                                ></v-img>
                            </v-col>
                            <v-col class="d-flex align-items-center">
                                <v-list-item-title>Sales</v-list-item-title>
                            </v-col>
                        </v-row>
                    </v-list-item>

                    <v-list-item>
                        <v-row dense>
                            <v-col class="d-flex align-items-center">
                                <v-list-item-title>DESIGN</v-list-item-title>
                            </v-col>
                        </v-row>
                    </v-list-item>
                    <v-list-item link>
                        <v-row dense>
                            <v-col md="3" class="justify-content-center d-flex">
                                <v-img
                                    width="25"
                                    height="25"
                                    max-width="25"
                                    src="/assets/admin/img/icons/menu/ui.svg"
                                ></v-img>
                            </v-col>
                            <v-col class="d-flex align-items-center">
                                <v-list-item-title>UI elements</v-list-item-title>
                            </v-col>
                        </v-row>
                    </v-list-item>
                    <v-list-item link>
                        <v-row dense>
                            <v-col md="3" class="justify-content-center d-flex">
                                <v-img
                                    width="25"
                                    height="25"
                                    max-width="25"
                                    src="/assets/admin/img/icons/menu/themes.svg"
                                ></v-img>
                            </v-col>
                            <v-col class="d-flex align-items-center">
                                <v-list-item-title>Themes</v-list-item-title>
                            </v-col>
                        </v-row>
                    </v-list-item>

                    <v-list-item>
                        <v-row dense>
                            <v-col class="d-flex align-items-center">
                                <v-list-item-title>Settings</v-list-item-title>
                            </v-col>
                        </v-row>
                    </v-list-item>
                    <v-list-item link>
                        <v-row dense>
                            <v-col md="3" class="justify-content-center d-flex">
                                <v-img
                                    width="25"
                                    height="25"
                                    max-width="25"
                                    src="/assets/admin/img/icons/menu/settings.svg"
                                ></v-img>
                            </v-col>
                            <v-col class="d-flex align-items-center">
                                <v-list-item-title>General</v-list-item-title>
                            </v-col>
                        </v-row>
                    </v-list-item>
                </v-list-item-group>
            </v-list>
        </v-navigation-drawer>

        <!-- Sizes your content based upon application components -->
        <v-main>

            <!-- Provides the application the proper gutter -->
            <!-- If using vue-router -->
            <router-view></router-view>
        </v-main>
    </v-app>
</template>

<script>
    export default {
        name: "Admin"
    }
</script>

<style scoped>

</style>
