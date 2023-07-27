import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    {
        path: '/',
        name: 'Home',
        component: () => import('../views/HomePage.vue')
      },,
      {
          path: "/about",
          name: "about",
          component: () => import('../views/About.vue')
      },
      {
        path: "/post/:id",
        name: "post",
        component: () => import('../views/Post.vue')
      },
      {
        path: "/login",
        name: "login",
        component: () => import('../views/Login.vue')
      },
      {
        path: "/register",
        name: "register",
        component: () => import('../views/Register.vue')
      },
      {
        path: "/admin",
        children: [
            {
                path: '',
                name: 'dashboard',
                component: () => import('../views/admin/Dashboard.vue'),
                // meta: {title: 'Kecamatan (Harga Pangan)', smalltitle: true}
                meta: {layout: 'LayoutAdmin', requiresAuth: true},
            },
            {
                path: 'posts',
                name: 'posts',
                component: () => import('../views/admin/Posts.vue'),
                meta: {layout: 'LayoutAdmin', requiresAuth: true},
            },
            {
              path: 'posts/create',
              name: 'createpost',
              component: () => import('../views/admin/PostCreate.vue'),
              meta: {layout: 'LayoutAdmin', requiresAuth: true},
            },
            {
              path: 'posts/:id/edit',
              name: 'editpost',
              component: () => import('../views/admin/PostEdit.vue'),
              meta: {layout: 'LayoutAdmin', requiresAuth: true},
            },
        ]
      }
]

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
  })

  export default router