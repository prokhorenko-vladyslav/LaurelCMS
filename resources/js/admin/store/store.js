import Vue from "vue";
import Vuex from 'vuex'
//import modules from './modules';
import Auth from "./modules/Auth";

Vue.use(Vuex);

export default new Vuex.Store({
    namespaced : true,
    state: {
        apiRoutes : window.apiRoutes || {},
        loaded : false,
    },
    mutations: {
        setLoaded : (state, loaded) => state.loaded = !!loaded
    },
    actions: {
        setLoadingStatus: async ({ commit }, loadingStatus) => {
            loadingStatus = !!loadingStatus;
            if (loadingStatus) {
                return new Promise((resolve, reject) => {
                    setTimeout(() => {
                        commit('setLoaded', loadingStatus);
                        resolve();
                    }, 500);
                });
            } else {
                commit('setLoaded', loadingStatus);
                return new Promise((resolve, reject) => {
                    setTimeout(resolve, 1000);
                });
            }
        }
    },
    modules : {
        Admin : {
            namespaced : true,
            modules : {
                Auth
            }
        }
    }
})
