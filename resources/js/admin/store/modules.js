import Auth from './modules/Auth';
import Page from './modules/Page';


export default {
    namespaced: true,
    Admin : {
        namespaced: true,
        modules : {
            Auth,
            Page
        }
    }
}
