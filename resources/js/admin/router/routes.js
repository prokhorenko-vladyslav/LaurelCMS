import App from "../pages/App";
import Dashboard from "../pages/Dashboard/Dashboard";
import PagesBrowse from "../pages/Pages/Browse";
import PagesAddEdit from "../pages/Pages/AddEdit";
import Login from "../pages/Auth/Login";
import Auth from "../pages/Auth/Auth";
import Admin from "../layouts/Admin";
import ConfirmIpAddress from "../pages/Auth/ConfirmIpAddress";
import ResetPassword from "../pages/Auth/ResetPassword";
import ChangePassword from "../pages/Auth/ChangePassword";

export default [
    {
        path: '/admin',
        component : App,
        children: [
            {
                path: 'auth',
                component: Auth,
                children: [
                    {
                        path: '',
                        component: Login,
                        name: 'admin.auth.login',
                    },
                    {
                        path: 'ip/confirm',
                        component: ConfirmIpAddress,
                        name: 'admin.auth.ip_confirm',
                    },
                    {
                        path: 'password/reset',
                        component: ResetPassword,
                        name: 'admin.auth.password.reset',
                    },
                    {
                        path: 'password/change',
                        component: ChangePassword,
                        name: 'admin.auth.password.change',
                    },
                ]
            },
            {
                path: '',
                component: Admin,
                children: [
                    {
                        path: '',
                        component : Dashboard,
                        name: 'admin.dashboard',
                    },
                    {
                        path : 'pages',
                        component : PagesBrowse,
                        name: 'admin.pages.browse'
                    },
                    {
                        path : 'pages/create',
                        component : PagesAddEdit,
                        name: 'admin.pages.add'
                    },
                    {
                        path : 'pages/:pageId/edit',
                        component : PagesAddEdit,
                        name: 'admin.pages.edit'
                    },
                ]
            }
        ]
    }
]
