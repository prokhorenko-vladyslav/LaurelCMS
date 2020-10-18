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
                    <custom-select></custom-select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <multiple-select></multiple-select>
                </div>
            </div>
        </div>
        <div class="col-md-6">

        </div>
    </div>
</template>

<script>
    import InputWithTranslations from "../components/InputWithTranslations";
    import CustomSelect from "../components/CustomSelect";
    import MultipleSelect from "../components/MultipleSelect";

    export default {
        name: "SettingFields",
        components: {
            InputWithTranslations, CustomSelect, MultipleSelect
        }
    }
</script>

<style scoped>

</style>
