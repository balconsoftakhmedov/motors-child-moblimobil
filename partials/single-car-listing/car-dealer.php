<?php
wp_enqueue_style( 'stm_car_dealer_info', get_theme_file_uri( '/assets/css/dist/stm_car_dealer_info.css' ), null, STM_THEME_VERSION, 'all' );

$user_added_by = get_post_meta( get_the_ID(), 'stm_car_user', true );
$show_number   = apply_filters( 'stm_me_get_nuxy_mod', false, 'stm_show_number' );

if ( ! empty( $user_added_by ) ) :

    $user_data = get_userdata( $user_added_by );

    if ( $user_data ) :

        $user_fields = stm_get_user_custom_fields( $user_added_by );
        $is_dealer   = apply_filters( 'stm_get_user_role', false, $user_added_by );

        if ( $is_dealer ) :
            $ratings = stm_get_dealer_marks( $user_added_by );
            ?>

            <div class="stm-listing-car-dealer-info">
                <a class="stm-no-text-decoration" href="<?php echo ( boolval( apply_filters( 'is_listing', array() ) ) || apply_filters( 'stm_is_aircrafts', false ) ) ? esc_url( stm_get_author_link( $user_added_by ) ) : '#!'; ?>">
                    <h3 class="title">
                        <?php stm_display_user_name( $user_added_by ); ?>
                    </h3>
                </a>
                <div class="clearfix">
                    <div class="dealer-image">
                        <div class="stm-dealer-image-custom-view">
                            <a href="<?php echo ( boolval( apply_filters( 'is_listing', array() ) ) || apply_filters( 'stm_is_aircrafts', false ) ) ? esc_url( stm_get_author_link( $user_added_by ) ) : '#!'; ?>">
                                <?php if ( ! empty( $user_fields['logo'] ) ) : ?>
                                    <img src="<?php echo esc_url( $user_fields['logo'] ); ?>" />
                                <?php else : ?>
                                    <img src="<?php stm_get_dealer_logo_placeholder(); ?>" />
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                    <?php if ( ! empty( $ratings['average'] ) ) : ?>
                        <div class="dealer-rating">
                            <div class="stm-rate-unit">
                                <div class="stm-rate-inner">
                                    <div class="stm-rate-not-filled"></div>
                                    <div class="stm-rate-filled" style="width:<?php echo esc_attr( $ratings['average_width'] ); ?>"></div>
                                </div>
                            </div>
                            <div class="stm-rate-sum">(<?php esc_html_e( 'Reviews', 'motors' ); ?> <?php echo esc_attr( $ratings['count'] ); ?>)</div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="dealer-contacts">
                    <?php if ( ! empty( $user_fields['phone'] ) ) : ?>
                        <div class="dealer-contact-unit phone">
                            <i class="stm-service-icon-phone_2"></i>
                            <?php if ( $show_number ) : ?>
                                <div class="phone heading-font">
                                    <?php echo esc_html( $user_fields['phone'] ); ?>
                                </div>
                            <?php else : ?>
                                <div class="phone heading-font">
                                    <?php echo esc_html( substr_replace( $user_fields['phone'], '*******', 3, strlen( $user_fields['phone'] ) ) ); ?>
                                </div>
                                <span class="stm-show-number" data-listing-id="<?php echo intval( get_the_ID() ); ?>" data-id="<?php echo esc_attr( $user_fields['user_id'] ); ?>">
									<?php echo esc_html__( 'Show number', 'motors' ); ?>
								</span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ( ! empty( $args['show_whatsapp'] ) && ! empty( $user_fields['phone'] ) && ! empty( $user_fields['stm_whatsapp_number'] ) ) : ?>
                        <div class="dealer-contact-unit whatsapp">
                            <a href="https://wa.me/<?php echo esc_attr( trim( preg_replace( '/[^0-9]/', '', $user_fields['phone'] ) ) ); ?>" target="_blank">
                                <div class="whatsapp-btn">
                                    <i class="stm-icon-whatsapp"></i>
                                    <span>
										<?php echo esc_html__( 'Chat via WhatsApp', 'motors' ); ?>
									</span>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if ( ! empty( $args['show_email'] ) && ! empty( $user_fields['email'] ) && ! empty( $user_fields['show_mail'] ) ) : ?>
                        <div class="dealer-contact-unit mail">
                            <a href="mailto:<?php echo esc_attr( $user_fields['email'] ); ?>">
                                <div class="email-btn">
                                    <i class="fas fa-envelope"></i>
                                    <span>
										<?php echo esc_html__( 'Message to dealer', 'motors' ); ?>
									</span>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if ( ! empty( $user_fields['location'] ) ) : ?>
                        <div class="dealer-contact-unit address">
                            <i class="stm-service-icon-pin_2"></i>
                            <div class="address"><?php echo esc_attr( $user_fields['location'] ); ?></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php else : ?>
            <div class="stm-listing-car-dealer-info stm-common-user">

                <div class="clearfix stm-user-main-info-c">
                    <div class="image">
                        <a href="<?php echo ( boolval( apply_filters( 'is_listing', array() ) ) || apply_filters( 'stm_is_aircrafts', false ) ) ? esc_url( stm_get_author_link( $user_added_by ) ) : '#!'; ?>">
                            <?php if ( ! empty( $user_fields['image'] ) ) : ?>
                                <img src="<?php echo esc_url( $user_fields['image'] ); ?>" />
                            <?php else : ?>
                                <div class="no-avatar">
                                    <i class="stm-service-icon-user"></i>
                                </div>
                            <?php endif; ?>
                        </a>
                    </div>
                    <a class="stm-no-text-decoration" href="<?php echo ( boolval( apply_filters( 'is_listing', array() ) ) || apply_filters( 'stm_is_aircrafts', false ) ) ? esc_url( stm_get_author_link( $user_added_by ) ) : '#!'; ?>">
                        <h3 class="title"><?php stm_display_user_name( $user_added_by ); ?></h3>
                        <div class="stm-label"><?php esc_html_e( 'Private Seller', 'motors' ); ?></div>
                    </a>
                </div>

                <div class="dealer-contacts">
                    <button 
                        class="stm-gallery-action-unit stm-motors-report-listing second-report"
                        data-id="<?php echo esc_attr(get_the_ID()); ?>"
                        data-title="<?php echo esc_attr(get_the_title()); ?>"
                        data-toggle="modal"
                        data-target="#stm-motors-report-listing"
                        title="<?php esc_attr_e('Send report', 'motors-child'); ?>"
                        style="padding: 0; display: grid; place-items: center;"
                    >
                        <svg width="22px" height="22px" fill="white" viewBox="0 0 56 56" xmlns="http://www.w3.org/2000/svg">
                            <path d="M 27.9999 51.9063 C 41.0546 51.9063 51.9063 41.0781 51.9063 28 C 51.9063 14.9453 41.0312 4.0937 27.9765 4.0937 C 14.8983 4.0937 4.0937 14.9453 4.0937 28 C 4.0937 41.0781 14.9218 51.9063 27.9999 51.9063 Z M 27.9999 47.9219 C 16.9374 47.9219 8.1014 39.0625 8.1014 28 C 8.1014 16.9609 16.9140 8.0781 27.9765 8.0781 C 39.0155 8.0781 47.8983 16.9609 47.9219 28 C 47.9454 39.0625 39.0390 47.9219 27.9999 47.9219 Z M 27.9765 32.2422 C 29.1014 32.2422 29.7343 31.6094 29.7577 30.3906 L 30.1093 18.0156 C 30.1327 16.8203 29.1952 15.9297 27.9530 15.9297 C 26.6874 15.9297 25.7968 16.7968 25.8202 17.9922 L 26.1249 30.3906 C 26.1483 31.5859 26.8046 32.2422 27.9765 32.2422 Z M 27.9765 39.8594 C 29.3124 39.8594 30.5077 38.7812 30.5077 37.4219 C 30.5077 36.0390 29.3358 34.9844 27.9765 34.9844 C 26.5936 34.9844 25.4452 36.0625 25.4452 37.4219 C 25.4452 38.7578 26.6171 39.8594 27.9765 39.8594 Z" />
                        </svg>
                    </button>

                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            document.querySelector('.stm-gallery-actions').insertBefore(
                                document.querySelector('.stm-motors-report-listing.second-report'),
                                document.querySelector('.stm-gallery-actions').firstChild
                            );
                        });
                    </script>

                    <?php if ( ! empty( $user_fields['phone'] ) ) : ?>
                        <div class="dealer-contact-unit phone">
                            <i class="stm-service-icon-phone_2"></i>
                            <?php if ( $show_number ) : ?>
                                <div class="phone heading-font"><?php echo esc_html( $user_fields['phone'] ); ?></div>
                            <?php else : ?>
                                <div class="phone heading-font">
                                    <?php echo esc_html( substr_replace( $user_fields['phone'], '*******', 3, strlen( $user_fields['phone'] ) ) ); ?>
                                </div>
                                <span class="stm-show-number" data-listing-id="<?php echo intval( get_the_ID() ); ?>" data-id="<?php echo esc_attr( $user_fields['user_id'] ); ?>"><?php echo esc_html__( 'Show number', 'motors' ); ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ( ! empty( $args['show_whatsapp'] ) && ! empty( $user_fields['phone'] ) && ! empty( $user_fields['stm_whatsapp_number'] ) ) : ?>
                        <div class="dealer-contact-unit whatsapp">
                            <a href="https://wa.me/<?php echo esc_attr( trim( preg_replace( '/[^0-9]/', '', $user_fields['phone'] ) ) ); ?>" target="_blank">
                                <div class="whatsapp-btn heading-font">
                                    <i class="stm-icon-whatsapp"></i>
                                    <span>
										<?php echo esc_html__( 'Chat via WhatsApp', 'motors' ); ?>
									</span>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if ( ! empty( $args['show_email'] ) && ! empty( $user_fields['email'] ) && ! empty( $user_fields['show_mail'] ) ) : ?>
                        <div class="dealer-contact-unit mail">
                            <a href="mailto:<?php echo esc_attr( $user_fields['email'] ); ?>">
                                <div class="email-btn heading-font">
                                    <i class="fas fa-envelope"></i>
                                    <span>
										<?php echo esc_html__( 'Message to dealer', 'motors' ); ?>
									</span>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php
        endif;
    endif;
endif;