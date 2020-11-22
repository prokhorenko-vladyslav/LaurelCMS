import App from "../pages/App";
import Dashboard from "../pages/Dashboard/Dashboard";
import PagesBrowse from "../pages/Pages/Browse";
import PagesAddEdit from "../pages/Pages/AddEdit";

export default [
    {
        path: '/admin',
        component : App,
        children: [
            {
                path : '',
                component : Dashboard,
                name: 'admin.dashboard',
                children: [
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
