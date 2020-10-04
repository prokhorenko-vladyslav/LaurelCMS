<template>
    <ul>
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
    </ul>
</template>

<script>
    import EditorComponents from "../../scripts/editor-components";
    import LiComponent from "./LiComponent";

    export default {
        name: "UlComponent",
        components: {
            ...EditorComponents,
            LiComponent
        },
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
