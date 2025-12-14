<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Hero Banner con Precio Garantizado -->
    <div class="bg-gradient-to-r from-[#4E56C0] via-[#9B5DE0] to-[#D78FEE] text-white">
      <div class="container mx-auto px-4 py-6 md:py-8">
        <div class="flex flex-col md:flex-row justify-between items-center">
          <div class="mb-4 md:mb-0">
            <h1 class="text-2xl md:text-3xl font-bold mb-1">Heathrow Air Park</h1>
            <p class="text-lg md:text-xl opacity-90">The Cheapest Meet & Greet at Heathrow - Guaranteed!</p>
          </div>
          <div class="bg-[#FDCFFA] text-[#4E56C0] px-5 py-3 rounded-lg shadow-lg">
            <div class="text-center">
              <p class="text-sm font-bold uppercase tracking-wide">BEST PRICE GUARANTEE</p>
              <p class="text-2xl font-bold">£14.99/day</p>
              <p class="text-xs mt-1">For 8+ days parking</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Price Comparison Banner -->
    <div class="bg-[#9B5DE0] text-white">
      <div class="container mx-auto px-4 py-3">
        <div class="flex flex-col md:flex-row items-center justify-between">
          <div class="flex items-center mb-2 md:mb-0">
            <svg class="w-5 h-5 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
              <path
                d="M400 0H176c-26.5 0-48.1 21.8-47.1 48.2c.2 5.3 .4 10.6 .7 15.8H24C10.7 64 0 74.7 0 88c0 92.6 33.5 157 78.5 200.7c44.3 43.1 98.3 64.8 138.1 75.8c23.4 6.5 39.4 26 39.4 45.6c0 20.9-17 37.9-37.9 37.9H192c-17.7 0-32 14.3-32 32s14.3 32 32 32H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H357.9C337 448 320 431 320 410.1c0-19.6 15.9-39.2 39.4-45.6c39.9-11 93.9-32.7 138.2-75.8C542.5 245 576 180.6 576 88c0-13.3-10.7-24-24-24H446.4c.3-5.2 .5-10.4 .7-15.8C448.1 21.8 426.5 0 400 0zM48.9 112h84.4c9.1 90.1 29.2 150.3 51.9 190.6c-24.9-11-50.8-26.5-73.2-48.3c-32-31.1-58-76-63-142.3zM464.1 254.3c-22.4 21.8-48.3 37.3-73.2 48.3c22.7-40.3 42.8-100.5 51.9-190.6h84.4c-5.1 66.3-31.1 111.2-63 142.3z" />
            </svg>
            <p class="font-bold">CHEAPEST ON THE MARKET - BEAT ANY PRICE!</p>
          </div>
          <div class="flex items-center">
            <svg class="w-5 h-5 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
              <path
                d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z" />
            </svg>
            <p class="font-bold">0203 925 7797</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
          <div class="bg-white rounded-xl shadow-lg p-6 mb-8 border-2 border-[#FDCFFA]">
            <div class="flex items-center mb-6">
              <span class="bg-[#FDCFFA] text-[#4E56C0] text-xs font-semibold px-3 py-1 rounded mr-3">LOWEST PRICE</span>
              <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Get Your Quote Now</h2>
            </div>
            <p class="text-gray-600 mb-6 text-lg">Enter your dates to see our unbeatable Heathrow parking price</p>

            <!-- Loading State -->
            <div v-if="loadingAvailability" class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
              <div class="flex items-center">
                <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-[#4E56C0] mr-3"></div>
                <p class="text-blue-800 font-medium">Checking available time slots...</p>
              </div>
            </div>

            <form @submit.prevent="calculatePrice" class="space-y-6">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Drop-off Date & Time -->
                <div>
                  <label class="block text-gray-700 font-semibold mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd"
                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                        clip-rule="evenodd"></path>
                    </svg>
                    Drop-Off Date *
                  </label>
                  <input v-model="searchData.dropOffDate" type="date" :min="minDate" required
                    @change="checkAvailabilityForDates"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4E56C0] focus:border-transparent" />
                </div>
                <div>
                  <label class="block text-gray-700 font-semibold mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                        clip-rule="evenodd"></path>
                    </svg>
                    Drop-Off Time *
                  </label>
                  <select v-model="searchData.dropOffTime" required
                    :disabled="!searchData.dropOffDate || loadingAvailability" @change="checkPickupAvailability"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4E56C0] focus:border-transparent">
                    <option value="">Select Time</option>
                    <option v-for="time in availableDropOffTimes" :key="time" :value="time">
                      {{ formatTimeDisplay(time) }}
                    </option>
                  </select>

                  <!-- Availability Status -->
                  <div v-if="searchData.dropOffDate && !loadingAvailability" class="mt-2">
                    <div v-if="availableDropOffTimes.length > 0" class="flex items-center text-sm text-green-600">
                      <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                          clip-rule="evenodd"></path>
                      </svg>
                      {{ availableDropOffTimes.length }} drop-off slot(s) available
                    </div>
                    <div v-else class="flex items-center text-sm text-red-600">
                      <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                          d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                          clip-rule="evenodd"></path>
                      </svg>
                      No drop-off slots available for {{ searchData.dropOffDate }}
                    </div>
                  </div>
                </div>

                <!-- Pick-up Date & Time -->
                <div>
                  <label class="block text-gray-700 font-semibold mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd"
                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                        clip-rule="evenodd"></path>
                    </svg>
                    Return Date *
                  </label>
                  <input v-model="searchData.pickUpDate" type="date" :min="searchData.dropOffDate || minDate" required
                    @change="checkPickupAvailability"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4E56C0] focus:border-transparent" />
                </div>
                <div>
                  <label class="block text-gray-700 font-semibold mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                        clip-rule="evenodd"></path>
                    </svg>
                    Return Time *
                  </label>
                  <select v-model="searchData.pickUpTime" required
                    :disabled="!searchData.pickUpDate || loadingPickupAvailability"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4E56C0] focus:border-transparent">
                    <option value="">Select Time</option>
                    <option v-for="time in availablePickUpTimes" :key="time" :value="time">
                      {{ formatTimeDisplay(time) }}
                    </option>
                  </select>

                  <!-- Pick-up Availability Status -->
                  <div v-if="searchData.pickUpDate && searchData.dropOffTime && !loadingPickupAvailability"
                    class="mt-2">
                    <div v-if="availablePickUpTimes.length > 0" class="flex items-center text-sm text-green-600">
                      <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                          clip-rule="evenodd"></path>
                      </svg>
                      {{ availablePickUpTimes.length }} return slot(s) available
                    </div>
                    <div v-else-if="searchData.pickUpTime" class="flex items-center text-sm text-red-600">
                      <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                          d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                          clip-rule="evenodd"></path>
                      </svg>
                      No return slots available for {{ searchData.pickUpDate }}
                    </div>
                  </div>
                </div>
              </div>

              <!-- Terminal Selection -->
              <div>
                <label class="block text-gray-700 font-semibold mb-2 flex items-center">
                  <svg class="w-4 h-4 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z"
                      clip-rule="evenodd"></path>
                  </svg>
                  Terminal *
                </label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                  <label
                    class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-[#FDCFFA]/10 transition-colors">
                    <input v-model="searchData.terminal" type="radio" value="T2" class="mr-2" required
                      @change="calculatePrice" />
                    <span class="font-medium">Terminal 2</span>
                  </label>
                  <label
                    class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-[#FDCFFA]/10 transition-colors">
                    <input v-model="searchData.terminal" type="radio" value="T3" class="mr-2"
                      @change="calculatePrice" />
                    <span class="font-medium">Terminal 3</span>
                  </label>
                  <label
                    class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-[#FDCFFA]/10 transition-colors">
                    <input v-model="searchData.terminal" type="radio" value="T4" class="mr-2"
                      @change="calculatePrice" />
                    <span class="font-medium">Terminal 4</span>
                  </label>
                  <label
                    class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-[#FDCFFA]/10 transition-colors">
                    <input v-model="searchData.terminal" type="radio" value="T5" class="mr-2"
                      @change="calculatePrice" />
                    <span class="font-medium">Terminal 5</span>
                  </label>
                </div>
              </div>

              <!-- Price Display -->
              <div v-if="calculatedPrice > 0 && isDropOffTimeAvailable && isPickUpTimeAvailable"
                class="bg-gradient-to-r from-[#FDCFFA]/20 to-[#D78FEE]/20 p-6 rounded-lg border-2 border-[#D78FEE]">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                  <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-1">Your Exclusive Price</h3>
                    <p class="text-gray-600">{{ parkingDuration }} days of Meet & Greet parking</p>
                    <div class="mt-3 space-y-2">
                      <div class="flex items-center">
                        <span class="bg-green-600 text-white text-xs font-semibold px-3 py-1 rounded mr-2">
                          <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                              clip-rule="evenodd"></path>
                          </svg>
                          Drop-off: {{ formatTimeDisplay(searchData.dropOffTime) }}
                        </span>
                        <span class="bg-green-600 text-white text-xs font-semibold px-3 py-1 rounded mr-2">
                          <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                              clip-rule="evenodd"></path>
                          </svg>
                          Return: {{ formatTimeDisplay(searchData.pickUpTime) }}
                        </span>
                        <span class="bg-[#4E56C0] text-white text-xs font-semibold px-3 py-1 rounded">
                          <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                              d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                              clip-rule="evenodd"></path>
                          </svg>
                          £{{ (dailyRate - 1).toFixed(2) }} cheaper
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="text-right mt-4 md:mt-0">
                    <p class="text-4xl md:text-5xl font-bold text-[#4E56C0]">£{{ calculatedPrice.toFixed(2) }}</p>
                    <p class="text-gray-600">Only £{{ dailyRate.toFixed(2) }} per day</p>
                  </div>
                </div>

                <!-- Savings Comparison -->
                <div class="mt-4 p-4 bg-white/50 rounded-lg">
                  <h4 class="font-bold text-gray-800 mb-3">You Save vs Competitors:</h4>
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div class="text-center p-3 bg-[#9B5DE0]/10 rounded">
                      <p class="text-sm text-gray-600">Standard Price</p>
                      <p class="text-lg font-bold line-through text-gray-500">£{{ competitorPrice.toFixed(2) }}</p>
                    </div>
                    <div class="text-center p-3 bg-[#4E56C0]/10 rounded">
                      <p class="text-sm text-gray-600">Your Price</p>
                      <p class="text-lg font-bold text-[#4E56C0]">£{{ calculatedPrice.toFixed(2) }}</p>
                    </div>
                    <div class="text-center p-3 bg-[#D78FEE]/10 rounded">
                      <p class="text-sm text-gray-600">You Save</p>
                      <p class="text-lg font-bold text-[#9B5DE0]">£{{ savings.toFixed(2) }}</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Book Now Button -->
              <button type="button" @click="proceedToBooking"
                :disabled="calculatedPrice === 0 || !isDropOffTimeAvailable || !isPickUpTimeAvailable"
                class="w-full bg-gradient-to-r from-[#4E56C0] to-[#9B5DE0] hover:from-[#3d46a8] hover:to-[#8a4dc9] text-white font-bold py-4 px-6 rounded-lg transition duration-300 disabled:opacity-50 disabled:cursor-not-allowed text-lg shadow-lg flex items-center justify-center">
                <span v-if="calculatedPrice > 0 && isDropOffTimeAvailable && isPickUpTimeAvailable">
                  <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                    <path fill-rule="evenodd"
                      d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"
                      clip-rule="evenodd"></path>
                  </svg>
                  BOOK NOW & SAVE £{{ savings.toFixed(2) }}
                </span>
                <span v-else>
                  <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12z"
                      clip-rule="evenodd"></path>
                    <path fill-rule="evenodd"
                      d="M11 6a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                      clip-rule="evenodd"></path>
                  </svg>
                  CHECK OUR UNBEATABLE PRICE
                </span>
              </button>

              <!-- Price Guarantee -->
              <div class="text-center">
                <p class="text-sm text-gray-600">
                  <span class="font-semibold text-[#4E56C0] flex items-center justify-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd"
                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                        clip-rule="evenodd"></path>
                    </svg>
                    Price Match Guarantee:
                  </span>
                  Find a cheaper Heathrow Meet & Greet and we'll beat it by £1!
                </p>
              </div>
            </form>
          </div>

          <!-- Price Comparison Table -->
          <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
              <svg class="w-6 h-6 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                  clip-rule="evenodd"></path>
              </svg>
              Why We're The Cheapest
            </h3>

            <div class="overflow-x-auto">
              <table class="w-full">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="py-3 px-4 text-left text-gray-700 font-semibold">Provider</th>
                    <th class="py-3 px-4 text-left text-gray-700 font-semibold">1 Day</th>
                    <th class="py-3 px-4 text-left text-gray-700 font-semibold">3 Days</th>
                    <th class="py-3 px-4 text-left text-gray-700 font-semibold">7 Days</th>
                    <th class="py-3 px-4 text-left text-gray-700 font-semibold">Our Price</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                  <tr>
                    <td class="py-3 px-4 font-semibold">Heathrow Official</td>
                    <td class="py-3 px-4 text-gray-600">£45.00</td>
                    <td class="py-3 px-4 text-gray-600">£135.00</td>
                    <td class="py-3 px-4 text-gray-600">£315.00</td>
                    <td class="py-3 px-4 font-bold text-[#4E56C0]">Save 49%</td>
                  </tr>
                  <tr class="bg-gray-50">
                    <td class="py-3 px-4 font-semibold">Purple Parking</td>
                    <td class="py-3 px-4 text-gray-600">£32.00</td>
                    <td class="py-3 px-4 text-gray-600">£96.00</td>
                    <td class="py-3 px-4 text-gray-600">£224.00</td>
                    <td class="py-3 px-4 font-bold text-[#4E56C0]">Save 28%</td>
                  </tr>
                  <tr>
                    <td class="py-3 px-4 font-semibold">APCOA Parking</td>
                    <td class="py-3 px-4 text-gray-600">£23.99</td>
                    <td class="py-3 px-4 text-gray-600">£71.97</td>
                    <td class="py-3 px-4 text-gray-600">£167.93</td>
                    <td class="py-3 px-4 font-bold text-[#4E56C0]">Save 4%</td>
                  </tr>
                  <tr class="bg-gradient-to-r from-[#FDCFFA]/20 to-[#D78FEE]/20">
                    <td class="py-3 px-4 font-bold text-[#4E56C0]">Heathrow Air Park</td>
                    <td class="py-3 px-4 font-bold text-[#4E56C0]">£22.99</td>
                    <td class="py-3 px-4 font-bold text-[#4E56C0]">£64.97</td>
                    <td class="py-3 px-4 font-bold text-[#4E56C0]">£111.93</td>
                    <td class="py-3 px-4 font-bold text-[#4E56C0]">CHEAPEST!</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="mt-6 p-4 bg-gradient-to-r from-[#FDCFFA]/30 to-[#D78FEE]/30 rounded-lg">
              <div class="flex items-center">
                <svg class="w-6 h-6 mr-3 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M4 4a2 2 0 00-2 2v4a1 1 0 001 1h1a1 1 0 100-2H4V6h3a1 1 0 100-2H4zm9 0a1 1 0 100 2h1a1 1 0 011 1v1a1 1 0 01-1 1h-1a1 1 0 100 2h1a1 1 0 011 1v1a1 1 0 01-1 1h-1a1 1 0 100 2h1a2 2 0 002-2v-1a2 2 0 00-.878-1.657l1.5-1.5A2 2 0 0016 8V7a2 2 0 00-2-2h-1zm-6 2a1 1 0 011-1h3a1 1 0 011 1v6a1 1 0 01-1 1H8a1 1 0 01-1-1V6z"
                    clip-rule="evenodd"></path>
                </svg>
                <div>
                  <p class="font-bold text-gray-800">Average Savings: £45 per booking</p>
                  <p class="text-sm text-gray-600">Based on 7-day bookings compared to competitors</p>
                </div>
              </div>
            </div>
          </div>

          <!-- How We Keep Prices Low -->
          <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">How We Offer The Lowest Prices</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
              <div class="text-center">
                <div
                  class="bg-gradient-to-br from-[#FDCFFA] to-[#D78FEE] p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                  <svg class="w-8 h-8 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                    </path>
                  </svg>
                </div>
                <h4 class="font-bold text-lg mb-2">Direct Partnership</h4>
                <p class="text-gray-600">We work directly with Heathrow parking facilities, cutting out middlemen fees.
                </p>
              </div>
              <div class="text-center">
                <div
                  class="bg-gradient-to-br from-[#FDCFFA] to-[#D78FEE] p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                  <svg class="w-8 h-8 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"
                      clip-rule="evenodd"></path>
                  </svg>
                </div>
                <h4 class="font-bold text-lg mb-2">Online-Only Model</h4>
                <p class="text-gray-600">No expensive call centers or retail shops. All bookings are online.</p>
              </div>
              <div class="text-center">
                <div
                  class="bg-gradient-to-br from-[#FDCFFA] to-[#D78FEE] p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                  <svg class="w-8 h-8 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M12 1.586l-4 4v12.828l4-4V1.586zM3.707 3.293A1 1 0 002 4v10a1 1 0 00.293.707L6 18.414V5.586L3.707 3.293zM17.707 5.293L14 1.586v12.828l2.293 2.293A1 1 0 0018 16V6a1 1 0 00-.293-.707z"
                      clip-rule="evenodd"></path>
                  </svg>
                </div>
                <h4 class="font-bold text-lg mb-2">Efficient Operations</h4>
                <p class="text-gray-600">Optimized routes and scheduling keep our costs (and your price) low.</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Column: Information & Trust Signals -->
        <div class="space-y-8">
          <!-- Best Price Guarantee -->
          <div class="bg-gradient-to-br from-[#FDCFFA] to-[#D78FEE] text-[#4E56C0] rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-bold mb-4">Best Price Guarantee</h3>
            <div class="space-y-4">
              <div class="flex items-start">
                <svg class="w-5 h-5 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                    clip-rule="evenodd"></path>
                </svg>
                <div>
                  <p class="font-bold">Find Cheaper? We Beat It!</p>
                  <p class="text-sm opacity-90 mt-1">We'll match any price and beat it by £1</p>
                </div>
              </div>
              <div class="flex items-start">
                <svg class="w-5 h-5 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"></path>
                </svg>
                <div>
                  <p class="font-bold">No Hidden Fees</p>
                  <p class="text-sm opacity-90 mt-1">Price shown is final price</p>
                </div>
              </div>
              <div class="flex items-start">
                <svg class="w-5 h-5 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z"
                    clip-rule="evenodd"></path>
                </svg>
                <div>
                  <p class="font-bold">Easy Price Match</p>
                  <p class="text-sm opacity-90 mt-1">Call 0203 925 7797 with competitor quote</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Daily Rate Card -->
          <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Our Unbeatable Daily Rates</h3>
            <div class="space-y-3">
              <div
                class="flex justify-between items-center p-3 bg-gradient-to-r from-[#4E56C0]/5 to-[#9B5DE0]/5 rounded-lg">
                <div>
                  <p class="font-semibold">1 Day</p>
                  <p class="text-sm text-gray-600">Short trip</p>
                </div>
                <div class="text-right">
                  <p class="text-xl font-bold text-[#4E56C0]">£22.99</p>
                  <p class="text-xs text-gray-600">Save £1 vs competitors</p>
                </div>
              </div>
              <div
                class="flex justify-between items-center p-3 bg-gradient-to-r from-[#9B5DE0]/5 to-[#D78FEE]/5 rounded-lg">
                <div>
                  <p class="font-semibold">3 Days</p>
                  <p class="text-sm text-gray-600">Long weekend</p>
                </div>
                <div class="text-right">
                  <p class="text-xl font-bold text-[#4E56C0]">£19.99</p>
                  <p class="text-xs text-gray-600">Save £4/day vs Heathrow</p>
                </div>
              </div>
              <div
                class="flex justify-between items-center p-3 bg-gradient-to-r from-[#D78FEE]/5 to-[#FDCFFA]/5 rounded-lg">
                <div>
                  <p class="font-semibold">7 Days</p>
                  <p class="text-sm text-gray-600">Week holiday</p>
                </div>
                <div class="text-right">
                  <p class="text-xl font-bold text-[#4E56C0]">£15.99</p>
                  <p class="text-xs text-gray-600">Save £8/day vs competitors</p>
                </div>
              </div>
              <div
                class="flex justify-between items-center p-3 bg-gradient-to-r from-[#FDCFFA]/5 to-[#4E56C0]/5 rounded-lg">
                <div>
                  <p class="font-semibold">8+ Days</p>
                  <p class="text-sm text-gray-600">Best value</p>
                </div>
                <div class="text-right">
                  <p class="text-xl font-bold text-[#4E56C0]">£14.99</p>
                  <p class="text-xs text-gray-600">Lowest price guaranteed</p>
                </div>
              </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
              <p class="text-sm text-gray-600">All prices include VAT, meet & greet service, and insurance</p>
            </div>
          </div>

          <!-- Customer Savings Testimonials -->
          <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Real Customer Savings</h3>
            <div class="space-y-4">
              <div class="border-l-4 border-[#4E56C0] pl-4">
                <div class="flex text-[#D78FEE] mb-2">
                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                    </path>
                  </svg>
                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                    </path>
                  </svg>
                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                    </path>
                  </svg>
                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                    </path>
                  </svg>
                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                    </path>
                  </svg>
                </div>
                <p class="text-gray-600 italic">"Saved £56 compared to Heathrow official parking. Same service, half the
                  price!"</p>
                <div class="flex justify-between items-center mt-2">
                  <p class="font-semibold text-gray-800">- James Wilson</p>
                  <span class="bg-[#4E56C0] text-white text-xs font-bold px-2 py-1 rounded">Saved £56</span>
                </div>
              </div>
              <div class="border-l-4 border-[#4E56C0] pl-4">
                <div class="flex text-[#D78FEE] mb-2">
                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                    </path>
                  </svg>
                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                    </path>
                  </svg>
                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                    </path>
                  </svg>
                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                    </path>
                  </svg>
                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                    </path>
                  </svg>
                </div>
                <p class="text-gray-600 italic">"£32 cheaper than APCOA for my 5-day trip. Will never use anyone else!"
                </p>
                <div class="flex justify-between items-center mt-2">
                  <p class="font-semibold text-gray-800">- Emma Thompson</p>
                  <span class="bg-[#4E56C0] text-white text-xs font-bold px-2 py-1 rounded">Saved £32</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Why Cheaper Doesn't Mean Worse -->
          <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Premium Service, Lowest Price</h3>
            <ul class="space-y-3">
              <li class="flex items-center">
                <svg class="w-5 h-5 text-[#4E56C0] mr-3" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"></path>
                </svg>
                <span class="text-gray-700">Same meet & greet service as competitors</span>
              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-[#4E56C0] mr-3" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"></path>
                </svg>
                <span class="text-gray-700">Fully insured drivers</span>
              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-[#4E56C0] mr-3" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"></path>
                </svg>
                <span class="text-gray-700">24/7 CCTV secure parking</span>
              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-[#4E56C0] mr-3" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"></path>
                </svg>
                <span class="text-gray-700">Flight delay cover included</span>
              </li>
              <li class="flex items-center">
                <svg class="w-5 h-5 text-[#4E56C0] mr-3" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"></path>
                </svg>
                <span class="text-gray-700">Free cancellation up to 24 hours</span>
              </li>
            </ul>
            <div class="mt-6 p-3 bg-gradient-to-r from-[#FDCFFA]/20 to-[#D78FEE]/20 rounded-lg">
              <p class="text-sm text-gray-700">
                <span class="font-bold text-[#4E56C0]">Note:</span> We're cheaper because we're efficient, not because
                we cut corners on service.
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Call to Action -->
      <div class="mt-12 bg-gradient-to-r from-[#4E56C0] to-[#9B5DE0] rounded-xl shadow-lg p-8 text-white text-center">
        <h3 class="text-2xl md:text-3xl font-bold mb-4">Ready to Save Money on Heathrow Parking?</h3>
        <p class="text-xl mb-6 opacity-90">Enter your dates above to see how much you'll save</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
          <button @click="scrollToForm"
            class="bg-white text-[#4E56C0] hover:bg-gray-100 font-bold py-3 px-8 rounded-lg text-lg transition duration-300 flex items-center justify-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12z"
                clip-rule="evenodd"></path>
              <path fill-rule="evenodd"
                d="M11 6a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                clip-rule="evenodd"></path>
            </svg>
            Check Your Price Now
          </button>
          <a href="tel:02039257797"
            class="bg-[#FDCFFA] text-[#4E56C0] hover:bg-[#FDCFFA]/90 font-bold py-3 px-8 rounded-lg text-lg transition duration-300 flex items-center justify-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z"
                clip-rule="evenodd"></path>
            </svg>
            Call: 0203 925 7797
          </a>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { ref, reactive, computed, onMounted, watch } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

// Search data
const searchData = reactive({
  dropOffDate: '',
  dropOffTime: '',
  pickUpDate: '',
  pickUpTime: '',
  terminal: 'T2'
})

// Variables para disponibilidad
const loadingAvailability = ref(false)
const loadingPickupAvailability = ref(false)
const availableDropOffTimes = ref([])
const availablePickUpTimes = ref([])
const bookedTimesOnDropOffDate = ref([])
const bookedTimesOnPickUpDate = ref([])

// Nuestro sistema de precios
const PRICING_TIERS = {
  1: 22.99,
  2: 21.99,
  3: 19.99,
  4: 18.99,
  5: 17.99,
  6: 16.99,
  7: 15.99,
  8: 14.99
}

// Precios de competencia para comparación
const COMPETITOR_PRICES = {
  1: 23.99,
  2: 23.99,
  3: 23.99,
  4: 22.99,
  5: 21.99,
  6: 20.99,
  7: 19.99,
  8: 18.99
}

// Minimum date for booking (tomorrow)
const minDate = computed(() => {
  const tomorrow = new Date()
  tomorrow.setDate(tomorrow.getDate() + 1)
  return tomorrow.toISOString().split('T')[0]
})

// Format time for display
const formatTimeDisplay = (time) => {
  if (!time) return ''
  const [hours, minutes] = time.split(':')
  const hour = parseInt(hours)
  const ampm = hour >= 12 ? 'PM' : 'AM'
  const displayHour = hour % 12 || 12
  return `${displayHour}:${minutes} ${ampm}`
}

// Todas las horas disponibles
const ALL_TIMES = ['07:00', '09:00', '11:00', '13:00', '14:00']

// Check available times for both dates
const checkAvailabilityForDates = async () => {
  if (!searchData.dropOffDate) {
    availableDropOffTimes.value = []
    availablePickUpTimes.value = []
    return
  }

  loadingAvailability.value = true

  try {
    const API_URL = import.meta.env.VITE_API_URL || '/api'
    // Verificar disponibilidad para la fecha de drop-off
    const dropOffResponse = await fetch(`${API_URL}/check-availability?date=${searchData.dropOffDate}`, {
      headers: {
        'Accept': 'application/json',
      },
    });

    if (dropOffResponse.ok) {
      const result = await dropOffResponse.json()

      if (result.success) {
        bookedTimesOnDropOffDate.value = result.booked_times || []
        availableDropOffTimes.value = result.available_times || []

        // Si la hora seleccionada ya no está disponible, resetearla
        if (searchData.dropOffTime && !availableDropOffTimes.value.includes(searchData.dropOffTime)) {
          searchData.dropOffTime = ''
        }
      }
    }

    // Si hay fecha de pick-up, verificar también
    if (searchData.pickUpDate) {
      await checkPickupAvailability()
    }
  } catch (error) {
    console.error('Error checking availability:', error)
    // En caso de error, mostrar todas las horas
    availableDropOffTimes.value = ALL_TIMES
  } finally {
    loadingAvailability.value = false
  }
}

// Check pickup availability - VERSIÓN CORREGIDA
const checkPickupAvailability = async () => {
  if (!searchData.pickUpDate || !searchData.dropOffTime) {
    availablePickUpTimes.value = []
    return
  }

  loadingPickupAvailability.value = true

  try {
    const API_URL = import.meta.env.VITE_API_URL || 'api'

    // Verificar disponibilidad para la fecha de pick-up
    const pickUpResponse = await fetch(`${API_URL}/check-availability?date=${searchData.pickUpDate}`, {
      headers: {
        'Accept': 'application/json',
      },
    });

    if (pickUpResponse.ok) {
      const result = await pickUpResponse.json()

      if (result.success) {
        bookedTimesOnPickUpDate.value = result.booked_times || []

        // SOLO verificar que no esté ocupada en pick-up date
        // QUITAR la condición que excluye la misma hora que drop-off
        availablePickUpTimes.value = ALL_TIMES.filter(time => {
          // Verificar que no esté ocupada en pick-up date
          const isNotBookedOnPickUpDate = !bookedTimesOnPickUpDate.value.includes(time)

          return isNotBookedOnPickUpDate
        })

        // Si la hora seleccionada ya no está disponible, resetearla
        if (searchData.pickUpTime && !availablePickUpTimes.value.includes(searchData.pickUpTime)) {
          searchData.pickUpTime = ''
        }
      }
    }
  } catch (error) {
    console.error('Error checking pickup availability:', error)
    // En caso de error, mostrar todas las horas
    availablePickUpTimes.value = ALL_TIMES
  } finally {
    loadingPickupAvailability.value = false
  }
}

const isDropOffTimeAvailable = computed(() => {
  return availableDropOffTimes.value.includes(searchData.dropOffTime)
})

const isPickUpTimeAvailable = computed(() => {
  return availablePickUpTimes.value.includes(searchData.pickUpTime)
})

watch(() => searchData.dropOffDate, (newDate) => {
  if (newDate) {
    checkAvailabilityForDates()
  }
})

watch(() => searchData.pickUpDate, (newDate) => {
  if (newDate) {
    checkPickupAvailability()
  }
})

const parkingDuration = computed(() => {
  if (!searchData.dropOffDate || !searchData.pickUpDate) {
    return 0
  }

  const dropOff = new Date(searchData.dropOffDate)
  const pickUp = new Date(searchData.pickUpDate)

  const diffTime = Math.abs(pickUp - dropOff)
  const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24))
  return Math.max(1, Math.min(diffDays, 30))
})

const dailyRate = computed(() => {
  const days = parkingDuration.value
  if (days <= 0) return 0

  if (days >= 8) return PRICING_TIERS[8]

  return PRICING_TIERS[days] || PRICING_TIERS[8]
})

const competitorPrice = computed(() => {
  const days = parkingDuration.value
  if (days <= 0) return 0

  if (days >= 8) return COMPETITOR_PRICES[8] * days
  return COMPETITOR_PRICES[days] * days
})

const calculatedPrice = computed(() => {
  if (parkingDuration.value === 0) return 0
  return parkingDuration.value * dailyRate.value
})

const savings = computed(() => {
  if (competitorPrice.value === 0 || calculatedPrice.value === 0) return 0
  return competitorPrice.value - calculatedPrice.value
})

const calculatePrice = () => {
  if (!searchData.dropOffDate || !searchData.dropOffTime ||
    !searchData.pickUpDate || !searchData.pickUpTime || !searchData.terminal) {
    return
  }

  const dropOff = new Date(searchData.dropOffDate)
  const pickUp = new Date(searchData.pickUpDate)

  if (pickUp < dropOff) {
    alert('Return date cannot be earlier than drop-off date')
    searchData.pickUpDate = ''
    return
  }

}

const proceedToBooking = () => {
  if (calculatedPrice.value === 0) {
    alert('Please enter your travel dates first')
    return
  }

  if (!searchData.terminal) {
    alert('Please select your terminal')
    return
  }

  if (!isDropOffTimeAvailable.value) {
    alert('Please select an available drop-off time slot')
    return
  }

  if (!isPickUpTimeAvailable.value) {
    alert('Please select an available return time slot')
    return
  }


  router.push({
    path: '/book',
    query: {
      dropOffDate: searchData.dropOffDate,
      dropOffTime: searchData.dropOffTime,
      pickUpDate: searchData.pickUpDate,
      pickUpTime: searchData.pickUpTime,
      terminal: searchData.terminal,
      duration: parkingDuration.value,
      dailyRate: dailyRate.value,
      totalPrice: calculatedPrice.value,
      savings: savings.value
    }
  })
}

const scrollToForm = () => {
  const form = document.querySelector('form')
  if (form) {
    form.scrollIntoView({ behavior: 'smooth' })
  }
}

onMounted(() => {
  // Todos los campos vacíos - el usuario debe seleccionar todo
  searchData.dropOffDate = ''
  searchData.dropOffTime = ''
  searchData.pickUpDate = ''
  searchData.pickUpTime = ''
  // Mantenemos el terminal por defecto si quieres
  searchData.terminal = 'T2'

  console.log('Form initialized - awaiting user input')
})
</script>