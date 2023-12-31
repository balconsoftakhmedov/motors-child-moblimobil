<?php if(is_user_logged_in()): ?>
	<?php
		$user = wp_get_current_user();
		if(!is_wp_error($user)):

		$link = stm_get_author_link($user->data->ID);

		$my_offers = 0;

		$user_cars = (function_exists('stm_user_listings_query')) ? stm_user_listings_query($user->data->ID, "publish", -1, false, 0,false, true) : null;
		if($user_cars != null && !empty($user_cars->post_count)) {
			$my_offers = $user_cars->post_count;
		}

		$my_fav = get_the_author_meta('stm_user_favourites', $user->ID);

		if(!empty($my_fav)) {
			$my_fav = count(array_filter(explode(',', $my_fav)));
		} else {
			$my_fav = 0;
		}
		$stm_enable_point_feature = stm_me_get_wpcfto_mod( 'stm_enable_point_feature', false );
		$user_point_amount = get_user_meta( $user->ID, 'custom_point_amount', true );
		if ( empty( $user_point_amount ) ) {
			$user_point_amount = 0;
		}
	?>

	<div class="lOffer-account-dropdown login">
		<a href="<?php echo esc_url(add_query_arg(array('page' => 'settings'), stm_get_author_link(''))); ?>" class="settings">
			<i class="stm-settings-icon stm-service-icon-cog"></i>
		</a>
		<div class="name">
			<a href="<?php echo esc_url(stm_get_author_link('')); ?>"><?php echo esc_attr(stm_display_user_name($user->ID)); ?></a>
		</div>
		<ul class="account-list">
			<li><a href="<?php echo esc_url(stm_get_author_link('')); ?>"><?php esc_html_e('My items', 'motors'); ?> (<span><?php echo esc_attr($my_offers); ?></span>)</a></li>
            <?php if(stm_show_my_plans()): ?>
            <li><a href="<?php echo esc_url(add_query_arg(array('page' => 'my-plans'), stm_get_author_link(''))); ?>"><?php esc_html_e('My plans', 'motors'); ?></a></li>
            <?php endif; ?>
			<li class="stm-my-favourites"><a href="<?php echo esc_url(add_query_arg(array('page' => 'favourite'), stm_get_author_link(''))); ?>"><?php esc_html_e('Favorites', 'motors'); ?> (<span><?php echo esc_attr($my_fav); ?></span>)</a></li>
			<?php if ( $stm_enable_point_feature ) : ?>
				<li>
					<a href="<?php echo esc_url(add_query_arg(array('page' => 'my-points'), stm_get_author_link(''))); ?>" class="my-points">
						<?php esc_html_e('Poin Saya', 'motors'); ?>
						(<span><?php echo esc_attr( $user_point_amount ); ?></span>)
					</a>
				</li>
			<?php endif; ?>

		</ul>
		<a href="<?php echo esc_url(wp_logout_url(home_url())); ?>" class="logout">
			<i class="fas fa-power-off"></i><?php esc_html_e('Logout', 'motors'); ?>
		</a>
	</div>

	<?php endif; ?>

<?php else :?>
	<div class="lOffer-account-dropdown stm-login-form-unregistered">
		<form method="post">
			<?php do_action( 'stm_before_signin_form' ) ?>
			<div class="form-group">
				<h4><?php esc_html_e('Login or E-mail', 'motors'); ?></h4>
				<input type="text" name="stm_user_login" autocomplete="off" placeholder="<?php esc_attr_e('Enter login or E-mail', 'motors') ?>"/>
			</div>

			<div class="form-group">
				<h4><?php esc_html_e('Password', 'motors'); ?></h4>
				<input type="password" name="stm_user_password" autocomplete="off" placeholder="<?php esc_attr_e('Enter password', 'motors') ?>"/>
			</div>

			<div class="form-group form-checker">
				<label>
					<input type="checkbox" name="stm_remember_me" />
					<span><?php esc_html_e('Remember me', 'motors'); ?></span>
				</label>
			</div>
            <?php if(class_exists('SitePress')) : ?><input type="hidden" name="current_lang" value="<?php echo ICL_LANGUAGE_CODE; ?>"/><?php endif; ?>
			<input type="submit" value="<?php esc_attr_e('Login', 'motors'); ?>"/>
			<span class="stm-listing-loader"><i class="stm-icon-load1"></i></span>
			<a href="<?php echo esc_url(stm_get_author_link('register')); ?>" class="stm_label"><?php esc_html_e('Sign Up', 'motors'); ?></a>
			<div class="stm-validation-message"></div>
			<?php do_action( 'stm_after_signin_form' ) ?>
		</form>
	</div>
<?php endif; ?>