<?php
$stm_enable_point_feature = stm_me_get_wpcfto_mod( 'stm_enable_point_feature', false );
$custom_boost_btn_text = stm_me_get_wpcfto_mod( 'custom_boost_btn_text', 'Boost' );
$custom_boost_btn = stm_me_get_wpcfto_mod( 'custom_boost_btn' );
$stm_car_user = get_post_meta( get_the_ID(), 'stm_car_user', true );
if(stm_is_dealer_two()) {
    $selling_online_global = stm_me_get_wpcfto_mod( 'enable_woo_online', false );
    $sell_online = ( $selling_online_global ) ? !empty( get_post_meta( get_the_ID(), 'car_mark_woo_online', true ) ) : false;
}
?>
<div class="car-meta-top heading-font clearfix this_place">
    <?php if(stm_is_dealer_two() && $sell_online && empty($car_price_form_label)):?>
        <?php
            if(!empty($sale_price)) $price = $sale_price;
        ?>
        <div class="sell-online-wrap price">
            <div class="normal-price">
                <span class="normal_font"><?php echo esc_html__('BUY ONLINE', 'motors'); ?></span>
                <span class="heading-font"><?php echo esc_attr( apply_filters( 'stm_filter_price_view', '', $price ) ); ?></span>
            </div>
        </div>
    <?php else : ?>
        <?php if(empty($car_price_form_label)): ?>
            <?php if(!empty($price) and !empty($sale_price) and $price != $sale_price):?>
                <div class="price discounted-price">
                    <div class="regular-price"><?php echo esc_attr( apply_filters( 'stm_filter_price_view', '', $price ) ); ?></div>
                    <div class="sale-price"><?php echo esc_attr( apply_filters( 'stm_filter_price_view', '', $sale_price ) ); ?></div>
                </div>
            <?php elseif(!empty($price)): ?>
                <div class="price">
                    <div class="normal-price"><?php echo esc_attr( apply_filters( 'stm_filter_price_view', '', $price ) ); ?></div>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="price">
                <div class="normal-price"><?php echo esc_attr($car_price_form_label); ?> 00</div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <div class="car-title" data-max-char="<?php echo stm_me_get_wpcfto_mod('grid_title_max_length', 44); ?>">
        <?php
        if(!stm_is_listing_three()) {
            echo esc_html( stm_generate_title_from_slugs( get_the_title(), get_the_ID() ) );
        } else {
            echo trim( stm_generate_title_from_slugs( get_the_title(), get_the_ID(), true ) );
        }
        ?>
    </div>
    <?php get_template_part('partials/stm-listing-views'); ?>
</div>

<?php if ( $stm_enable_point_feature && (int)$stm_car_user > 0 && $stm_car_user == get_current_user_id() ) : ?>
    <div class="stm-listing-boost" style="width: fit-content;margin-top: 10px;">
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
    </div>
<?php endif; ?>