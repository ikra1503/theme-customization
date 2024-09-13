<template>
	<div>
		<section class="wpcm-sec wpcm-cart-sec" v-loading="loading">
			<div class="wpcm-cart-table" v-if="$root.order.order_items">
				<div class="wpcm-table-responsive">
					<table class="wpcm-table">
						<thead class="wpcm-sec-titlebar wpcm-cart-heading">
				            <tr>
				                <th>{{i18n.item}}</th>
				                <th>{{i18n.cost}}</th>
				                <th>{{i18n.qty}}</th>
				                <th>{{i18n.total}}</th>
				                <th>{{i18n.action}}</th>
				            </tr>
				        </thead>
				        <tbody>
				            <tr class="wpcm-cart-item" v-for="item in $root.order.order_items">
				               <td>
									<div class="wpcm-cart-img">
										<a href="#" title="" @click.prevent="removeItem(item.order_item_id)" class="wpcm-secondary-colr"><i class="fa fa-times"></i></a>
										<img :src="item.thumb" alt="">
									</div>
									<div class="wpcm-item-title">
										<span>
											<a :href="item.link" :title="item.order_item_name">{{ item.order_item_name }}</a>
										</span>
									</div>
								</td>
								<td><span class="wpcm-price">{{$root.formatPrice(item.price)}}</span></td>
								<td>
									<span class="wpcm-qty" v-show="onEditing(item.order_item_id) == false">{{item.qty}}</span>
									<div class="wpcm-vue-number-input" v-show="onEditing(item.order_item_id)">
										<el-input-number v-model="item.qty" autocomplete="off"></el-input-number>
									</div>
									
								</td>
								<td><span class="wpcm-price-total">{{$root.formatPrice(item.price*item.qty) }}</span></td>
								<td>
									<a href="#" title="" v-show="onEditing(item.order_item_id) == false" class="wpcm-update-cart" @click.prevent="editItem(item.order_item_id)"><i class="fa fa-pencil-alt"></i></a>							
									<a href="#" title="" class="wpcm-update-cart" @click.prevent="editItemSave($event)" v-show="onEditing(item.order_item_id)"><i class="fa fa-check"></i></a>							
								</td>
				            </tr>
				            
				        </tbody>
				        <tfoot class="wpcm-cart-bottom">
							<tr>
								<td>
									<div class="wpcm-cart-msg">
										<div class="wpcm-tooltip-area">
											<a href="#" title="" class="wpcm-primary-bgcolr"><i class="fa fa-question"></i></a>
											<div class="wpcm-tootip">
												<span v-html="i18n.to_edit_this_order"></span>
											</div>
										</div>
										<span v-html="i18n.order_not_editable"></span>
									</div>
									<div class="wpcm-cart-btns">
										<a href="#" title="" @click.prevent="dialogFormVisible = true;getProducts()">{{i18n.add_item}}</a>
										<a href="#" v-if="isRefundable() && $root.order.post_status == 'completed'" title="" @click.prevent="giveRefund">{{i18n.refund}}</a>
									</div>
								</td>
								<td></td>
								<td></td>
								<td class="wpcm-primary-bgcolr">
									<span class="wpcm-shiping-charges">
										<strong>{{i18n.subtotal}}:</strong>
										<span v-if="$root.symbol" class="wpcm-per-itme">{{$root.formatPrice(itemsTotal())}}</span>
									</span>
								</td>
								<td class="wpcm-primary-bgcolr">
									<span class="wpcm-cart-total">
										<strong>{{i18n.total}}:</strong>
										<span v-if="$root.symbol" class="wpcm-total-amount">{{ $root.formatPrice(itemsTotal()) }}</span>
									</span>
								</td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</section>
		
		<el-dialog :title="i18n.add_new_item" :visible.sync="dialogFormVisible">
			<el-form :model="form" v-loading="dialogLoading">
				<el-form-item :label="i18n.select_product" :label-width="formLabelWidth">
					<div class="el-custom-select wpcm-custom-select2">
						<el-select v-model="form.name" :placeholder="i18n.select_product" size="large">
							<el-option v-if="products" v-for="(label, key) in products" :key="key" :label="label" :value="key"></el-option>
						</el-select>
					</div>
				</el-form-item>
				<el-form-item :label="i18n.price" :label-width="formLabelWidth">
					<el-input-number v-model="form.price" autocomplete="off"></el-input-number>
				</el-form-item>
				<el-form-item :label="i18n.qty" :label-width="formLabelWidth">
					<el-input-number v-model="form.qty" autocomplete="off"></el-input-number>
				</el-form-item>
			</el-form>
			<span slot="footer" class="dialog-footer">
				<el-button @click="dialogFormVisible = false" round>{{i18n.cancel}}</el-button>
				<el-button type="primary" @click="addNewProduct()" round>{{i18n.add_item}}</el-button>
			</span>
		</el-dialog>
		
	</div>
