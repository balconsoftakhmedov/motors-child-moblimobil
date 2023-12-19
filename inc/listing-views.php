<?php
//    add_action( 'wp_head', 'stm_motors_listing_views' );

    /**
     * @param array $args
     *
     * @return null
     */
    function stm_motors_listing_views( $args = [] ){
        global $user_ID, $post, $wpdb;

        if( ! $post || ! is_singular('listings') )
            return;

        $rg = (object) wp_parse_args( $args, [
            'meta_key' => 'stm_car_views',
            'who_count' => 0,
            'exclude_bots' => true,
        ] );

        $do_count = false;
        switch( $rg->who_count ){

            case 0:
                $do_count = true;
                break;
            case 1:
                if( ! $user_ID )
                    $do_count = true;
                break;
            case 2:
                if( $user_ID )
                    $do_count = true;
                break;
        }

        if( $do_count && $rg->exclude_bots ){

            $notbot = 'Mozilla|Opera'; // Chrome|Safari|Firefox|Netscape - все равны Mozilla
            $bot = 'Bot/|robot|Slurp/|yahoo';
            if(
                ! preg_match( "/$notbot/i", $_SERVER['HTTP_USER_AGENT'] ) ||
                preg_match( "~$bot~i", $_SERVER['HTTP_USER_AGENT'] )
            ){
                $do_count = false;
            }

        }

        if( $do_count ){

            $up = $wpdb->query( $wpdb->prepare(
                "UPDATE $wpdb->postmeta SET meta_value = (meta_value+1) WHERE post_id = %d AND meta_key = %s",
                $post->ID, $rg->meta_key
            ) );

            if( ! $up ){
                add_post_meta( $post->ID, $rg->meta_key, 1, true );
            }

            wp_cache_delete( $post->ID, 'post_meta' );
        }
    }