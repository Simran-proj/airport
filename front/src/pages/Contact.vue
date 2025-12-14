<template>
  <div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4">
      <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12">
          <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Contact Heathrow Air Park</h1>
          <p class="text-gray-600 text-lg">Get in touch with our customer support team</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
          <!-- Contact Form -->
          <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Send us a Message</h2>

            <form @submit.prevent="submitContactForm" class="space-y-6">
              <!-- Personal Information -->
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <label class="block text-gray-700 mb-2 font-medium flex items-center">
                    <svg class="w-4 h-4 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                        clip-rule="evenodd" />
                    </svg>
                    First Name *
                  </label>
                  <input v-model="contactForm.firstName" placeholder="John" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4E56C0] focus:border-[#4E56C0] transition" />
                </div>
                <div>
                  <label class="block text-gray-700 mb-2 font-medium flex items-center">
                    <svg class="w-4 h-4 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                        clip-rule="evenodd" />
                    </svg>
                    Last Name *
                  </label>
                  <input v-model="contactForm.lastName" placeholder="Smith" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4E56C0] focus:border-[#4E56C0] transition" />
                </div>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <label class="block text-gray-700 mb-2 font-medium flex items-center">
                    <svg class="w-4 h-4 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg">
                      <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                      <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                    Email Address *
                  </label>
                  <input v-model="contactForm.email" type="email" placeholder="john@example.com" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4E56C0] focus:border-[#4E56C0] transition" />
                </div>
                <div>
                  <label class="block text-gray-700 mb-2 font-medium flex items-center">
                    <svg class="w-4 h-4 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd"
                        d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1 5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1 1 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z"
                        clip-rule="evenodd" />
                    </svg>
                    Phone Number
                  </label>
                  <input v-model="contactForm.phone" placeholder="+44 1234 567890"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4E56C0] focus:border-[#4E56C0] transition" />
                </div>
              </div>

              <!-- Subject -->
              <div>
                <label class="block text-gray-700 mb-2 font-medium flex items-center">
                  <svg class="w-4 h-4 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z"
                      clip-rule="evenodd" />
                  </svg>
                  Subject *
                </label>
                <select v-model="contactForm.subject" required @change="updateBookingReferenceVisibility"
                  class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4E56C0] focus:border-[#4E56C0] transition bg-white">
                  <option value="">Select a subject</option>
                  <option value="booking_inquiry">Booking Inquiry</option>
                  <option value="existing_booking">Existing Booking</option>
                  <option value="cancellation">Cancellation Request</option>
                  <option value="amendment">Booking Amendment</option>
                  <option value="complaint">Complaint</option>
                  <option value="feedback">Feedback</option>
                  <option value="general">General Question</option>
                </select>
              </div>

              <!-- Booking Reference (if applicable) -->
              <div v-if="showBookingReference">
                <label class="block text-gray-700 mb-2 font-medium flex items-center">
                  <svg class="w-4 h-4 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                      clip-rule="evenodd" />
                  </svg>
                  Booking Reference
                </label>
                <input v-model="contactForm.bookingReference" placeholder="HAP12345678 (optional)"
                  class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4E56C0] focus:border-[#4E56C0] transition" />
              </div>

              <!-- Message -->
              <div>
                <label class="block text-gray-700 mb-2 font-medium flex items-center">
                  <svg class="w-4 h-4 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                      clip-rule="evenodd" />
                  </svg>
                  Message *
                </label>
                <textarea v-model="contactForm.message" rows="6" placeholder="Please describe your inquiry in detail..."
                  required
                  class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4E56C0] focus:border-[#4E56C0] transition resize-none"></textarea>
                <p class="text-sm text-gray-500 mt-1">{{ contactForm.message.length }}/1000 characters</p>
              </div>

              <!-- Submit Button -->
              <button type="submit" :disabled="isSubmitting || contactForm.message.length > 1000"
                class="w-full bg-gradient-to-r from-[#4E56C0] to-[#9B5DE0] text-white font-bold py-3 px-6 rounded-lg hover:shadow-md transition-all disabled:opacity-50 flex items-center justify-center">
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
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z"
                    clip-rule="evenodd" />
                </svg>
                <span>{{ isSubmitting ? 'Sending...' : 'Send Message' }}</span>
              </button>

              <!-- Success Message -->
              <div v-if="submitSuccess" class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-lg">
                <div class="flex items-center">
                  <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                      clip-rule="evenodd" />
                  </svg>
                  <div>
                    <p class="font-semibold">Message sent successfully!</p>
                    <p class="text-sm">We'll get back to you within 24 hours.</p>
                  </div>
                </div>
              </div>
            </form>
          </div>

          <!-- Contact Information -->
          <div class="space-y-8">
            <!-- Contact Details Card -->
            <div class="bg-gradient-to-br from-[#4E56C0] to-[#9B5DE0] text-white rounded-xl shadow-lg p-8">
              <h2 class="text-2xl font-bold mb-6">Contact Information</h2>

              <div class="space-y-6">
                <div class="flex items-start">
                  <div class="bg-white/20 p-3 rounded-lg mr-4">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd"
                        d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z"
                        clip-rule="evenodd" />
                    </svg>
                  </div>
                  <div>
                    <p class="font-semibold text-lg">Call Us</p>
                    <p class="text-xl font-bold mt-1">0203 925 7797</p>
                    <div class="flex items-center mt-2 text-sm opacity-90">
                      <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                          clip-rule="evenodd" />
                      </svg>
                      <span>Mon-Fri: 09:00-17:00</span>
                    </div>
                    <div class="flex items-center text-sm opacity-90">
                      <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                          clip-rule="evenodd" />
                      </svg>
                      <span>Sat-Sun: 10:00-16:00</span>
                    </div>
                  </div>
                </div>

                <div class="flex items-start">
                  <div class="bg-white/20 p-3 rounded-lg mr-4">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                      <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                  </div>
                  <div>
                    <p class="font-semibold text-lg">Email Us</p>
                    <p class="text-lg font-bold mt-1">support@heathrowairpark.co.uk</p>
                    <div class="flex items-center mt-2 text-sm opacity-90">
                      <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                          clip-rule="evenodd" />
                      </svg>
                      <span>Response within 24 hours</span>
                    </div>
                  </div>
                </div>

                <div class="flex items-start">
                  <div class="bg-white/20 p-3 rounded-lg mr-4">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd"
                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                        clip-rule="evenodd" />
                    </svg>
                  </div>
                  <div>
                    <p class="font-semibold text-lg">Office Address</p>
                    <p class="mt-1">
                      Heathrow Air Park Ltd<br>
                      124 City Road<br>
                      London, EC1V 2NX<br>
                      United Kingdom
                    </p>
                  </div>
                </div>
              </div>

              <!-- Emergency Contact -->
              <div class="mt-8 pt-6 border-t border-white/30">
                <p class="font-semibold mb-2 flex items-center">
                  <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"
                      clip-rule="evenodd" />
                  </svg>
                  For Parking Emergencies:
                </p>
                <div class="bg-white/10 rounded-lg p-4">
                  <p class="text-lg font-bold flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd"
                        d="M17.707 9.293a1 1 0 010 1.414l-1.414 1.414a1 1 0 01-1.414 0 1 1 0 00-1.414 0l-1.414 1.414a1 1 0 01-1.414 0 1 1 0 00-1.414 0L9.879 14.12a1 1 0 01-1.414 0l-1.414-1.414a1 1 0 00-1.414 0L4.879 14.12a1 1 0 01-1.414 0L2.05 12.707a1 1 0 010-1.414l1.414-1.414a1 1 0 010-1.414L2.05 8.05a1 1 0 010-1.414l1.414-1.414a1 1 0 011.414 0 1 1 0 001.414 0l1.414-1.414a1 1 0 011.414 0 1 1 0 001.414 0L10.121 3.88a1 1 0 011.414 0l1.414 1.414a1 1 0 001.414 0 1 1 0 011.414 0l1.414 1.414a1 1 0 011.414 0l1.414 1.414a1 1 0 010 1.414l-1.414 1.414a1 1 0 000 1.414l1.414 1.414zM9 9a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1zm3 0a1 1 0 011-1h.01a1 1 0 110 2H13a1 1 0 01-1-1z"
                        clip-rule="evenodd" />
                    </svg>
                    07900 000 000
                  </p>
                  <p class="text-sm opacity-90 mt-1">24/7 emergency line for drivers at Heathrow</p>
                </div>
              </div>
            </div>

            <!-- FAQ Section -->
            <div class="bg-white rounded-xl shadow-lg p-6">
              <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                    clip-rule="evenodd" />
                </svg>
                Frequently Asked Questions
              </h3>

              <div class="space-y-4">
                <details class="border-b border-gray-100 pb-4 group">
                  <summary
                    class="font-medium text-gray-700 cursor-pointer hover:text-[#4E56C0] flex items-center justify-between">
                    <span>How quickly will I get a response?</span>
                    <svg class="w-5 h-5 text-gray-400 group-open:rotate-180 transition-transform" fill="currentColor"
                      viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                    </svg>
                  </summary>
                  <p class="text-gray-600 mt-2 text-sm pl-6">
                    We aim to respond to all inquiries within 24 hours during business hours.
                  </p>
                </details>

                <details class="border-b border-gray-100 pb-4 group">
                  <summary
                    class="font-medium text-gray-700 cursor-pointer hover:text-[#4E56C0] flex items-center justify-between">
                    <span>What information should I include in my message?</span>
                    <svg class="w-5 h-5 text-gray-400 group-open:rotate-180 transition-transform" fill="currentColor"
                      viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                    </svg>
                  </summary>
                  <p class="text-gray-600 mt-2 text-sm pl-6">
                    Please include your booking reference if you have one, along with dates and any relevant details.
                  </p>
                </details>

                <details class="pb-4 group">
                  <summary
                    class="font-medium text-gray-700 cursor-pointer hover:text-[#4E56C0] flex items-center justify-between">
                    <span>Can I cancel or amend my booking via email?</span>
                    <svg class="w-5 h-5 text-gray-400 group-open:rotate-180 transition-transform" fill="currentColor"
                      viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                    </svg>
                  </summary>
                  <p class="text-gray-600 mt-2 text-sm pl-6">
                    Yes, you can request changes via email. Please include your booking reference and the changes you
                    require.
                  </p>
                </details>
              </div>
            </div>

            <!-- Response Time Info -->
            <div class="bg-gradient-to-r from-[#FDCFFA]/20 to-[#D78FEE]/20 rounded-xl p-6">
              <h3 class="font-bold text-gray-900 mb-3 flex items-center">
                <svg class="w-5 h-5 mr-2 text-[#4E56C0]" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                    clip-rule="evenodd" />
                </svg>
                Our Response Times
              </h3>
              <div class="space-y-3">
                <div class="flex items-center justify-between">
                  <span class="text-gray-700 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg">
                      <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                      <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                    Email Inquiries
                  </span>
                  <span class="font-semibold text-[#4E56C0]">Within 24 hours</span>
                </div>
                <div class="flex items-center justify-between">
                  <span class="text-gray-700 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd"
                        d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z"
                        clip-rule="evenodd" />
                    </svg>
                    Phone Support
                  </span>
                  <span class="font-semibold text-[#4E56C0]">Immediate</span>
                </div>
                <div class="flex items-center justify-between">
                  <span class="text-gray-700 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                        clip-rule="evenodd" />
                    </svg>
                    Weekend Inquiries
                  </span>
                  <span class="font-semibold text-[#4E56C0]">Monday Morning</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Loading Overlay -->
        <div v-if="isSubmitting" class="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-50">
          <div class="bg-white p-8 rounded-xl shadow-2xl max-w-sm">
            <div class="flex flex-col items-center">
              <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-[#4E56C0] mb-4"></div>
              <p class="font-semibold text-gray-800">Sending your message...</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const isSubmitting = ref(false)
const submitSuccess = ref(false)

const contactForm = ref({
  firstName: '',
  lastName: '',
  email: '',
  phone: '',
  subject: '',
  bookingReference: '',
  message: ''
})

const showBookingReference = computed(() => {
  const relevantSubjects = ['booking_inquiry', 'existing_booking', 'cancellation', 'amendment', 'complaint']
  return relevantSubjects.includes(contactForm.value.subject)
})

const submitContactForm = async () => {
  if (contactForm.value.message.length > 1000) {
    alert('Message must be 1000 characters or less')
    return
  }

  isSubmitting.value = true
  submitSuccess.value = false

  try {
    const API_BASE_URL = import.meta.env.VITE_API_URL || '/api';
    const response = await fetch(`${API_BASE_URL}/contact`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
      },
      body: JSON.stringify({
        name: `${contactForm.value.firstName} ${contactForm.value.lastName}`,
        email: contactForm.value.email,
        phone: contactForm.value.phone || null,
        subject: contactForm.value.subject,
        booking_reference: contactForm.value.bookingReference || null,
        message: contactForm.value.message,
        submitted_at: new Date().toISOString()
      })
    })

    const result = await response.json()

    if (response.ok && result.success) {
      submitSuccess.value = true

      contactForm.value = {
        firstName: '',
        lastName: '',
        email: '',
        phone: '',
        subject: '',
        bookingReference: '',
        message: ''
      }

      setTimeout(() => {
        submitSuccess.value = false
      }, 5000)

    } else {
      throw new Error(result.message || 'Failed to send message')
    }

  } catch (error) {
    console.error('Contact form error:', error)

    sendEmailFallback()

  } finally {
    isSubmitting.value = false
  }
}

