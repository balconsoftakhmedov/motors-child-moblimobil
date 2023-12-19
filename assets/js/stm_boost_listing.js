(function ($) {
    $(function() {
        $('body').on('click', '.stm-custom-boost-listing', function(e){
            e.preventDefault();

            var listing_id = parseInt($(this).attr('data-listing-id'));
            if ( listing_id > 0 ) {
                var form_data = new FormData();
                form_data.append('action', 'stm_boost_listing_by_points');
                var icon_class = $(this).find('i').attr('class');
                $(this).find('i').removeClass(icon_class).addClass('fa fa-spinner fa-spin fa-1x fa-fw');
                $(this).find('i').css('top', '7px')
                form_data.append('listing_id', listing_id);  
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function(data){
                        $(this).find('i').removeClass('fa-spinner fa-spin fa-1x fa-fw').addClass(icon_class);
                        if ( data['status'] == 'success' ) {
                            if ( data['redirect'] == 'current' ) {
                                $("#stm_boosted_listing_notification").fadeIn("slow").append(data['response']);
                                location.reload();
                            }
                        }
                        if ( data['status'] == 'error' ) {
                            window.location.href = data['redirect'];
                        }
                    }
                });
            }
        });
    });
})(jQuery);