<?php
$stock_number = get_post_meta( get_the_ID(), 'stock_number', true );
$car_brochure = get_post_meta( get_the_ID(), 'car_brochure', true );

$certified_logo_1 = get_post_meta( get_the_ID(), 'certified_logo_1', true );
$history_link_1   = get_post_meta( get_the_ID(), 'history_link', true );

$certified_logo_2      = get_post_meta( get_the_ID(), 'certified_logo_2', true );
$certified_logo_2_link = get_post_meta( get_the_ID(), 'certified_logo_2_link', true );

// Show car actions
$show_stock                           = stm_me_get_wpcfto_mod( 'show_listing_stock', false );
$show_test_drive                      = stm_me_get_wpcfto_mod( 'show_listing_test_drive', false );
$show_compare                         = stm_me_get_wpcfto_mod( 'show_listing_compare', false );
$show_share                           = stm_me_get_wpcfto_mod( 'show_listing_share', false );
$show_pdf                             = stm_me_get_wpcfto_mod( 'show_listing_pdf', false );
$show_certified_logo_1                = stm_me_get_wpcfto_mod( 'show_listing_certified_logo_1', false );
$show_certified_logo_2                = stm_me_get_wpcfto_mod( 'show_listing_certified_logo_2', false );
$listing_directory_enable_dealer_info = stm_me_get_wpcfto_mod( 'listing_directory_enable_dealer_info', false );
$stm_enable_point_feature = stm_me_get_wpcfto_mod( 'stm_enable_point_feature', false );
$custom_boost_btn_text = stm_me_get_wpcfto_mod( 'custom_boost_btn_text', 'Boost' );
$custom_boost_btn = stm_me_get_wpcfto_mod( 'custom_boost_btn' );
$stm_car_user = get_post_meta( get_the_ID(), 'stm_car_user', true );

?>

