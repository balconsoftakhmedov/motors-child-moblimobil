<?php 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$stm_points_plans_title = '';
if ( isset( $atts['stm_points_plans_title'] ) && ! empty( $atts['stm_points_plans_title'] ) ) {
	$stm_points_plans_title = $atts['stm_points_plans_title'];
}
wp_enqueue_style( 'account-point', get_stylesheet_directory_uri().'/assets/css/account_point.css', array(), time(), 'all' );
$custom_point_btn_text = stm_me_get_wpcfto_mod( 'custom_point_btn_text', 'Buy' );
$custom_point_btn = stm_me_get_wpcfto_mod( 'custom_point_btn' );

$login_page = stm_me_get_wpcfto_mod( 'login_page', 1718 );
$login_page = stm_motors_wpml_is_page( $login_page );


$args = array(
  'post_type'   => 'product',
  'posts_per_page' => -1
);
//Get all products
$all_products = get_posts( $args );
?>
<style type="text/css">
	.entry-header.left.small_title_box{
		display: none;
	}
</style>
<div class="container" id="stm_account_custom_points">
	<?php if ( ! empty( $stm_points_plans_title ) ) : ?>
		<div class="row">
			<div class="col-sm-12">
				<h3><?php echo $stm_points_plans_title; ?></h3>
			</div>
		</div>
	<?php endif; ?>
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
					<div class="col-sm-3">
						<div class="panel panel-default">
						  	<div class="panel-heading" style="text-align: center;"><?php echo $product->post_title; ?></div>
						  	<div class="panel-body">
						    	<h3 class="point-price" style="text-align: center;"><?php echo woocommerce_price( $product_price ); ?></h3>
						    	<ul class="list-group point-list-group">
							  	<li class="list-group-item"><?php echo sprintf( __( 'Points: %d' ), $product_point_amount ); ?></li>
								</ul>
								<?php if ( is_user_logged_in() ) : ?>
									<a href="/?add-to-cart=<?php echo $product->ID; ?>&quantity=1" class="btn btn-primary btn-block">
								<?php else : ?>
									<a href="<?php echo esc_url( get_permalink( $login_page ) ); ?>" class="btn btn-primary btn-block">
								<?php endif; ?>	
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
