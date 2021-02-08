import { RouteConfig } from 'vue-router'

const routes: RouteConfig[] = [
  {
    name: 'login',
    path: '/login',
    component: () => import('pages/login/login.page.vue'),
  },
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { name: 'index', path: '/', component: () => import('pages/Index.vue') },

      { name: 'userType_form', path: 'tipo_usuario-form/:id?', component: () => import('pages/userType/form.vue') },
      { name: 'userType_list', path: 'tipo_usuario', component: () => import('pages/userType/list.vue') },
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '*',
    component: () => import('pages/Error404.vue')
  }
]

export default routes
