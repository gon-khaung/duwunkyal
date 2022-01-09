/* eslint-disable */
export default [
    {
        path: "products",
        component: render("admin-dashboard/Products"),
    },
    {
        path: "users-management",
        component: render("admin-dashboard/UserManagement"),
    },
    {
        path: "orders",
        component: render("admin-dashboard/Orders"),
    },
    {
        path: "categories",
        component: render("admin-dashboard/CategoryManagement"),
    },
    {
        path: "sitecontacts",
        component: render("admin-dashboard/Sitecontact"),
    },
    {
        path: "dynamic-names",
        component: render("admin-dashboard/Dynamic"),
    },
];

function render(template) {
    return require(`@/pages/${template}.vue`).default;
}
