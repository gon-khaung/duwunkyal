/* eslint-disable */
export default [
    {
        path: "deposit",
        component: render("admin-dashboard/Deposit"),
    },
    {
        path: "withdraw",
        component: render("admin-dashboard/Withdraw"),
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
];

function render(template) {
    return require(`@/pages/${template}.vue`).default;
}
