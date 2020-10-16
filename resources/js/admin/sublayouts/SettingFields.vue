<template>
    <div class="settings__fields row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <input-with-translations></input-with-translations>
                </div>
                <div class="col-md-6">
                    <input-with-translations></input-with-translations>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input-with-translations></input-with-translations>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <select-component></select-component>
                </div>
            </div>
        </div>
        <div class="col-md-6">

        </div>
    </div>
</template>

<script>
    import InputWithTranslations from "../components/InputWithTranslations";
    import SelectComponent from "../components/SelectComponent";

    export default {
        name: "SettingFields",
        components: {
            InputWithTranslations, SelectComponent
        }
    }
</script>

<style scoped>

</style>
