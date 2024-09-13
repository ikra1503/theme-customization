<template>
	<div>
		<!-- Dashboard Options List -->
		<ul class="wpcm-tabs-group">
			<li :class="(active == index ) ? 'active' : false" v-if="fields" v-for="(tab, index) in fields">
				<a data-toggle="tab" :href="'#'+tab.id" @click.prevent="changeTab(index)">
					<i v-if="tab.icon" :class="tab.icon"></i>
					<span>{{ tab.title }}</span>
				</a>
			</li>

			<li class="wpcm-settingbtn-list">
				<div class="wpcm-settings-btn">
					<a href="#" title="" @click.prevent="dialogFormVisible = true"><span>Import Setting</span><i class="fa fa-file-import "></i></a>
					<a href="#" title="" @click.prevent="exportSettings">
						<span>Export Setting</span>
						<i class="fa fa-file-export" v-if="!loading && loading_name !== 'export'"></i>
						<i class="fa fa-refresh fa-spin" style="display:inline-block;" v-if="loading && loading_name == 'export'"></i>
					</a>
				</div>
			</li>
		</ul>

		<el-dialog title="Import Settings" :visible.sync="dialogFormVisible">
			<el-form :model="form" label-position="top" v-loading="loading">
				
				<el-form-item label="Settings" :label-width="formLabelWidth">
					<el-input type="textarea" v-model="form.settings_text" placeholder="Please paste the json data" rows="5"></el-input>
				</el-form-item>
			</el-form>
			<span slot="footer" class="dialog-footer">
				<el-button @click="dialogFormVisible = false">Cancel</el-button>
				<el-button type="primary" @click="importSettings">Import</el-button>
			</span>
		</el-dialog>
	</div>
</template>

<script>
	export default {
		props: {
			fields: Array,
			active: Number
		},
		data() {
			return {
				loading: false,
				loading_name: '',
				form: {
					settings_text: '',
				},
				dialogFormVisible: false,
				formLabelWidth: '120px'
			}
		},
		methods: {
			changeTab(index) {
				this.$emit('active', index)
			},
			exportSettings() {
				this.loading = true
				this.loading_name = 'export'
				let $ = jQuery

				$.ajax({
					url: ajaxurl,
					type: 'post',
					//content_type: "application/json",
					data: {action: '_wpcommerce_admin_settings', subaction: 'export_settings', nonce: wpApiSettings.nonce},
					success: (response, status, xhr) => {
						this.loading = false

						// check for a filename
				        var filename = "";
				        var disposition = xhr.getResponseHeader('Content-Disposition');
				        if (disposition && disposition.indexOf('attachment') !== -1) {
				            var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
				            var matches = filenameRegex.exec(disposition);
				            if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
				        }

				        var type = xhr.getResponseHeader('Content-Type');
				        var blob = new Blob([response], { type: type });

				        if (typeof window.navigator.msSaveBlob !== 'undefined') {
				            // IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
				            window.navigator.msSaveBlob(blob, filename);
				        } else {
				            var URL = window.URL || window.webkitURL;
				            var downloadUrl = URL.createObjectURL(blob);

				            if (filename) {
				                // use HTML5 a[download] attribute to specify filename
				                var a = document.createElement("a");
				                // safari doesn't support this yet
				                if (typeof a.download === 'undefined') {
				                    window.location = downloadUrl;
				                } else {
				                    a.href = downloadUrl;
				                    a.download = filename;
				                    document.body.appendChild(a);
				                    a.click();
				                }
				            } else {
				                window.location = downloadUrl;
				            }

				            setTimeout(function () { URL.revokeObjectURL(downloadUrl); }, 100); // cleanup
				        }
					},
					error: (res) => {
						this.loading = false
						this.$notify.error({
	                        title: 'Error',
	                        message: res.statusText,
	                        offset: 30
	                    });

					}
				});
			},
			importSettings() {
				let $ = jQuery

				this.$confirm('This will permanently overwite all settings. Continue?', 'Warning', {
					confirmButtonText: 'OK',
					cancelButtonText: 'Cancel',
					type: 'warning'
				}).then(() => {

					this.loading = true
					this.loading_name = 'export'
					let myjson = {};

					try {
						let myjson = JSON.parse(this.form.settings_text)
					} catch(e) {
						this.$notify({
							type: 'error',
	                        title: 'Error',
	                        message: 'Invalid json provided',
	                        offset: 30
	                    });
	                    return;
					}

					if( ! myjson ) {
						this.$notify({
							type: 'error',
	                        title: 'Error',
	                        message: 'Please provide a valid json data',
	                        offset: 30
	                    });
	                    return;
					}

					$.ajax({
						url: ajaxurl,
						type: 'post',
						data: {action: '_wpcommerce_admin_settings', subaction: 'import_settings', json: myjson, nonce: wpApiSettings.nonce },
						success: (response, status, xhr) => {
							this.loading = false
							let type = (response.success == false) ? 'error' : 'success';
							this.$notify({
								type: type,
		                        title: type,
		                        message: response.data,
		                        offset: 30
		                    });
		                    if( response.success ) {
			                    this.dialogFormVisible = false // Close the dialog on success.
			                    window.location = window.location // Reload the page so new imported data should be reflected.
		                    }
						},
						error: (response) => {
							this.loading = false
							this.$notify.error({
		                        title: 'Error',
		                        message: response.statusText,
		                        offset: 30
		                    });
						}

					})
				}).catch(() => {
					this.$message({
						type: 'info',
						message: 'canceled'
					});          
				});
			}
		}
	}
</script>