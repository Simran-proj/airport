<template>
  <nav class="bg-white text-gray-800 shadow-md border-b border-gray-100">
    <div class="container mx-auto px-4">
      <div class="flex items-center justify-between h-16">
        <!-- Logo -->
        <router-link to="/" class="flex items-center space-x-3">
          <div class="bg-gradient-to-r from-[#4E56C0] to-[#9B5DE0] p-2 rounded-lg">
            <span class="text-white font-bold text-lg">HAP</span>
          </div>
          <div>
            <h1 class="text-lg font-bold text-gray-900">Heathrow Air Park</h1>
            <p class="text-xs text-gray-500">Meet & Greet Parking</p>
          </div>
        </router-link>

        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center space-x-8">
          <router-link to="/" class="font-medium hover:text-[#4E56C0] transition-colors relative" :class="{
            'text-[#4E56C0]': $route.path === '/',
            'router-link-active': $route.path === '/'
          }" exact-active-class="text-[#4E56C0]">
            Home
            <span v-if="$route.path === '/'" class="absolute -bottom-1 left-0 right-0 h-0.5 bg-[#4E56C0]"></span>
          </router-link>

          <router-link to="/search" class="font-medium hover:text-[#4E56C0] transition-colors relative"
            :class="{ 'text-[#4E56C0]': $route.path === '/search' }" exact-active-class="text-[#4E56C0]">
            Find Booking
            <span v-if="$route.path === '/search'" class="absolute -bottom-1 left-0 right-0 h-0.5 bg-[#4E56C0]"></span>
          </router-link>

          <router-link to="/contact" class="font-medium hover:text-[#4E56C0] transition-colors relative"
            :class="{ 'text-[#4E56C0]': $route.path === '/contact' }" exact-active-class="text-[#4E56C0]">
            Contact
            <span v-if="$route.path === '/contact'" class="absolute -bottom-1 left-0 right-0 h-0.5 bg-[#4E56C0]"></span>
          </router-link>

          <a href="tel:02039257797"
            class="bg-gradient-to-r from-[#4E56C0] to-[#9B5DE0] text-white px-4 py-2 rounded-lg font-semibold hover:shadow-md transition-all hover:scale-105 flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z"
                clip-rule="evenodd" />
            </svg>
            0203 925 7797
          </a>
        </div>

        <!-- Mobile Menu Button -->
        <button @click="toggleMenu"
          class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors focus:outline-none text-gray-700">
          <svg v-if="!menuOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <div v-if="menuOpen" class="fixed inset-0 z-50 md:hidden" @click="closeMenu">
        <!-- Fondo Blur -->
        <div class="absolute inset-0 bg-black bg-opacity-20 backdrop-blur-sm"></div>

        <!-- Popup pequeño -->
        <div class="absolute top-0 right-0 w-72 bg-white shadow-2xl rounded-l-2xl p-6 mt-16 animate-slide-in"
          @click.stop>
          <!-- Header -->
          <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-3">
              <div class="bg-gradient-to-r from-[#4E56C0] to-[#9B5DE0] p-2 rounded-lg">
                <span class="text-white font-bold">HAP</span>
              </div>
              <h3 class="font-bold text-gray-900">Menu</h3>
            </div>

            <button @click="closeMenu" class="p-2 rounded-lg hover:bg-gray-100 transition-colors text-gray-600">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <!-- PÁGINAS -->
          <ul class="space-y-2">
            <li>
              <router-link @click="closeMenu" to="/"
                class="block px-4 py-3 rounded-lg hover:bg-gray-50 transition-colors text-gray-700"
                exact-active-class="bg-[#4E56C0]/5 text-[#4E56C0]">
                Home
              </router-link>
            </li>



            <li>
              <router-link @click="closeMenu" to="/search"
                class="block px-4 py-3 rounded-lg hover:bg-gray-50 transition-colors text-gray-700"
                exact-active-class="bg-[#4E56C0]/5 text-[#4E56C0]">
                Find Booking
              </router-link>
            </li>

            <li>
              <router-link @click="closeMenu" to="/contact"
                class="block px-4 py-3 rounded-lg hover:bg-gray-50 transition-colors text-gray-700"
                exact-active-class="bg-[#4E56C0]/5 text-[#4E56C0]">
                Contact Us
              </router-link>
            </li>

            <li>
              <router-link @click="closeMenu" to="/about"
                class="block px-4 py-3 rounded-lg hover:bg-gray-50 transition-colors text-gray-700"
                exact-active-class="bg-[#4E56C0]/5 text-[#4E56C0]">
                About Us
              </router-link>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</template>


<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const menuOpen = ref(false)

const toggleMenu = () => {
  menuOpen.value = !menuOpen.value
}

const closeMenu = () => {
  menuOpen.value = false
}

// Cerrar menú con tecla Escape
const handleEscape = (e) => {
  if (e.key === 'Escape' && menuOpen.value) {
    closeMenu()
  }
}

onMounted(() => {
  document.addEventListener('keydown', handleEscape)
})

onUnmounted(() => {
  document.removeEventListener('keydown', handleEscape)
})
</script>

<style scoped>
.fixed .absolute.right-0 {
  animation: slideIn 0.3s ease-out;
}

@keyframes slideIn {
  from {
    transform: translateX(100%);
  }

  to {
    transform: translateX(0);
  }
}

.h-\[calc\(100\%-80px\)\]::-webkit-scrollbar {
  width: 4px;
}

.h-\[calc\(100\%-80px\)\]::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 2px;
}

.h-\[calc\(100\%-80px\)\]::-webkit-scrollbar-thumb {
  background: #d1d5db;
  border-radius: 2px;
}

.h-\[calc\(100\%-80px\)\]::-webkit-scrollbar-thumb:hover {
  background: #9ca3af;
}

body:has(.fixed) {
  overflow: hidden;
}
</style>