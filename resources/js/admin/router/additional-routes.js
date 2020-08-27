window.additional_routes = [
    {
        path: '/admin',
        component : () => import('../pages/Main'),
        children: [
            {
                path : 'login',
                component : () => import('../pages/auth/Login'),
                name : 'admin.auth.login'
            },
            {
                path : 'ipConfirm',
                component : () => import('../pages/auth/IpAddressConfirm'),
                name : 'admin.auth.ipConfirm'
            },
            {
                path : 'forgot',
                component : () => import('../pages/auth/Forgot'),
                name : 'admin.auth.forgot'
            },
            {
                path : 'lock',
                component : () => import('../pages/auth/Lock'),
            },
            {
                path : 'dashboard',
                component : () => import('../pages/dashboard/Dashboard'),
            }
        ]
    }
]
