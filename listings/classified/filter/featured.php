<?php
$args                   = stm_listings_query()->query;
$args['posts_per_page'] = 3;

if(is_listing()) {
	$args['meta_query'] = array(
		array(
			'key' => 'special_car',
			'value' => 'on',
			'compare' => '='
		)
	);
} else {
	$args['meta_query'][]   = array(
		'key'     => 'special_car',
		'value'   => 'on',
		'compare' => '='
	);
}

$args['orderby'] = 'rand';

$featured = new WP_Query( $args );

$view_type = stm_listings_input('view_type', stm_me_get_wpcfto_mod("listing_view_type", "list")); ?>

<?php if ( $featured->have_posts() ): ?>
	<div class="stm-featured-top-cars-title">
		<div class="heading-font"><?php esc_html_e( 'Featured Classified', 'motors' ); ?></div>
		<a href="<?php echo esc_url( get_the_permalink() . '?featured_top=true' ); ?>">
			<?php esc_html_e( 'Show all', 'motors' ); ?>
		</a>
	</div>

	<?php if(!stm_listings_input('featured_top')): ?>
		<?php if ( $view_type == 'grid' ): ?>
			<div class="row row-3 car-listing-row car-listing-modern-grid">
		<?php endif; ?>


			
		<?php if ( $view_type == 'grid' ): ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>