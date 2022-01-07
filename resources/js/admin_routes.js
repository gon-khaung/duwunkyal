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
        path: "twod-management",
        component: render("admin-dashboard/TwodManagement"),
    },
    {
        path: "threed-management",
        component: render("admin-dashboard/ThreedManagement"),
    },
    {
        path: "payment-accounts",
        component: render("admin-dashboard/PaymentAccounts"),
    },
];

function render(template) {
    return require(`@/pages/${template}.vue`).default;
}
