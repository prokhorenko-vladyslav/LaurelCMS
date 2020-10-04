import Index from "../../pages/dashboard/pages/Index";
import Create from "../../pages/dashboard/pages/Create";

export default [
    {
        path: 'pages',
        component: Index,
        name: 'admin.pages.index',
    },
    {
        path: 'pages/create',
        component: Create,
        name: 'admin.pages.create',
    }
]
