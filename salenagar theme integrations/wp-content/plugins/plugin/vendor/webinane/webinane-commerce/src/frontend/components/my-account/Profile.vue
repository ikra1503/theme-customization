<template>
	<el-form>
		<div class="profile-form wpcm-tab-area" v-loading="loading">
			
			<template v-for="field in fields" >
				<template v-if="field.props">
					<div class="wpcm-tab-heading mb-4" v-if="field.props.heading">
						<h2>{{field.props.heading}}</h2>
					</div>
				</template>
				<el-row :gutter="30">
					<el-col :sm="24">
						<el-form-item :label="field.label" label-width="25%">
							<component :is="field.type" v-model="field.value" v-bind="field.props"></component>
						</el-form-item>
					</el-col>
				</el-row>
			</template>
			

		</div>
		<div class="wpcm-bottom-area">
			<button class="wpcm-btn" @click.prevent="save">{{$webinane_i18n.submit}}</button>
		</div>
	</el-form>
</template>

<script>
import Media from '../../../components/fields/Media.vue'
import Country from '../../../components/fields/Country.vue'
export default {
	name: 'myaccount-profile',
	components: {
		Media,
		Country
	},
	props: {
		fields: [Array]
	},
	data() {
		return {
			loading: false,
			options: {},
			dependencies: {}
		}
	},
	mounted() {
		this.getData();
		// this.toggle();
	},
	methods: {
		getData() {

			let $ = jQuery
			this.loading = true

			$.ajax({
				url: wpcm_data.ajaxurl,
				type: 'post',
				data: {action: wpcm_data.ajax_action, callback: ['WebinaneCommerce\\Classes\\MyAccount', 'user_data']},
				success: (res) => {
					this.options = res.options
				},
				complete: (res) => {
					this.loading = false
				},
			})
		},
		getFieldsValue() {
			let values = {}
			_.each(this.fields, (value, key) => {
				values[ value.id ] = value.value
			})
			
			return values
		},
		save() {
			let $ = jQuery
			this.loading = true

			let data = this.getFieldsValue()

			$.ajax({
				url: wpcm_data.ajaxurl,
				type: 'post',
				data: {action: wpcm_data.ajax_action, nonce: wpcm_data.nonce, options: data, callback: ['WebinaneCommerce\\Classes\\MyAccount', 'save_profile']},
				success: (res) => {
					if( res.success == true ) {
						this.$notify.success({
							title: 'Success',
							message: res.data.message,
							offset: 80
				        });
				        
					} else if( res.success == false ) {
				        this.$notify.error({
							title: 'Error',
							message: res.data.message,
							offset: 80
				        });
					}
				},
				complete: (res) => {
					this.loading = false
				},
				fail: (error) => {
					this.loading = false
			        this.$notify.error({
						title: 'Error',
						message: error.response.data.message,
						offset: 80
			        });
				}
			})
		},
		toggle() {
			// close and open tab
			$( '.wpcm-close-open' ).on( 'click', function(e){
			    e.preventDefault();
			    var el = $(this);
			    el.parent().toggleClass('wpcm-tab-gap').nextUntil('.wpcm-tab-heading,.el-loading-mask').slideToggle('slow','linear');
			});
		}
	}
}
</script>