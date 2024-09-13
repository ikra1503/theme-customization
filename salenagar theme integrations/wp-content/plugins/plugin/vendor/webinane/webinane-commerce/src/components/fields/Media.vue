<template>
	<transition name="fade">
		<div class="wpcm-media-wrapper">
			<input type="hidden" v-model="fieldModel">
			<div class="image" v-if="attachment.sizes">
				<a href="#" @click.prevent="remove()" class="remove-media">x</a>
				<img :src="attachment.sizes.thumbnail.url" :alt="attachment.title">
			</div>
			<br />
			<a href="#" class="button wpcm-btn mt-3" @click.prevent="addMedia($event)">
				{{ btnText() }}
				<i class="fa fa-refresh fa-spin" v-if="loading"></i>
			</a>
		</div>
	</transition>
</template>

<script>
	const {ajaxurl, wpcm_data} = window;

	export default {
		props: {
			field: Object,
			options: Object,
			value: '',
			update_text: {
				required: false,
				default: 'Update Media'
			},
			add_text: {
				required: false,
				default: 'Add Media'
			},
			
		},
		data() {
			return {
				attachment: {},
				loading: false,
				is_done: false,
			}
		},
		computed: {
			fieldModel: {
				get() {
					return 2
				},
				set(value) {
					
				}
			}
		},
		watch: {
			value(value) {
				this.getMedia()
			}
		},
		mounted() {
			if(this.value > 0 ) {
				this.getMedia()
			}
		},
		methods: {
			getValue() {
				if( this.value ) {
					return this.value
				} else if ( this.field.default ) {
					return this.field.default
				}

				return ''
			},
			getMedia() {
				let url = (ajaxurl !== undefined) ? ajaxurl : '';
				if( url == undefined || !url ) {
					url = (wpcm_data !== undefined) ? wpcm_data.ajaxurl : ''
				}

				if( this.value > 0 ) {
					
					let $ = jQuery
					let thisis = this
					thisis.loading = true
					$.ajax({
						url: url,
						type: 'post',
						data: {action: 'get-attachment', id: thisis.value},
						success: (res) => {
							if( res.success === true ) {
								thisis.attachment = res.data
							}
						},
						complete: (res) => {
							thisis.loading = false
							this.is_done = true
						}
					})
				}
			},
			getClass() {
				if( this.field.type == 'text_small' ) {
					return 'wpcm-field-input wpcm-col-lg-4 wpcm-col-md-12 wpcm-col-sm-12'
				} else {
					return 'wpcm-field-input wpcm-col-lg-8 wpcm-col-md-12 wpcm-col-sm-12'
				}
			},
			addMedia(event) {

				let thisis = this
                var button = $(event.target);
                var id = button.prev();
                wp.media.editor.send.attachment = (props, attachment) => {
                    // thisis.fieldModel = attachment.id
                    thisis.attachment = attachment
					this.$emit('input', attachment.id)
					this.$emit('change', attachment.id)
                };
                wp.media.editor.open(button);
                return false;
			},
			btnText() {
				if( this.attachment.sizes ) {
					return this.update_text
				} else {
					return this.add_text
				}
			},
			remove() {
				this.$confirm('Are sure you want to delete the image. Continue?', 'Warning', {
			          confirmButtonText: 'OK',
			          cancelButtonText: 'Cancel',
			          type: 'warning'
			        }).then(() => {
			          	this.attachment = {}
						this.$emit('input', 0)
						this.$emit('change', 0)
			        }).catch((error) => {
			        	console.log(error)
			        });
			}
		}
	}
</script>

<style lang="scss">
.wpcm-wrapper .wpcm-media-wrapper {
	.image {
		position: relative;
		display: inline-block;
	}
	.remove-media {
		border-radius: 20px;
	    background-color: #f4465b;
	    border: 1px solid #f4465b;
	    color: #fff;
	    position: absolute;
	    right: 5px;
	    width: 20px;
	    height: 20px;
	    text-align: center;
	    top: 5px;
	    line-height: 15px;
	}
}
</style>