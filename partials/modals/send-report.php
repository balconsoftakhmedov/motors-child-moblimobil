<div class="modal fade" id="stm-motors-report-listing" tabindex="-1" role="dialog" aria-labelledby="reportListingModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <?php
                        _e('Send report', 'motors-child') ;
                    ?>
                    <span></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo do_shortcode('[contact-form-7 id="ab12790" title="Kirim Laporan"]'); ?>
            </div>
            <?php if ( false ) : ?>
                <div class="modal-body">
                    <form method="POST">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Recipient Mail:</label>
                            <input type="email" class="form-control" id="recipient-mail">
                        </div>
                        <div class="form-group">
                            <label for="recipient-message" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="recipient-message"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">
                        <?php esc_html_e('Send', 'motors-child'); ?>
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>