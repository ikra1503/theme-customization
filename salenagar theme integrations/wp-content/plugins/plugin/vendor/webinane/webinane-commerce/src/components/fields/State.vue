<template>
	
	<el-select 
	  placeholder="Select Country" 
	  remote 
	  :remote-method="getItems"
	  filterable 
	  v-bind="$attrs" 
	  v-model="address.country"
	  class="wpcm-form-inputt" 
	  @change="onChange" 
	  :loading="loading" 
	  size="large" 
	  loading-text="Loading...">
		<template v-if="items" >
			<el-option v-for="(value) in items" :value="value.value" :key="value.value" :label="value.label"></el-option>
		</template>
	</el-select>

</template>


<script>
	import {dep_visibility} from '../../mixins.js'

	export default {
		mixins: [dep_visibility],
		props: {
			/*id: {
				type: String,
				required: true,
				default: 'base_country'
			}*/
		},
		data() {
			return {
				address: {
					country: '',
					city: '',
					state: ''
				},
				items: [],
				loading: false
			}
		},
		computed: {
			
		},
		watch: {
			
		},
		mounted() {
			
			this.address = (this.$attrs.value) ? $this.attrs.value : {}
			this.getItems()
			
		},
		methods: {
			onChange(event) {
				this.$emit('input', this.address)
				// this.$emit('country_field_change', this.field.id, String(this.value))
			},
			getItems() {
				let $ = jQuery
				let thisis = this
				this.loading = true
				$.ajax({
					url: 'https://raw.githubusercontent.com/wowthemes/countries/master/src/data/countries/default/_countries.json',
					type: 'get',
					dataType: "json",
					success: (res) => {

						this.items = []
						_.each(res, (value, key) => {
							this.items.push({
								value: key,
								label: value
							})
						})
					},
					complete: (res) => {
						this.loading = false
					}
				})
			}

		}
	}
</script>