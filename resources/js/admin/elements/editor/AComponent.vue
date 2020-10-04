<template>
    <a :href="options.href" :target="options.target">{{ options.content }}</a>
</template>

<script>
    import ParagraphComponent from "./PComponent";
    import LinkComponent from "./AComponent";

    export default {
        name: "AComponent",
        components: {
            ParagraphComponent,
            LinkComponent
        },
        props: {
            options: {
                type: Object,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>
