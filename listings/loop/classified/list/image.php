<?php
$gallery_hover_interaction = stm_me_get_wpcfto_mod( 'gallery_hover_interaction', false );
$show_compare              = stm_me_get_wpcfto_mod( 'show_listing_compare', false );
$show_favorite             = stm_me_get_wpcfto_mod( 'enable_favorite_items', false );
$car_media                 = stm_get_car_medias( get_the_id() );

if ( stm_is_dealer_two() || stm_is_aircrafts() ) {
	$show_favorite = false;
}

$dynamic_class_photo = 'stm-car-photos-' . get_the_id() . '-' . wp_rand( 1, 99999 );
$dynamic_class_video = 'stm-car-videos-' . get_the_id() . '-' . wp_rand( 1, 99999 );

//Custom boosted listing badge
$enable_point_feature = stm_me_get_wpcfto_mod( 'stm_enable_point_feature', false );
$show_badge = stm_me_get_wpcfto_mod( 'custom_show_boosted_badge', false );
$badge_text = stm_me_get_wpcfto_mod( 'custom_boosted_listing_badge_text', '' );
$badge_text_size = stm_me_get_wpcfto_mod( 'custom_boosted_listing_badge_text_size', '' );
$badge_background_color = stm_me_get_wpcfto_mod( 'custom_boosted_listing_badge_text_background', '' );
$badge_background_color_on_hover = stm_me_get_wpcfto_mod( 'custom_boosted_listing_badge_text_hover_background', '' );
$badge_text_color_on_hover = stm_me_get_wpcfto_mod( 'custom_boosted_listing_badge_text_hover_color', '' );
$badge_text_color = stm_me_get_wpcfto_mod( 'custom_boosted_listing_badge_text_color', '' );
$badge_font_weight = stm_me_get_wpcfto_mod( 'custom_boosted_listing_badge_font', '' );
//Check boosted time
date_default_timezone_set( wp_timezone_string() );
$listing_boosted_time = get_post_meta( get_the_id(), 'stm_boosted_listing_date', true );
$show_boosted_badge = false;
if ( ! empty( $listing_boosted_time ) ) {
	$show_boosted_badge = true;
	// $changed_listing_boosted_time = date( 'd.m.Y h:i:s', strtotime( '+1 day', $listing_boosted_time ) );

	// echo 
	// $current_date_time = date( 'd.m.Y h:i:s', time() );
	// if ( strtotime( $changed_listing_boosted_time ) > strtotime( $current_date_time ) ) {
	// 	$show_boosted_badge = true;
	// }
}

?>
<?php if ( $show_boosted_badge && $enable_point_feature && $show_badge ) : ?>
	<style type="text/css">
		.boosted_listing_badge {
			<?php if ( ! empty( $badge_background_color ) ) : ?>
				background-color: <?php echo $badge_background_color; ?>!important;
			<?php endif; ?>
		}
		<?php if ( ! empty( $badge_background_color_on_hover ) ) : ?>
			.boosted_listing_badge:hover {
				background-color: <?php echo $badge_background_color_on_hover; ?>!important;;
			}
		<?php endif; ?>
		<?php if ( ! empty( $badge_text_color_on_hover ) ) : ?>
			.boosted_listing_badge:hover span {
				color: <?php echo $badge_text_color_on_hover; ?>!important;;
			}
		<?php endif; ?>	
		.boosted_listing_badge span{
			<?php if ( ! empty( $badge_text_color ) ) : ?>
				color: <?php echo $badge_text_color; ?>;
			<?php endif; ?>
			<?php if ( ! empty( $badge_text_size ) && $badge_text_size > 0 ) : ?>
				font-size: <?php echo $badge_text_size; ?>px;
			<?php endif; ?>
			<?php if ( ! empty( $badge_font_weight ) ) : ?>
				font-weight: <?php echo $badge_font_weight; ?>;
			<?php endif; ?>
		}	
	</style>
<?php endif; ?>	

