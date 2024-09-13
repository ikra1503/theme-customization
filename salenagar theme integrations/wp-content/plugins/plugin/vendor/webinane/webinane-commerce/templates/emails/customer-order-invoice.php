<?php esc_html_e('Hello', 'lifeline-donation-pro' ); ?> <?php echo $customer_data->name ?>,<br>

<p><?php esc_html_e('Please find the attached invoice for the reference', 'lifeline-donation-pro'); ?> #<?php echo esc_attr( $order['ID'] ) ?></p>

<br>
<?php esc_html_e('Thanks', 'lifeline-donation-pro'); ?>, <br>
<?php bloginfo( 'name' ) ?>