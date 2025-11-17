import { createRouter, createWebHistory } from 'vue-router'
import RightContent from '../js/components/Settings.vue'
import Reviews from '../js/components/Reviews.vue'


const routes = [
  {
    path: '/',
    name: 'RightContent',
    component: RightContent,
    meta: { title: 'Настройки' }
  },
  {
    path: '/reviews',
    name: 'Reviews',
    component: Reviews,
    meta: { title: 'Отзывы' }
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title ? `${to.meta.title} - Daily Grow` : 'Daily Grow'
  next()
})

export default router
