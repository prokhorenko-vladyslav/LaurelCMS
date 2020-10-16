<template>
    <p contenteditable="true">
        <template v-for="element in childElements">
            <template v-if="element.isText">
                {{ element.content }}
            </template>
            <component v-else
                       :is="element.component"
                       :options="element.options"
                       :childElements="element.childElements"
                       :content="element.content"
            ></component>
        </template>
    </p>
</template>

<script>
    import AComponent from "./AComponent";

    export default {
        name: "PComponent",
        components: {
            AComponent
        },
        props: {
            options: {
                type: Object,
                required: true
            },
            childElements: {
                type: Array,
                default() {
                    return [];
                }
            },
            content: {
                type: String,
                default: ''
            }
        }
    }
</script>

<style scoped>

</style>
