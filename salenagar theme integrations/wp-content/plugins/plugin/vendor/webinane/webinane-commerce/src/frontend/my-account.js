// require('../components/fields/fields')
import i18n from '../i18n.js'

Vue.component('login-register-form', require('./components/my-account/Login.vue').default)
Vue.component('myaccount-tabs', require('./components/my-account/Tabs.vue').default)
Vue.component('myaccount-profile', require('./components/my-account/Profile.vue').default)
Vue.component('myaccount-orders', require('./components/my-account/Orders.vue').default)
Vue.component('myaccount-payment-methods', require('./components/my-account/OrdersPaymentMethodes.vue').default)

Vue.use(i18n)
window.$ = jQuery

if (document.querySelector('.wpcm-my-account-wrapper')) {

	const wpcm_my_account_app = new Vue({
		el: '.wpcm-my-account-wrapper',
		data: {
			loading: false,
			result: false,
			tabs: {},
			user: {},
			customer: {},
			dependencies: {}
		},
		mounted() {
			this.getData();
		},
		methods: {
			getData() {

				let $ = jQuery

				$.ajax({
					url: wpcm_data.ajaxurl,
					type: 'post',
					data: {
						action: wpcm_data.ajax_action,
						callback: ["WebinaneCommerce\\Classes\\MyAccount", 'account_config']
					},
					success: (res) => {
						this.tabs = res.config
					}
				})
			}
		}
	});
}
