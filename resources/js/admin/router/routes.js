import Main from "../pages/Main";
import Login from "../pages/auth/Login";
import Lock from "../pages/auth/Lock";

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
                path : 'lock',
                component : Lock
            }
        ]
    }
]
