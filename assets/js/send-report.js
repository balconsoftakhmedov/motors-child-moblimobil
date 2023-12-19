(function ($) {
    $(document).ready(function () {
		let modal = $('#stm-motors-report-listing');

        $('.stm-motors-report-listing').on('click', function (e) {
            e.preventDefault();

            let $this = $(this);

            modal.find('input[name="listing-id"]').val( $this.data('id') );
            modal.find('input[name="listing-title"]').val( $this.data('title') );
        });

		modal.on('hidden.bs.modal', function (e) {
			let form = $( e.currentTarget ).find('.wpcf7-form');

			form.removeClass('sent').removeClass('invalid').addClass('init');
			form.attr('data-status', 'init');

			form.find('.wpcf7-form-control').removeClass('wpcf7-not-valid');
		});
    });
})(jQuery);