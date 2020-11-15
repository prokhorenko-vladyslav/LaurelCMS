import Browse from "../../pages/dashboard/pages/Browse";
import Create from "../../pages/dashboard/pages/Create";

export default [
    {
        path: 'pages',
        component: Browse,
        name: 'admin.pages.browse',
    },
    {
        path: 'pages/create',
        component: Create,
        name: 'admin.pages.create',
    }
]
