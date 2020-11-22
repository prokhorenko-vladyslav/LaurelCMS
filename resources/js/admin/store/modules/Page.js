export default {
    namespaced: true,
    state: {
        pages : [],
        pagePagination : {}
    },
    mutations: {
        setPages: (state, pages) => state.pages = pages,
        setPagination: (state, pagePagination) => state.pagePagination = pagePagination,
    },
    getters: {

    },
    actions: {
        async fetchPages({ commit }, { page, limit } = {}) {
            let route = composeRoute('api.modules.page.index'),
                hasPage = false;

            if (page && typeof page === 'number') {
                hasPage = true;
                route += `?page=${page}`
            }

            if (limit && typeof limit === 'number' && limit > 0) {
                route += hasPage ? `&limit=${limit}` : `?limit=${limit}`;
            }

            return await axios
                .get(
                    route
                )
                .then( function ({ data }) {
                    if (data.alias === 'modules.pages.index.success') {
                        commit('setPages', data.data.pages);
                        commit('setPagination', data.meta);

                        return true;
                    }

                    return false
                })
                .catch( error => false)
        },
    },
}
