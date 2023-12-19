<?php 
//Get listing by meta value
if ( ! function_exists( 'stm_get_listing_by_meta_value' ) ) {
	function stm_get_listing_by_meta_value( $meta_key = '', $listing_data = array() ) {
		if ( ! empty( $meta_key ) ) {
			$args = array(
			    'post_type' => 'listings',
			    'posts_per_page' => -1
			);
			//Get featured listing
			if ( $meta_key == 'special_car' ) {
				$args['meta_query'] = array(
					array(
						'key' => 'special_car',
						'value' => 'on',
						'compare' => '='
					)
				);
			}
			//Get custom boosted value
			if ( $meta_key == 'stm_boosted_listing_date' ) {
				$args['meta_key'] = 'stm_boosted_listing_date';
				$args['orderby'] = 'meta_value_num';
				$args['order'] = 'DESC';
				$args['meta_query'] = array(
					'relation' => 'AND',
					array(
				        'key' => 'stm_boosted_listing_date', 
				        'compare' => 'EXISTS'
				    ),
					array(
						'key' => 'stm_boosted_listing_date',
						'value' => '',
						'compare' => '!='
					)
				);
			}
			$listings = get_posts( $args );
			if ( ! empty( $listings ) ) {
				foreach ( $listings as $listing ) {
					if ( ! in_array( $listing->ID, $listing_data ) ) {
						$listing_data[] = $listing->ID;
					}
				}
			}
		}

		return $listing_data;
	}
}
//STM boost listing by points
function stm_boost_listing_by_points() {
  	$listing_id = intval( $_POST['listing_id'] );
  	$current_user_id = get_current_user_id();
  	$success = '';
	$error = '';
	$redirect = '';
  	if ( get_post_type( $listing_id ) == 'listings' ) {
  		$stm_car_user_id = get_post_meta( $listing_id, 'stm_car_user', true );
  		if ( $stm_car_user_id == $current_user_id ) {
  			$current_user_data = get_userdata( $current_user_id );
  			$user_point_amount = get_user_meta( $current_user_id, 'custom_point_amount', true );
  			$user_point_expired_date = get_user_meta( $current_user_id, 'custom_point_expire_date', true );
  			if ( (int)$user_point_amount > 0 && ! empty( $user_point_expired_date ) ) {
  				$formatted_expire_date = date( 'd.m.Y H:i:s', strtotime( $user_point_expired_date ) );
				$current_date = date( 'd.m.Y H:i:s', time() );
				if ( strtotime( $formatted_expire_date ) > strtotime( $current_date ) ) {
					$user_point_amount = (int)$user_point_amount - 1;
					update_user_meta( $current_user_id, 'custom_point_amount', $user_point_amount );
					update_post_meta( $listing_id, 'stm_boosted_listing_date', strtotime( $current_date ) );
					$success = esc_html( 'Iklan berhasil di-boost.', 'motors-child' );
					$redirect = 'current';
					$featured_listings = stm_get_listing_by_meta_value( 'special_car' );
					$boosted_listings = stm_get_listing_by_meta_value( 'stm_boosted_listing_date', $featured_listings );
					$default_listings = stm_get_listing_by_meta_value( 'default', $boosted_listings );
					$array = array();
					$i = 1;
					if ( ! empty( $default_listings ) ) {
						foreach( $default_listings as $listing_id ) {
							update_post_meta( $listing_id, 'stm_custom_listings_ordered', $i );
							$i++;
						}
					}
				}
  			} else {
  				$redirect = get_site_url().'/author/'.$current_user_data->user_nicename.'/?page=my-points';
  				$error = esc_html( 'Silakan beli poin sebelum mem-boost iklan.', 'motors-child' );
  			}
  		}
  	}

  	if ( $success ) {
        $response = $success;
        $status = 'success';
    }
    if ( $error ) {
        $response = $error;
        $status = 'error';
    }
    //Send response
    wp_send_json( ['response'=>$response, 'redirect' => $redirect, 'status'=>$status] );
}
add_action( 'wp_ajax_stm_boost_listing_by_points', 'stm_boost_listing_by_points' );

//Change stm listings query 
function stm_change_default_queries( $args, $source ) {
	$featured_listings = stm_get_listing_by_meta_value( 'special_car' );
	$boosted_listings = stm_get_listing_by_meta_value( 'stm_boosted_listing_date', $featured_listings );
	$default_listings = stm_get_listing_by_meta_value( 'default', $boosted_listings );
	if ( ! empty( $default_listings ) && is_array( $default_listings ) && ! isset( $source['sort_order'] ) || $source['sort_order'] == 'date_high' ) {
		$args['post__in'] = $default_listings;
		$args['orderby'] = 'post__in';
	}
	return $args;
}
add_filter( 'stm_listings_build_query_args', 'stm_change_default_queries', 100, 2 );


//Check listing boosted time if limited date is equal to boosted date
if ( ! function_exists( 'stm_check_listing_boosted_date_by_limit_date' ) ) {
	function stm_check_listing_boosted_date_by_limit_date( $limited_datetime = '1 day' ) {
		$get_boosted_listings = stm_get_listing_by_meta_value( 'stm_boosted_listing_date' );
		if ( ! empty( $get_boosted_listings ) && is_array( $get_boosted_listings ) ) {
			foreach ( $get_boosted_listings as $listing_id ) {
				if ( $listing_id > 0 ) {
					$listing_boosted_datetime = get_post_meta( $listing_id, 'stm_boosted_listing_date', true );
					if ( ! empty( $listing_boosted_datetime ) ) {
						$formatted_expire_date = date( 'd.m.Y H:i:s', strtotime( '+'.$limited_datetime, $listing_boosted_datetime ) );
						$current_date = date( 'd.m.Y H:i:s', time() );
						if ( strtotime( $current_date ) > strtotime( $formatted_expire_date ) ) {
							update_post_meta( $listing_id, 'stm_old_boosted_listing_date', $listing_boosted_datetime );
							update_post_meta( $listing_id, 'stm_boosted_listing_date', '' );
						}
					}
				}
			}
		}
	}
}


function stm_check_listing_boosted_datetime() {
	date_default_timezone_set( wp_timezone_string() );
	stm_check_listing_boosted_date_by_limit_date();
}
add_action( 'wp_head', 'stm_check_listing_boosted_datetime' );

function stm_boosted_listing_notificiation() {
	?>
	<div id="stm_boosted_listing_notification" style="display: none;">
	  <span class="dismiss"><a title="dismiss notification">x</a></span>
	</div>

	<script type="text/javascript">
		(function ($) {
	    	$(function() {
		        $('body').on('click', '#stm_boosted_listing_notification .dismiss', function(e){
		        	$("#stm_boosted_listing_notification").fadeOut("slow");
		    	});
	    	});
		})(jQuery);
	</script>
	<?php 
}
add_action( 'wp_footer', 'stm_boosted_listing_notificiation' );





