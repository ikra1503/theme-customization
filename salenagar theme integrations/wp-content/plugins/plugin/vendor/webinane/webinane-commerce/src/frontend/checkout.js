const { __, setLocaleData } = wp.i18n


Vue.component('front-billing-address', require('./components/BillingAddress.vue').default)
Vue.component('front-shipping-address', require('./components/ShippingAddress.vue').default)
Vue.component('front-checkout-items', require('./components/Items.vue').default)
Vue.component('front-checkout-order', require('./components/Order.vue').default)

window.webinane_checkout_app = {}

if( document.querySelector('.wpcm-checkout-wrapper')) {

	const wpcm_checkout_app = new Vue({
		el: '.wpcm-checkout-wrapper',
		data: {
			isLoaded: true,
			loading: false,
			result: false,
			result_type: 'error',
			result_msg: '',
			ship_diff: false,
			billing_fields: {
				first_name: '',
				last_name: '',
				company: '',
				base_country: '',
				address_line_1: '',
				address_line_2: '',
				city: '',
				state: '',
				zip: '',
				phone: '',
				email: ''
			},
			shipping_fields: {
				first_name: '',
				last_name: '',
				company: '',
				base_country: '',
				address_line_1: '',
				address_line_2: '',
				city: '',
				state: '',
				zip: '',
				phone: '',
			},
			gateway: 'offline',
			payment_method: '',
			ccard: {

			},
			countries: {},
			cart: {},
			items: {},
			recurring: false,
			extras: {},
			braintree_plan: '',
			validated: true,
		},
		computed: {
		},
		mounted() {
			this.getData()
		},
		methods: {
			onDone: function() {
				this.result = false
				this.result_type = '';
				this.result_msg = '';
			},
			getData() {
				let $ = jQuery
				let thisis = this
				setTimeout(() => {
					jQuery(document).trigger('webinane_donation_modal_opened', this);

				}, 1000)

				this.loading = true

				$.ajax({
					url: wpcm_data.ajaxurl,
					type: 'post',
					data: {action:'_wpcommerce_checkout_data', nonce: wpcm_data.nonce, is_ajax: true},
					success: (res) => {
						thisis.countries = res.countries
						thisis.cart = res.cart
						thisis.items = res.items
						thisis.billing_fields.email = res.customer.email
						thisis.billing_fields.first_name = res.customer.name

						if( res.customer.meta !== undefined ) {
							
							thisis.ship_diff = res.customer.meta.ship_diff
							
							_.map(res.customer.meta, function(myres, key){
								let new_key = key.replace('billing_', '')
								if( thisis.billing_fields[new_key] !== undefined ) {
									thisis.billing_fields[new_key] = myres
								}
							})
							_.map(res.customer.meta, function(myres, key){
								let new_key = key.replace('shipping_', '')
								if( thisis.shipping_fields[new_key] !== undefined ) {
									thisis.shipping_fields[new_key] = myres
								}
							})
						} 
					},
					complete: (res) => {
						thisis.loading = false
					}
				})
			},
			submit() {
				this.checkout()
			},
			checkout() {
				let $ = jQuery
				let thisis = this

				this.$emit('webinane-checkout-form-validation', false);

				if( ! this.validated ) {
					return;
				}

				this.loading = true

				$.ajax({
					url: wpcm_data.ajaxurl,
					type: 'post',
					data: {
						action:wpcm_data.ajax_action, 
						subaction: 'checkout', 
						nonce: wpcm_data.nonce, 
						shipping: thisis.shipping_fields, 
						billing: thisis.billing_fields, 
						is_ajax: true, 
						ship_diff:thisis.ship_diff, 
						gateway: thisis.payment_method, 
						extras: this.extras,
						cc: this.ccard,
						braintree_plan: this.braintree_plan
					},
					success: (res) => {
						if( res.type == 'redirect' ) {
							window.location = res.url
						}
						if( ! res.success ) {
							this.$notify.error({
					          title: 'Error',
					          dangerouslyUseHTMLString: true,
					          message: res.data.message,
					          offset: 100
					        });
						}
					},
					fail: (res) => {

					},
					complete: (res) => {
						this.loading = false
					}
				})
			},
			cartTotal() {
				let total = 0
				_.map(this.items, function(item){
					total += (item.qty*item.price)
				})

				return total
			},
			toggleShipping(value) {
				this.ship_diff = value
			},
			updateItems() {
				
				let $ = jQuery
				let thisis = this
				this.loading = true

				$.ajax({
					url: wpcm_data.ajaxurl,
					type: 'post',
					data: {action:wpcm_data.ajax_action, subaction: 'update_cart_items', nonce: wpcm_data.nonce, items: thisis.items},
					success: (res) => {
						thisis.items = res.data.items
						this.$notify({
							type: 'success',
							title: __('Success', 'webinane-commerce'),
					        message: __('Items are updated', 'webinane-commerce'),
					        offset: 100
						})
					},
					complete: (res) => {
						this.loading = false
					}
				})
			},
			getYears() {
				let d = new Date();
				let year = parseInt(d.getFullYear())

				return _.range(year, (year+10))
			},
		}

	});

	window.webinane_checkout_app = wpcm_checkout_app
}