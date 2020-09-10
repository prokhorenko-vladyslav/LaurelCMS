export default {
    namespaced: true,
    state: {
        token : false
    },
    mutations: {

    },
    getters: {

    },
    actions: {
        signIn({ commit }, { login, password, rememberMe }) {
            axios
                .post(
                    composeRoute('api.modules.auth.login'),
                    {
                        login, password, rememberMe
                    }
                )
                .then( response => {
                    console.log(response);
                })
                .catch( error => {
                    console.log('catch', error);
                })
        }
    },
}
