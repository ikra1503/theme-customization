<template>
	<div>
		<ul class="wpcm-tabs-group" v-if="$root.tabs">
			<li :class="getActive(index)" v-for="(tab, index) in $root.tabs">
				<a data-toggle="tab" :href="'#'+tab.id" aria-expanded="false" @click.prevent="active = index"><i :class="tab.icon"></i><span>{{ tab.title }}</span></a>
			</li>

		</ul>

		<div class="wpcm-tabs-main tab-content">
			<div class="wpcm-tab-content wpcm-personal-tab tab-pane fade show active in" v-if="activTab">
				<component :is="activTab.component" :fields="activTab.fields"></component>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		name: 'myacount-tabs',
		data() {
			return {
				active: 0,
			}
		},
		computed: {
			activTab: {
				get() {
					return this.$root.tabs[this.active]
				},
				set() {

					if( this.$root.tabs[this.active] !== undefined ) {
					}
				}
			}

		},
		mounted() {
			// this.active = 0
		},
		methods: {
			getActive(index) {
				return (index == this.active ) ? 'active' : '';
			},
		}
	}
</script>