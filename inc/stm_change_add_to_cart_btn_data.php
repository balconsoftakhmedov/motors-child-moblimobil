<?php 
//Change add to cart text
function woocommerce_custom_single_add_to_cart_text() {
    return __( 'Add to cart', 'woocommerce' ); 
}
// To change add to cart text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text', 99999 ); 


function woocommerce_custom_product_add_to_cart_text() {
    return __( 'Add to cart', 'woocommerce' );
}
// To change add to cart text on product archives(Collection) page
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text', 99999 ); 

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );