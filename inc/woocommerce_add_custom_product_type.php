<?php
//Register new custom product type in woocommerce
function stm_register_custom_premium_listing_type () {
	class WC_Product_Custom_Premium_listing extends WC_Product {
		public function __construct( $product ) {
			$this->product_type = 'custom_premium_listing'; // name of your custom product type
			parent::__construct( $product );
			// add additional functions here
		}
	}
}
add_action( 'init', 'stm_register_custom_premium_listing_type' );
  
function stm_add_woocommerce_product_class( $classname, $product_type ) {
    if ( $product_type == 'custom_premium_listing' ) {
        $classname = 'WC_Product_Custom_Premium_listing';
    }
    return $classname;
}

add_filter( 'woocommerce_product_class', 'stm_add_woocommerce_product_class', 10, 2 );

function stm_add_custom_premium_listing_tab( $tabs) {
	// Key should be exactly the same as in the class product_type
	$tabs['custom_premium_listing'] = array(
		'label'	 => __( 'Point data', 'motors-child' ),
		'target' => 'custom_premium_listing_options',
		'class'  => ('show_if_custom_premium_listing'),
	);
	return $tabs;
}

add_filter( 'woocommerce_product_data_tabs', 'stm_add_custom_premium_listing_tab' );


function stm_custom_premium_listing_options_product_tab_content() {
	// Dont forget to change the id in the div with your target of your product tab
	global $woocommerce, $post;
	$product = wc_get_product( $post->ID );
	if ( $product && $product->get_type() == 'custom_premium_listing' ) :
		ob_start();
		?>
		<div id="custom_premium_listing_options" class="panel woocommerce_options_panel">
			<div class='options_group'>
				<?php
					// woocommerce_wp_checkbox( array(
					// 	'id' 	=> '_enable_custom_premium_listing',
					// 	'label' => __( 'Enable Premium listing', 'motors-child' ),
					// ) );
					woocommerce_wp_text_input( array(
			       		'id'          => '_point_amount',
			       		'label'       => __( 'Point amount', 'motors-child' ),
			       		'placeholder' => '',
			       		'desc_tip'    => 'true',
			       		'description' => __( 'Enter point amount', 'motors-child' ),
			       	) );
					woocommerce_wp_text_input( array(
			       		'id'          => '_regular_price',
			       		'label'       => __( 'Price', 'motors-child' ),
			       		'placeholder' => '',
			       		'desc_tip'    => 'true',
			       		'description' => __( 'Enter primium Listing Price', 'motors-child' ),
			       	) ); 
			    ?>
			</div>
		</div>
		<?php
		echo ob_get_clean();
	endif;
}
add_action( 'woocommerce_product_data_panels', 'stm_custom_premium_listing_options_product_tab_content' );

//Save custom premium listing field value
function save_custom_premium_listing_options_field( $post_id ) {
	// $enable_custom_premium_listing = isset( $_POST['_enable_custom_premium_listing'] ) ? 'yes' : 'no';
	// update_post_meta( $post_id, '_enable_custom_premium_listing', $enable_custom_premium_listing );
	$product_data = wc_get_product( $post_id );
	$product_type = $product_data->get_type();
	if ( $product_type == 'custom_premium_listing' ) {
		if ( isset( $_POST['_point_amount'] ) ) {
			update_post_meta( $post_id, '_point_amount', sanitize_text_field( $_POST['_point_amount'] ) );
		}
		if ( isset( $_POST['_regular_price'] ) ) {
			update_post_meta( $post_id, '_regular_price', sanitize_text_field( $_POST['_regular_price'] ) );
			update_post_meta( $post_id, '_price', sanitize_text_field( $_POST['_regular_price'] ) );
		}
	}
}

add_action( 'woocommerce_process_product_meta', 'save_custom_premium_listing_options_field' );
//Show add to cart button in product single page
add_action( "woocommerce_custom_premium_listing_add_to_cart", function() {
    do_action( 'woocommerce_simple_add_to_cart' );
});

//Add to woocommerce product type selector
function stm_add_custom_premium_listing ( $type ) {
	// Key should be exactly the same as in the class product_type
	$type[ 'custom_premium_listing' ] = __( 'Premium listing' );
	return $type;
}
add_filter( 'product_type_selector', 'stm_add_custom_premium_listing' );
//Change product shop query
function stm_change_product_shop_query( $query ) {
	if (!is_admin() && is_post_type_archive( 'product' ) && $query->is_main_query()) {
		$taxquery = array(
	        array(
	            'taxonomy' => 'product_type',
	            'field' => 'slug',
	            'terms' => 'custom_premium_listing',
	            'operator'  => 'NOT IN'
	        )
	    );
	    $query->set('tax_query', $taxquery);
	}

	return $query;
}
add_action( 'pre_get_posts','stm_change_product_shop_query' );
