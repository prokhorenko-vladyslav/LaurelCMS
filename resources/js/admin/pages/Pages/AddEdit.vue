<template>
    <v-container>
        <v-row>
            <v-col>
                <h1 class="header">Add/Edit page</h1>
            </v-col>
        </v-row>
        <v-row>
            <v-col>
                <v-stepper
                    class="mt-12"
                    non-linear
                    value="1"
                    v-if="!loading"
                >
                    <v-stepper-header>
                        <v-stepper-step
                            editable
                            step="1"
                        >
                            Main info
                        </v-stepper-step>

                        <v-divider></v-divider>

                        <v-stepper-step
                            editable
                            step="2"
                        >
                            Content
                        </v-stepper-step>

                        <v-divider></v-divider>

                        <v-stepper-step
                            editable
                            step="3"
                        >
                            SEO Settings
                        </v-stepper-step>

                        <v-divider></v-divider>

                        <v-stepper-step
                            editable
                            step="4"
                        >
                            Publish Settings
                        </v-stepper-step>
                    </v-stepper-header>
                    <v-stepper-items>
                        <v-stepper-content
                            key="1-content"
                            step="1"
                        >
                            <v-row>
                                <v-col>
                                    <v-text-field
                                        v-model="page.title"
                                        label="Title"
                                        :rules="[
                                            value => !!value || 'Required.',
                                        ]"
                                        hide-details="auto"
                                    ></v-text-field>
                                    <v-text-field
                                        label="Alias"
                                        :rules="[
                                            value => !!value || 'Required.',
                                        ]"
                                        hide-details="auto"
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                        </v-stepper-content>
                        <v-stepper-content
                            key="2-content"
                            step="2"
                        >
                            <v-textarea
                                v-model="page.text"
                                label="Text"
                                :rules="[
                                    value => !!value || 'Required.',
                                        ]"
                                hide-details="auto"
                            ></v-textarea>
                        </v-stepper-content>
                        <v-stepper-content
                            key="3-content"
                            step="3"
                        >
                            <v-text-field
                                v-model="page.seo_title"
                                label="Seo title"
                                :rules="[

                                        ]"
                                hide-details="auto"
                            ></v-text-field>
                            <v-textarea
                                v-model="page.seo_description"
                                label="Seo description"
                                :rules="[

                                        ]"
                                hide-details="auto"
                            ></v-textarea>
                            <v-text-field
                                v-model="page.seo_keywords"
                                label="Seo keywords"
                                :rules="[

                                        ]"
                                hide-details="auto"
                            ></v-text-field>
                            <v-text-field
                                v-model="page.seo_robots_txt"
                                label="Seo robots"
                                :rules="[

                                        ]"
                                hide-details="auto"
                            ></v-text-field>
                        </v-stepper-content>

                        <v-stepper-content
                            key="4-content"
                            step="4"
                        >
                            <v-row>
                                <v-col>
                                    <v-switch
                                        label="Published"
                                        color="success"
                                        value="success"
                                    ></v-switch>
                                </v-col>
                            </v-row>
                        </v-stepper-content>
                    </v-stepper-items>
                </v-stepper>
            </v-col>
        </v-row>
        <v-row>
            <v-col>
                <v-btn
                    :loading="savingInProcess"
                    color="success"
                    @click="triggerPageSaving(false)"
                >
                    Save
                </v-btn>
                <v-btn
                    :loading="savingInProcess"
                    color="success"
                    @click="triggerPageSaving(true)"
                >
                    Save and return
                </v-btn>
                <v-btn
                    :loading="savingInProcess"
                    color="warning"
                    link
                    :to="{ name : 'admin.pages.browse' }"
                >
                    Cancel
                </v-btn>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
    import {mapActions} from "vuex";

    export default {
        name: "AddEdit",
        props : {
            id : {
                type : Number
            }
        },
        data: () => ({
            page : {},
            loading : false,
            savingInProcess : false
        }),
        created() {
            if (typeof this.id !== 'undefined' || typeof this.$route.params.pageId !== 'undefined') {
                this.triggerPageFetchForUpdating()
            } else {
                this.page = this.createDefaultPageObject();
            }
        },
        methods: {
            ...mapActions('Admin/Page', ['fetchPageForUpdating', 'storePage', 'updatePage']),
            async triggerPageFetchForUpdating()
            {
                this.loading = true;
                this.page = await this.fetchPageForUpdating({
                    id : this.id || this.$route.params.pageId
                })
                this.loading = false;
            },
            createDefaultPageObject() {
                return {
                    title : '',
                    seo_title : '',
                    seo_description : '',
                    seo_keywords : '',
                    seo_robots_txt : '',
                    text : '',
                    attributes : [],
                    views : null
                }
            },
            async triggerPageSaving(returnToBrowse)
            {
                let result = false;
                let goToEdit = false;
                this.savingInProcess = true;
                if (typeof this.page.id === 'undefined') {
                     result = await this.storePage(this.page);
                     goToEdit = true;
                } else {
                    result = await this.updatePage(this.page);
                }
                this.savingInProcess = false;

                if (result.status && returnToBrowse) {
                    this.$router.push({
                        name : 'admin.pages.browse'
                    })
                } else if (result.status && goToEdit) {
                    this.$router.push({
                        name : 'admin.pages.edit',
                        params : { pageId : result.data.id }
                    });
                    this.triggerPageFetchForUpdating();
                }
            }
        }
    }
</script>

<style scoped>

</style>
