<template>
    <div class="settings__fields row">
        <div class="col-md-6">
            <div class="row" v-for="setting in firstSection">
                <div class="col-md-12">
                    <component :is="setting.field.studlyType"
                               :name="setting.name"
                               :description="setting.description"
                               :value="setting.value"
                               :attributes="setting.field.attributes"
                    ></component>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row" v-for="setting in secondSection">
                <div class="col-md-12">
                    <component :is="setting.field.studlyType"
                               :name="setting.name"
                               :description="setting.description"
                               :value="setting.value"
                               :attributes="setting.field.attributes"
                    ></component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import SimpleInput from "../components/SimpleInput";
    import SingleSelect from "../components/SingleSelect";
    import MultipleSelect from "../components/MultipleSelect";

    export default {
        name: "SettingFields",
        components: {
            SimpleInput, SingleSelect, MultipleSelect
        },
        props: {
            settings : {
                type : Array,
                default: () => []
            }
        },
        computed: {
            firstSection() {
                let firstSection = [];
                for (let i = 0; i <= parseInt(this.settings.length / 2); i++) {
                    firstSection.push(this.settings[i]);
                }
                return firstSection;
            },
            secondSection() {
                let secondSection = [];
                for (let i = parseInt(this.settings.length / 2) + 1; i < this.settings.length; i++) {
                    secondSection.push(this.settings[i]);
                }
                return secondSection;
            }
        },
        methods: {
            log(value) {
                console.log(value);
            }
        }
    }
</script>

<style scoped>

</style>
