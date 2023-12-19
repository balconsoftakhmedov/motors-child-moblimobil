<?php 
function stm_override_account_navigation( $navs ) {
	$stm_enable_point_feature = stm_me_get_wpcfto_mod( 'stm_enable_point_feature', false );
	$navs = array(
		'inventory' => array(
			'label' => esc_html__( 'My Inventory', 'motors' ),
			'url'   => stm_get_author_link( '' ),
			'icon'  => 'stm-service-icon-inventory',
		),
		'favourite' => array(
			'label' => esc_html__( 'My Favorites', 'motors' ),
			'url'   => add_query_arg( array( 'page' => 'favourite' ), stm_get_author_link( '' ) ),
			'icon'  => 'stm-service-icon-star-o',
		),
		'plans'     => array(
			'label' => esc_html__( 'My Plans', 'motors' ),
			'url'   => add_query_arg( array( 'page' => 'my-plans' ), stm_get_author_link( '' ) ),
			'icon'  => 'stm-service-icon-inventory',
		),
		'my-points' => array(
			'label' => esc_html__( 'Poin Saya', 'motors' ),
			'url'   => add_query_arg( array( 'page' => 'my-points' ), stm_get_author_link( '' ) ),
			'icon'  => 'fa fa-coins',
		),
		'settings'  => array(
			'label' => esc_html__( 'Profile Settings', 'motors' ),
			'url'   => add_query_arg( array( 'page' => 'settings' ), stm_get_author_link( '' ) ),
			'icon'  => 'fa fa-cog',
		),
	);
	if ( ! stm_show_my_plans() ) {
		unset( $navs['plans'] );
	}

	if ( ! $stm_enable_point_feature ) {
		unset( $navs['my-points'] );
	}
	return $navs;
}
add_filter( 'stm_account_navigation', 'stm_override_account_navigation' );