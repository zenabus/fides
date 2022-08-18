      <footer class="footer">
        <div class="container pt-4 pb-3">
          <div class="row">
            <div class="col-md-12">
              <p class="text-center">&copy; 2020 - <?= date('Y') ?> &nbsp;iHotelier&nbsp; | &nbsp;All Rights Reserved</p>
              <p class="text-center mb-0">Made with <i class="fa fa-heart heart"></i> by <a href="https://wsmitservices.com/" class="text-dark" target="blank">WSM IT Services</a></p>
            </div>
          </div>
        </div>
      </footer>
      </div>
      </div>

      <script>
        $(document).ready(function() {
          $('[rel="tooltip"]').click(function() {
            $(this).tooltip('hide')
            $('.tooltip').remove();
          });
          $('[rel="tooltip"]').hover(()=>{}, function() {
            $(this).tooltip('hide')
            $('.tooltip').remove();
          });
        });
      </script>
      <script src="<?= base_url() ?>assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
      <script src="<?= base_url() ?>assets/js/plugins/bootstrap-switch.js"></script>
      <script src="<?= base_url() ?>assets/js/plugins/sweetalert2.min.js"></script>
      <script src="<?= base_url() ?>assets/js/plugins/jquery.validate.min.js"></script>
      <script src="<?= base_url() ?>assets/js/plugins/jquery.bootstrap-wizard.js"></script>
      <script src="<?= base_url() ?>assets/js/plugins/jquery.dataTables.min.js"></script>
      <script src="<?= base_url() ?>assets/js/plugins/bootstrap-selectpicker.js"></script>
      <script src="<?= base_url() ?>assets/js/plugins/bootstrap-tagsinput.js"></script>
      <script src="<?= base_url() ?>assets/js/plugins/bootstrap-notify.js"></script>
      <script src="<?= base_url() ?>assets/js/plugins/jasny-bootstrap.min.js"></script>
      <script src="<?= base_url() ?>assets/js/paper-dashboard.min.js?v=2.0.1"></script>
      <script src="<?= base_url() ?>assets/js/demo.js"></script>
      </body>

      </html>