const sendEmailFallback = () => {
  const { firstName, lastName, email, phone, subject, bookingReference, message } = contactForm.value

  const subjectText = {
    booking_inquiry: 'Booking Inquiry',
    existing_booking: 'Existing Booking',
    cancellation: 'Cancellation Request',
    amendment: 'Booking Amendment',
    complaint: 'Complaint',
    feedback: 'Feedback',
    general: 'General Question'
  }[subject] || 'General Inquiry'

  const emailBody = `
Name: ${firstName} ${lastName}
Email: ${email}
Phone: ${phone || 'Not provided'}
Booking Reference: ${bookingReference || 'Not provided'}

Message:
${message}
  `.trim()

  const mailtoLink = `mailto:support@heathrowairpark.co.uk?subject=${encodeURIComponent(`Heathrow Air Park: ${subjectText}`)}&body=${encodeURIComponent(emailBody)}`

  window.location.href = mailtoLink

  submitSuccess.value = true
  setTimeout(() => {
    submitSuccess.value = false
  }, 5000)
}

</script>

<style scoped>
details summary {
  list-style: none;
}

details summary::-webkit-details-marker {
  display: none;
}

details[open] summary {
  color: #4E56C0;
}

button,
input,
select,
textarea {
  transition: all 0.2s ease;
}
</style>