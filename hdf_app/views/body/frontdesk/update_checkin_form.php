<?php if ($this->session->flashdata('error')) : ?>
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
          <form action="<?php echo base_url() ?>index.php/main/checkingInUpdate" method="post" class="form-horizontal">
            <input type="hidden" value="<?php echo $result_room_by_id[0]['room_number'] ?>" name="room_id">
            <input type="hidden" value="<?php echo $result_room_by_id[0]['id'] ?>" name="id">
            <?php //echo $result_room_by_id[0]['room_type'] 
            ?>
            <?php //echo $result_room_by_id[0]['room_number'] 
            ?>

            <input type="hidden" value="<?php echo $result_room_form[0]['id'] ?>" name="check_in_id">

            <div class="row">
              <div class="col-sm-12">
                <label class="form-label">Last Name</label>
                <div class="form-group">
                  <input type="text" class="form-control" name="last_name" value="<?php echo $result_room_form[0]['last_name'] ?>">
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">First Name</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="first_name" value="<?php echo $result_room_form[0]['first_name'] ?>">
                </div>
              </div>
            </div>


            <div class="row">
              <label class="col-sm-2 col-form-label">Middle Name</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="middle_name" value="<?php echo $result_room_form[0]['middle_name'] ?>">
                </div>
              </div>
            </div>


            <div class="row">
              <label class="col-sm-2 col-form-label">Extra Person</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <select class="btn btn-primary form-control" name="extra_person">
                    <option value="<?php echo $result_room_form[0]['add_person'] ?>"><?php echo $result_room_form[0]['add_person'] ?></option>
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
                    <option value="<?php echo $result_room_form[0]['add_bed'] ?>"><?php echo $result_room_form[0]['add_bed'] ?></option>
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
                  <input type="text" class="form-control" required="true" name="contact" value="<?php echo $result_room_form[0]['contact'] ?>">
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">Email Address</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="email" value="<?php echo $result_room_form[0]['email'] ?>">
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">Address</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="address" value="<?php echo $result_room_form[0]['address'] ?>">
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">Advance Payment</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="advance" value="<?php echo $result_room_form[0]['advance_payment'] ?>">
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">Deduction</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <select class="btn btn-primary form-control" name="deduction">
                    <option value="<?php echo $result_room_form[0]['deduction'] ?>"><?php echo $result_room_form[0]['deduction'] ?>%</option>
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
                  <input type="text" class="form-control" name="days_ren" value="<?php echo $result_room_form[0]['days_ren'] ?>">
                </div>
              </div>
            </div>



            <div class="card-footer ">
              <div class="row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-md-10">
                  <input type="submit" class="btn btn-success" value="Update">
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

          <div class="card-body">

            <div class="row">
              <label class="col-sm-2 col-form-label"><b>Name:</b></label>
              <label class="col-sm-10 col-form-label">Name:</label>
            </div>

            <hr>
            <?php
            $days_ren = $result_room_form[0]['days_ren'];
            $bed_cost = $result_room_form[0]['price_bed'];
            $per_cost = $result_room_form[0]['price_person'];
            $room_cost = $result_room_form[0]['price_room'];
            $pwd = $result_room_form[0]['deduction'];
            $adv = $result_room_form[0]['advance_payment'];
            $deduct = $result_room_form[0]['deduction'];

            $total_room_cost = $room_cost * $days_ren;
            $add_bed = $result_room_form[0]['add_bed'];
            $add_per = $result_room_form[0]['add_person'];

            $total_bed = $add_bed * $bed_cost;
            $total_per = $add_per * $per_cost;

            $total_in = $total_bed + $total_per + $total_room_cost;
            $total_deduc = $total_in * ".$deduct";

            $total_balance = $total_in - $total_deduc;


            $total_deduc_all = $total_deduc + $adv;
            $total_bal_all = $total_balance - $adv;

            ?>
            <div class="row">
              <label class="col-sm-3 col-form-label"><b></b></label>
              <label class="col-sm-3 col-form-label"></label>
              <label class="col-sm-3 col-form-label">Unit Cost:</label>
              <label class="col-sm-3 col-form-label">Total Cost:</label>
            </div>

            <div class="row">
              <label class="col-sm-3 col-form-label"><b>Extra Bed</b></label>
              <label class="col-sm-3 col-form-label"><?php echo $add_bed ?></label>
              <label class="col-sm-3 col-form-label">P <?php echo $bed_cost ?></label>
              <label class="col-sm-3 col-form-label">P <?php echo $total_bed ?></label>
            </div>

            <div class="row">
              <label class="col-sm-3 col-form-label"><b>Extra Person</b></label>
              <label class="col-sm-3 col-form-label"><?php echo $add_per ?></label>
              <label class="col-sm-3 col-form-label">P <?php echo $per_cost ?></label>
              <label class="col-sm-3 col-form-label">P <?php echo $total_per ?></label>
            </div>

            <div class="row">
              <label class="col-sm-3 col-form-label"><b>Double Extra family Room</b></label>
              <label class="col-sm-3 col-form-label"><?php echo $days_ren ?> Day/s</label>
              <label class="col-sm-3 col-form-label"><?php echo $room_cost ?></label>
              <label class="col-sm-3 col-form-label">P <?php echo $total_room_cost ?></label>
            </div>

            <hr>
            <div class="row">
              <label class="col-sm-3 col-form-label"></label>
              <label class="col-sm-3 col-form-label"><b>Total:</b></label>
              <label class="col-sm-3 col-form-label"></label>
              <label class="col-sm-3 col-form-label">P <?php echo $total_in ?></label>
            </div>
            <hr>

            <div class="row">
              <label class="col-sm-3 col-form-label"><b>Advance Payment</b></label>
              <label class="col-sm-3 col-form-label"></label>
              <label class="col-sm-3 col-form-label"></label>
              <label class="col-sm-3 col-form-label">P -<?php echo $adv ?></label>
            </div>

            <div class="row">
              <label class="col-sm-3 col-form-label"><b>PWD/Senior</b></label>
              <label class="col-sm-3 col-form-label"></label>
              <label class="col-sm-3 col-form-label"></label>
              <label class="col-sm-3 col-form-label">P -<?php echo $total_deduc ?></label>
            </div>
            <hr>

            <div class="row">
              <label class="col-sm-3 col-form-label"></label>
              <label class="col-sm-3 col-form-label"><b>Total Deduction:</b></label>
              <label class="col-sm-3 col-form-label"></label>
              <label class="col-sm-3 col-form-label">P <?php echo $total_deduc_all ?></label>
            </div>

            <div class="row">
              <label class="col-sm-3 col-form-label"></label>
              <label class="col-sm-3 col-form-label"><b>Total Balance:</b></label>
              <label class="col-sm-3 col-form-label"></label>
              <label class="col-sm-3 col-form-label">P <?php echo $total_bal_all ?></label>
            </div>

            <div class="card-footer ">
              <div class="row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-md-10">
                  <input type="submit" class="btn btn-success" value="Check Out">

                  <!-- <button type="submit" class="btn btn-info btn-round">Sign in</button> -->
                </div>
              </div>
            </div>


          </div>


        </div>
      </div>