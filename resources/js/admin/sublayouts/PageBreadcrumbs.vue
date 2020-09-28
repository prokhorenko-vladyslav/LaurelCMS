<template>
    <div class="page-breadcrumbs">
        <span class="page-title">{{ title }}</span>
        <span class="breadcrumbs">test / test</span>
    </div>
</template>

<script>
    export default {
        name: "PageBreadcrumbs",
        props: {
            title: {
                type : String,
                required: true
            },
            items : {
                type : Array,
                default: () => [],
            },
        }
    }
</script>

<style lang="scss" scoped>
    .page-breadcrumbs {
        .page-title {
            margin-right: 1rem;
            padding-right: 1rem;
            border-right: 1px solid #828D99;
            color: #475F7B;
            font-size: 1.1rem;
        }
    }
</style>
