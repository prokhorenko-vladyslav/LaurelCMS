<template>
    <div class="pagination__block">
        <div class="go_to_page">
            <div class="go_to_page__current">
                Страница {{ currentPage }} из {{ pagesCount }}
            </div>
            <div class="go_to_page__forward">
                Go to page <input type="number" v-model="toPage"> <button @click="setCurrentPage(Number(toPage))">Go</button>
            </div>
        </div>
        <div
            class="pagination"
            :class="{ 'hidden' : pagesCount === 1}"
        >
            <div
                class="pagination__arrow pagination__arrow_prev"
                :class="{ hidden: currentPage <= 1 }"
                @click="goToFirstPage"
            >
                <img src="/img/icons/pagination-prev.svg" alt="">
            </div>
            <div
                class="pagination__item"
                :class="{ active: page === currentPage }"
                v-for="(page, index) in paginationLinks"
                :key="index"
                @click="setCurrentPage(page)"
            >{{ page }}</div>
            <div
                class="pagination__arrow pagination__arrow_next"
                :class="{ hidden: currentPage === pagesCount }"
                @click="goToLastPage"
            >
                <img src="/img/icons/pagination-next.svg" alt="">
            </div>
        </div>
        <div class="limit_changer">
            <select v-model="limit">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="40">40</option>
            </select>
        </div>
    </div>
</template>

<script>
    import SingleSelect from "../components/SingleSelect";

    export default {
        name: "Pagination",
        components: {
            SingleSelect
        },
        props: {
            pagesCount : {
                type : Number,
                default : 1
            },
            maxPaginationLinks : {
                type : Number,
                default : 3,
            },
            currentPage : {
                type : Number,
                default : 1
            }
        },
        data() {
            return {
                limit : 10,
                counts : [
                    10, 20, 30, 50
                ],
                toPage : null
            }
        },
        computed: {
            paginationLinks() {
                let maxPaginationLinks = this.maxPaginationLinks;
                if (this.maxPaginationLinks > this.pagesCount) {
                    maxPaginationLinks = this.pagesCount;
                }

                let paginationLinks = [],
                    firstPage = (this.currentPage - parseInt(maxPaginationLinks / 2)) > 0 ? this.currentPage - parseInt(maxPaginationLinks / 2) : 1,
                    lastPage = (this.currentPage + parseInt(maxPaginationLinks / 2)) <= this.pagesCount ? this.currentPage + parseInt(maxPaginationLinks / 2) : this.pagesCount;

                for (let i = firstPage; i <= lastPage; i++) {
                    paginationLinks.push(i);
                }

                if (paginationLinks.length < maxPaginationLinks && firstPage === 1 && lastPage < this.pagesCount) {
                    while (paginationLinks.length < maxPaginationLinks && lastPage <= this.pagesCount) {
                        lastPage++;
                        paginationLinks.push(lastPage);
                    }
                }

                if (paginationLinks.length < maxPaginationLinks && firstPage > 1 && lastPage === this.pagesCount) {
                    while (paginationLinks.length < maxPaginationLinks && firstPage >= 1) {
                        firstPage--;
                        paginationLinks.unshift(firstPage)
                    }
                }

                return paginationLinks;
            },
        },
        watch: {
            limit() {
                this.changeLimit();
            }
        },
        methods: {
            decrementCurrentPage() {
                if (this.currentPage > 1) this.emitPage(this.currentPage - 1);
            },
            incrementCurrentPage() {
                if (this.currentPage < this.pagesCount)
                    this.emitPage(this.currentPage + 1);
            },
            goToFirstPage() {
                this.setCurrentPage(1);
            },
            goToLastPage() {
                this.setCurrentPage(this.pagesCount);
            },
            setCurrentPage(page) {
                if (page > 0 && page <= this.pagesCount && page !== this.currentPage) this.emitPage(page);
            },
            emitPage(page) {
                this.$emit('pageChanging', page, Number(this.limit));
            },
            changeLimit() {
                this.$emit('pageChanging', this.currentPage, Number(this.limit));
                this.goToFirstPage();
            }
        }
    }
</script>

<style lang="scss" scoped>
    .pagination__block {
        display: flex;
        justify-content: center;
        margin: 2rem auto;

        .pagination {
            display: flex;
            justify-content: center;

            .pagination__arrow,
            .pagination__item {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 30px;
                height: 30px;
                cursor: pointer;
                transition: all .3s ease-in-out;

                &:hover {
                    background: red;
                }
            }

            .pagination__item {
                border: 1px solid grey;
                font-size: 14px;

                &.active {
                    background: red;
                }
            }
        }

        .pagination__count {
            display: flex;
            align-items: center;
            margin-left: auto;

            &.hidden {
                margin-right: auto;
                margin-left: 0;
            }

            &.filter-element {
                min-width: max-content;

                .filter-element__select {
                    width: 55px;
                    min-width: 55px;
                }
            }

            .pagination__count__label {
                margin-right: 1rem;
            }
        }
    }
</style>
