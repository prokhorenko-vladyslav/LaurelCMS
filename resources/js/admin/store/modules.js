import Auth from './modules/Auth';


export default {
    namespaced: true,
    Admin : {
        namespaced: true,
        modules : {
            Auth
        }
    }
}
