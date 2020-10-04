<template>
    <div>
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
    </div>
</template>

<script>
    import EditorComponents from "../../scripts/editor-components";

    export default {
        name: "LinkComponent",
        components: EditorComponents,
        props: {
            options: {
                type: Object,
                required: true
            },
            childElements : {
                type : Array,
                default() {
                    return [];
                }
            },
            content : {
                type : String,
                default: ''
            }
        }
    }
</script>

<style scoped>

</style>
