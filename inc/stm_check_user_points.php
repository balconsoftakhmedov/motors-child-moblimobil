<?php 
//Check user points expire date
if ( ! function_exists( 'stm_check_user_custom_points_expire_data' ) ) {
	function stm_check_user_custom_points_expire_data() {
		if ( is_user_logged_in() ) {
			$expire_date_exist = false;
			//Get current user id
			$current_user_id = get_current_user_id();
			//Check user exist by id
			$current_user_data = get_userdata( $current_user_id );
			if ( $current_user_data ) {
				//Get user points meta data
				$user_point_amount = get_user_meta( $current_user_id, 'custom_point_amount', true );
				$user_point_expired_date = get_user_meta( $current_user_id, 'custom_point_expire_date', true );
				if ( ! empty( $user_point_expired_date ) ) {
					$expire_date_exist = true;
					$formatted_expire_date = date( 'd.m.Y H:i:s', strtotime( $user_point_expired_date ) );
					$current_date = date( 'd.m.Y H:i:s', time() );
					if ( strtotime( $current_date ) > strtotime( $formatted_expire_date ) ) {
						update_user_meta( $current_user_id, 'custom_point_amount', 0 );
						$expire_date_exist = false;
					}
				}
			}
			return $expire_date_exist;
		}
	}
}

function stm_check_users_points_data() {
	stm_check_user_custom_points_expire_data();
}
add_action( 'init', 'stm_check_users_points_data' );