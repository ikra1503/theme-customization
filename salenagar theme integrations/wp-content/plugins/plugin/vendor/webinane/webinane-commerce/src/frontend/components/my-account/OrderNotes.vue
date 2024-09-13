<template>
	<div class="wpcm-comment" v-loading="loading">
		<h4>Order Notes: </h4>

		<div :class="replyClass(note)" v-for="note in notes" v-if="notes">
			<div v-html="note.comment_content" class="note-txt"></div>
		</div>
		<div class="wpcm-comment-form">
			<form action="">
				<div class="wpcm-field-input">
					<textarea class="wpcm-form-input" placeholder="Write something..." v-model="note"></textarea>
					<span class="wpcm-send-comt" @click.prevent="submit"><i class="fa fa-paper-plane"></i></span>
				</div>
			</form>
		</div>
	</div>
</template>

<script>
	export default {
		name: 'order-notes',
		props: ['orderdata', 'customer'],
		data() {
			return {
				notes: {},
				loading: false,
				note: ''
			}
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
					data: {action: wpcm_data.ajax_action, callback: ['WebinaneCommerce\\Classes\\MyAccount', 'get_order_notes'], order_id: this.orderdata.ID},
					success: (res) => {
						this.notes = res.notes
					},
					complete: (res) => {
						this.loading = false
					}
				})
			},
			replyClass(note) {
				if( note.comment_author_email !== this.customer.email ) {
					return 'wpcm-comment-msg wpcm-comment-reply'
				} else {
					return 'wpcm-comment-msg'
				}
			},
			submit() {
				let $ = jQuery
				this.loading = true

				$.ajax({
					url: wpcm_data.ajaxurl,
					type: 'post',
					data: {action: wpcm_data.ajax_action, callback: ['WebinaneCommerce\\Classes\\MyAccount', 'add_order_notes'], order_id: this.orderdata.ID, note: this.note},
					success: (res) => {
						if( res.success == true ) {
							this.$notify.success({
								title: 'Success',
								message: res.data.message,
								offset: 80
					        });
							this.notes = res.data.notes
							this.note = ''
					        
						} else if( res.success == false ) {
					        this.$notify.error({
								title: 'Error',
								message: res.data.message,
								offset: 80
					        });
						}

					},
					error: (res) => {
						this.$notify.error({
							title: 'Error',
							message: res.statusText,
							offset: 80
				        });
					},
					complete: (res) => {
						this.loading = false
					}
				})
			}
		}
	}
</script>