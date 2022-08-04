<?php if (validation_errors()) : ?>
  <script>
    $(document).ready(function() {
      demo.showNotification_error('top', 'right');
    });
  </script>

<?php endif; ?>

<?php if ($this->session->flashdata('success')) : ?>
  <script>
    $(document).ready(function() {
      demo.showNotification('top', 'right');
    });
  </script>

<?php endif; ?>
<div class="content pb-0">
  <div class="row">

    <?php foreach ($result_table as $data) {
      # code...
    ?>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-body ">
            <div class="row">
              <div class="col-5 col-md-4">
                <div class="icon-big text-center icon-warning">
                  <i class="fa fa-table text-primary"></i>
                </div>
              </div>
              <div class="col-7 col-md-8">
                <div class="numbers">
                  <p class="card-category"><?php echo $data['table_number'] ?></p>
                  <p class="card-title">
                  <p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer ">
            <hr>
            <div class="stats">
              <a href="<?php echo base_url('index.php/main/PerTableProcess/' . $data['id_table']) ?>"> <i class="nc-icon nc-tap-01"></i> View</a>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>


  </div>
  <!-- end row -->
</div>