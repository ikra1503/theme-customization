<script>
	export default {
		props: {
			nonce: String,
			error_string: String,
			success_string: String
		},
		data() {
			return {
				login_form: {
				},
				register_form: {

				},
				loading: false
			}
		},
		methods: {
			login() {
				this.loading = true
				let $ = jQuery
				$.ajax({
					url: wpcm_data.ajaxurl,
					type: 'post',
					data: {
						action: wpcm_data.ajax_action,
						callback: ['\\WebinaneCommerce\\Classes\\MyAccount', 'login'],
						form: this.login_form,
						nonce: this.nonce
					},
					success: (res) => {
						if(res.success) {
							window.location = location.href
						} else {
							this.$notify({
								type: 'error',
								title: this.error_string,
								message: res.data.message,
								dangerouslyUseHTMLString: true,
							})
						}
					},
					error: (error) => {
						this.$notify({type: 'error', title: this.error_string, message: error})
					},
					complete: (error) => {
						this.loading = false
					}
				
				})
			},
			register() {
				this.loading = true
				let $ = jQuery
				$.ajax({
					url: wpcm_data.ajaxurl,
					type: 'post',
					data: {
						action: wpcm_data.ajax_action,
						callback: ['\\WebinaneCommerce\\Classes\\MyAccount', 'register'],
						form: this.register_form,
						nonce: this.nonce
					},
					success: (res) => {
						if(res.success) {
							this.$notify({
								type: 'success',
								title: this.success_string,
								message: res.data.message,
							})
						} else {
							this.$notify({
								type: 'error',
								title: this.error_string,
								message: res.data.message,
								dangerouslyUseHTMLString: true,
							})
						}
					},
					error: (error) => {
						this.$notify({type: 'error', title: this.error_string, message: error})
					},
					complete: (error) => {
						this.loading = false
					}
				
				})
			}
		}
	}
</script>