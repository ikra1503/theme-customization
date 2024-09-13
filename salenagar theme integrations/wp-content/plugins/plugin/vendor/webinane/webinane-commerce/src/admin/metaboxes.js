//import ElementUI from 'element-ui';
const ElementUI = window.ELEMENT

ElementUI.locale(window.ELEMENT.lang.en)
Vue.use(ElementUI);
import store from '../stores/metaboxes'
window.$ = jQuery

import Metaboxes from './metaboxes/Metaboxes.vue'

if(document.querySelector('.wpcm-metabox-wrapper') ) {

	const app = new Vue({
		store,
		el: '.wpcm-metabox-wrapper',
		components: {
			Metaboxes
		},
		data: {
			loading: false,
			result: false,
			result_type: 'error',
			result_msg: '',
			fields: [],
			options: {},
			meta_id: '',
			dependencies: {},
			dep_fields: {}
		},
		computed: {
		},
		mounted() {
			//let fields = this.$el.attributes.data.value
			// let meta_id = this.$el.attributes.meta_id.value
			//let options = this.$el.attributes.myoptions.value

			//this.fields = (fields !== undefined) ? JSON.parse(fields) : {}
			// this.meta_id = (meta_id !== undefined) ? String(meta_id) : ''
			//this.options = (options !== undefined) ? JSON.parse(options) : {}
			// this.getData()
			//this.setupData()
			// this.bindPostSubmit(this)
		},
		methods: {
			valueChange(name, value) {
				this.options[name] = value
			},
			onDone: function() {
				this.result = false
				this.result_type = '';
				this.result_msg = '';
			},
			setupData() {
				let thisis = this
				if( this.fields ) {
					_.each(this.fields, function(field){

						if( field.id !== undefined && thisis.options[field.id] === undefined ) {
							thisis.options[field.id] = '';
						}
						if( field.dependency !== undefined ) {
							thisis.dependencies[field.id] = field.dependency
						}
					})
					_.each(this.fields, function(field){
						if( field.dependency !== undefined ) {
							_.each(field.dependency, function(dep){
								thisis.depedency_event_change(dep.id, thisis.options[dep.id])
							})
						}
					})

				}
			},
			bindPostSubmit(thisis) {
				let element = document.getElementById('post')

				if( element ) {
					let callback = this.submit
					element.addEventListener('submit', callback )
				}

				if( wp !== undefined ) {
					wp.data.subscribe(() => {
					  if(wp.data.select('core/editor') !== undefined && wp.data.select('core/editor')) {
						  var isSavingPost = wp.data.select('core/editor').isSavingPost();
						  var isAutosavingPost = wp.data.select('core/editor').isAutosavingPost();

						  if (isSavingPost && !isAutosavingPost) {
						    thisis.submit();
						  }
					  }
					})
				}
			},
			submit(event) {
				let $ = jQuery
				let thisis = this
				let post_id = $('#post_ID').val()
				this.loading = true

				$.ajax({
					url: ajaxurl,
					type: 'post',
					data: {
						action:'_wpcommerce_admin_save_metabox', 
						meta_id: thisis.meta_id, 
						options: thisis.$store.state.values, fields: thisis.fields, post_id: post_id
          },
          success: function(res) {
            //thisis.fields = res.data
            //thisis.option_values = res.options
            //event.preventDefault()
          },
          complete: function(res) {
            thisis.loading = false
          }
				})
				//event.preventDefault()
			},
			getData() {
				let $ = jQuery
				let thisis = this
				let post_id = $('#post_ID').val()
				let action = this.$refs.metabox_action
				let type = this.$refs.metabox_object_type

				action = (action) ? action.value : '_wpcommerce_admin_metabox_data';
				type = (type) ? type.value : '';
				$.ajax({
					url: ajaxurl,
					type: 'post',
					data: {
						action, 
						metabox_id: thisis.meta_id, 
						post_id: post_id, 
						type
					},
					success: (res) => {
						thisis.fields = res.fields.fields
						// thisis.options = res.options
						this.options = (this._vnode.data.attrs.options) ? JSON.parse(this._vnode.data.attrs.options) : {}
            this.$store.commit('setValues', this.options);
						// thisis.setupData()
					}
				})
			},
			depedency_event_change(id, value) {
				let thisis = this

				_.each(this.dependencies, function(dep, key){
					_.each(dep, function(field){

						if( field.id == id ) {
							value = thisis.checkBool(value)
							field.value = thisis.checkBool(field.value)

							if( field.value == value ) {
								thisis.dep_fields[key] = true
							} else {
								thisis.dep_fields[key] = false
							}
						}
					})
				})
				$(document).trigger('webinane_depency_field_changed')
			},
			checkBool(value) {
				if( value === 'true' ) {
					return true
				} else if( value === 'false' ) {
					return false
				}

				return value
			}
		}

	});
}