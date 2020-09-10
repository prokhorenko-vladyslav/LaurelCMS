import Vue from "vue";
import Vuex from 'vuex'
//import modules from './modules';
import Auth from "./modules/Auth";

Vue.use(Vuex);

export default new Vuex.Store({
    namespaced : true,
    state: {
        apiRoutes : window.apiRoutes || {}
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
