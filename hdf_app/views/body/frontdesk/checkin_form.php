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

    <div class="col-md-6">
      <div class="card ">
        <div class="card-header ">
          <div class="timeline-heading">
            <span class="badge badge-pill badge-danger">Check In form</span>
          </div>

        </div>
        <div class="card-body ">
          <form action="<?php echo base_url() ?>index.php/main/checkingIN" method="post" class="form-horizontal">
            <input type="hidden" value="<?php echo $result_room_by_id[0]['room_number'] ?>" name="room_id">
            <input type="hidden" value="<?php echo $result_room_by_id[0]['id'] ?>" name="id">
            <?php //echo $result_room_by_id[0]['room_type'] 
            ?>
            <?php //echo $result_room_by_id[0]['room_number'] 
            ?>


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
              <label class="col-sm-2 col-form-label">Extra Person</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <select class="btn btn-primary form-control" name="extra_person">
                    <option value="">Select</option>
                    <option value="0">N/A</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">Extra Bed</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <select class="btn btn-primary form-control" name="extra_bed">
                    <option value="">Select</option>
                    <option value="0">N/A</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                  </select>
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
                  <input type="text" class="form-control" name="advance">
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">Deduction</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <select class="btn btn-primary form-control" name="deduction">
                    <option value="">Select</option>
                    <option value="0">N/A</option>
                    <option value="20">PWD</option>
                    <option value="20">Senior Citizen</option>

                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">Days Rendered</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="days_ren">
                </div>
              </div>
            </div>



            <div class="card-footer ">
              <div class="row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-md-10">
                  <input type="submit" class="btn btn-success" value="Check In">
                  <input type="reset" class="btn btn-info " value="Clear">
                  <!-- <button type="submit" class="btn btn-info btn-round">Sign in</button> -->
                </div>
              </div>
            </div>


          </form>
        </div>
      </div>
    </div>



    <!-- Checkin Cart -->





    <div class="col-md-6">
      <div class="card ">
        <div class="card-header ">
          <div class="timeline-heading">
            <span class="badge badge-pill badge-danger">Check In Details</span>
          </div>

        </div>
        <div class="card-body ">
          <hr>
          <center>
            <h4>Empty Set</h4>
          </center>
        </div>


      </div>
    </div>