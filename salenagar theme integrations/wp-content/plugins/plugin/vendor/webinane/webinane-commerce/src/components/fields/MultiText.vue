<template>
	<div>
		<div v-for="(frss, index) in form" :key="index">
			<el-input v-model="form[index]" class="mb-2">
				<el-button 
					@click="handleAdd()"
					type="info" 
					size="mini" 
					icon="el-icon-plus" 
					slot="append"></el-button>
				<el-button 
					@click="handleRemove(index)"
					v-if="form.length > 1"
					type="danger" 
					size="mini" 
					icon="el-icon-close" 
					slot="append"></el-button>
			</el-input>
		</div>
	</div>
</template>

<script>
	export default {
		props: {
			value: {
				required: true,
				default: ['']
			}
		},
		data() {
			return {
				form: [''],
				isVisible: false,
				fieldSize: []
			}
		},
		watch: {
			form(value) {
				this.resolveValue(value)
			},
			value(value) {
			}
		},
		computed: {
		},
		mounted() {
			this.resolveValue(this.value)
		},
		methods: {
			handleAdd() {
				this.form.push('')
			},
			handleRemove(index) {
				let newform = _.reject(this.form, (value, ind) => {
					return index === ind
				})
				this.form = newform
			},
			resolveValue(value) {
				// console.log(value)
				if(_.isArray(value) && value.length) {
					this.form = value
				} else {
					this.form = ['.']
				}
				this.$emit('input', value)
				this.$emit('change', value)
			}
		}
	}
</script>