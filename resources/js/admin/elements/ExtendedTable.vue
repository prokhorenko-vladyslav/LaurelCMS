<template>
    <div class="extended-table">
        <table class="table">
            <thead>
                <tr>
                    <th><checkbox-field :value="false"></checkbox-field></th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Member</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="row in rows">
                    <td v-for="column in row">{{ column.title }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import CheckboxField from "./CheckboxField";

    export default {
        name: "ExtendedTable",
        components : {
            CheckboxField
        },
        data: () => ({
            rows : [
                [
                    {
                        title : ''
                    },
                    {
                        title : 'Music'
                    },
                    {
                        title : '11/04/2019'
                    },
                    {
                        title : 'Photo'
                    },
                    {
                        title : 'Success'
                    },
                    {
                        title : 'Action'
                    }
                ],
                [
                    {
                        title : ''
                    },
                    {
                        title : 'Music'
                    },
                    {
                        title : '11/04/2019'
                    },
                    {
                        title : 'Photo'
                    },
                    {
                        title : 'Success'
                    },
                    {
                        title : 'Action'
                    }
                ],
                [
                    {
                        title : ''
                    },
                    {
                        title : 'Music'
                    },
                    {
                        title : '11/04/2019'
                    },
                    {
                        title : 'Photo'
                    },
                    {
                        title : 'Success'
                    },
                    {
                        title : 'Action'
                    }
                ],
                [
                    {
                        title : ''
                    },
                    {
                        title : 'Music'
                    },
                    {
                        title : '11/04/2019'
                    },
                    {
                        title : 'Photo'
                    },
                    {
                        title : 'Success'
                    },
                    {
                        title : 'Action'
                    }
                ],
                [
                    {
                        title : ''
                    },
                    {
                        title : 'Music'
                    },
                    {
                        title : '11/04/2019'
                    },
                    {
                        title : 'Photo'
                    },
                    {
                        title : 'Success'
                    },
                    {
                        title : 'Action'
                    }
                ],
                [
                    {
                        title : ''
                    },
                    {
                        title : 'Music'
                    },
                    {
                        title : '11/04/2019'
                    },
                    {
                        title : 'Photo'
                    },
                    {
                        title : 'Success'
                    },
                    {
                        title : 'Action'
                    }
                ],
                [
                    {
                        title : ''
                    },
                    {
                        title : 'Music'
                    },
                    {
                        title : '11/04/2019'
                    },
                    {
                        title : 'Photo'
                    },
                    {
                        title : 'Success'
                    },
                    {
                        title : 'Action'
                    }
                ],
                [
                    {
                        title : ''
                    },
                    {
                        title : 'Music'
                    },
                    {
                        title : '11/04/2019'
                    },
                    {
                        title : 'Photo'
                    },
                    {
                        title : 'Success'
                    },
                    {
                        title : 'Action'
                    }
                ],
                [
                    {
                        title : ''
                    },
                    {
                        title : 'Music'
                    },
                    {
                        title : '11/04/2019'
                    },
                    {
                        title : 'Photo'
                    },
                    {
                        title : 'Success'
                    },
                    {
                        title : 'Action'
                    }
                ],
                [
                    {
                        title : ''
                    },
                    {
                        title : 'Music'
                    },
                    {
                        title : '11/04/2019'
                    },
                    {
                        title : 'Photo'
                    },
                    {
                        title : 'Success'
                    },
                    {
                        title : 'Action'
                    }
                ]
            ]
        })
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
