<?php
    require_once 'inc/stm_enqueue_scripts.php';
    require_once 'inc/stm_theme_options_add_options.php';
    require_once 'inc/woocommerce_add_custom_product_type.php';
    require_once 'inc/stm_add_seller_point_navigation.php';
    require_once 'inc/stm_check_user_points.php';
    require_once 'inc/stm_boost_listing_by_points.php';
    require_once 'inc/stm_change_add_to_cart_btn_data.php';
    require_once 'inc/stm_register_custom_vc_shortcode.php';
    require_once 'inc/listing-views.php';

    require_once __DIR__ . '/inc/showing_modal_footer.php';

function flance_write_log( $message, $file = 'logs/logfile.log' ) {
	ob_start();
	print_r( $message );
	$message         = ob_get_clean();
	$theme_directory = get_stylesheet_directory();
	$log_file_path   = $theme_directory . '/' . $file;
	$log_directory   = dirname( $log_file_path );
	if ( ! file_exists( $log_directory ) ) {
		mkdir( $log_directory, 0755, true );
	}
	file_put_contents( $log_file_path, date( 'Y-m-d H:i:s' ) . ' ' . $message . "\n", LOCK_EX );
}