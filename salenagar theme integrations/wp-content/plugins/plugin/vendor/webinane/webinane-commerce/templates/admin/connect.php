<?php

use WebinaneCommerce\Helpers\Api;

if(isset($_GET['access_token']) && ($access_token = sanitize_text_field($_GET['access_token']))) {
	Api::update_token_options([
		'access_token' => $access_token,
		'token_type'	=> 'Bearer',
		'expires_in'	=> sanitize_text_field( $_GET['expires_in'] ),
		'refresh_token'	=> sanitize_text_field( $_GET['refresh_token'] ),
	]);

	?>
	<script>
		window.location = "<?php echo admin_url('admin.php?page=wp-commerce-extensions') ?>";
	</script>
	<?php
}

$connect = Api::get_storage();

$expires = array_get($connect, 'expires_in');
$expires = absint($expires) ? absint($expires) + time() : 0;

$token = array_get($connect, 'access_token');
$plugins = array_keys(get_plugins());
$active_plugs = array_values(get_option('active_plugins'));
$return_url = urlencode(admin_url('admin.php?page=wp-commerce-extensions'));
$connect_url = add_query_arg(['return_uri' => $return_url], Api::$api_server . '/connect/redirect');
?>
<h3 class="hndle" style="display: none;"><?php esc_html_e('Connect', 'lifeline-donation-pro') ?></h3>


<div id="wpcm-admin-live-connect">
	<?php //if($token && $expires > time() ) : ?>
		<connect
		inline-template
		nonce="<?php echo wp_create_nonce( WPCM_AJAX_ACTION ) ?>"
		:active_plugins='<?php echo json_encode($active_plugs) ?>'
		:inst_plugins='<?php echo json_encode($plugins) ?>'
		:is_active="true">
			<div>
				<?php if($token && $expires > time() ) : ?>
					<el-button @click="login_out()" :loading="loading" type="danger"><?php esc_html_e('Disconnect', 'lifeline-donation-pro'); ?></el-button>
				<?php else: ?>
					<a href="<?php echo esc_url( $connect_url ) ?>" class="el-button el-button--primary" target="_blank">Connect</a>
				<?php endif; ?>
				<div class="clearfix"></div>
				<div v-show="loaded" style="display: none; max-width: 95%;">
					<div class="extensions-head" style="width: 100%;display: block;position: relative;">
						<h3 style="margin-bottom: 30px;"><?php esc_html_e('Our Extensions', 'lifeline-donation-pro') ?></h3>
					</div>

					<el-row :gutter="30" v-loading="loading">
						<el-col :span="6" v-for="item in items" :style="{marginBottom: '30px'}">
							<el-card :body-style="{ padding: '0px' }">
							<img :src="item.thumb" class="image">
							<div style="padding: 14px;">
								<h4>{{ item.title }}</h4>
								<div class="bottom clearfix">
								<span class="price">$ {{ item.price }}</span>
								
								<a v-if="is_purchased(item.wp_slug) && !is_installed(item.wp_slug) " :href="item.url" target="_blank" class="button " @click.prevent="installPlugin(item)">
									<?php esc_html_e('Install', 'lifeline-donation-pro') ?>
								</a>
								<a v-else-if="is_installed(item.wp_slug) && !plugin_active(item.wp_slug)" :href="item.url" target="_blank" class="button" @click.prevent="activatePlugin(item)">
									<?php esc_html_e('Activate', 'lifeline-donation-pro') ?>
								</a>
								<a v-else-if="!is_purchased(item.wp_slug) && !is_installed(item.wp_slug) " :href="item.url" target="_blank" class="button">
									<?php esc_html_e('Buy Now', 'lifeline-donation-pro') ?>
								</a>

								</div>
							</div>
							</el-card>
						</el-col>
					</el-row>
				</div>
			</div>
		</connect>
	<?php //endif; ?>
</div>
