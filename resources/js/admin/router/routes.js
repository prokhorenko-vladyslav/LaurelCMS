import Main from "../pages/Main";
import Login from "../pages/auth/Login";

export default [
    {
        path: '/admin',
        component : Main,
        children: [
            {
                path : 'login',
                component : Login
            }
        ]
    }
]
