<template>
	<div v-loading="loading" class="wpcm-container mb-4 table-boxes">
		<el-row :gutter="30">
			<el-col :span="12" v-for="(item, key) in items" :key="key">
				<el-card :header="item.title">
					<template v-slot:header>
						<el-input v-model="search_box[key]" @blur="setValue" @clear="query = '';getData()" class="mb-4" :placeholder="item.placeholder" clearable :disabled="loading">
							<el-button slot="append" @click="type = item.id;getData()" icon="el-icon-search"></el-button>
						</el-input>
						{{ item.title }}
					</template>
					<el-table :data="item.data">
						<el-table-column
						  v-for="(col, index) in item.cols"
						  :key="index"
						  :label="col.label"
						  :prop="col.prop"
						  :width="col.width"
						>
							<template slot-scope="scope">
								<span v-html="scope.row[col.prop]"></span>
							</template>
						</el-table-column>
					</el-table>
				</el-card>
			</el-col>
			
		</el-row>
	</div>
</template>

<script>
export default {
	props: {
		start_date: String,
		end_date: String
	},
	data() {
		return {
			items: [],
			loading: false,
			query: '',
			search_box: {},
			type: ''
		}
	},
	mounted() {
		// this.getData() 
	},
	methods: {
		getData() {
			this.loading = true
			let $ = jQuery

			$.ajax({
				url: ajaxurl,
				// type: 'post',
				data: {
					action: 'webinane_commerce_dashboard_chart', 
					type: 'table',
					nonce: wpcm_data.nonce,
					start_date: this.start_date,
					end_date: this.end_date,
					query: this.query,
					id: this.type
				},
				success: (res) => {
					this.items = res.data
				},
				fail: (error) => {
					this.$notify({type: 'error', offset: 40, message: error})
				},
				complete: (res) => {
					this.loading = false
				}
			})
		},
		setValue(value) {
			this.query = value.target.value
		}
	}
}
</script>