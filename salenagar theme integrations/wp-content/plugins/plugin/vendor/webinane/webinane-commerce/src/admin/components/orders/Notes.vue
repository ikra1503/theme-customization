<template>
	<div>
		<section class="wpcm-sec">
			<div class="wpcm-sec-titlebar">
				<h4>{{ $webinane_i18n.order_notes }}</h4>
			</div>
			<div class="wpcm-sec-content">
				<div class="wpcm-note-list" v-if="notes">
					<div class="wpcm-row">
						<div class="wpcm-col-lg-3 wpcm-col-md-6 wpcm-col-sm-6" v-for="s_note in notes">
							<div class="wpcm-note-box">
								<div class="wpcm-note-date">
									<div class="wpcm-date">
										<span class="wpcm-gray-colr">{{s_note.comment_author}}</span>
										<span class="wpcm-primary-colr">{{ s_note.comment_date }}</span>
									</div>
									<a class="wpcm-secondary-colr" href="#" @click.prevent="removeNote(s_note.comment_ID)" title=""><i class="fas fa-trash-alt"></i></a>
								</div>
								<p v-html="s_note.comment_content"></p>
							</div>
						</div>
					</div>
				</div>
				<div class="wpcm-add-note">
					<div class="wpcm-row">
						<div class="wpcm-col-md-2">
							<div class="wpcm-note-title">
								<span>{{ $webinane_i18n.add_note }}</span><a class="wpcm-primary-bgcolr" href="#" title=""><i class="fa fa-question"></i></a>
							</div>
						</div>
						<div class="wpcm-col-md-10">
							<form class="wpcm-note-form" action="">
								<div class="wpcm-row">
									<div class="wpcm-col-md-12 wpcm-col-lg-4">
										<div class="wpcm-note-area">
											<div class="wpcm-custom-select">
												<select class="wpcm-form-input" v-model="status">
													<option value="customer">{{ $webinane_i18n.customer_note }}</option> 
													<option value="private">{{ $webinane_i18n.private_note }}</option> 
												</select>
											</div>
											<a href="#" @click.prevent="addNote" class="wpcm-btn wpcm-note-btn">
												{{ $webinane_i18n.add_note }}
												<transition name="fade">
													<i class="fa fa-circle-notch fa-spin" v-show="$root.loading"></i>
												</transition>
											</a>
										</div>
									</div>
									<div class="wpcm-col-md-12 wpcm-col-lg-8">
										<div class="wpcm-note-content">
											<textarea class="wpcm-form-input" v-model="note" required></textarea>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				note: '',
				status: 'customer',
				notes: []
			}
		},
		mounted() {
			this.getNotes()
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
			/**
			 * Get All the notes of the current order.
			 * 
			 * @return {[type]} [description]
			 */
			getNotes() {
				let thisis = this
				let $ = jQuery
				let post_id = jQuery('#post_ID').val()

				$.ajax({
					url: ajaxurl,
					type: 'post',
					data: {action: '_wpcommerce_admin_order_get_notes', post_id: post_id},
					success: function(res) {
						if( res.success === true ) {
							thisis.notes = res.data.notes
						} else {
							thisis.notif(res.data, 'danger')
						}
					},
					error: function(res) {
						thisis.notif(res.statusText, 'danger')
					}
				})
			},
			/**
			 * Add new note.
			 */
			addNote() {

				let thisis = this
				let $ = jQuery
				let post_id = jQuery('#post_ID').val()

				if( this.note == '' ) {
					this.$notify.error({
                      title: this.$webinane_i18n.error,
                      message: this.$webinane_i18n.please_enter_note,
                      offset: 30
                    });
                    return;
				}

				thisis.$root.loading = true;
				$.ajax({
					url: ajaxurl,
					type: 'post',
					data: {action: '_wpcommerce_admin_order_add_note', note: thisis.note, post_id: post_id, order: thisis.$root.order, customer: thisis.$root.customer_data, status: thisis.status},
					success: function(res) {
						if( res.success === true ) {
							thisis.notif(res.data.message, 'success')
							thisis.notes = res.data.notes
							thisis.note = ''
						} else {
							thisis.notif(res.data, 'danger')
						}
					},
					error: function(res) {
						thisis.notif(res.statusText, 'danger')
					}
				})
			},
			/**
			 * Remote the note of given id.
			 *
			 * @param  {[type]} id [description]
			 * @return {[type]}    [description]
			 */
			removeNote(id) {
				if ( confirm(this.$webinane_i18n.sure_remove_note) ) {
					let thisis = this
					let $ = jQuery
					let post_id = jQuery('#post_ID').val()

					thisis.$root.loading = true;
					$.ajax({
						url: ajaxurl,
						type: 'post',
						data: {action: '_wpcommerce_admin_order_remove_note', id: id, post_id: post_id},
						success: function(res) {
							if( res.success === true ) {
								thisis.notif(res.data.message, 'success')
								thisis.notes = res.data.notes
							} else {
								thisis.notif(res.data, 'danger')
							}
						},
						error: function(res) {
							thisis.notif(res.statusText, 'danger')
						}
					})
				}
			}
		}
	}
</script>