import Main from "../pages/Main";
import Login from "../pages/auth/Login";
import IpAddressConfirm from "../pages/auth/IpAddressConfirm";
import Forgot from "../pages/auth/Forgot";
import Lock from "../pages/auth/Lock";
import Dashboard from "../pages/dashboard/Dashboard";
import PagesRoutes from "./Pages/PagesRoutes";

export default [
    {
        path: '/admin',
        component : Main,
        children: [
            {
                path : 'login',
                component : Login,
                name : 'admin.auth.login'
            },
            {
                path : 'ipConfirm',
                component : IpAddressConfirm,
                name : 'admin.auth.ipConfirm'
            },
            {
                path : 'forgot',
                component : Forgot,
                name : 'admin.auth.forgot'
            },
            {
                path : 'lock',
                component : Lock,
                name : 'admin.auth.lock'
            },
            {
                path : 'dashboard',
                component : Dashboard,
                name: 'admin.dashboard',
            },
            ...PagesRoutes,
        ]
    }
]
