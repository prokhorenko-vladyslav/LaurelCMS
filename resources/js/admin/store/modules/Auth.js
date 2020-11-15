export default {
    namespaced: true,
    state: {
        token : false,
        lockCheckingInterval : null,
        isLocked : false,
        login : '',
        ipAddress : '',
    },
    mutations: {
        setApiToken: (state, token) => state.token = token,
        setLockCheckingInterval: (state, lockCheckingInterval) => state.lockCheckingInterval = lockCheckingInterval,
        clearLockCheckingInterval: (state) => clearInterval(state.lockCheckingInterval),
        setIsLocked: (state, isLocked) => state.isLocked = isLocked,
        setLogin: (state, login) => state.login = login,
        setIpAddress: (state, ipAddress) => state.ipAddress = ipAddress,
    },
    getters: {
        getToken: (state) => state.token,
    },
    actions: {
        async loadTokenFromLocalStorage({ dispatch }) {
            if (localStorage.api_token) {
                let tokenValid = await dispatch('checkToken');
                if (tokenValid) {
                    await dispatch('saveToken', {
                        token : localStorage.api_token,
                        rememberMe : true
                    });
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
        async hasToken({ state, dispatch }) {
            if (!state.token) {
                return await dispatch('loadTokenFromLocalStorage');
            } else {
                return true;
            }
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
                        await dispatch('saveToken', {
                            token : response.data.data.token,
                            rememberMe
                        });
                        return response.data;
                    } else {
                        return false;
                    }
                })
                .catch( error => {
                    return false;
                })
        },
        unlock({ dispatch }, password) {
            return axios
                .post(
                    composeRoute('api.modules.auth.unlock'),
                    {
                        password
                    },
                    {
                        headers: { Authorization: `Bearer ${localStorage.api_token}` }
                    }
                )
                .then( async response => {
                    return response.data.status && response.data.alias === 'auth.account_unlocked';
                })
                .catch( error => {
                    return false;
                })
        },
        saveToken({ commit }, { token, rememberMe = false }) {
            localStorage.api_token = rememberMe ? token : null;
            commit('setApiToken', token)
        },
        startLockChecking({ commit, dispatch }) {
            commit('setLockCheckingInterval', setInterval(async () => {
                commit('setIsLocked', await dispatch('checkLock'))
            }, 10000));
        },
        stopLockChecking({ commit }) {
            commit('clearLockCheckingInterval');
        },
        checkLock() {
            return axios
                .post(
                    composeRoute('api.modules.auth.lockStatus'), null,
                    {
                        headers: { Authorization: `Bearer ${localStorage.api_token}` }
                    }
                )
                .then( async response => {
                    return !response.data.status || response.data.alias !== 'auth.account_not_locked';
                })
                .catch( error => {
                    return !error.response.data.status && error.response.data.alias === 'auth.account_locked';
                })
        },
        sendResetPasswordMail({ dispatch }, login) {
            return axios
                .post(
                    composeRoute('api.modules.auth.sendResetPasswordMail'),
                    {
                        login
                    }
                )
                .then( async response => {
                    return response.data.status && response.data.alias === 'auth.email_for_reset_password_sent';
                })
                .catch( error => {
                    return false;
                })
        },
        resetPassword({ dispatch }, { login, new_password, new_password_confirmation, token}) {
            return axios
                .post(
                    composeRoute('api.modules.auth.resetPassword'),
                    {
                        login, new_password, new_password_confirmation, token
                    }
                )
                .then( async response => {
                    return response.data.status && response.data.alias === 'auth.password_changed';
                })
                .catch( error => {
                    return false;
                })
        },
        confirmIpAddress({ dispatch }, { login, ipAddress, code}) {
            return axios
                .post(
                    composeRoute('api.modules.auth.confirmIpAddress'),
                    {
                        login, ipAddress, code
                    }
                )
                .then( async response => {
                    return response.data;
                })
                .catch( error => {
                    return false;
                })
        },
        sendIpConfirmMail({ dispatch }, { login }) {
            return axios
                .post(
                    composeRoute('api.modules.auth.sendIpConfirmMail'),
                    {
                        login
                    }
                )
                .then( async response => {
                    return response.data;
                })
                .catch( error => {
                    return false;
                })
        },
    },
}
