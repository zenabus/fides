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
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header ">
          <div class="timeline-heading">
            <span class="badge badge-pill badge-danger">Reservation form</span>
          </div>
          <script src="<?php echo base_url() ?>assets/daboy_script.js"></script>
        </div>
        <div class="card-body ">
          <form action="<?php echo base_url() ?>index.php/main/addingReservation" method="post" class="form-horizontal">

            <div class="row">
              <label class="col-sm-2 col-form-label">Reserve Date</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="daterange">
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">Room Types</label>
              <div class="col-sm-10">
                <table class="col-sm-12">
                  <tr id="table4">

                  </tr>
                </table>
                <button id="addInput4" type="button" class="btn btn-default">Add</button></td>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">Last Name</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="last_name">
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">First Name</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="first_name">
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">Middle Name</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="middle_name">
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">Contact No.</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" required="true" name="contact">
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">Email Address</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="email">
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">Address</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="address">
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">Advance Payment</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="advance" value="">
                </div>
              </div>
            </div>

            <div class="card-footer ">
              <div class="row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-md-10">
                  <input type="submit" class="btn btn-success" value="Reserve">
                  <input type="reset" class="btn btn-info " value="Clear">
                  <!-- <button type="submit" class="btn btn-info btn-round">Sign in</button> -->
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- modal -->