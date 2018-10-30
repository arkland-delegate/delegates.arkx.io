/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

if (window.Vue === undefined) {
    window.Vue = require('vue')
}

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('local-time', require('./components/LocalTime.vue'))
Vue.component('progressmeter', require('./components/ProgressMeter.vue'))
Vue.component('progressbar', require('./components/ProgressBar.vue'))
Vue.component('notification', require('./components/Notification.vue'))
Vue.component('calculator', require('./components/Calculator.js'))
Vue.component('delegate-tabs', require('./components/DelegateTabs.js'))

new Vue({
  el: '#app',
  data() {
    return {
      showMobileMenu: false
    }
  },
  methods: {
    toggleMenu() {
      this.showMobileMenu = !this.showMobileMenu
    }
  }
})

require('./markdown')
