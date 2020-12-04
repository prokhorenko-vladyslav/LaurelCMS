export default {
    namespaced: true,
    state: {
        token : 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNzMyOTU5NzA3MDcxYjE4NGQwNDNhNDAxMzRiMTYxM2U0ZDhlOWQxOWYxMjI5NTVhY2QwMGY0MWFiYzFhMWI0Y2JjZWRiOWU1M2UzZGI0ZTMiLCJpYXQiOjE2MDU0NjIyMDIsIm5iZiI6MTYwNTQ2MjIwMiwiZXhwIjoxNjM2OTk4MjAyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.cQyYTQhejnngOwbMm_5Nnt7YweOiyi_9z0R91K0U9wLZrc_z64Jh4B_VsUL9S91c9VdDK2e5W1lfQEbaMWZtHn_YGMVvCJ5iujU4cOnxpsAjJXwp6grePo4Ycpgze1_kfX_2nbRPMts6V0-rm7Y6gPSzJk_s8I0EzBrckmJctsTb-_mWGxx8IqQHImfSX-0O7ALcnXSkdLluaLXkW2VawNDsUfBt00jb1loKrMpndNJxEOjv4QxGGsnm7ebRkP4zgaF9LjpBaif6pBb1LSjpSy06tjGvLPqHI3RmGQy7IAi5j_QNlFx-QNLGSi6RpkzNSkS1VHpcapEufNmvqp9lOTW6HqCj2FAJqUamZd7Hi_lCW4lKdVKFWpFRgnGgLVe6V7MQRoFecpt3diphFxsXVPCxjedTBrVIwklRvpOkVBkvwQ1RAQHUV43jqHJ4b95TTN2OIqN9vI4ZgfEYapGmrytvnGrBq89gFHhCQ1_5fZ03BoB6I0_8I-bshULt6vWu4W7EMcHHhePhe51FK6Us-Z7hKW79SJnzp5QiHvbnC6aBP3LWdBsoNjgKBrJ-ocVcQqnYbj3gPKuH8n41XIE12Iy0MLF4VH6wrS7mEdDoPmWl0inGyO8zMlH6rqjpLll0UZQ21dPcymyMRs4wr4Yb4NqEvmoZuXm7A1gqTFRCyoM',
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
                        return response.data;
                    }
                })
                .catch( error => {
                    return error.response.data;
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
                    return response.data;
                })
                .catch( error => {
                    return error.response.data;
                })
        },
        resetPassword({ dispatch }, { login, newPassword, newPasswordConfirm, token}) {
            return axios
                .post(
                    composeRoute('api.modules.auth.resetPassword'),
                    {
                        login,
                        newPassword,
                        newPasswordConfirm,
                        token
                    }
                )
                .then( async response => {
                    return response.data;
                })
                .catch( error => {
                    return error.response.data;
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
                    return error.response.data;
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
