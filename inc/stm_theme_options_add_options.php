<?php

function stm_theme_options_add_options( $setups ) {

	if ( is_plugin_active( 'motors-listing-types/motors-listing-types.php' ) ) {
		$k = 1;
	} else {
		$k = 0;
	}
	$setups[$k]['fields']['inventory_settings']['fields']['stm_enable_point_feature'] = array(
		'label'   => esc_html__( 'Show Point Feature', 'motors-child' ),
		'type'    => 'checkbox',
		'group'   => 'started',
		'submenu' => esc_html__( 'Main', 'motors-child' ),
	);
	$setups[ $k ]['fields']['inventory_settings']['fields']['custom_point_btn_text'] = array(
		'label'      => esc_html__( 'Point Button Label', 'motors-child' ),
		'type'       => 'text',
		'dependency' => array(
			'key'   => 'stm_enable_point_feature',
			'value' => 'not_empty'
		),
		'submenu'    => esc_html__( 'Main', 'motors-child' ),
	);
	$setups[ $k ]['fields']['inventory_settings']['fields']['custom_point_btn']      = array(
		'label'      => esc_html__( 'Point Button Icon', 'motors-child' ),
		'type'       => 'icon_picker',
		'dependency' => array(
			'key'   => 'stm_enable_point_feature',
			'value' => 'not_empty'
		),
		'submenu'    => esc_html__( 'Main', 'motors-child' ),
	);
	$setups[ $k ]['fields']['inventory_settings']['fields']['custom_boost_btn_text'] = array(
		'label'      => esc_html__( 'Boost Button Text', 'motors-child' ),
		'type'       => 'text',
		'dependency' => array(
			'key'   => 'stm_enable_point_feature',
			'value' => 'not_empty'
		),
		'submenu'    => esc_html__( 'Main', 'motors-child' ),
	);
	$setups[ $k ]['fields']['inventory_settings']['fields']['custom_boost_btn']      = array(
		'label'      => esc_html__( 'Boost Button Icon', 'motors-child' ),
		'type'       => 'icon_picker',
		'dependency' => array(
			'key'   => 'stm_enable_point_feature',
			'value' => 'not_empty'
		),
		'submenu'    => esc_html__( 'Main', 'motors-child' ),
	);
	//Boosted listing badge
	$setups[ $k ]['fields']['inventory_settings']['fields']['custom_show_boosted_badge']                          = array(
		'label'      => esc_html__( 'Show Badge', 'motors-child' ),
		'type'       => 'checkbox',
		'dependency' => array(
			'key'   => 'stm_enable_point_feature',
			'value' => 'not_empty'
		),
		'submenu'    => esc_html__( 'Main', 'motors-child' ),
	);
	$setups[ $k ]['fields']['inventory_settings']['fields']['custom_boosted_listing_badge_text']                  = array(
		'label'      => esc_html__( 'Badge Text', 'motors-child' ),
		'type'       => 'text',
		'dependency' => array(
			'key'   => 'custom_show_boosted_badge',
			'value' => 'not_empty'
		),
		'submenu'    => esc_html__( 'Main', 'motors-child' ),
	);
	$setups[ $k ]['fields']['inventory_settings']['fields']['custom_boosted_listing_badge_text_size']             = array(
		'label'      => esc_html__( 'Badge Text size', 'motors-child' ),
		'type'       => 'number',
		'dependency' => array(
			'key'   => 'custom_show_boosted_badge',
			'value' => 'not_empty'
		),
		'submenu'    => esc_html__( 'Main', 'motors-child' ),
	);
	$setups[ $k ]['fields']['inventory_settings']['fields']['custom_boosted_listing_badge_font']                  = array(
		'type'       => 'select',
		'label'      => esc_html__( 'Badge Font weight', 'my-domain' ),
		'options'    => array(
			100       => '100',
			200       => '200',
			300       => '300',
			400       => '400',
			500       => '500',
			600       => '600',
			700       => '700',
			800       => '800',
			900       => '900',
			'bold'    => 'Bold',
			'bolder'  => 'Bolder',
			'lighter' => 'Lighter',
		),
		'dependency' => array(
			'key'   => 'custom_show_boosted_badge',
			'value' => 'not_empty'
		),
		'submenu'    => esc_html__( 'Main', 'motors-child' ),
	);
	$setups[ $k ]['fields']['inventory_settings']['fields']['custom_boosted_listing_badge_text_background']       = array(
		'label'      => esc_html__( 'Badge Background Color', 'motors-child' ),
		'type'       => 'color',
		'dependency' => array(
			'key'   => 'custom_show_boosted_badge',
			'value' => 'not_empty'
		),
		'submenu'    => esc_html__( 'Main', 'motors-child' ),
	);
	$setups[ $k ]['fields']['inventory_settings']['fields']['custom_boosted_listing_badge_text_color']            = array(
		'label'      => esc_html__( 'Badge Text Color', 'motors-child' ),
		'type'       => 'color',
		'dependency' => array(
			'key'   => 'custom_show_boosted_badge',
			'value' => 'not_empty'
		),
		'submenu'    => esc_html__( 'Main', 'motors-child' ),
	);
	$setups[ $k ]['fields']['inventory_settings']['fields']['custom_boosted_listing_badge_text_hover_background'] = array(
		'label'      => esc_html__( 'Badge Background Color On Hover', 'motors-child' ),
		'type'       => 'color',
		'dependency' => array(
			'key'   => 'custom_show_boosted_badge',
			'value' => 'not_empty'
		),
		'submenu'    => esc_html__( 'Main', 'motors-child' ),
	);
	$setups[ $k ]['fields']['inventory_settings']['fields']['custom_boosted_listing_badge_text_hover_color']      = array(
		'label'      => esc_html__( 'Badge Text Color On Hover', 'motors-child' ),
		'type'       => 'color',
		'dependency' => array(
			'key'   => 'custom_show_boosted_badge',
			'value' => 'not_empty'
		),
		'submenu'    => esc_html__( 'Main', 'motors-child' ),
	);
	//Border style
	$setups[ $k ]['fields']['inventory_settings']['fields']['custom_boosted_listing_border_size']  = array(
		'label'      => esc_html__( 'Left Border size', 'motors-child' ),
		'type'       => 'number',
		'dependency' => array(
			'key'   => 'custom_show_boosted_badge',
			'value' => 'not_empty'
		),
		'submenu'    => esc_html__( 'Main', 'motors-child' ),
	);
	$setups[ $k ]['fields']['inventory_settings']['fields']['custom_boosted_listing_border_type']  = array(
		'label'      => esc_html__( 'Left Border Type', 'motors-child' ),
		'type'       => 'select',
		'options'    => array(
			'dotted' => 'Dotted',
			'dashed' => 'Dashed',
			'solid'  => 'Solid',
			'double' => 'Double',
			'groove' => 'Groove',
			'ridge'  => 'Ridge',
			'inset'  => 'Inset',
			'outset' => 'Outset',
			'none'   => 'None',
			'hidden' => 'Hidden',
		),
		'dependency' => array(
			'key'   => 'custom_show_boosted_badge',
			'value' => 'not_empty'
		),
		'submenu'    => esc_html__( 'Main', 'motors-child' ),
	);
	$setups[ $k ]['fields']['inventory_settings']['fields']['custom_boosted_listing_border_color'] = array(
		'label'      => esc_html__( 'Left border color', 'motors-child' ),
		'type'       => 'color',
		'group'      => 'ended',
		'dependency' => array(
			'key'   => 'custom_show_boosted_badge',
			'value' => 'not_empty'
		),
		'submenu'    => esc_html__( 'Main', 'motors-child' ),
	);
	flance_write_log( $setups );

	return $setups;
}

//Add point button text and icon options
add_filter( 'wpcfto_options_page_setup', 'stm_theme_options_add_options', 15, 1 );