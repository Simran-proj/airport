<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Progress Bar -->
    <div class="bg-white shadow-sm">
      <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <div
              class="bg-gradient-to-r from-[#4E56C0] to-[#9B5DE0] text-white rounded-full w-8 h-8 flex items-center justify-center mr-2">
              1
            </div>
            <span class="font-semibold">Quote</span>
          </div>
          <div class="h-1 w-16 bg-gradient-to-r from-[#4E56C0] to-[#9B5DE0] mx-2"></div>
          <div class="flex items-center">
            <div
              class="bg-gradient-to-r from-[#4E56C0] to-[#9B5DE0] text-white rounded-full w-8 h-8 flex items-center justify-center mr-2">
              2
            </div>
            <span class="font-semibold text-[#4E56C0]">Book</span>
          </div>
        </div>
      </div>
    </div>

    <div class="container mx-auto px-4 py-8">
      <div class="max-w-4xl mx-auto">
        <!-- Error Message -->
        <div v-if="bookingError" class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                  d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                  clip-rule="evenodd" />
              </svg>
            </div>
            <div class="ml-3">
              <h3 class="text-sm font-medium text-red-800">
                {{ bookingError }}
              </h3>
              <div class="mt-2">
                <router-link to="/"
                  class="text-sm font-medium text-red-800 hover:text-red-600 underline flex items-center">
                  <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                      clip-rule="evenodd" />
                  </svg>
                  Return to home page to choose another time
                </router-link>
              </div>
            </div>
          </div>
        </div>

        <!-- Booking Summary (solo mostrar si no hay error) -->
        <div v-if="!bookingError && !timeSlotTaken" class="bg-white rounded-xl shadow-lg p-6 mb-8">
          <div class="mb-6 pb-6 border-b border-gray-200">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
              <div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Complete Your Booking</h2>
                <p class="text-gray-600 mt-2">Meet & Greet Service at Heathrow</p>
              </div>
              <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex items-center">
                  <svg class="h-5 w-5 text-green-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                      clip-rule="evenodd" />
                  </svg>
                  <div>
                    <p class="font-medium text-green-800">Time slot available</p>
                    <p class="text-sm text-green-600">{{ formattedDropOff }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Resto del formulario (igual que antes) -->
          <div class="bg-gradient-to-r from-[#FDCFFA]/30 to-[#D78FEE]/30 p-6 rounded-lg mb-8 border border-[#D78FEE]">
            <h3 class="font-bold text-lg text-gray-800 mb-4">Price Summary</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
              <div>
                <p class="text-gray-600 text-sm">Duration</p>
                <p class="font-semibold text-[#4E56C0]">{{ routeParams.duration }} days</p>
              </div>
              <div>
                <p class="text-gray-600 text-sm">Daily Rate</p>
                <p class="font-semibold text-[#4E56C0]">£{{ parseFloat(routeParams.dailyRate).toFixed(2) }}/day</p>
              </div>
              <div>
                <p class="text-gray-600 text-sm">Terminal</p>
                <p class="font-semibold text-[#4E56C0]">{{ routeParams.terminal }}</p>
              </div>
            </div>

            <div class="border-t border-[#D78FEE] pt-4">
              <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                  <p class="text-gray-600 text-sm">Drop-off</p>
                  <p class="font-semibold text-[#4E56C0]">{{ formattedDropOff }}</p>
                </div>
                <div>
                  <p class="text-gray-600 text-sm">Pick-up</p>
                  <p class="font-semibold text-[#4E56C0]">{{ formattedPickUp }}</p>
                </div>
                <div class="text-right">
                  <p class="text-gray-600 text-sm">Total Price</p>
                  <p class="text-3xl font-bold text-[#4E56C0]">£{{ totalPrice.toFixed(2) }}</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Complete Booking Form -->
          <form @submit.prevent="submitBooking" class="space-y-8">
            <!-- Customer Information -->
            <div>
              <h3 class="text-xl font-bold text-gray-800 mb-6 pb-3 border-b border-[#FDCFFA]">Your Details</h3>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <label class="block text-gray-700 mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                        clip-rule="evenodd" />
                    </svg>
                    Full Name *
                  </label>
                  <input v-model="formData.nombre" placeholder="John Smith" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4E56C0] focus:border-transparent" />
                </div>
                <div>
                  <label class="block text-gray-700 mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg">
                      <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                      <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                    Email Address *
                  </label>
                  <input v-model="formData.email" type="email" placeholder="john@example.com" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4E56C0] focus:border-transparent" />
                </div>
                <div>
                  <label class="block text-gray-700 mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd"
                        d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z"
                        clip-rule="evenodd" />
                    </svg>
                    Phone Number *
                  </label>
                  <input v-model="formData.telefono" placeholder="0203 925 7797" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4E56C0] focus:border-transparent" />
                </div>
                <div>
                  <label class="block text-gray-700 mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd"
                        d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                        clip-rule="evenodd" />
                    </svg>
                    Flight Number (Optional)
                  </label>
                  <input v-model="formData.vuelo" placeholder="BA123"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4E56C0] focus:border-transparent" />
                </div>
              </div>
            </div>

            <!-- Car Information -->
            <div>
              <h3 class="text-xl font-bold text-gray-800 mb-6 pb-3 border-b border-[#FDCFFA]">Car Details</h3>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <label class="block text-gray-700 mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg">
                      <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                      <path
                        d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1v-1a1 1 0 011-1h2a1 1 0 011 1v1a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H19a1 1 0 001-1V5a1 1 0 00-1-1H3zm11 3a1 1 0 01-1-1 1 1 0 00-1-1H9a1 1 0 00-1 1 1 1 0 01-1 1v1a1 1 0 011 1 1 1 0 001 1h1a1 1 0 001-1 1 1 0 011-1V7z" />
                    </svg>
                    Car Make *
                  </label>
                  <input v-model="formData.marca" placeholder="Toyota" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4E56C0] focus:border-transparent" />
                </div>
                <div>
                  <label class="block text-gray-700 mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd"
                        d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z"
                        clip-rule="evenodd" />
                    </svg>
                    Model *
                  </label>
                  <input v-model="formData.modelo" placeholder="Corolla" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4E56C0] focus:border-transparent" />
                </div>
                <div>
                  <label class="block text-gray-700 mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd"
                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                        clip-rule="evenodd" />
                    </svg>
                    Registration Plate *
                  </label>
                  <input v-model="formData.matricula" placeholder="AB12 CDE" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4E56C0] focus:border-transparent" />
                </div>
                <div>
                  <label class="block text-gray-700 mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd"
                        d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"
                        clip-rule="evenodd" />
                    </svg>
                    Colour *
                  </label>
                  <input v-model="formData.color" placeholder="Blue" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4E56C0] focus:border-transparent" />
                </div>
              </div>
            </div>

            <!-- Additional Options -->
            <div>
              <h3 class="text-xl font-bold text-gray-800 mb-6 pb-3 border-b border-[#FDCFFA]">Additional Options</h3>
              <div class="space-y-4">
                <div class="flex items-start">
                  <input v-model="formData.eco_friendly" type="checkbox" id="eco-friendly"
                    class="mr-3 h-5 w-5 text-[#4E56C0] rounded mt-1 focus:ring-[#4E56C0]" />
                  <label for="eco-friendly" class="text-gray-700">
                    <span class="font-semibold text-[#4E56C0] flex items-center">
                      <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                          d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                          clip-rule="evenodd" />
                      </svg>
                      Eco-friendly parking option (+£2)
                    </span>
                    <p class="text-sm text-gray-600 mt-1">Your car will be parked in our eco-zone with solar charging
                      available.</p>
                  </label>
                </div>
              </div>
            </div>

            <!-- Terms & Conditions -->
            <div class="bg-gradient-to-r from-[#FDCFFA]/20 to-[#D78FEE]/20 p-6 rounded-lg">
              <div class="flex items-start">
                <input v-model="formData.agree_terms" type="checkbox" id="terms" required
                  class="mr-3 h-5 w-5 text-[#4E56C0] rounded mt-1 focus:ring-[#4E56C0]" />
                <label for="terms" class="text-gray-700">
                  <span class="font-semibold flex items-center">
                    <svg class="w-4 h-4 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd"
                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                        clip-rule="evenodd" />
                    </svg>
                    I agree to the booking terms and conditions
                  </span>
                  <p class="text-sm text-gray-600 mt-2">
                    By proceeding, you confirm that all information provided is accurate and authorize Heathrow Air Park
                    to process your booking. You agree to our
                    <a href="#" class="text-[#4E56C0] hover:underline">Terms & Conditions</a> and
                    <a href="#" class="text-[#4E56C0] hover:underline">Privacy Policy</a>.
                  </p>
                </label>
              </div>
            </div>

            <!-- Final Price -->
            <div class="bg-gradient-to-r from-[#FDCFFA]/30 to-[#D78FEE]/30 p-6 rounded-lg border border-[#D78FEE]">
              <div class="flex flex-col md:flex-row justify-between items-center">
                <div>
                  <p class="text-lg font-bold text-gray-800">Total to pay</p>
                  <p class="text-sm text-gray-600">Includes VAT and all charges</p>
                </div>
                <div class="text-right mt-4 md:mt-0">
                  <p class="text-3xl font-bold text-[#4E56C0]">£{{ totalPrice.toFixed(2) }}</p>
                  <p class="text-sm text-gray-600">{{ routeParams.duration }} days of Meet & Greet parking</p>
                </div>
              </div>
            </div>

            <!-- Submit Button -->
            <div class="space-y-4">
              <button type="submit" :disabled="isSubmitting"
                class="w-full bg-gradient-to-r from-[#4E56C0] to-[#9B5DE0] hover:from-[#3d46a8] hover:to-[#8a4dc9] text-white font-bold py-4 px-6 rounded-lg transition duration-300 disabled:opacity-50 text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center">
                <svg v-if="isSubmitting" class="animate-spin h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                  </path>
                </svg>
                <svg v-else class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                    clip-rule="evenodd" />
                </svg>
                <span>{{ isSubmitting ? 'Processing Your Booking...' : 'Complete Booking & Pay Securely' }}</span>
              </button>

              <div class="flex justify-center gap-6 pt-4">
                <div class="flex items-center text-gray-600">
                  <svg class="w-4 h-4 text-[#4E56C0] mr-2" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                      clip-rule="evenodd" />
                  </svg>
                  <span class="text-sm">SSL Secured</span>
                </div>
                <div class="flex items-center text-gray-600">
                  <svg class="w-4 h-4 text-[#9B5DE0] mr-2" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                      clip-rule="evenodd" />
                  </svg>
                  <span class="text-sm">Fully Insured</span>
                </div>
                <div class="flex items-center text-gray-600">
                  <svg class="w-4 h-4 text-[#D78FEE] mr-2" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                      clip-rule="evenodd" />
                  </svg>
                  <span class="text-sm">Price Guaranteed</span>
                </div>
              </div>
            </div>
          </form>
        </div>

        <!-- Service Information -->
        <div v-if="!bookingError && !timeSlotTaken" class="bg-white rounded-xl shadow-lg p-6 mb-8">
          <h3 class="text-xl font-bold text-gray-800 mb-6">Meet & Greet Service Information</h3>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center p-4 border border-[#FDCFFA] rounded-lg">
              <div class="flex justify-center mb-3">
                <svg class="w-8 h-8 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                    clip-rule="evenodd" />
                </svg>
              </div>
              <p class="font-semibold mb-2">Meeting Point</p>
              <p class="text-sm text-gray-600">Your driver will meet you at the terminal drop-off point</p>
            </div>
            <div class="text-center p-4 border border-[#FDCFFA] rounded-lg">
              <div class="flex justify-center mb-3">
                <svg class="w-8 h-8 text-[#9B5DE0]" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M7 2a2 2 0 00-2 2v12a2 2 0 002 2h6a2 2 0 002-2V4a2 2 0 00-2-2H7zm3 14a1 1 0 100-2 1 1 0 000 2z"
                    clip-rule="evenodd" />
                </svg>
              </div>
              <p class="font-semibold mb-2">Contact Details</p>
              <p class="text-sm text-gray-600">Driver contact sent 24 hours before your booking</p>
            </div>
            <div class="text-center p-4 border border-[#FDCFFA] rounded-lg">
              <div class="flex justify-center mb-3">
                <svg class="w-8 h-8 text-[#D78FEE]" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                    clip-rule="evenodd" />
                </svg>
              </div>
              <p class="font-semibold mb-2">Flight Delays</p>
              <p class="text-sm text-gray-600">We track your flight and adjust meeting time</p>
            </div>
          </div>
        </div>

        <!-- Si el horario ya está ocupado, mostrar mensaje -->
        <div v-if="timeSlotTaken" class="bg-white rounded-xl shadow-lg p-8 text-center">
          <div class="mb-6">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-4">
              <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                  clip-rule="evenodd" />
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Time Slot Unavailable</h3>
            <p class="text-gray-600 mb-4">The selected time slot for {{ formattedDropOff }} is already booked.</p>
          </div>
          <div class="space-y-4">
            <router-link to="/"
              class="inline-block bg-gradient-to-r from-[#4E56C0] to-[#9B5DE0] text-white font-semibold py-3 px-6 rounded-lg hover:opacity-90 transition flex items-center justify-center mx-auto">
              <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                  clip-rule="evenodd" />
              </svg>
              Choose Another Time
            </router-link>
            <div>
              <p class="text-gray-500 text-sm mt-4 flex items-center justify-center">
                <svg class="w-4 h-4 mr-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z"
                    clip-rule="evenodd" />
                </svg>
                Or call us at
                <a href="tel:02039257797" class="text-[#4E56C0] hover:underline ml-1">0203 925 7797</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Loading Overlay -->
    <div v-if="isSubmitting" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white p-8 rounded-xl shadow-2xl max-w-md w-full">
        <div class="flex flex-col items-center">
          <div class="animate-spin rounded-full h-16 w-16 border-b-4 border-[#4E56C0] mb-4"></div>
          <p class="text-xl font-semibold text-gray-800 mb-2">Processing Your Booking</p>
          <p class="text-gray-600 text-center">Please don't close this window</p>
          <p class="text-sm text-gray-500 mt-2">This may take a few moments...</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, computed, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import api from '@/services/api.js' // Importa tu servicio API

const route = useRoute()
const router = useRouter()
const isSubmitting = ref(false)
const bookingError = ref('')
const timeSlotTaken = ref(false)
const checkingAvailability = ref(false)

// Get parameters from route query
const routeParams = computed(() => route.query)

// Form data
const formData = reactive({
  nombre: '',
  email: '',
  telefono: '',
  marca: '',
  modelo: '',
  matricula: '',
  color: '',
  vuelo: '',
  terminal: route.query.terminal || '',
  eco_friendly: false,
  agree_terms: false,
  precio: parseFloat(route.query.totalPrice) || 0
})

// Format dates for display
const formattedDropOff = computed(() => {
  if (routeParams.value.dropOffDate && routeParams.value.dropOffTime) {
    const date = new Date(routeParams.value.dropOffDate)
    const time = routeParams.value.dropOffTime
    return `${date.toLocaleDateString('en-GB', { weekday: 'short', day: 'numeric', month: 'short' })} at ${time}`
  }
  return 'Not specified'
})

const formattedPickUp = computed(() => {
  if (routeParams.value.pickUpDate && routeParams.value.pickUpTime) {
    const date = new Date(routeParams.value.pickUpDate)
    const time = routeParams.value.pickUpTime
    return `${date.toLocaleDateString('en-GB', { weekday: 'short', day: 'numeric', month: 'short' })} at ${time}`
  }
  return 'Not specified'
})

// Calculate total price
const totalPrice = computed(() => {
  let total = parseFloat(routeParams.value.totalPrice) || 0
  if (formData.eco_friendly) total += 2
  return total
})

// Format datetime for API
const formatDateTime = (dateStr, timeStr) => {
  if (!dateStr || !timeStr) return ''

  const allowedTimes = ['07:00', '09:00', '11:00', '13:00', '14:00']
  let adjustedTime = timeStr

  if (!allowedTimes.includes(timeStr + ':00')) {
    const timeParts = timeStr.split(':')
    if (timeParts.length > 1) {
      const hour = parseInt(timeParts[0])
      const closestTime = allowedTimes.reduce((prev, curr) => {
        const currHour = parseInt(curr.split(':')[0])
        const prevHour = parseInt(prev.split(':')[0])
        return Math.abs(currHour - hour) < Math.abs(prevHour - hour) ? curr : prev
      })
      adjustedTime = closestTime
    }
  }

  return `${dateStr} ${adjustedTime}:00`
}

// Función para verificar disponibilidad del horario
const checkTimeSlotAvailability = async () => {
  if (!routeParams.value.dropOffDate || !routeParams.value.dropOffTime) {
    return true
  }

  checkingAvailability.value = true
  const formattedDateTime = formatDateTime(routeParams.value.dropOffDate, routeParams.value.dropOffTime)

  try {    
    const API_URL = import.meta.env.VITE_API_URL || '/api'
    const checkResponse = await fetch(`${API_BASE_URL}/reservas`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
      },
      body: JSON.stringify({
        fecha_hora_llegada: formattedDateTime
      })
    })

    if (checkResponse.ok) {
      const result = await checkResponse.json()
      if (result.available === false) {
        timeSlotTaken.value = true
        return false
      }
    }

    return true
  } catch (error) {
    console.error('Error checking availability:', error)
    return true 
  } finally {
    checkingAvailability.value = false
  }
}

