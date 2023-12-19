<?php 
// wp_enqueue_style( 'account-point', get_stylesheet_directory_uri().'/assets/css/account_point.css', array(), time(), 'all' );
$stm_enable_point_feature = stm_me_get_wpcfto_mod( 'stm_enable_point_feature', false );
$custom_point_btn_text = stm_me_get_wpcfto_mod( 'custom_point_btn_text', 'Buy' );
$custom_point_btn = stm_me_get_wpcfto_mod( 'custom_point_btn' );
$args = array(
  'post_type'   => 'product',
  'posts_per_page' => -1
);
//Get all products
$all_products = get_posts( $args );
$current_user_id = get_current_user_id();
$user_point_amount = get_user_meta( $current_user_id, 'custom_point_amount', true );
if ( empty( $user_point_amount ) ) {
	$user_point_amount = 0;
}
$user_point_expired_date = get_user_meta( $current_user_id, 'custom_point_expire_date', true );
$check_user_expire_date = stm_check_user_custom_points_expire_data();
$show_point_data = false;
if ( ! empty( $user_point_expired_date ) ) {
	$show_point_data = true;
	if ( $check_user_expire_date ) {
		$user_point_expired_date = date( 'j F, Y, g:i a', strtotime( $user_point_expired_date ) );
	} else {
		$user_point_expired_date = esc_html__( 'Expire date is over!', 'motors-child' );
	}
}
?>
<?php if ( $stm_enable_point_feature ) : ?>
	<div class="container" id="stm_account_custom_points">
		<div class="row">
			<div class="col-sm-12">
				<h3><?php esc_html_e( 'Point amount', 'motors-child' ); ?></h3>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<?php if ( $show_point_data ) : ?>
					<ul class="list-group points-data">
					  <li class="list-group-item">
					  	<?php 
					  		echo sprintf( esc_html( '%s : %s' ), '<strong>' . esc_html__( 'Point amount', 'motors-child' ) . '</strong>', '<span>' . $user_point_amount . '</span>' );
					  	?>
					  </li>
					  <li class="list-group-item"><strong><?php esc_html_e( 'Expire date', 'motors-child' ); ?></strong>: <span><?php echo $user_point_expired_date; ?></span></li>
					</ul>
				<?php else : ?>	
					<div class="alert alert-danger" role="alert"><?php esc_html_e( 'You don\'t have any points', 'motors-child' ); ?></div>
				<?php endif; ?>
				<hr>
			</div>
		</div>
		<div class="row">
			<?php if ( ! empty( $all_products ) ) : ?>
				<?php foreach ( $all_products as $product ) : ?>
					<?php 
						$product_data = wc_get_product( $product->ID );
        		$product_type = $product_data->get_type();
        		$product_price = $product_data->get_price();
        		$product_point_amount = get_post_meta( $product->ID, '_point_amount', true );
					?>
					<?php if ( $product_type == 'custom_premium_listing' ) : ?>
						<div class="col-sm-4">
							<div class="panel panel-default">
							  	<div class="panel-heading" style="text-align: center;"><?php echo $product->post_title; ?></div>
							  	<div class="panel-body">
							    	<h3 class="point-price" style="text-align: center;"><?php echo woocommerce_price( $product_price ); ?></h3>
							    	<ul class="list-group point-list-group">
								  	<li class="list-group-item"><?php echo sprintf( __( 'Points: %d', 'motors-child' ), $product_point_amount ); ?></li>
									</ul>
									<a href="/?add-to-cart=<?php echo $product->ID; ?>&quantity=1" class="btn btn-primary btn-block">
										<?php if ( isset( $custom_point_btn['icon'] ) && ! empty( $custom_point_btn['icon'] ) ) : ?>
											<?php 
												$icon_styles = '';
												if ( isset( $custom_point_btn['color'] ) && ! empty( $custom_point_btn['color'] ) ) {
													$icon_styles = 'color:'.$custom_point_btn['color'].';';
												}
												if ( isset( $custom_point_btn['size'] ) && ! empty( $custom_point_btn['size'] ) ) {
													$icon_styles .= 'font-size:'.$custom_point_btn['size'].'px;';
												}
											?>
											<i class="<?php echo esc_attr( $custom_point_btn['icon'] ); ?>" style="<?php echo $icon_styles; ?>"></i>
										<?php endif; ?>
										<?php echo $custom_point_btn_text; ?></a>
							  	</div>
							</div>
						</div>
					<?php endif; ?>	
				<?php endforeach; ?>	
			<?php endif; ?>	
		</div>
	</div>
<?php endif; ?>