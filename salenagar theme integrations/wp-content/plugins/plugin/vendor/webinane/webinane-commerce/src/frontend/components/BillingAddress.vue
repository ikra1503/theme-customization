<template>
	<div>
		<slot></slot>
		
	</div>
</template>

<script>
	export default {
		props: {
			ship_diff: Boolean,
			billing_fields: Object
		},
		data() {
			return {
				
				errors: {

				}
			}
		},
		computed: {
			same_shipping: {
				get() {
					return this.ship_diff
				},
				set(value) {
					this.$emit('toggle_ship', value)
				}
			},
			test_field: {
				get() {
					return 'test'
				},
				set(value) {

				}
			}
		},
		methods: {
			changing(event) {
				//this.$emit('billing_fields', this.fields)
			}
		}
	}
</script>