</template>

<script>

export default {
	data() {
		return {
			dialogFormVisible: false,
			dialogLoading: false,
			loading: false,
			editing: false,
			edit_id: 0,
			products: [],
			add_new_id: 0,
			add_new_qty: 1,
			add_new_price: 0,
			i18n: this.$webinane_i18n,
			form: {
				name: '',
				qty: 0,
				price: 10
			},
			formLabelWidth: '120px'
		}
	},
	components: {},
	mounted() {
	},
	methods: {
		notif(message, type, thisis) {
			if( message === undefined ) {
				return;
			}

			this.$root.loading = false;
					
			this.$root.result = true
			this.$root.result_type = type
			this.$root.result_msg = message
		},
		isRefundable() {
			if( this.$root.order.meta ) {
				let gateway = this.$root.order.meta._wpcm_order_gateway
				if( gateway ) {
					let gt_obj = _.find(this.$root.gateways, (gw) => {
						return (gw.id === gateway)
					})

					if(gt_obj && gt_obj !== undefined) {
						return gt_obj.is_refundable
					}
				}
			}
			return false
		},
		giveRefund() {
			let thisis = this

			this.$confirm(this.$webinane_i18n.sure_to_give_refund, 'Warning', {
				confirmButtonText: this.$webinane_i18n.ok,
				cancelButtonText: this.$webinane_i18n.cancel,
				type: 'warning'
			}).then(() => {
				jQuery.ajax({
					url: ajaxurl,
					type: 'post',
					data: {action: '_wpcommerce_admin_order_give_refund', order: thisis.$root.order},
					success: (res) => {
						this.$notify({
							type: (res.success) ? 'success' : 'error',
				          	title: (res.success) ? this.$webinane_i18n.success : this.$webinane_i18n.error,
				          	message: res.data.message,
				          	offset: 30
				        });
				        this.loading = false

					},
					error: (res) => {
						this.$notify.error({
				          title: this.$webinane_i18n.error,
				          message: res.statusText,
				          offset: 30
				        });
				        this.loading = false
					}
				})
			}).catch(() => {
				this.$message({
					type: 'info',
					message: this.$webinane_i18n.delete_canceled
				});          
			});
		},
		/**
		 * @deprecated: this method is deprecated.
		 */
		addItem() {
			jQuery('#addItemModal').modal()
			this.getProducts();
		},
		removeItem(id) {
			let thisis = this

			this.$confirm(this.$webinane_i18n.sure_remove_item_from_order, 'Warning', {
				confirmButtonText: this.$webinane_i18n.ok,
				cancelButtonText: this.$webinane_i18n.cancel,
				type: 'warning'
			}).then(() => {
				let order_items = [...this.$root.order.order_items]
				this.$root.order.order_items = _.reject(order_items, function(item){
					return item.order_item_id == id
				})

				let complete = function(res) {
					thisis.editing = false
					thisis.edit_id = 0
				}

				this.doAjax(complete)
			}).catch(() => {
				this.$message({
					type: 'info',
					message: this.$webinane_i18n.delete_canceled
				});          
			});
			
		},
		editItem(id) {
			this.editing = true
			this.edit_id = id
		},
		onEditing(id) {
			return this.editing && this.edit_id == id
		},
		editItemSave($event) {
			let target = $event.target
			let thisis = this
			jQuery(target).removeClass('fa-check').addClass('fa-circle-notch fa-spin')

			let complete = (res) => {
				jQuery(target).removeClass('fa-circle-notch fa-spin').addClass('fa-check')
				this.editing = false
				this.edit_id = 0
			}

			this.doAjax(complete)
		},
		doAjax(onComplete) {
			let thisis = this
			this.loading = true

			jQuery.ajax({
				url: ajaxurl,
				type: 'post',
				data: {action: '_wpcommerce_admin_order_update_item', order: thisis.$root.order, customer: thisis.$root.customer_data},
				success: (res) => {
					this.$notify.success({
			          title: this.$webinane_i18n.success,
			          message: res.data,
			          offset: 30
			        });
			        this.loading = false
					onComplete()
				},
				error: (res) => {
					this.$notify.error({
			          title: this.$webinane_i18n.error,
			          message: res.statusText,
			          offset: 30
			        });
			        this.loading = false
					onComplete()
				}
			})
		},
		itemsTotal() {
			let total = 0;

			_.map(this.$root.order.order_items, function(item){
				if( item.price ) {
					total += parseInt(item.price)*parseInt(item.qty)
				}
			})
			return total
		},
		getProducts() {
			if( _.size(this.products) > 0 ) {
				return
			}

			let thisis = this
			let $ = jQuery
			this.dialogLoading = true

			$.ajax({
				url: ajaxurl,
				type: 'post',
				data: {action: '_wpcommerce_admin_order_get_products'},
				success: (res) => {
					this.products = res.data
					this.dialogLoading = false
				},
				error: (res) => {
					thisis.$notify.error({
			          title: this.$webinane_i18n.error,
			          message: res.statusText,
			          offset: 30
			        });
			        this.dialogLoading = false
				}
			})
		},
		/**
		 * Wiating for full browerser support.
		 * 
		 * @return {[type]} [description]
		 */
		fetchSupport() {
			fetch(ajaxurl,{
				method:'POST', 
				headers: {
					'Accept': 'application/json, text/plain, */*',
		            "Content-Type": 'application/x-www-form-urlencoded',
		            // "Content-Type": "application/x-www-form-urlencoded",
		        },
				body: 'action=_wpcommerce_admin_order_get_products'
			})
			.then(response => response.json())
			.then(response => {
				thisis.notif(response.message, 'success')
				if( response.data ) {
					_.each(response.data, function(product, ID) {
						thisis.products.push( {code: ID, label: product} )
					})
				}
			})
			.catch(error => console.error('Error:', error))
		},
		addNewProduct() {
			let thisis = this
			let $ = jQuery
			let post_id = jQuery('#post_ID').val()

			this.dialogLoading = true
			
			$.ajax({
				url: ajaxurl,
				type: 'post',
				data: {action: '_wpcommerce_admin_order_add_new_item', id: thisis.form.name, post_id: post_id, amount: thisis.form.price, qty: thisis.form.qty},
				success: (res) => {
					if( res.success === true ) {
						thisis.$notify.success({
				          title: this.$webinane_i18n.success,
				          message: res.data.message,
				          offset: 30
				        });
						if( res.data.order.order_items ) {
							res.data.order.order_items = res.data.order.order_items.filter(item => item.qty = parseInt(item.qty))
						}
						thisis.$root.order = res.data.order
						this.dialogFormVisible = false
					} else {
						thisis.$notify.error({
				          title: this.$webinane_i18n.error,
				          message: res.data,
				          offset: 30
				        });
					}
				    
				    this.dialogLoading = false

				},
				error: (res) => {
					thisis.$notify.error({
			          title: this.$webinane_i18n.error,
			          message: res.statusText,
			          offset: 30
			        });
			        this.loading = false
				}
			})

		}
	}
}
</script>
