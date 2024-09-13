<template>
	<div>
		<div class="wpcm-tab-area">
			<h3>{{strings.order_heading}}</h3>
			<div class="wpcm-order-table">
				<div class="wpcm-table-responsive">
					<table class="wpcm-table" v-loading="loading">
						<thead class="wpcm-sec-titlebar wpcm-cart-heading">
							<tr>
								<th>{{strings.order}}</th>
								<th>{{ $webinane_i18n.gateway}}</th>
								<th>{{ $webinane_i18n.total}}</th>
								<th colspan="2">{{ $webinane_i18n.status}}</th>
							</tr>
						</thead>
						<tbody>
							<template v-if="orders" v-for="(order, index) in orders">
								<order-row :order="order" @openpopup="orderPopup"></order-row>
							</template>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<el-dialog :title="popup_data.post_title" :visible.sync="dialogFormVisible" :append-to-body="bool_true" top="150px" :lock-scroll="bool_true">
			<div class="wpcm-modal wpcm-wrapper">
				<div class="wpcm-model-content">
					<order-detail :popup_data="popup_data" :customer="customer" :settings="settings"></order-detail>
					<template v-if="dialogFormVisible">
						<order-notes :orderdata="popup_data" :customer="customer"></order-notes>
					</template>
				</div>
			</div>
		</el-dialog>
	</div>
</template>

<script>
	import orderRow from './OrderRow.vue'
	import orderNotes from './OrderNotes.vue'
	import orderDetail from './OrderDetail.vue'

	export default {
		data() {
			return {
				loading: false,
				bool_true: true,
				orders: {},
				settings: {},
				popup_data: {},
				customer: {},
				dialogFormVisible: false,
				strings: {}
			}
		},
		components: {
			'order-row': orderRow,
			'order-notes': orderNotes,
			'order-detail': orderDetail
		},
		mounted() {
			this.getData()
		},
		methods: {
			getData() {
				let $ = jQuery
				this.loading = true

				$.ajax({
					url: wpcm_data.ajaxurl,
					type: 'post',
					data: {action: wpcm_data.ajax_action, callback: ['WebinaneCommerce\\Classes\\MyAccount', 'get_user_orders']},
					success: (res) => {
						if( res.orders ) {
							this.orders = res.orders
							this.settings = res.settings
							this.customer = res.customer
							this.strings = (res.settings.strings) ? res.settings.strings : {}
						} else {
							this.$notify({
								type: 'warning',
								message: res.data.message,
								title: 'Warning'
							})
						}
					},
					complete: (res) => {
						this.loading = false
					}
				})
			},
			orderPopup(order_data) {
				this.popup_data = order_data
				this.dialogFormVisible = true
			}
		}
	}
</script>