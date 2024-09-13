//import '../main.scss';
//import "vue-select/src/scss/vue-select.scss";
//import ElementUI from 'element-ui';
// import locale from 'element-ui/lib/locale/lang/en'

import '../filters.js';
// import VueNumberInput from '@chenfengyuan/vue-number-input';
import i18n from '../i18n.js'

const ElementUI = window.ELEMENT

// Vue.use(VueNumberInput);
// Vue.component('vue-number-input', VueNumberInput);
ElementUI.locale(window.ELEMENT.lang.en)
Vue.use(ElementUI);

Vue.use(i18n);

if( document.querySelector('.wpcm-order-detail') ) {
	
	const app = new Vue({
		el: '.wpcm-order-detail',
		data: {
			loading: false,
			result: false,
			result_type: 'error',
			result_msg: '',
			customer: 0,
			customer_data: {
				email: '',
				name: '',
			},
			customers: [],
			order: {},
			gateways: {},
			symbol: '$'
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
				let post_id = jQuery('#post_ID').val()
				let thisis = this

				this.loading = true

				jQuery.ajax({
					url: ajaxurl,
					type: 'post',
					data: {action: '_wpcommerce_admin_orders_data', post_id:post_id},
					success: (res) => {
						if( res ) {
							if( _.size(res.customer) > 0 ) {

								this.customer_data = res.customer
							}
							this.customer = (res.customer) ? parseInt(res.customer.id) : 0
							if( res.customers ) {
								_.each(res.customers, (value) => {
									this.customers.push({
										label: value.name,
										value: value.id
									})
								})
							}
							this.order = res.order
							this.gateways = res.gateways
							if( res.order.order_items ) {
								this.order.order_items = res.order.order_items.filter(item => item.qty = parseInt(item.qty))
							}
							this.symbol = (res.symbol !== undefined) ? res.symbol : '$'
						}
						jQuery(document).trigger('webinane_commerce_admin_orders_meta', thisis);

						this.loading = false
					},

					fail: (res) => {
						thisis.result = true
						thisis.result_type = 'danger'
						thisis.result_msg = 'Something went wrong'

						this.loading = false
					}
				})
			},
			formatPrice(price) {
				let symbol = this.symbol
				let position = this.set_var(window.wpcm_data, 'position')
				let sep = this.set_var(window.wpcm_data, 'sep')
				let d_sep = this.set_var(window.wpcm_data, 'd_sep')
				let d_point = this.set_var(window.wpcm_data, 'd_point')
				price = this.formatMoney(price, d_point, d_sep, sep)
				price = (symbol === 'after') ? price+' '+symbol : symbol+' '+price
				return price
			},
			formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
				try {
					decimalCount = Math.abs(decimalCount);
					decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

					const negativeSign = amount < 0 ? "-" : "";

					let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
					let j = (i.length > 3) ? i.length % 3 : 0;

					return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
				} catch (e) {
					this.$notify({type: 'error', message: e})
				}
			},
			set_var(varr, key, def) {
				if(varr[key] !== undefined) {
					return varr[key]
				}
				return def;
			}
		}

	});
}