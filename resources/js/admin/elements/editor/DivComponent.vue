<template>
    <div>
        <component v-for="element in content"
                   :is="element.component"
                   :options="element.options"
        ></component>
    </div>
</template>

<script>
    import PComponent from "./PComponent";
    import AComponent from "./AComponent";

    export default {
        name: "LinkComponent",
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
