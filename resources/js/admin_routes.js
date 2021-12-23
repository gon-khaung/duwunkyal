/* eslint-disable */
export default [
    // {
    //     path: "ledger",
    //     component: render("admin-dashboard/Ledger"),
    // },
];

function render(template) {
    return require(`@/pages/${template}.vue`).default;
}
