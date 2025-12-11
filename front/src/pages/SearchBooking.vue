<template>
  <div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4">
      <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
          <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Find Your Booking</h1>
          <p class="text-gray-600">Search by email and booking reference or by name and email</p>
        </div>

        <!-- Search Card -->
        <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 mb-8">
          <!-- Search Tabs -->
          <div class="flex border-b border-gray-200 mb-6">
            <button 
              @click="activeTab = 'reference'"
              class="px-4 py-3 font-medium text-sm transition-colors relative flex items-center"
              :class="activeTab === 'reference' 
                ? 'text-[#4E56C0]' 
                : 'text-gray-500 hover:text-gray-700'"
            >
              <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M6.625 2.655A9 9 0 0119 11a1 1 0 11-2 0 7 7 0 00-9.625-6.492 1 1 0 11-.75-1.853zM4.662 4.959A1 1 0 014.75 6.37 6.97 6.97 0 003 11a1 1 0 11-2 0 8.97 8.97 0 012.25-5.953 1 1 0 011.412-.088z" clip-rule="evenodd" />
                <path fill-rule="evenodd" d="M5 11a5 5 0 1110 0 1 1 0 11-2 0 3 3 0 10-6 0c0 1.677-.345 3.276-.968 4.729a1 1 0 11-1.838-.789A9.964 9.964 0 005 11zm8.921 2.012a1 1 0 01.831 1.145 19.86 19.86 0 01-.545 2.436 1 1 0 11-1.92-.558c.207-.713.371-1.445.49-2.192a1 1 0 011.144-.831z" clip-rule="evenodd" />
              </svg>
              Search by Reference
              <span 
                v-if="activeTab === 'reference'"
                class="absolute bottom-0 left-0 right-0 h-0.5 bg-[#4E56C0]"
              ></span>
            </button>
            <button 
              @click="activeTab = 'name'"
              class="px-4 py-3 font-medium text-sm transition-colors relative flex items-center"
              :class="activeTab === 'name' 
                ? 'text-[#4E56C0]' 
                : 'text-gray-500 hover:text-gray-700'"
            >
              <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
              </svg>
              Search by Name
              <span 
                v-if="activeTab === 'name'"
                class="absolute bottom-0 left-0 right-0 h-0.5 bg-[#4E56C0]"
              ></span>
            </button>
          </div>

          <!-- Search by Reference Form -->
          <form v-if="activeTab === 'reference'" @submit.prevent="searchByReference" class="space-y-6">
            <div>
              <label class="block text-gray-700 mb-2 font-medium flex items-center">
                <svg class="w-4 h-4 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                  <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                </svg>
                Email Address *
              </label>
              <input 
                v-model="referenceSearch.email"
                type="email"
                placeholder="your.email@example.com"
                required
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4E56C0] focus:border-[#4E56C0] transition"
              />
            </div>
            <div>
              <label class="block text-gray-700 mb-2 font-medium flex items-center">
                <svg class="w-4 h-4 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                </svg>
                Booking Reference *
              </label>
              <div class="relative">
                <input 
                  v-model="referenceSearch.bookingReference"
                  placeholder="e.g., HAP12345678"
                  required
                  class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4E56C0] focus:border-[#4E56C0] transition"
                />
                <span class="absolute right-3 top-3 text-gray-400 text-sm">
                  Format: HAP + 8 digits
                </span>
              </div>
            </div>
            <button
              type="submit"
              :disabled="isLoading"
              class="w-full bg-gradient-to-r from-[#4E56C0] to-[#9B5DE0] text-white font-bold py-3 px-6 rounded-lg hover:shadow-md transition-all disabled:opacity-50 flex items-center justify-center"
            >
              <svg v-if="isLoading" class="animate-spin h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              <svg v-else class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
              </svg>
              <span>{{ isLoading ? 'Searching...' : 'Find Booking' }}</span>
            </button>
          </form>

          <!-- Search by Name Form -->
          <form v-if="activeTab === 'name'" @submit.prevent="searchByName" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-gray-700 mb-2 font-medium flex items-center">
                  <svg class="w-4 h-4 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                  </svg>
                  First Name *
                </label>
                <input 
                  v-model="nameSearch.firstName"
                  placeholder="John"
                  required
                  class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4E56C0] focus:border-[#4E56C0] transition"
                />
              </div>
              <div>
                <label class="block text-gray-700 mb-2 font-medium flex items-center">
                  <svg class="w-4 h-4 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                  </svg>
                  Last Name
                </label>
                <input 
                  v-model="nameSearch.lastName"
                  placeholder="Smith (optional)"
                  class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4E56C0] focus:border-[#4E56C0] transition"
                />
              </div>
            </div>
            <div>
              <label class="block text-gray-700 mb-2 font-medium flex items-center">
                <svg class="w-4 h-4 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                  <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                </svg>
                Email Address *
              </label>
              <input 
                v-model="nameSearch.email"
                type="email"
                placeholder="your.email@example.com"
                required
                class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4E56C0] focus:border-[#4E56C0] transition"
              />
            </div>
            <button
              type="submit"
              :disabled="isLoading"
              class="w-full bg-gradient-to-r from-[#4E56C0] to-[#9B5DE0] text-white font-bold py-3 px-6 rounded-lg hover:shadow-md transition-all disabled:opacity-50 flex items-center justify-center"
            >
              <svg v-if="isLoading" class="animate-spin h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              <svg v-else class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
              </svg>
              <span>{{ isLoading ? 'Searching...' : 'Find Booking' }}</span>
            </button>
          </form>

          <!-- Help Text -->
          <div class="mt-6 p-4 bg-gray-50 rounded-lg">
            <div class="flex items-start">
              <svg class="w-5 h-5 mt-0.5 mr-3 text-[#4E56C0] flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
              </svg>
              <div>
                <p class="text-sm text-gray-600">
                  <span class="font-medium text-[#4E56C0]">Note:</span> Your booking reference was sent to your email after completing the booking. 
                  If you can't find it, use the search by name option.
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Loading State -->
        <div v-if="isLoading" class="text-center py-8">
          <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-[#4E56C0] mb-4"></div>
          <p class="text-gray-600">Searching for your booking...</p>
        </div>

        <!-- Results -->
        <div v-if="searchResults && !isLoading">
          <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
            <div class="flex items-center justify-between mb-6">
              <div class="flex items-center">
                <svg class="w-6 h-6 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                <h2 class="text-2xl font-bold text-gray-900">Booking Found</h2>
              </div>
              <span :class="formatStatus(searchResults.status).color + ' text-xs font-semibold px-3 py-1 rounded-full flex items-center'">
                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                {{ formatStatus(searchResults.status).text }}
              </span>
            </div>

            <!-- Booking Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
              <div class="space-y-4">
                <div>
                  <p class="text-sm text-gray-500 flex items-center mb-1">
                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                    </svg>
                    Booking Reference
                  </p>
                  <p class="text-lg font-bold text-[#4E56C0]">{{ searchResults.bookingReference }}</p>
                </div>
                <div>
                  <p class="text-sm text-gray-500 flex items-center mb-1">
                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                    Customer Name
                  </p>
                  <p class="text-lg font-medium text-gray-900">{{ searchResults.customerName }}</p>
                </div>
                <div>
                  <p class="text-sm text-gray-500 flex items-center mb-1">
                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                      <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                    Email
                  </p>
                  <p class="text-lg font-medium text-gray-900">{{ searchResults.email }}</p>
                </div>
                <div v-if="searchResults.phone">
                  <p class="text-sm text-gray-500 flex items-center mb-1">
                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z" clip-rule="evenodd" />
                    </svg>
                    Phone
                  </p>
                  <p class="text-lg font-medium text-gray-900">{{ searchResults.phone }}</p>
                </div>
              </div>
              <div class="space-y-4">
                <div>
                  <p class="text-sm text-gray-500 flex items-center mb-1">
                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd" />
                    </svg>
                    Service Type
                  </p>
                  <p class="text-lg font-medium text-gray-900">{{ formatServiceType(searchResults.serviceType) }}</p>
                </div>
                <div>
                  <p class="text-sm text-gray-500 flex items-center mb-1">
                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                    Terminal
                  </p>
                  <p class="text-lg font-medium text-gray-900">{{ searchResults.terminal }}</p>
                </div>
                <div>
                  <p class="text-sm text-gray-500 flex items-center mb-1">
                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                    </svg>
                    Total Amount
                  </p>
                  <p class="text-xl font-bold text-[#4E56C0]">£{{ searchResults.totalAmount }}</p>
                </div>
                <div v-if="searchResults.flightNumber">
                  <p class="text-sm text-gray-500 flex items-center mb-1">
                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                    </svg>
                    Flight Number
                  </p>
                  <p class="text-lg font-medium text-gray-900">{{ searchResults.flightNumber }}</p>
                </div>
                <div v-if="searchResults.ecoFriendly" class="mt-2">
                  <span class="bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded-full flex items-center w-fit">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd" />
                    </svg>
                    Eco Friendly
                  </span>
                </div>
              </div>
            </div>

            <!-- Dates Section -->
            <div class="bg-gray-50 rounded-lg p-6 mb-6">
              <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                </svg>
                Travel Dates
              </h3>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="text-center p-4 bg-white rounded-lg">
                  <p class="text-sm text-gray-500 mb-1 flex items-center justify-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Drop-off
                  </p>
                  <p class="text-lg font-bold text-gray-900">{{ formatDate(searchResults.dropOffDate) }}</p>
                  <p class="text-gray-600">{{ searchResults.dropOffTime }}</p>
                </div>
                <div class="text-center p-4 bg-white rounded-lg">
                  <p class="text-sm text-gray-500 mb-1 flex items-center justify-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd" />
                    </svg>
                    Pick-up
                  </p>
                  <p class="text-lg font-bold text-gray-900">{{ formatDate(searchResults.pickUpDate) }}</p>
                  <p class="text-gray-600">{{ searchResults.pickUpTime }}</p>
                </div>
              </div>
            </div>

            <!-- Car Details -->
            <div class="border-t border-gray-200 pt-6">
              <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                  <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1v-1a1 1 0 011-1h2a1 1 0 011 1v1a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H19a1 1 0 001-1V5a1 1 0 00-1-1H3zm11 3a1 1 0 01-1-1 1 1 0 00-1-1H9a1 1 0 00-1 1 1 1 0 01-1 1v1a1 1 0 011 1 1 1 0 001 1h1a1 1 0 001-1 1 1 0 011-1V7z" />
                </svg>
                Car Details
              </h3>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                  <div class="mr-3 bg-[#4E56C0] p-2 rounded-lg">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                      <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1v-1a1 1 0 011-1h2a1 1 0 011 1v1a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H19a1 1 0 001-1V5a1 1 0 00-1-1H3zm11 3a1 1 0 01-1-1 1 1 0 00-1-1H9a1 1 0 00-1 1 1 1 0 01-1 1v1a1 1 0 011 1 1 1 0 001 1h1a1 1 0 001-1 1 1 0 011-1V7z" />
                    </svg>
                  </div>
                  <div>
                    <p class="text-sm text-gray-500">Make & Model</p>
                    <p class="font-medium">{{ searchResults.carMake }} {{ searchResults.carModel }}</p>
                  </div>
                </div>
                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                  <div class="mr-3 bg-[#4E56C0] p-2 rounded-lg">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                    </svg>
                  </div>
                  <div>
                    <p class="text-sm text-gray-500">Registration</p>
                    <p class="font-medium">{{ searchResults.registrationPlate }}</p>
                  </div>
                </div>
                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                  <div class="mr-3 bg-[#4E56C0] p-2 rounded-lg">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                    </svg>
                  </div>
                  <div>
                    <p class="text-sm text-gray-500">Colour</p>
                    <p class="font-medium">{{ searchResults.color }}</p>
                  </div>
                </div>
                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                  <div class="mr-3 bg-[#4E56C0] p-2 rounded-lg">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                    </svg>
                  </div>
                  <div>
                    <p class="text-sm text-gray-500">Booked On</p>
                    <p class="font-medium">{{ formatDate(searchResults.createdAt) }}</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Actions -->
            <div class="mt-8 pt-6 border-t border-gray-200">
              <div class="flex flex-col sm:flex-row gap-4">
                <button
                  @click="printBooking"
                  class="flex-1 border border-[#4E56C0] text-[#4E56C0] font-bold py-3 px-6 rounded-lg hover:bg-[#4E56C0] hover:text-white transition-colors flex items-center justify-center"
                >
                  <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                  </svg>
                  Print Details
                </button>
                <button
                  @click="contactSupport"
                  class="flex-1 bg-gradient-to-r from-[#4E56C0] to-[#9B5DE0] text-white font-bold py-3 px-6 rounded-lg hover:shadow-md transition-all flex items-center justify-center"
                >
                  <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z" clip-rule="evenodd" />
                  </svg>
                  Contact Support
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- No Results Message -->
        <div v-if="showNoResults" class="text-center py-8">
          <div class="mb-4">
            <svg class="w-16 h-16 mx-auto text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
            </svg>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-2">No Booking Found</h3>
          <p class="text-gray-600 mb-6">We couldn't find a booking matching your search criteria.</p>
          <div class="space-y-3">
            <button
              @click="resetSearch"
              class="block w-full md:w-auto md:inline-block bg-gradient-to-r from-[#4E56C0] to-[#9B5DE0] text-white font-medium py-2 px-6 rounded-lg hover:shadow-md transition-all flex items-center justify-center mx-auto"
            >
              <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
              </svg>
              Try a Different Search
            </button>
            <p class="text-sm text-gray-500 mt-4">
              Need help? Call us at <a href="tel:02039257797" class="text-[#4E56C0] font-medium">0203 925 7797</a>
            </p>
          </div>
        </div>

        <!-- Need Help Section -->
        <div v-if="!searchResults && !showNoResults && !isLoading" class="mt-8 bg-gradient-to-r from-[#4E56C0]/5 to-[#9B5DE0]/5 rounded-xl p-6">
          <h3 class="font-bold text-gray-900 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
            </svg>
            Need Help Finding Your Booking?
          </h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex items-start">
              <div class="bg-[#4E56C0] text-white p-2 rounded-lg mr-3">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                  <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                </svg>
              </div>
              <div>
                <p class="font-medium text-gray-900">Check Your Email</p>
                <p class="text-sm text-gray-600">Your booking confirmation email contains your reference number.</p>
              </div>
            </div>
            <div class="flex items-start">
              <div class="bg-[#4E56C0] text-white p-2 rounded-lg mr-3">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1 1 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1 5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z" clip-rule="evenodd" />
                </svg>
              </div>
              <div>
                <p class="font-medium text-gray-900">Call Us</p>
                <p class="text-sm text-gray-600">Contact our support team at 0203 925 7797</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      activeTab: 'reference',
      isLoading: false,
      searchResults: null,
      showNoResults: false,
      referenceSearch: {
        email: '',
        bookingReference: ''
      },
      nameSearch: {
        firstName: '',
        lastName: '',
        email: ''
      }
    }
  },
  methods: {
    searchByReference() {
      this.isLoading = true;
      this.showNoResults = false;
      
      // Simulación de búsqueda
      setTimeout(() => {
        // Datos de ejemplo
        this.searchResults = {
          bookingReference: 'HAP12345678',
          customerName: 'John Smith',
          email: 'john.smith@example.com',
          phone: '+44 7123 456789',
          serviceType: 'meet_greet',
          terminal: 'T2',
          totalAmount: '125.50',
          flightNumber: 'BA123',
          ecoFriendly: true,
          status: 'confirmed',
          dropOffDate: '2024-01-15',
          dropOffTime: '10:00 AM',
          pickUpDate: '2024-01-22',
          pickUpTime: '03:00 PM',
          carMake: 'Toyota',
          carModel: 'Corolla',
          registrationPlate: 'ABC123',
          color: 'Red',
          createdAt: '2024-01-10'
        };
        
        this.isLoading = false;
      }, 1500);
    },
    
    searchByName() {
      this.isLoading = true;
      this.showNoResults = false;
      
      // Simulación de búsqueda
      setTimeout(() => {
        // Datos de ejemplo
        this.searchResults = {
          bookingReference: 'HAP87654321',
          customerName: `${this.nameSearch.firstName} ${this.nameSearch.lastName || ''}`.trim(),
          email: this.nameSearch.email,
          phone: '+44 7987 654321',
          serviceType: 'meet_greet',
          terminal: 'T5',
          totalAmount: '89.99',
          flightNumber: 'EK009',
          ecoFriendly: false,
          status: 'pending',
          dropOffDate: '2024-02-01',
          dropOffTime: '09:00 AM',
          pickUpDate: '2024-02-05',
          pickUpTime: '02:00 PM',
          carMake: 'BMW',
          carModel: 'X3',
          registrationPlate: 'XYZ789',
          color: 'Blue',
          createdAt: '2024-01-25'
        };
        
        this.isLoading = false;
      }, 1500);
    },
    
    formatStatus(status) {
      const statusMap = {
        'pending': { text: 'Pending', color: 'bg-yellow-100 text-yellow-800' },
        'confirmed': { text: 'Confirmed', color: 'bg-green-100 text-green-800' },
        'completed': { text: 'Completed', color: 'bg-blue-100 text-blue-800' },
        'cancelled': { text: 'Cancelled', color: 'bg-red-100 text-red-800' }
      };
      return statusMap[status] || { text: 'Unknown', color: 'bg-gray-100 text-gray-800' };
    },
    
    formatServiceType(type) {
      const typeMap = {
        'meet_greet': 'Meet & Greet',
        'park_ride': 'Park & Ride',
        'valet': 'Valet Service'
      };
      return typeMap[type] || type;
    },
    
    formatDate(dateString) {
      if (!dateString) return 'N/A';
      const date = new Date(dateString);
      return date.toLocaleDateString('en-GB', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      });
    },
    
    printBooking() {
      window.print();
    },
    
    contactSupport() {
      window.location.href = 'tel:02039257797';
    },
    
    resetSearch() {
      this.searchResults = null;
      this.showNoResults = false;
      this.referenceSearch = { email: '', bookingReference: '' };
      this.nameSearch = { firstName: '', lastName: '', email: '' };
    }
  }
}
</script>

<style scoped>
/* Print styles */
@media print {
  nav, button, .no-print {
    display: none !important;
  }
  
  body {
    background: white !important;
    color: black !important;
  }
  
  .bg-gray-50, .bg-white, .bg-gray-100 {
    background: white !important;
    border: 1px solid #ddd !important;
  }
  
  .text-\[#4E56C0\] {
    color: black !important;
  }
  
  .shadow-lg, .shadow-md {
    box-shadow: none !important;
  }
}
</style>