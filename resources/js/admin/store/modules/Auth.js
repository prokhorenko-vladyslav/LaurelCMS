export default {
    namespaced: true,
    state: {
        token : false
    },
    mutations: {
        setApiToken: (state, token) => state.token = token,
    },
    getters: {

    },
    actions: {
        async loadTokenFromLocalStorage({ dispatch }) {
            if (localStorage.api_token) {
                let tokenValid = await dispatch('checkToken');
                if (tokenValid) {
                    await dispatch('saveToken', localStorage.api_token);
                    return true;
                }
            }

            return false;
        },
        checkToken() {
            return axios
                .post(
                    composeRoute('api.modules.auth.checkToken'), null,
                    {
                        headers: { Authorization: `Bearer ${localStorage.api_token}` }
                    }
                )
                .then( response => {
                    return response.data.status && response.data.alias === 'auth.user_has_access';
                })
                .catch( error => {
                    return false;
                })
        },
        signIn({ dispatch }, { login, password, rememberMe }) {
            return axios
                .post(
                    composeRoute('api.modules.auth.login'),
                    {
                        login, password, rememberMe
                    }
                )
                .then( async response => {
                    if (response.data.status) {
                        await dispatch('saveToken', response.data.data.token);
                        return true;
                    } else {
                        return false;
                    }
                })
                .catch( error => {
                    console.log('catch', error);
                    return false;
                })
        },
        saveToken({ commit }, token) {
            localStorage.api_token = token;
            commit('setApiToken', token)
        }
    },
}
