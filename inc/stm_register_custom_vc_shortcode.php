<?php 
add_action( 'vc_before_init', 'stm_register_custom_points_plans' );
//Register custom points plans
function stm_register_custom_points_plans() {
	vc_map( array(
        'name'   => esc_html__('STM Points Plans', 'motors-child'),
        'base'   => 'stm_custom_points_plans',
        'category' => __( 'STM General', 'motors-child' ),
        'params' => array(
            array(
                'type'       => 'textfield',
                'heading'    => __( 'Page title', 'motors-child' ),
                'param_name' => 'stm_points_plans_title',
                'value'      => '',
            ),
        )
    ) );
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Stm_Custom_Points_Plans extends WPBakeryShortCode
    {
    }
}

function stm_set_child_custom_vc_shortcode( $template ) {
	$file = get_stylesheet_directory().'/vc_templates/stm_custom_points_plans.php';
	if ( is_file( $file ) ) {
		return $file;
	}
    return $template;
}
add_filter( 'vc_shortcode_set_template_stm_custom_points_plans', 'stm_set_child_custom_vc_shortcode' );
