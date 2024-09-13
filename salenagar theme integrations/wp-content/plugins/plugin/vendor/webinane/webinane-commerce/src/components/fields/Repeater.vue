<template>
	<div v-if="loaded">
		<div class="box" v-for="(val, index) in localValues">
			<div class="text-right">
				<a href="#"><i class="fa fa-close"></i></a>
			</div>
			<wpcm-fields :fields="fields" :values="{}" label-position="top"></wpcm-fields>
		</div>
		<el-button type="primary" @click="addNew()">Add New</el-button>
	</div>
</template>

<script>

export default {
	props: ['fields', 'values'],
	data() {
		return {
			loaded: false,
			localValues: []
		}
	},
	mounted() {
		if(typeof this.values !== 'array') {
			this.localValues = [this.values]
		}
		this.loaded = true
	}
}
</script>
<style scoped>
.box {
    border: 1px solid #ddd;
    padding: 30px;
    margin-bottom: 20px;
}
</style>