<div class="single-car-actions">
	<ul class="list-unstyled clearfix">

		<?php if ( is_listing( array( 'listing', 'listing_three', 'listing_five' ) ) ) : ?>
			<?php if ( ! empty( $listing_directory_enable_dealer_info ) and ! empty( $listing_directory_enable_dealer_info ) and $listing_directory_enable_dealer_info ) : ?>
				<?php get_template_part( 'partials/user/listing-list-user', 'info' ); ?>
			<?php endif; ?>
		<?php endif; ?>

		<!--Stock num-->
		<?php if ( ! empty( $stock_number ) and ! empty( $show_stock ) and $show_stock ) : ?>
			<li>
				<div class="stock-num heading-font"><span><?php esc_html_e( 'stock', 'motors' ); ?># </span><?php echo esc_attr( $stock_number ); ?></div>
			</li>
		<?php endif; ?>

		<!--Schedule-->
		<?php if ( $show_test_drive === true ) : ?>
			<li>
				<a href="#" class="car-action-unit stm-schedule" data-toggle="modal" data-target="#test-drive" onclick="stm_test_drive_car_title(<?php echo esc_js( get_the_ID() ); ?>, '<?php echo esc_js( get_the_title( get_the_ID() ) ); ?>')">
					<i class="stm-icon-steering_wheel"></i>
					<?php esc_html_e( 'Test Drive', 'motors' ); ?>
				</a>
			</li>
		<?php endif; ?>

		<!--Compare-->
		<?php if ( ! empty( $show_compare ) and $show_compare ) : ?>
			<li data-compare-id="<?php the_ID(); ?>">
				<a
					href="#" style="display: none"
					class="car-action-unit add-to-compare stm-added"
					data-id="<?php echo esc_attr( get_the_ID() ); ?>"
					data-post-type="<?php echo esc_attr( get_post_type( get_the_ID() ) ); ?>"
					data-action="remove">
					<i class="stm-icon-added stm-unhover"></i>
					<span class="stm-unhover"><?php esc_html_e( 'in compare list', 'motors' ); ?></span>
					<div class="stm-show-on-hover">
						<i class="stm-icon-remove"></i>
						<?php esc_html_e( 'Remove from list', 'motors' ); ?>
					</div>
				</a>
				<a
					href="#"
					class="car-action-unit add-to-compare"
					data-id="<?php echo esc_attr( get_the_ID() ); ?>"
					data-post-type="<?php echo get_post_type( get_the_ID() ); ?>"
					data-action="add">
					<i class="stm-icon-add"></i>
					<?php esc_html_e( 'Add to compare', 'motors' ); ?>
				</a>
			</li>
		<?php endif; ?>

		<!--PDF-->
		<?php if ( ! empty( $show_pdf ) and $show_pdf ) : ?>
			<?php if ( ! empty( $car_brochure ) ) : ?>
				<li>
					<a
						href="<?php echo esc_url( wp_get_attachment_url( $car_brochure ) ); ?>"
						class="car-action-unit stm-brochure"
						title="<?php esc_attr_e( 'Download brochure', 'motors' ); ?>"
						download>
						<i class="stm-icon-brochure"></i>
						<?php ( stm_is_listing_five() ) ? esc_html_e( 'PDF brochure', 'motors' ) : esc_html_e( 'Car brochure', 'motors' ); ?>
					</a>
				</li>
			<?php endif; ?>
		<?php endif; ?>

		<!--Share-->
		<?php if ( ! empty( $show_share ) && $show_share ) : ?>
			<li class="stm-shareble">
				<a href="#" class="car-action-unit stm-share">
					<i class="stm-icon-share"></i>
					<?php esc_html_e( 'Share this', 'motors' ); ?>
				</a>
				<?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) : ?>
				<div class="stm-a2a-popup">
					<?php echo stm_add_to_any_shortcode( get_the_ID() ); ?>
				</div>
				<?php endif; ?>
			</li>
		<?php endif; ?>

		<!--Certified Logo 1-->
		<?php if ( ! empty( $certified_logo_1 ) and ! empty( $show_certified_logo_1 ) and $show_certified_logo_1 ) : ?>
			<?php
			$certified_logo_1 = wp_get_attachment_image_src( $certified_logo_1, 'full' );
			if ( ! empty( $certified_logo_1[0] ) ) {
				$certified_logo_1 = $certified_logo_1[0];
				?>

				<li class="certified-logo-1">
					<?php if ( ! empty( $history_link_1 ) ) : ?>
						<a href="<?php echo esc_url( $history_link_1 ); ?>" target="_blank">
					<?php endif; ?>
						<img src="<?php echo esc_url( $certified_logo_1 ); ?>" alt="<?php esc_attr_e( 'Logo 1', 'motors' ); ?>"/>
					<?php if ( ! empty( $history_link_1 ) ) : ?>
						</a>
					<?php endif; ?>
				</li>



			<?php } ?>
		<?php endif; ?>

		<!--Certified Logo 2-->
		<?php if ( ! empty( $certified_logo_2 ) and ! empty( $show_certified_logo_2 ) and $show_certified_logo_2 ) : ?>
			<?php
			$certified_logo_2 = wp_get_attachment_image_src( $certified_logo_2, 'full' );
			if ( ! empty( $certified_logo_2[0] ) ) {
				$certified_logo_2 = $certified_logo_2[0];
				?>


				<li class="certified-logo-2">
					<?php if ( ! empty( $certified_logo_2_link ) ) : ?>
						<a href="<?php echo esc_url( $certified_logo_2_link ); ?>" target="_blank">
					<?php endif; ?>
						<img src="<?php echo esc_url( $certified_logo_2 ); ?>"  alt="<?php esc_attr_e( 'Logo 2', 'motors' ); ?>"/>
					<?php if ( ! empty( $certified_logo_2_link ) ) : ?>
						</a>
					<?php endif; ?>
				</li>

			<?php } ?>
		<?php endif; ?>
		<?php if ( $stm_enable_point_feature && (int)$stm_car_user > 0 && $stm_car_user == get_current_user_id() ) : ?>
			<li>
				<a href="#" class="car-action-unit stm-custom-boost-listing" data-listing-id="<?php echo esc_attr( get_the_ID() ); ?>">
					<?php if ( isset( $custom_boost_btn['icon'] ) && ! empty( $custom_boost_btn['icon'] ) ) : ?>
						<?php 
							$icon_styles = '';
							if ( isset( $custom_boost_btn['color'] ) && ! empty( $custom_boost_btn['color'] ) ) {
								$icon_styles = 'color:'.$custom_boost_btn['color'].';';
							}
							if ( isset( $custom_boost_btn['size'] ) && ! empty( $custom_boost_btn['size'] ) ) {
								$icon_styles .= 'font-size:'.$custom_boost_btn['size'].'px;';
							}
						?>
						<i class="<?php echo esc_attr( $custom_boost_btn['icon'] ); ?>" style="<?php echo $icon_styles; ?>"></i>
					<?php endif; ?>
					<?php echo $custom_boost_btn_text; ?></a>
				</a>
			</li>
		<?php endif; ?>	
	</ul>
</div>
