import Login from "../pages/auth/Login";

export default [
    {
        path: '/admin',
        children: [
            {
                path : 'login',
                component : Login
            }
        ]
    }
]
