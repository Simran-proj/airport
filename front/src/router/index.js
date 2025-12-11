import { createRouter, createWebHistory } from 'vue-router'
import Home from '../pages/Home.vue'
import Book from '../pages/Book.vue'
import SearchBooking from '../pages/SearchBooking.vue'
import Contact from '../pages/Contact.vue'
import AboutUs from '../pages/AboutUs.vue'
import BookingSuccess from '../pages/BookingSuccess.vue'

const routes = [
  { path: '/', component: Home },
  { path: '/book', component: Book },
  { path: '/search', component: SearchBooking },
  { path: '/contact', component: Contact },
  { path: '/about', component: AboutUs },
    { path: '/booking-success', component: BookingSuccess }

]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router