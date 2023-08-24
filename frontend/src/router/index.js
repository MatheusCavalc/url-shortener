import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/Auth/LoginView.vue';
import RegisterView from '../views/Auth/RegisterView.vue';
import DashboardView from '../views/Dashboard/DashboardView.vue';
import LinksView from '../views/Dashboard/LinksView.vue';
import CreateLink from '../views/Dashboard/CreateLink.vue';
import EditLink from '../views/Dashboard/EditLink.vue';

let authUser = localStorage.getItem("bearerToken") === null ? false : true

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView,
    beforeEnter: (to, from, next) => {
      if (authUser) {
        return next({
          name: 'links'
        })
      }

      next()
    }
  },
  {
    path: '/login',
    name: 'login',
    component: LoginView,
    beforeEnter: (to, from, next) => {
      if (authUser) {
        return next({
          name: 'links'
        })
      }

      next()
    }
  },
  {
    path: '/register',
    name: 'register',
    component: RegisterView,
    beforeEnter: (to, from, next) => {
      if (authUser) {
        return next({
          name: 'links'
        })
      }

      next()
    }
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: DashboardView,
    beforeEnter: (to, from, next) => {
      if (!authUser) {
        return next({
          name: 'home'
        })
      }

      next()
    }
  },
  {
    path: '/links',
    name: 'links',
    component: LinksView,
    beforeEnter: (to, from, next) => {
      if (!authUser) {
        return next({
          name: 'home'
        })
      }

      next()
    }
  },
  {
    path: '/create',
    name: 'create-links',
    component: CreateLink,
    beforeEnter: (to, from, next) => {
      if (!authUser) {
        return next({
          name: 'home'
        })
      }

      next()
    }
  },
  {
    path: '/edit/:id',
    name: 'edit-links',
    component: EditLink,
    beforeEnter: (to, from, next) => {
      if (!authUser) {
        return next({
          name: 'home'
        })
      }

      next()
    }
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