const submitBooking = async () => {
  if (!formData.agree_terms) {
    const termsCheckbox = document.getElementById('terms')
    termsCheckbox?.focus()
    termsCheckbox?.parentElement?.classList.add('ring-2', 'ring-red-500', 'ring-opacity-50')
    setTimeout(() => {
      termsCheckbox?.parentElement?.classList.remove('ring-2', 'ring-red-500', 'ring-opacity-50')
    }, 2000)
    return
  }

  const bookingData = {
    nombre: formData.nombre,
    email: formData.email,
    telefono: formData.telefono,
    marca: formData.marca,
    modelo: formData.modelo,
    matricula: formData.matricula,
    color: formData.color,
    fecha_hora_llegada: formatDateTime(routeParams.value.dropOffDate, routeParams.value.dropOffTime),
    fecha_hora_recogida: formatDateTime(routeParams.value.pickUpDate, routeParams.value.pickUpTime),
    vuelo: formData.vuelo || null,
    terminal: formData.terminal,
    precio: totalPrice.value,
    eco_friendly: formData.eco_friendly,
    service_type: 'meet_greet',
    duration_days: parseInt(routeParams.value.duration)
  }

  console.log('Submitting booking:', bookingData)
  isSubmitting.value = true

  try {
    const API_URL = import.meta.env.VITE_API_URL || '/api'
    const API_BASE_URL = import.meta.env.VITE_API_URL || '/api';
    const response = await fetch(`${API_BASE_URL}/reservas`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
      },
      body: JSON.stringify(bookingData)
    })

    const result = await response.json()

    if (response.ok && result.success) {
      if (result.message && result.message.includes('Time slot already booked')) {
        timeSlotTaken.value = true
        isSubmitting.value = false
        return
      }

      router.push({
        path: '/booking-success',
        query: {
          reservationNumber: result.data.numero_reserva,
          email: formData.email,
          totalPrice: totalPrice.value,
          duration: routeParams.value.duration,
          dropOffDate: routeParams.value.dropOffDate,
          dropOffTime: routeParams.value.dropOffTime,
          pickUpDate: routeParams.value.pickUpDate,
          pickUpTime: routeParams.value.pickUpTime,
          terminal: formData.terminal
        }
      })
    } else {
      console.error('Booking failed:', result)
      isSubmitting.value = false

      if (result.message) {
        bookingError.value = result.message
        if (result.message.includes('Time slot already booked')) {
          timeSlotTaken.value = true
        }
      }

      if (result.errors) {
        Object.keys(result.errors).forEach(field => {
          console.error(`${field}: ${result.errors[field]}`)
        })
      }
    }
  } catch (error) {
    console.error('Booking error:', error)
    isSubmitting.value = false
    bookingError.value = 'Network error. Please try again or call 0203 925 7797'
  }
}

onMounted(async () => {
  if (!route.query.dropOffDate) {
    router.push('/')
    return
  }

  const isAvailable = await checkTimeSlotAvailability()
  if (!isAvailable) {
    timeSlotTaken.value = true
  }
})
</script>

<style scoped>
.animate-slide-in {
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

input:focus,
button:focus {
  outline: none;
}

form input,
form select,
form textarea {
  transition: all 0.2s ease;
}

form input:focus,
form select:focus,
form textarea:focus {
  box-shadow: 0 0 0 3px rgba(78, 86, 192, 0.1);
}

button {
  transition: all 0.3s ease;
}
</style>