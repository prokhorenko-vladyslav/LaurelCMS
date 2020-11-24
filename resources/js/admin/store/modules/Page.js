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
        async fetchPageForUpdating({ commit }, { id } = {}) {
            return await axios
                .get(
                    composeRoute('api.modules.page.edit', {
                        replace : {
                            page : id
                        }
                    })
                )
                .then( function ({ data }) {
                    if (data.alias === 'modules.pages.edit.success') {
                        return data.data;
                    }

                    return false
                })
                .catch( error => false)
        },
        async deletePage({ commit }, { id }) {
            return await axios
                .delete(
                    composeRoute('api.modules.page.destroy', {
                        replace : {
                            page: id
                        }
                    })
                )
                .then( function ({ data }) {
                    return data.alias === 'modules.page.destroy.success';
                })
                .catch( error => false)
        },
        async storePage({ commit }, {
            title, seo_title, seo_description, seo_keywords, seo_robots_txt,
            text, attributes, views
        })
        {
            return await axios
                .post(
                    composeRoute('api.modules.page.store'), {
                        title, seo_title, seo_description, seo_keywords, seo_robots_txt,
                        text, attributes, views
                    }
                )
                .then( function ({ data }) {
                    return data;
                })
                .catch( error => false)
        },
        async updatePage({ commit }, {
            id, title, seo_title, seo_description, seo_keywords, seo_robots_txt,
            text, attributes, views
        })
        {
            return await axios
                .put(
                    composeRoute('api.modules.page.update', {
                        replace : {
                            page: id
                        }
                    }), {
                        title, seo_title, seo_description, seo_keywords, seo_robots_txt,
                        text, attributes, views
                    }
                )
                .then( function ({ data }) {
                    return data;
                })
                .catch( error => false)
        }
    },
}
