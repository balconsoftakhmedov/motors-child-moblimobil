<?php
$regular_price_label = get_post_meta(get_the_ID(), 'regular_price_label', true);
$special_price_label = get_post_meta(get_the_ID(),'special_price_label',true);

$price = get_post_meta(get_the_id(),'price',true);
$sale_price = get_post_meta(get_the_id(),'sale_price',true);

$car_price_form_label = get_post_meta(get_the_ID(), 'car_price_form_label', true);

$data = array(
    'data_price' => 0,
    'data_mileage' => 0,
);

if(!empty($price)) {
    $data['data_price'] = $price;
}

if(!empty($sale_price)) {
    $data['data_price'] = $sale_price;
}

if(empty($price) and !empty($sale_price)) {
    $price = $sale_price;
}

$mileage = get_post_meta(get_the_id(),'mileage',true);

if(!empty($mileage)) {
    $data['data_mileage'] = $mileage;
}
$enable_point_feature = stm_me_get_wpcfto_mod( 'stm_enable_point_feature', false );
$show_badge = stm_me_get_wpcfto_mod( 'custom_show_boosted_badge', false );
//Border style
$boosted_left_border_size = stm_me_get_wpcfto_mod( 'custom_boosted_listing_border_size', 5 );
$boosted_left_border_type = stm_me_get_wpcfto_mod( 'custom_boosted_listing_border_type', 'solid' );
$boosted_left_border_color = stm_me_get_wpcfto_mod( 'custom_boosted_listing_border_color', '#ffce32' );
$border_style = $boosted_left_border_size.'px'.' '.$boosted_left_border_type.' '.$boosted_left_border_color;
//Check boosted time
date_default_timezone_set( wp_timezone_string() );
$listing_boosted_time = get_post_meta( get_the_id(), 'stm_boosted_listing_date', true );
$boosted_border_class = '';
if ( ! empty( $listing_boosted_time ) && $enable_point_feature && $show_badge ) {
    $changed_listing_boosted_time = date( 'd.m.Y h:i:s', strtotime( '+1 day', $listing_boosted_time ) );
    $current_date_time = date( 'd.m.Y h:i:s', time() );
    if ( strtotime( $changed_listing_boosted_time ) > strtotime( $current_date_time ) ) {
        $boosted_border_class = 'active';
    }
}

?>

<?php stm_listings_load_template('loop/classified/grid/start', $data); ?>

        <?php stm_listings_load_template('loop/classified/grid/image', $data); ?>

		<div class="listing-car-item-meta <?php echo esc_attr( $boosted_border_class ); ?>">
            <?php stm_listings_load_template('loop/default/grid/title_price', array('price' => $price, 'sale_price' => $sale_price, 'car_price_form_label' => $car_price_form_label)); ?>

            <?php
                if ( function_exists( 'stm_multilisting_load_template' ) ) {
                    stm_multilisting_load_template('templates/grid-listing-data');
                } else {
                    stm_listings_load_template('loop/classified/grid/data');
                }
            ?>

		</div>
	</a>
</div>
<style type="text/css">
    .car-listing-row .listing-car-item-meta.active {
        border-left: <?php echo esc_attr( $border_style ); ?>;
        margin-top: 5px;
        padding-left: 3px;
    }
</style>