<div class="image">
	<!---Media-->
	<div class="stm-car-medias">
		<?php if ( $show_boosted_badge && $enable_point_feature && $show_badge ) : ?>
			<div class="stm-listing-photos-unit boosted_listing_badge">
				<span><?php echo $badge_text; ?></span>
			</div>
		<?php endif; ?>
		<?php if ( ! empty( $car_media['car_photos_count'] ) ) : ?>
			<div class="stm-listing-photos-unit stm-car-photos-<?php echo esc_attr( get_the_ID() ); ?> <?php echo esc_attr( $dynamic_class_photo ); ?>">
				<i class="stm-service-icon-photo"></i>
				<span><?php echo esc_html( $car_media['car_photos_count'] ); ?></span>
			</div>

			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery(".<?php echo esc_attr( $dynamic_class_photo ); ?>").on('click', function() {
						jQuery(this).lightGallery({
							dynamic: true,
							dynamicEl: [
								<?php foreach ( $car_media['car_photos'] as $car_photo ) : ?>
								{
									src  : "<?php echo esc_url( $car_photo ); ?>",
									thumb: "<?php echo esc_url( $car_photo ); ?>"
								},
								<?php endforeach; ?>
							],
							download: false,
							mode: 'lg-fade',
						})
					});
				});

			</script>
		<?php endif; ?>
		<?php if ( ! empty( $car_media['car_videos_count'] ) ) : ?>
			<div class="stm-listing-videos-unit stm-car-videos-<?php echo get_the_ID(); ?> <?php echo esc_attr( $dynamic_class_video ); ?>">
				<i class="fas fa-film"></i>
				<span><?php echo esc_html( $car_media['car_videos_count'] ); ?></span>
			</div>

			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery(".<?php echo esc_attr( $dynamic_class_video ); ?>").on('click', function() {

						jQuery(this).lightGallery({
							selector: 'this',
							dynamic: true,
							dynamicEl: [
								<?php foreach ( $car_media['car_videos'] as $car_video ) : ?>
								{
									src : "<?php echo esc_url( $car_video ); ?>",
									thumb: ''
								},
								<?php endforeach; ?>
							],
							download: false,
							mode: 'lg-video',
						})
					}); //click
				}); //ready

			</script>
		<?php endif; ?>
	</div>

	<!--Favorite-->
	<?php if ( ! empty( $show_favorite ) && $show_favorite ) : ?>
		<div
			class="stm-listing-favorite"
			data-id="<?php echo esc_attr( get_the_ID() ); ?>"
			data-toggle="tooltip" data-placement="right" title="<?php esc_attr_e( 'Add to favorites', 'motors' ); ?>">
			<i class="stm-service-icon-staricon"></i>
		</div>
	<?php endif; ?>

    <button
            class="stm-motors-report-listing"
            data-id="<?php echo esc_attr( get_the_ID() ); ?>"
            data-title="<?php echo esc_attr( get_the_title() ); ?>"
            data-toggle="modal"
            data-target="#stm-motors-report-listing"
            title="<?php esc_attr_e('Send report', 'motors-child'); ?>"
    >
        <svg width="22px" height="22px" viewBox="0 0 56 56" xmlns="http://www.w3.org/2000/svg">
            <path d="M 27.9999 51.9063 C 41.0546 51.9063 51.9063 41.0781 51.9063 28 C 51.9063 14.9453 41.0312 4.0937 27.9765 4.0937 C 14.8983 4.0937 4.0937 14.9453 4.0937 28 C 4.0937 41.0781 14.9218 51.9063 27.9999 51.9063 Z M 27.9999 47.9219 C 16.9374 47.9219 8.1014 39.0625 8.1014 28 C 8.1014 16.9609 16.9140 8.0781 27.9765 8.0781 C 39.0155 8.0781 47.8983 16.9609 47.9219 28 C 47.9454 39.0625 39.0390 47.9219 27.9999 47.9219 Z M 27.9765 32.2422 C 29.1014 32.2422 29.7343 31.6094 29.7577 30.3906 L 30.1093 18.0156 C 30.1327 16.8203 29.1952 15.9297 27.9530 15.9297 C 26.6874 15.9297 25.7968 16.7968 25.8202 17.9922 L 26.1249 30.3906 C 26.1483 31.5859 26.8046 32.2422 27.9765 32.2422 Z M 27.9765 39.8594 C 29.3124 39.8594 30.5077 38.7812 30.5077 37.4219 C 30.5077 36.0390 29.3358 34.9844 27.9765 34.9844 C 26.5936 34.9844 25.4452 36.0625 25.4452 37.4219 C 25.4452 38.7578 26.6171 39.8594 27.9765 39.8594 Z"/>
        </svg>
    </button>

	<a href="<?php the_permalink(); ?>" class="rmv_txt_drctn">
		<div class="image-inner interactive-hoverable">
			<?php get_template_part( 'partials/listing-cars/listing-directory', 'badges' ); ?>
			<?php
			if ( has_post_thumbnail() ) :
				$img_size   = ( stm_is_dealer_two() ) ? 'stm-img-275-205' : 'stm-img-280-165';
				$img_retina = ( stm_is_dealer_two() ) ? 'stm-img-275-205-x-2' : 'stm-img-280-165-x-2';
				$plchldr    = ( stm_is_dealer_two() ) ? 'plchldr-275.jpg' : 'plchldr350.png';
				$plchldr    = ( stm_is_aircrafts() ) ? 'ac_plchldr.jpg' : $plchldr;
				$img        = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $img_size );
				if ( ! empty( $img_retina ) ) {
					$img_x2 = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $img_retina );
				}

				if ( true === $gallery_hover_interaction && ! wp_is_mobile() ) {
					$thumbs = stm_get_hoverable_thumbs( get_the_ID(), $img_size );
					if ( empty( $thumbs['gallery'] ) || 1 === count( $thumbs['gallery'] ) ) :
						?>
						<img data-src="<?php echo esc_url( ! empty( $img[0] ) ? $img[0] : get_stylesheet_directory_uri() . '/assets/images/' . $plchldr ); ?>"
							<?php if ( ! empty( $img_retina ) ) : ?>
								srcset="<?php echo esc_url( ! empty( $img[0] ) ? $img[0] : get_stylesheet_directory_uri() . '/assets/images/' . $plchldr ); ?> 1x, <?php echo esc_url( ! empty( $img_x2[0] ) ? $img_x2[0] : get_stylesheet_directory_uri() . '/assets/images/' . $plchldr ); ?> 2x"
							<?php endif; ?>
							src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/' . $plchldr ); ?>"
							class="lazy img-responsive"
							alt="<?php the_title(); ?>"
						/>
						<?php
					else :
						$array_keys    = array_keys( $thumbs['gallery'] );
						$last_item_key = array_pop( $array_keys );
						?>
						<div class="hoverable-wrap">
							<?php foreach ( $thumbs['gallery'] as $key => $img_url ) : ?>
								<div class="hoverable-unit <?php echo ( 0 === $key ) ? 'active' : ''; ?>">
									<div class="thumb">
										<?php if ( $key === $last_item_key && 5 === count( $thumbs['gallery'] ) && 0 < $thumbs['remaining'] ) : ?>
											<div class="remaining">
												<i class="stm-icon-album"></i>
												<p>
													<?php
														echo esc_html(
															sprintf(
																/* translators: number of remaining photos */
																_n( '%d more photo', '%d more photos', $thumbs['remaining'], 'motors' ),
																$thumbs['remaining']
															)
														);
													?>
												</p>
											</div>
										<?php endif; ?>
										<?php if ( is_array( $img_url ) ) : ?>
											<img
													data-src="<?php echo esc_url( $img_url[0] ); ?>"
													srcset="<?php echo esc_url( $img_url[0] ); ?> 1x, <?php echo esc_url( $img_url[1] ); ?> 2x"
													src="<?php echo esc_url( $img_url[0] ); ?>"
													class="lazy img-responsive"
													alt="<?php echo esc_attr( get_the_title( get_the_ID() ) ); ?>" >
										<?php else : ?>
											<img src="<?php echo esc_url( $img_url ); ?>" class="lazy img-responsive" alt="<?php echo esc_attr( get_the_title( get_the_ID() ) ); ?>" >
										<?php endif; ?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="hoverable-indicators">
							<?php
							$first = true;
							foreach ( $thumbs['gallery'] as $thumb ) :
								?>
								<div class="indicator <?php echo ( $first ) ? 'active' : ''; ?>"></div>
								<?php
								$first = false;
							endforeach;
							?>
						</div>
						<?php
					endif;
				} else {
					?>
					<img data-src="<?php echo esc_url( ! empty( $img[0] ) ? $img[0] : get_stylesheet_directory_uri() . '/assets/images/' . $plchldr ); ?>"
						<?php if ( ! empty( $img_retina ) ) : ?>
							srcset="<?php echo esc_url( ! empty( $img[0] ) ? $img[0] : get_stylesheet_directory_uri() . '/assets/images/' . $plchldr ); ?> 1x, <?php echo esc_url( ! empty( $img_x2[0] ) ? $img_x2[0] : get_stylesheet_directory_uri() . '/assets/images/' . $plchldr ); ?> 2x"
						<?php endif; ?>
						src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/' . $plchldr ); ?>"
						class="lazy img-responsive"
						alt="<?php the_title(); ?>"
					/>
					<?php
				}
			else :
				$plchldr = ( stm_is_dealer_two() ) ? 'plchldr-275.jpg' : 'plchldr350.png';
				?>
				<img
					src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/' . $plchldr ); ?>"
					class="img-responsive"
					alt="<?php esc_attr_e( 'Placeholder', 'motors' ); ?>"
				/>
			<?php endif; ?>
		</div>
	</a>
</div>

<style>
    @media screen and (max-width: 768px) {
        .stm-listing-directory-list-loop .stm-motors-report-listing {
            bottom: 11px;
        }
    }
</style>
