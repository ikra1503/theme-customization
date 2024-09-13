<template>
	<transition name="fade">
		<div class="wpcm-media-wrapper">
			<input type="hidden" v-model="fieldModel">
			<div class="image" v-for="attach in attachment" v-if="attach.sizes">
				<a href="#" @click.prevent="remove(attach.id)" class="remove-media">x</a>
				<img :src="attach.sizes.thumbnail.url" :alt="attach.title">
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
			if(this.value ) {
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

				if( this.value ) {
					let $ = jQuery
					let thisis = this
					thisis.loading = true
					$.ajax({
						url: url,
						type: 'post',
						data: {action: 'get_custom_media_list', id: thisis.value},
						success: (res) => {
							if( res.success === true ) {
								thisis.attachment = res.data
								// exclude removed attachment id
								let list_ids = thisis.attachment;
								let real_list = [];
								for( let list_id of list_ids ) {
									real_list.push(list_id.id);
								}
								thisis.value = real_list.join(',');
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
                var meta_gallery_frame;
                
                // If the frame already exists, re-open it.
                if ( meta_gallery_frame ) {
                	meta_gallery_frame.open();
                	return;
                }

                // Sets up the media library frame
                meta_gallery_frame = wp.media.frames.meta_gallery_frame = wp.media({
                	title: 'custom gallery',
                	button: { text:  'insert gallery' },
                	library: { type: 'image' },
                	multiple: 'add'
                });

                // Sets up selected image
                meta_gallery_frame.on('open', function() {
                	var selection = meta_gallery_frame.state().get('selection');
                	var library = meta_gallery_frame.state('gallery-edit').get('library');
                	if ( thisis.value ) {
                		var ids = thisis.value.split(',');
                	} else {
                		var ids = thisis.value
                	}
                	if (ids) {
                		ids.forEach(function(id) {
                			let attachment = wp.media.attachment(id);
                			attachment.fetch();
                			selection.add( attachment ? [ attachment ] : [] );
                		});
                	}
                });

                // Sets up the media
                meta_gallery_frame.on('select', function() {
                	var imageIDArray = [];
                	var metadataString = '';
                	var images = meta_gallery_frame.state().get('selection');
                	images.each(function(attachment) {
                		imageIDArray.push(String( attachment.attributes.id ));
                	});
                	thisis.value = imageIDArray.join(','); 
                	thisis.$emit('input', thisis.value)
                	thisis.$emit('change', thisis.value)
                });

                // Finally, open the modal
                meta_gallery_frame.open(button);

                return false;
			},
			btnText() {
				if( Array.isArray(this.attachment) ) {
					return this.update_text
				} else {
					return this.add_text
				}
			},
			remove(id) {
				this.$confirm('Are sure you want to delete the image. Continue?', 'Warning', {
			          confirmButtonText: 'OK',
			          cancelButtonText: 'Cancel',
			          type: 'warning'
			        }).then(() => {
			          	id = String(id);
			          	let array = this.value
			          	array = array.split(',')
						let index = array.indexOf(id) 
			          	array.splice(index, 1)
			          	if ( array.length ) {
			          		this.value = array.join(',')
			          	} else {
			          		this.value = array.join(',')
			          		this.attachment = {}
			          	}
						this.$emit('input', this.value)
						this.$emit('change', this.value)
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