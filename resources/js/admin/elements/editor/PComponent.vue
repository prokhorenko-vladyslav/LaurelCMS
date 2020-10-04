<template>
    <div class="page-editor__block">
        <p>
            {{ options.content }}
            <component v-for="element in content"
                       :is="element.component"
                       :options="element.options"
            ></component>
        </p>
    </div>
</template>

<script>
    import AComponent from "./AComponent";
    import PComponent from "./PComponent";

    export default {
        name: "PComponent",
        components: {
            PComponent,
            AComponent
        },
        props: {
            options: {
                type: Object,
                required: true
            },
            content : {
                type : Array,
                default() {
                    return [];
                }
            }
        }
    }
</script>

<style scoped>

</style>
