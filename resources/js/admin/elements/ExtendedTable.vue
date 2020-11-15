<template>
    <div class="extended-table">
        <table class="table">
            <thead>
                <tr>
                    <th><checkbox-field :value="false"></checkbox-field></th>
                    <th>Заголовок</th>
                    <th>Алиас</th>
                    <th>Статус</th>
                    <th>Автор</th>
                    <th>Родитель</th>
                    <th>Просмотрено</th>
                    <th>Создано/Обновлено</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="row in rows">
                    <td><checkbox-field :value="false"></checkbox-field></td>
                    <td v-for="column in row">{{ column }}</td>
                    <td><checkbox-field :value="false"></checkbox-field></td>
                </tr>
            </tbody>
        </table>
        <pagination :pagesCount="pagination.last_page"
                    :currentPage="pagination.current_page"
                    @pageChanging="emitPageChanging"
                    @limitChanging="emitPageChanging"
        ></pagination>
    </div>
</template>

<script>
    import CheckboxField from "./CheckboxField";
    import Pagination from "./Pagination";

    export default {
        name: "ExtendedTable",
        components : {
            CheckboxField,
            Pagination
        },
        props : {
            rows : {
                type : Array,
                default: () => []
            },
            pagination : {
                type : Object,
                default: () => {}
            }
        },
        data: () => ({

        }),
        methods: {
            emitPageChanging(page, limit) {
                this.$emit('pageChanging', page, limit);
            }
        }
    }
</script>

<style lang="scss" scoped>
    .table {
        width: 100%;
        background: #fff;
        border-radius: .25rem;
        box-shadow: -8px 12px 18px 0 rgba(25,42,70,.13);
        color: #727E8C;
        overflow-x: hidden;

        thead {
            border-bottom: 2px solid #dfe3e7;

            th {
                border: none;
            }
        }

        th, td {
            height: 4rem;
            vertical-align: middle;
        }

        th:first-of-type,
        td:first-of-type {
            padding-left: 2rem;
        }

        th:last-of-type,
        td:last-of-type {
            padding-right: 2rem;
        }

        tr {
            transition: all .5s ease-in-out;

            &:hover {
                cursor: pointer;
                background: rgba(247, 247, 247, 1);
            }
        }
    }
</style>
