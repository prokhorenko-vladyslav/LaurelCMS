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
                            <v-text-field label="Title"></v-text-field>
                            <v-text-field label="Slug"></v-text-field>
                            <v-select
                                :items="authors"
                                label="Author"
                            ></v-select>
                        </v-stepper-content>
                        <v-stepper-content
                            key="2-content"
                            step="2"
                        >
                            Page builder
                        </v-stepper-content>
                        <v-stepper-content
                            key="3-content"
                            step="3"
                        >
                            <v-text-field label="SEO Title"></v-text-field>
                            <v-text-field label="SEO Description"></v-text-field>
                            <v-text-field label="SEO Keywords"></v-text-field>
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
                    color="success"
                >
                    Save
                </v-btn>
                <v-btn
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
    export default {
        name: "AddEdit",
        data: () => ({
            seoEditing : false,
            authors : ['Foo', 'Bar', 'Fizz', 'Buzz'],
        })
    }
</script>

<style scoped>

</style>
