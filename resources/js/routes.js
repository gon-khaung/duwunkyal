import AdminRoutes from './admin_routes';

export const routes = [
  {
    path: '/admin',
    component: render('admin-dashboard/Index'),
    children: AdminRoutes,
  },
  {
    path: '/admin/login',
    component: render('admin-dashboard/auth/Login'),
  },
  {
    path: '/',
    component: render('frontend/Index'),
    children: [
      {
        path: '',
        component: render('frontend/Home'),
      },
      {
        path: 'auth/login',
        component: render('frontend/auth/Login'),
      },
      {
        path: 'auth/register',
        component: render('frontend/auth/Register'),
      },
    ],
  },
];

function render(template) {
  return require(`@/pages/${template}.vue`).default;
}