import VueRouter from "vue-router";
import routes from "./routes";

window.createRouter = function() {
    return new VueRouter({
        routes,
        mode : 'history'
    })
}

const router = window.createRouter();

export default router;
