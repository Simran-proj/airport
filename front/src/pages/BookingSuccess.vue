<template>
    <Navbar></Navbar>
  <div class="min-h-screen bg-gray-50 flex items-center justify-center py-12">
    <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8 text-center">
      <div class="text-green-500 text-6xl mb-6">✓</div>
      <h1 class="text-3xl font-bold text-gray-800 mb-4">Booking Confirmed!</h1>
      <p class="text-gray-600 mb-6">
        Your parking reservation has been successfully booked.
      </p>
      
      <div class="bg-blue-50 p-6 rounded-lg mb-6">
        <p class="text-gray-600 mb-2">Reservation Number</p>
        <p class="text-2xl font-bold text-blue-700">{{ routeParams.reservationNumber }}</p>
        <p class="text-sm text-gray-600 mt-4">
          A confirmation email has been sent to:<br>
          <span class="font-semibold">{{ routeParams.email }}</span>
        </p>
      </div>
      
      <div class="space-y-4">
        <router-link 
          to="/search"
          class="block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300"
        >
          Find My Booking
        </router-link>
        <router-link 
          to="/"
          class="block border border-blue-600 text-blue-600 hover:bg-blue-50 font-bold py-3 px-6 rounded-lg transition duration-300"
        >
          Back to Home
        </router-link>
      </div>
      
      <div class="mt-8 pt-6 border-t border-gray-200">
        <p class="text-gray-600 text-sm">
          Need help? Call us at <span class="font-bold">0203 925 7797</span>
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useRoute } from 'vue-router'

const route = useRoute()
const routeParams = route.query
</script>