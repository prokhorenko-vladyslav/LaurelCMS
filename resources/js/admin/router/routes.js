import Main from "../pages/Main";
import Login from "../pages/auth/Login";
import Lock from "../pages/auth/Lock";
import Forgot from "../pages/auth/Forgot";

export default [
    {
        path: '/admin',
        component : Main,
        children: [
            {
                path : 'login',
                component : Login
            },
            {
                path : 'forgot',
                component : Forgot,
                name : 'admin.auth.forgot'
            },
            {
                path : 'lock',
                component : Lock
            }
        ]
    }
]
