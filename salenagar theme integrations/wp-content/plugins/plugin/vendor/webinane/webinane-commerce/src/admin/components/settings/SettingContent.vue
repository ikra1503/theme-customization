<template>
	<div>
		<template v-if="fields && fields[active] !== undefined">
			<template v-for="field in fields[active].fields">
				<div class="wpcm-tab-heading" v-if="field.main_heading">
					<h2>{{field.main_heading}}</h2>
				</div>
				<component :is="field.is" :field="field" :options="options" :dependencies="$parent.dependencies" v-on:depedency_event_change="$parent.depedency_event_change"></component>
			</template>
		</template>
	</div>
</template>

<script>
	export default {
		props: {
			fields: Array,
			active: Number,
			options: Object
		},
		data() {
			return {
				//fields:[],
				values: [],
				
			}
		},
		
		mounted() {
			
		},
		methods: {
			
			depedency_event_change(id, value) {
				this.$parent.depedency_event_change(id, value)
			}
		}
	}
</script>
