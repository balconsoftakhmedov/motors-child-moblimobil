<?php
    add_action( 'stm_pre_footer', function () {

        get_template_part( 'partials/modals/send', 'report' );

    });