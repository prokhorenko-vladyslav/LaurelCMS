<template>
    <v-container>
        <v-row>
            <v-col md="8" class="d-flex">
                <h1 class="headline d-flex align-center">Pages</h1>
                <v-breadcrumbs :items="breadcrumbs" class="d-flex align-center">
                    <template v-slot:divider>
                        <v-icon>mdi-chevron-right</v-icon>
                    </template>
                </v-breadcrumbs>
            </v-col>
            <v-col md="4" class="d-flex justify-end">
                <v-btn
                    color="success"
                    link
                    :to="{ name : 'admin.pages.add' }"
                >
                    Add
                </v-btn>
            </v-col>
        </v-row>
        <v-divider></v-divider>
        <v-data-table
            :headers="headers"
            :items="pages"
            :search="search"
            show-select
            :loading="loadingPages"
            :items-per-page="limit"
            :server-items-length="pagePagination.total"
            :footer-props="{
                'items-per-page-options' : [ 5, 10, 15 ]
            }"
            @pagination="triggerPagination"
        >
            <template v-slot:top>
                <v-dialog v-model="dialogDelete" max-width="500px" v-if="editedPage">
                    <v-card>
                        <v-card-title class="headline">Are you sure you want to delete page "{{ editedPage.title }}"?</v-card-title>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="deleteItemConfirm" :loading="deleteInProcess">OK</v-btn>
                            <v-btn color="blue darken-1" text @click="closeDelete" :disabled="deleteInProcess">Cancel</v-btn>
                            <v-spacer></v-spacer>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </template>
            <template v-slot:item.action="{ item }">
                <v-btn icon :to="{ name : 'admin.pages.edit', params : { pageId : item.id } }">
                    <v-icon>mdi-file-document-edit-outline</v-icon>
                </v-btn>
                <v-btn icon @click="deleteItem(item.id)">
                    <v-icon>mdi-delete-outline</v-icon>
                </v-btn>
            </template>
            <template v-slot:no-data>

            </template>
            <template v-slot:no-results>

            </template>
        </v-data-table>
    </v-container>
</template>

<script>
    import {mapActions, mapState} from "vuex";

    export default {
        name: "List",
        data () {
            return {
                loadingPages : false,
                deleteInProcess : false,
                breadcrumbs: [
                    {
                        text: 'Dashboard',
                        disabled: false,
                        href: 'breadcrumbs_dashboard',
                    },
                    {
                        text: 'Link 1',
                        disabled: false,
                        href: 'breadcrumbs_link_1',
                    },
                    {
                        text: 'Link 2',
                        disabled: true,
                        href: 'breadcrumbs_link_2',
                    },
                ],
                dialogDelete: false,
                search: '',
                headers: [
                    { text: 'ID', value: 'id' },
                    { text: 'Title', value: 'title' },
                    { text: 'Alias', value: 'alias' },
                    { text: 'Status', value: 'status' },
                    { text: 'Author', value: 'author' },
                    { text: 'Parent', value: 'parent' },
                    { text: 'Views', value: 'views' },
                    { text: 'Created at', value: 'created_at' },
                    { text: 'Updated at', value: 'updated_at' },
                    { text: 'Action', value: 'action', sortable: false }
                ],
                editedPageId: -1,
                page: 1,
                limit: 10,
            }
        },
        computed: {
            ...mapState('Admin/Page', ['pages', 'pagePagination']),
            editedPage()
            {
                return this.pages.find( page => page.id === this.editedPageId );
            }
        },
        watch: {
            dialogDelete (val) {
                val || this.closeDelete()
            },
        },
        created() {
            this.triggerFetchPages();
        },
        methods : {
            ...mapActions('Admin/Page', ['fetchPages', 'deletePage']),
            async triggerFetchPages()
            {
                this.loadingPages = true;
                await this.fetchPages({
                    page : this.page,
                    limit : this.limit
                });
                this.loadingPages = false;
            },
            async triggerPagination({ page, itemsPerPage })
            {
                this.page = page;
                this.limit = itemsPerPage;
                this.triggerFetchPages();
            },
            deleteItem (pageId)
            {
                this.editedPageId = pageId;
                if (this.editedPageId) {
                    this.dialogDelete = true
                }
            },
            async deleteItemConfirm ()
            {
                this.deleteInProcess = true;
                if (await this.deletePage({ id : this.editedPageId })) {
                    this.triggerFetchPages()
                }
                this.deleteInProcess = false;
                this.closeDelete();
            },
            closeDelete ()
            {
                this.dialogDelete = false
                this.$nextTick(() => {
                    this.editedIndex = -1
                })
            },
        }
    }
</script>

<style scoped>

</style>
