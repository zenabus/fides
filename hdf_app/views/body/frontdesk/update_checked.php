<script type="text/javascript">
  //window.location.reload();
  window.onload = function() {
    if (!window.location.hash) {
      window.location = window.location + '#loaded';
      window.location.reload();
    }
  }
</script>

<?php if ($result_room_form[0]['status'] == 'Locked1') {
  redirect('main/ListOfCheckedIn');
} ?>

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
      <h5><b>BOOKINGS</b></h5>
      <div class="card ">
        <div class="card-header ">
          <div class="timeline-heading">
            <!-- <span class="badge badge-pill badge-danger">Add a Room</span> -->
            <a href="" class="btn btn-primary btn-icon btn-sm" data-toggle="modal" data-target="#charges"><i class="fa fa-coffee"></i></a>
            <a href="" class="btn btn-primary btn-icon btn-sm" data-toggle="modal" data-target="#chargesAmen"><i class="fa fa-bookmark"></i></a>
            <!-- 
                           <?php //if ($result_room_form[0]['status_payment'] == 'Unpaid') { 
                            ?> 

                         <button class="float-right btn btn-primary "  href="#"  rel="tooltip" data-toggle="modal" data-target="#ModalRoom5" class="editRoom btn-icon btn-sm " data-toggle="tooltip"><i class="nc-icon nc-simple-add"></i></button>

                          <?php //} 
                          ?>

                         <a class="float-right btn btn-primary"  href="#"  rel="tooltip" data-toggle="modal" data-target="#ModalRoom4" class="btn-icon btn-sm " data-toggle="tooltip"><i class="fa fa-exclamation-circle"></i></a> -->

          </div>
        </div>
        <div class="card-body ">
          <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Room Type</th>
                <th>Room Number</th>

                <th class="text-center">Status</th>
                <th colspan="3" class="text-center">Action</th>
              </tr>
            </thead>

            <tbody>

              <?php foreach ($result_room_checked as $data) {

                # code...

              ?>

                <tr>
                  <?php if ($connect_book[0]['name'] == 'Reserve') {
                    $status = "<span class='badge badge-info'>Reserve</span>";
                  } elseif ($connect_book[0]['name'] == 'Confirmed') {
                    $status = "<span class='badge badge-success'>Confirm</span>";
                  } elseif ($connect_book[0]['name'] == 'Check-In') {
                    $status = "<span class='badge badge-danger'>Check In</span>";
                  } elseif ($connect_book[0]['name'] == 'Check-Out') {
                    $status = "<span class='badge badge-default'>Check Out</span>";
                  } else {
                    $status = "";
                  }

                  if ($connect_book[0]['type'] == '11') {
                    $RT = "Executive Room / Family Room";
                  } elseif ($connect_book[0]['type'] == '12') {
                    $RT = "Deluxe (Twin)";
                  } elseif ($connect_book[0]['type'] == '13') {
                    $RT = "Executive Suite";
                  } elseif ($connect_book[0]['type'] == '14') {
                    $RT = "Seaside Suite (King)";
                  } elseif ($connect_book[0]['type'] == '15') {
                    $RT = "Deluxe (King)";
                  } elseif ($connect_book[0]['type'] == '16') {
                    $RT = "Seaside Suite Twin";
                  } else {
                    $RT = "";
                  }

                  ?>
                  <td><?php echo $RT ?>
                  <td><?php echo $connect_book[0]['label'] ?> <?php //echo $connect_book[0]['rooms_id'] 
                                                              ?> <?php //echo $connect_book[0]['status'] 
                                                                                                            ?></td>

                  <td class="text-center"><?php echo $status //$connect_book[0]['name'] 
                                          ?></td>
                  <?php if ($connect_book[0]['name'] == 'Check-Out') {
                    $this->db->query('update rooms set status_by_room="Checkout" where room_number="' . $connect_book[0]['label'] . '"');
                    $this->db->query('update rooms_booking set status="3" where id="' . $connect_book[0]['rooms_id'] . '"');
                  } ?>

                  <?php if ($connect_book[0]['name'] == 'Check-In') {
                    $this->db->query('update rooms set status_by_room="Checkin" where room_number="' . $connect_book[0]['label'] . '"');
                    $this->db->query('update rooms_booking set status="5" where id="' . $connect_book[0]['rooms_id'] . '"');
                  } ?>

                  </span>

                  <td class="td-actions text-center">
                    <form action="<?php echo base_url() ?>index.php/main/deleteChecked" method="post">
                      <a data-date="<?php echo $data['check_in_date'] ?> - <?php echo $data['check_out_date'] ?>" data-room-type="<?php echo $data['room_type_id'] ?>" data-room-id="<?php echo $data['id_rooms'] ?>" data-room-number="<?php echo $data['room_number'] ?>" data-add-person="<?php echo $data['add_person'] ?>" data-breakfast="<?php echo $data['breakfast'] ?>" data-add-bed="<?php echo $data['add_bed'] ?>" data-add-deduction="<?php echo $data['dedeuction'] ?>" href="#" rel="tooltip" data-toggle="modal" data-target="#ModalRoom" class="editRoom btn btn-success btn-icon btn-sm " data-toggle="tooltip" data-placement="top" title="Update">

                        <i class="fa fa-edit"></i>&nbsp;</a>

                      <!-- details -->

                      <a data-id="<?php echo $data['id_rooms'] ?>" data-name="<?php echo $data['room_details_name'] ?>" data-contact="<?php echo $data['room_details_contact'] ?>" data-email="<?php echo $data['room_details_email'] ?>" href="#" rel="tooltip" data-toggle="modal" data-target="#ModalRoom2" class="details_room btn btn-info btn-icon btn-sm " data-toggle="tooltip" data-placement="top" title="Details">

                        <i class="fa fa-user"></i>&nbsp;</a>

                      <!-- deduction -->

                      <?php if (!$data['deduction'] == '0') : ?>

                        <a data-id="<?php echo $data['id_rooms'] ?>" data-namedis="<?php echo $data['details_discount_name'] ?>" data-idnum="<?php echo $data['details_discount_id'] ?>" href="#" rel="tooltip" data-toggle="modal" data-target="#ModalRoom3" class="details_deduction btn btn-secondary btn-icon btn-sm " data-toggle="tooltip" data-placement="top" title="Discount Details">
                          <i class="fa fa-edit"></i>&nbsp;</a>

                      <?php endif ?>

                      <input type="hidden" value="<?php echo $result_room_form[0]['id'] ?>" name="redi">
                      <input type="hidden" value="<?php echo $data['id_rooms'] ?>" name="id">
                      <input type="hidden" value="<?php echo $data['room_number'] ?>" name="room_number">

                      <!-- <button type="submit" onclick="return confirm('Are you sure to Cancel??')" class="btn btn-danger btn-icon btn-sm btn-neutral" data-placement="left" title="Cancel" rel="tooltip"><i class="fa fa-times"></i></button> -->

                    </form>
                  </td>

                  <td>
                    <form action="<?php echo base_url('index.php/main/updateStatuschecked') ?>" method="POST">
                      <input type="hidden" value="<?php echo $connect_book[0]['book_id'] ?>" name="id">
                      <input type="hidden" value="<?php echo $lols ?>" name="red_id">
                      <input type="hidden" value="<?php echo $connect_book[0]['label'] ?>" name="room_label">

                      <select class="form-control" required name="status">
                        <option value="">SELECT</option>
                        <!-- <option value="1">Reserve</option>
                                      <option value="2">Confirmed</option>
                                      <option value="3">Check In</option> -->
                        <option value="4">Checkout</option>
                      </select>
                      <input type="submit" value="Update" class="form-control btn btn-success" style="margin-top:5px">
                    </form>
                  </td>
                  <!-- 
                            <td>

                                <form action="<?php echo base_url() ?>index.php/main/checkoutChecked" method="post" onclick="return confirm('Check out this room?')">

                                 <input type="hidden" value="<?php echo $result_room_form[0]['id'] ?>" name="redi">

                                  <input type="hidden" value="<?php echo $data['id_rooms'] ?>" name="id">

                                  <input type="hidden" value="<?php echo $data['room_number'] ?>" name="room_number">

                                  <button type="submit" class="btn btn-warning btn-icon btn-sm btn-danger" data-placement="right" title="Check Out" rel="tooltip"><i class="fa fa-edit"></i></button>

              
                                </form> 

                            </td> -->

                  </td>
                </tr>

              <?php } ?>

            </tbody>
          </table>
        </div>
      </div>

      <?php //$date = new \DateTime();
      // //echo date_format($date, 'Y-m-d H:i:s');
      // #output: 2012-03-24 17:45:12

      // echo $sdate = date_format($date, 'G:ia'); echo "<br>";

      //   if ($sdate == "11:19am") {
      //     echo "dabs";
      //   }



      //               $sdate = date_format($date, 'G:ia');

      //                 if ($sdate >= "10:00am" && $sdate <= "1:00am") {
      //                   echo "dabs";
      //                 }

      ?>
      <div class="card ">
        <div class="card-header ">
          <div class="timeline-heading">
            <span class="badge badge-pill badge-danger">Information Details</span>
          </div>
        </div>

        <div class="card-body ">

          <div class="row">
            <div class="col-sm-12">
              <label class="form-label">Check-In and Check-Out Date(s)</label>
              <div class="form-group">
                <?php
                $date1 = $connect_book[0]['start_date'];
                $date2 = $connect_book[0]['end_date'];
                $start = new DateTime($date1);
                $end = new DateTime($date2);
                $diff = $start->diff($end);
                $days_ren = $diff->format('%r%a');

                //echo $current_date = date("m/d/Y");
                ?>

                <form action="<?php echo base_url('index.php/main/updateReservationsDateToextend') ?>" method="post">
                  <input type="hidden" name="rm" value="<?php echo $connect_book[0]['room'] ?>">
                  <input type="hidden" name="id" value="<?php echo $connect_book[0]['book_id'] ?>">
                  <input type="hidden" name="redi" value="<?php echo $result_room_form[0]['id'] ?>">
                  <div class="col-lg-12">
                    <div class="col-lg-4" style="float: left">
                      <label class="form-label">Check-In</label>
                      <input type="text" class="form-control datepicker" value="<?php echo $date1; ?>" name="ci"><br>
                    </div>
                    <div class="col-lg-4" style="float: left">
                      <label class="form-label">Check-Out</label>
                      <input type="text" class="form-control datepicker" value="<?php echo $date2; ?>" name="co"><br>
                    </div>
                    <?php if ($result_room_form[0]['status_payment'] == 'Paid') { ?>
                      <div class="col-lg-4" style="float: left">
                        <input type="submit" class="btn btn-primary" disabled value="Update" style="margin-top: 24px">
                      </div>
                    <?php } else { ?>
                      <div class="col-lg-4" style="float: left">
                        <input type="submit" class="btn btn-primary" value="Update" style="margin-top: 24px">
                      </div>
                    <?php } ?>

                </form>
                <form action="<?php echo base_url() ?>index.php/main/checkingInUpdate" method="post" class="form-horizontal">
                  <input type="hidden" name="connect" value="<?php echo $result_room_form[0]['connect_booking']  ?>">
                  <input type="hidden" value="<?php echo $result_room_form[0]['id'] ?>" name="check_in_id">

              </div>
            </div>
          </div>
        </div>
        <hr>
        <hr>
        <div class="row">
          <div class="col-sm-12">
            <label class="form-label">Last Name / Company Name</label>
            <div class="form-group">
              <?php if ($result_room_form[0]['status_payment'] == 'Paid') { ?>
                <input type="text" class="form-control" name="" value="<?php echo $result_room_form[0]['last_name'] ?>" disabled>

                <input type="hidden" class="form-control" name="last_name" value="<?php echo $result_room_form[0]['last_name'] ?>">
              <?php } else { ?>
                <input type="text" class="form-control" name="last_name" value="<?php echo $result_room_form[0]['last_name'] ?>">
              <?php } ?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <label class="form-label">First Name / Company Name</label>
            <div class="form-group">
              <?php if ($result_room_form[0]['status_payment'] == 'Paid') { ?>
                <input type="text" class="form-control" name="" value="<?php echo $result_room_form[0]['first_name'] ?>" disabled>

                <input type="hidden" class="form-control" name="first_name" value="<?php echo $result_room_form[0]['first_name'] ?>" disabled>
              <?php } else { ?>
                <input type="text" class="form-control" name="first_name" value="<?php echo $result_room_form[0]['first_name'] ?>">
              <?php } ?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <label class="form-label">Middle Name / Company Name</label>
            <div class="form-group">
              <?php if ($result_room_form[0]['status_payment'] == 'Paid') { ?>
                <input type="text" class="form-control" name="" value="<?php echo $result_room_form[0]['middle_name'] ?>" disabled>

                <input type="hidden" class="form-control" name="middle_name" value="<?php echo $result_room_form[0]['middle_name'] ?>">
              <?php } else { ?>
                <input type="text" class="form-control" name="middle_name" value="<?php echo $result_room_form[0]['middle_name'] ?>">
              <?php } ?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <label class="form-label">Contact Number</label>
            <div class="form-group">
              <?php if ($result_room_form[0]['status_payment'] == 'Paid') { ?>
                <input type="text" class="form-control" required="true" name="" value="<?php echo $result_room_form[0]['contact'] ?>" disabled>

                <input type="hidden" class="form-control" required="true" name="contact" value="<?php echo $result_room_form[0]['contact'] ?>">
              <?php } else { ?>
                <input type="text" class="form-control" required="true" name="contact" value="<?php echo $result_room_form[0]['contact'] ?>">
              <?php } ?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <label class="form-label">E-mail</label>
            <div class="form-group">
              <?php if ($result_room_form[0]['status_payment'] == 'Paid') { ?>
                <input type="text" class="form-control" name="" value="<?php echo $result_room_form[0]['email'] ?>" disabled>
                <input type="hidden" class="form-control" name="email" value="<?php echo $result_room_form[0]['email'] ?>">
              <?php } else { ?>
                <input type="text" class="form-control" name="email" value="<?php echo $result_room_form[0]['email'] ?>">
              <?php } ?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <label class="form-label">Address</label>
            <div class="form-group">
              <?php if ($result_room_form[0]['status_payment'] == 'Paid') { ?>
                <input type="text" class="form-control" name="" value="<?php echo $result_room_form[0]['address'] ?>" disabled>
                <input type="hidden" class="form-control" name="address" value="<?php echo $result_room_form[0]['address'] ?>">
              <?php } else { ?>
                <input type="text" class="form-control" name="address" value="<?php echo $result_room_form[0]['address'] ?>">
              <?php } ?>
            </div>
          </div>
        </div>



        <div class="row">
          <div class="col-sm-12">
            <label class="form-label">Refund Amount</label>
            <div class="form-group">
              <?php if ($result_room_form[0]['status_payment'] == 'Paid') { ?>
                <input type="number" class="form-control" name="ref_amount" value="<?php echo $result_room_form[0]['refund_amount'] ?>">

              <?php } else { ?>

                <input type="number" class="form-control" name="ref_amount" value="<?php echo $result_room_form[0]['refund_amount'] ?>">

              <?php } ?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <label class="form-label">Advance Payment (<b>CASH</b>)</label>
            <div class="form-group">
              <?php if ($result_room_form[0]['status_payment'] == 'Paid') { ?>
                <input type="number" class="form-control" name="" value="<?php echo $result_room_form[0]['advance_payment'] ?>" disabled>
                <input type="hidden" class="form-control" name="advance" value="<?php echo $result_room_form[0]['advance_payment'] ?>">
              <?php } else { ?>

                <input type="number" class="form-control" name="advance" value="<?php echo $result_room_form[0]['advance_payment'] ?>">

              <?php } ?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <label class="form-label">Advance Payment (<b>CARD</b>)</label>
            <div class="form-group">
              <?php if ($result_room_form[0]['status_payment'] == 'Paid') { ?>
                <input type="number" class="form-control" name="" value="<?php echo $result_room_form[0]['card_advance'] ?>" disabled>
                <input type="hidden" class="form-control" name="card_advance" value="<?php echo $result_room_form[0]['card_advance'] ?>">
              <?php } else { ?>

                <input type="number" class="form-control" name="card_advance" value="<?php echo $result_room_form[0]['card_advance'] ?>">

              <?php } ?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <label class="form-label">Card Account Number</label>
            <div class="form-group">
              <?php if ($result_room_form[0]['status_payment'] == 'Paid') { ?>
                <input type="" class="form-control" name="" value="<?php echo $result_room_form[0]['card_number'] ?>" disabled>

                <input type="hidden" class="form-control" name="card_number" value="<?php echo $result_room_form[0]['card_number'] ?>">
              <?php } else { ?>
                <input type="" class="form-control" name="card_number" value="<?php echo $result_room_form[0]['card_number'] ?>" placeholder="XXXX XXXX XXXX XXXX">
              <?php } ?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <label class="form-label">Card Account Name</label>
            <div class="form-group">
              <?php if ($result_room_form[0]['status_payment'] == 'Paid') { ?>
                <input type="" class="form-control" name="" value="<?php echo $result_room_form[0]['card_name'] ?>" disabled>
                <input type="hidden" class="form-control" name="card_name" value="<?php echo $result_room_form[0]['card_name'] ?>">
              <?php } else { ?>
                <input type="" class="form-control" name="card_name" value="<?php echo $result_room_form[0]['card_name'] ?>" placeholder="eg: Juan Dela Cruz">
              <?php } ?>
            </div>
          </div>
        </div>

        <?php

        // echo $lols;

        ?>


        <div class="row">
          <div class="col-sm-12">
            <!--  <label class="form-label">Amenities Name</label> -->
            <div class="form-group">
              <?php if ($result_room_form[0]['status_payment'] == 'Paid') { ?>
                <input type="hidden" class="form-control" name="" value="<?php echo $result_room_form[0]['amenities_name'] ?>" disabled>
                <input type="hidden" class="form-control" name="amen_name" value="<?php echo $result_room_form[0]['amenities_name'] ?>">
              <?php } else { ?>
                <input type="hidden" class="form-control" name="amen_name" value="<?php echo $result_room_form[0]['amenities_name'] ?>">
              <?php } ?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <!-- <label class="form-label">Total Amenities Amount</label> -->
            <div class="form-group">
              <?php if ($result_room_form[0]['status_payment'] == 'Paid') { ?>
                <input type="hidden" class="form-control" name="" value="<?php echo $result_room_form[0]['amenities_amount'] ?>" disabled>
                <input type="hidden" class="form-control" name="amen_amount" value="<?php echo $result_room_form[0]['amenities_amount'] ?>">
              <?php } else { ?>

                <input type="hidden" class="form-control" name="amen_amount" value="<?php echo $result_room_form[0]['amenities_amount'] ?>">

              <?php } ?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <!--  <label class="form-label">Coffee Shop Charge</label> -->
            <div class="form-group">
              <?php if ($result_room_form[0]['status_payment'] == 'Paid') { ?>
                <input type="hidden" class="form-control" name="" value="<?php echo $result_room_form[0]['coffee_charge'] ?>" disabled>

                <input type="hidden" class="form-control" name="coffee_charge" value="<?php echo $result_room_form[0]['coffee_charge'] ?>">
              <?php } else { ?>

                <input type="hidden" class="form-control" name="coffee_charge" value="<?php echo $result_room_form[0]['coffee_charge'] ?>">

              <?php } ?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <!-- <label class="form-label">Restaurant Charge</label> -->
            <div class="form-group">
              <?php if ($result_room_form[0]['status_payment'] == 'Paid') { ?>
                <input type="hidden" class="form-control" name="resto_charge" value="<?php echo $result_room_form[0]['res_charge'] ?>">
              <?php } else { ?>

                <input type="hidden" class="form-control" name="resto_charge" value="<?php echo $result_room_form[0]['res_charge'] ?>">

              <?php } ?>
            </div>
          </div>
        </div>

        <div class="card-footer ">
          <div class="row">
            <label class="col-sm-2 col-form-label"></label>
            <div class="col-md-12">
              <?php if ($result_room_form[0]['status'] == 'Locked') { ?>
                <input type="submit" class="btn btn-success" value="Add Refund Amount">
              <?php } else { ?>
                <?php if ($result_room_form[0]['status_payment'] == 'Paid') { ?>
                  <a id="<?php echo base_url('index.php/main/frontdeskLock/' . $result_room_form[0]['id']) ?>" class="lock btn btn-info text-light">
                    Lock</a>
                  <input type="submit" class="btn btn-success" value="Add Refund Amount">
                <?php } else { ?>
                  <input type="submit" class="btn btn-success" value="Update">
                  <input type="reset" class="btn btn-info " value="Clear">
                <?php } ?>
                <button class="btn btn-success text-light" onclick="popupCenter('<?php echo base_url('index.php/main/printForm/' . $lols) ?>',  'myPop1', 600,600); return false;">Print Form </button>
                <!-- <button type="submit" class="btn btn-info btn-round">Sign in</button> -->
              <?php   } ?>
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
          <span class="badge badge-pill badge-danger">Collection Details</span>
        </div>
      </div>
      <div class="card-body ">
        <div class="row">
          <label class="col-sm-3 col-form-label"><b>ROOM #</b></label>
          <label class="col-sm-3 col-form-label"></label>
          <label class="col-sm-3 col-form-label"><b>UNIT COST</b></label>
          <label class="col-sm-3 col-form-label"><b>TOTAL COST</b></label>
        </div>
        <hr>
        <?php
        foreach ($result_room_checked as $data) {
          $date1 = $connect_book[0]['start_date'];
          $date2 = $connect_book[0]['end_date'];
          $start = new DateTime($date1);
          $end = new DateTime($date2);
          $diff = $start->diff($end);
          $days_ren = $diff->format('%r%a');
          $update_price_rooms = $this->db->query('select * from room_type where id="' . $connect_book[0]['type'] . '"');
          $price_per_room_type = "";
          if ($update_price_rooms->num_rows() > 0) {
            $row = $update_price_rooms->row();
            $price_per_room_type = $row->pricing_type;
          }

          $id = $data['id_rooms'];
          $breakfast = $data['breakfast_id'];
          $price_room = $price_per_room_type + $breakfast;
          $price_room_days = $price_room * $days_ren;
          $price_person = $data['price_person'];
          $add_person = $data['add_person'];
          $total_person = $price_person * $add_person;
          $price_bed = $data['price_bed'];
          $add_bed = $data['add_bed'];
          $total_bed = $price_bed * $add_bed;
          $deduction = $data['name'];
          $ded_percent = $data['price_deduct'];
          $price_amen_amount = $result_room_form[0]['amenities_amount'];
          $price_ref_amount = $result_room_form[0]['refund_amount'];
          $price_resto_charge = $result_room_form[0]['res_charge'];
          $price_coffe_charge = $result_room_form[0]['coffee_charge'];
          $card_advance = $result_room_form[0]['card_advance'];
          // if (empty($price_resto_charge)) {
          //   # code...
          // }
          //echo "<br>";

          //echo "<br>";
          //$total_in = $total_person + $total_bed + $price_room_days + $price_amen_amount;
          $total_percent = $price_room_days * ".$ded_percent";
          $resamount = $data['restaurant_amount'];
          $cofamount = $data['cof_amount'];
          /////////////////
          ///update 2.0///////
          $total_charge_resto['restoTotal'];
          $total_charge_coffee['cofTotal'];
          $total_charge_amen['AmTotal'];
          $total_in = $total_person + $total_bed + $price_room_days + $price_amen_amount + $total_charge_resto['restoTotal'] + $total_charge_coffee['cofTotal'] + $total_charge_amen['AmTotal'];;
          //////////////////
          ///end update 2.0//
          $total_in_all = ($total_in - $total_percent) + $cofamount + $resamount;

          //echo $connect_book[0]['type'];

          $this->db->query('update rooms_checked set price_room="' . $price_per_room_type . '",total_balance="' . $total_in_all . '" where id_rooms="' . $id . '"');

          //$this->db->query('update rooms_checked set total_balance="'.$total_in_all.'" where id_rooms="'.$id.'"'); 

        ?>

          <div class="row">
            <label class="col-sm-3 col-form-label"><strong><?php echo $data['room_number'] ?></strong></label>
            <label class="col-sm-3 col-form-label"><b style="color:red">(<?php echo $days_ren ?>)</b> <strong>Day(s)</strong></label>
            <label class="col-sm-3 col-form-label"><strong>P <?php echo number_format($price_room, 2) ?></strong></label>
            <label class="col-sm-3 col-form-label"><strong>P <?php echo number_format("$price_room_days", 2) ?></strong></label>
            <!-- <label class="col-sm-3 col-form-label"><strong>P <?php echo $price_room_days ?></strong></label>  -->
          </div>

          <div class="row">
            <label class="col-sm-3 col-form-label"><strong>Discount(s)</strong></label>
            <label class="col-sm-3 col-form-label"><strong><?php echo $deduction ?></strong></label>
            <label class="col-sm-3 col-form-label"><strong><?php echo $ded_percent ?> %</strong></label>
            <label class="col-sm-3 col-form-label"><strong>P -<?php echo number_format("$total_percent", 2) ?></strong></label>
            <!-- <label class="col-sm-3 col-form-label"><strong>P -<?php echo $total_percent ?></strong></label>  -->
          </div>

          <div class="row">
            <label class="col-sm-3 col-form-label"></label>
            <label class="col-sm-3 col-form-label"><b style="color:red">(<?php echo $add_bed ?>)</b> <strong>Extra Bed(s)</strong></label>
            <label class="col-sm-3 col-form-label"><strong>P <?php echo number_format($data['price_bed'], 2) ?></strong></label>
            <label class="col-sm-3 col-form-label"><strong>P <?php echo number_format("$total_bed", 2) ?></strong></label>
            <!-- <label class="col-sm-3 col-form-label"><strong>P <?php echo $total_bed ?></strong></label>    -->
          </div>

          <div class="row">
            <label class="col-sm-3 col-form-label"></label>
            <label class="col-sm-3 col-form-label"><b style="color:red">(<?php echo $add_person ?>)</b> <strong>Extra Person(s)</strong></label>
            <label class="col-sm-3 col-form-label"><strong>P <?php echo number_format($data['price_person'], 2) ?></strong></label>
            <label class="col-sm-3 col-form-label"><strong>P <?php echo number_format("$total_person", 2) ?></strong></label>
            <!-- <label class="col-sm-3 col-form-label"><strong>P <?php echo $total_bed ?></strong></label>    -->
          </div>

          <!--  <div class="row">
                              <label class="col-sm-3 col-form-label"></label>
                              <label class="col-sm-3 col-form-label"><b style="color:red"></b> <strong>Amenities</strong></label>   
                              <label class="col-sm-3 col-form-label"><strong>P <?php //echo number_format($result_room_form[0]['amenities_amount'],2) 
                                                                                ?></strong></label>
                              <label class="col-sm-3 col-form-label"><strong>P <?php //echo number_format($result_room_form[0]['amenities_amount'],2) 
                                                                                ?></strong></label>
                               <label class="col-sm-3 col-form-label"><strong>P <?php //echo $total_person 
                                                                                ?></strong></label>    -->
          <!-- </div> -->

          <!-- <div class="row">
                              <label class="col-sm-3 col-form-label"><strong>Charge To:</strong></label>
                              <label class="col-sm-3 col-form-label"><strong>Restaurant</strong></label>   
                              <label class="col-sm-3 col-form-label"><strong></strong></label>
                              <label class="col-sm-3 col-form-label"><strong>P <?php //echo number_format($price_resto_charge,2) 
                                                                                ?></strong></label>   
                            </div>

                            <div class="row">
                              <label class="col-sm-3 col-form-label"><strong>Charge To:</strong></label>
                              <label class="col-sm-3 col-form-label"><strong>Coffee Shop</strong></label>   
                              <label class="col-sm-3 col-form-label"><strong></strong></label>
                              <label class="col-sm-3 col-form-label"><strong>P <?php //echo number_format($price_coffe_charge,2) 
                                                                                ?></strong></label>   
                            </div> -->
          <!-- /////////update 2.0//////// -->
          <?php if (!empty($get_charge_amen)) : ?>
            <?php foreach ($get_charge_amen as $rowamen) { ?>
              <div class="row">
                <label class="col-sm-3 col-form-label"><strong></strong></label>
                <label class="col-sm-3 col-form-label"><strong><?php echo $rowamen['amen_name'] ?></strong></label>
                <label class="col-sm-3 col-form-label"><strong></strong></label>
                <label class="col-sm-2 col-form-label"><strong>P <?php echo number_format($rowamen['amen_amount'] * $rowamen['amen_qty'], 2) ?></strong></label>
                <?php if ($result_room_form[0]['status_payment'] == 'Paid') { ?>


                <?php } else { ?>
                  <label class="col-sm-1 col-form-label"><strong><a id="<?php echo base_url('index.php/main/cancelChargeAmen/' . $rowamen['amen_id'] . 'Z' . $result_room_form[0]['id'] . 'Z' . $rowamen['amen_name']) ?>" style="cursor: pointer;" class="cancel"><i class="fa fa-times text-danger"></i></a></strong></label>
                <?php } ?>
              </div>
            <?php } ?>
          <?php endif ?>


          <?php if (!empty($get_charge_resto)) : ?>
            <?php foreach ($get_charge_resto as $rowrest) { ?>
              <div class="row">
                <label class="col-sm-3 col-form-label"><strong></strong></label>
                <label class="col-sm-3 col-form-label"><strong><?php echo $rowrest['charge_name'] ?></strong></label>
                <label class="col-sm-3 col-form-label"><strong></strong></label>
                <label class="col-sm-2 col-form-label"><strong>P <?php echo number_format($rowrest['charge_amount'], 2) ?></strong></label>
                <?php if ($result_room_form[0]['status_payment'] == 'Paid') { ?>

                <?php } else { ?>
                  <label class="col-sm-1 col-form-label"><strong><a id="<?php echo base_url('index.php/main/cancelChargeFoResCof/' . $rowrest['charge_id'] . 'H' . $result_room_form[0]['id']) ?>" style="cursor: pointer;" class="cancel"><i class="fa fa-times text-danger"></i></a></strong></label>
                <?php } ?>
              </div>
            <?php } ?>
          <?php endif ?>


          <?php if (!empty($get_charge_coffee)) : ?>
            <?php foreach ($get_charge_coffee as $rowcoff) { ?>
              <div class="row">
                <label class="col-sm-3 col-form-label"><strong></strong></label>
                <label class="col-sm-3 col-form-label"><strong><?php echo $rowcoff['charge_name'] ?></strong></label>
                <label class="col-sm-3 col-form-label"><strong></strong></label>
                <label class="col-sm-2 col-form-label"><strong>P <?php echo number_format($rowcoff['charge_amount'], 2) ?></strong></label>
                <?php if ($result_room_form[0]['status_payment'] == 'Paid') { ?>

                <?php } else { ?>
                  <label class="col-sm-1 col-form-label"><strong><a id="<?php echo base_url('index.php/main/cancelChargeFoResCof/' . $rowcoff['charge_id'] . 'H' . $result_room_form[0]['id']) ?>" class="cancel" style="cursor: pointer;"><i class="fa fa-times text-danger"></i></a></strong></label>
                <?php } ?>
              </div>
            <?php } ?>
          <?php endif ?>

          <!-- ////end update 2.0 /////// -->

          <!-- if restaurant -->

          <?php if (!empty($data['restaurant_charge'])) : ?>

            <div class="row">
              <label class="col-sm-3 col-form-label"><strong>Charge To:</strong></label>
              <label class="col-sm-3 col-form-label"><strong>Restaurant</strong></label>
              <label class="col-sm-3 col-form-label"><strong></strong></label>
              <label class="col-sm-3 col-form-label"><strong>P <?php echo number_format($data['restaurant_amount'], 2) ?></strong></label>
            </div>

          <?php endif ?>

          <?php if (!empty($data['cof_charge'])) : ?>

            <div class="row">
              <label class="col-sm-3 col-form-label"><strong>Charge To:</strong></label>
              <label class="col-sm-3 col-form-label"><strong>Coffee</strong></label>
              <label class="col-sm-3 col-form-label"><strong></strong></label>
              <label class="col-sm-3 col-form-label"><strong>P <?php echo number_format($data['cof_amount'], 2) ?></strong></label>
            </div>

          <?php endif ?>

          <!-- end if -->

          <hr>

          <div class="row">
            <label class="col-sm-3 col-form-label"><strong></strong></label>
            <label class="col-sm-3 col-form-label"><strong></strong></label>
            <label class="col-sm-3 col-form-label"><strong>TOTAL</strong></label>
            <label class="col-sm-3 col-form-label"><b style="color:red">P <?php echo number_format("$total_in_all", 2) ?></b></label>
            <!-- <label class="col-sm-3 col-form-label"><b style="color:red">P <?php echo $total_in_all ?></b></label>   -->
          </div>

          <hr>

        <?php }

        $advance = $result_room_form[0]['advance_payment'];
        $amen = $result_room_form[0]['amenities_amount'];

        $total_balance_input = $result_total[0]['total'] - $advance - $price_ref_amount - $card_advance;

        ?>

        <hr>

        <div class="row">
          <label class="col-sm-3 col-form-label"><strong></strong></label>
          <label class="col-sm-3 col-form-label"><strong></strong></label>
          <label class="col-sm-3 col-form-label"><strong>REFUND AMOUNT</strong></label>
          <label class="col-sm-3 col-form-label"><strong>P -<?php echo number_format("$price_ref_amount", 2) ?></strong></label>
          <!-- <label class="col-sm-3 col-form-label"><strong>P -<?php echo $advance ?></strong></label>     -->
        </div>

        <div class="row">
          <label class="col-sm-3 col-form-label"><strong></strong></label>
          <label class="col-sm-3 col-form-label"><strong></strong></label>
          <label class="col-sm-3 col-form-label"><strong>ADVANCE PAYMENT CASH</strong></label>
          <label class="col-sm-3 col-form-label"><strong>P -<?php echo number_format("$advance", 2) ?></strong></label>
          <!-- <label class="col-sm-3 col-form-label"><strong>P -<?php echo $advance ?></strong></label>     -->
        </div>

        <div class="row">
          <label class="col-sm-3 col-form-label"><strong></strong></label>
          <label class="col-sm-3 col-form-label"><strong></strong></label>
          <label class="col-sm-3 col-form-label"><strong>ADVANCE PAYMENT CARD</strong></label>
          <label class="col-sm-3 col-form-label"><strong>P -<?php echo number_format($card_advance, 2) ?></strong></label>
        </div>

        <hr>

        <?php if (!empty($result_restaurant_charge)) { ?>

          <div class="row">
            <label class="col-sm-3 col-form-label"> <?php if ($result_room_form[0]['status_payment'] == 'Unpaid') { ?>
                <a href="" data-tamount="<?php echo $total_balance_input ?>" data-ad_card="<?php echo $advance ?>" data-ad_cash="<?php echo $card_advance ?>" data-toggle="modal" data-target="#Complete" class="complete btn btn-primary">Complete Checkout</a>

              <?php } else { ?>

                <h1 class="btn btn-danger">Paid</h1>

              <?php } ?>

            </label>

            <label class="col-sm-3 col-form-label"><strong></strong></label>
            <label class="col-sm-3 col-form-label"><strong>TOTAL BALANCE</strong></label>
            <label class="col-sm-3 col-form-label"><b style="color:red">P <?php echo number_format("$total_balance_input", 2) ?> </b></label>
            <!-- <label class="col-sm-3 col-form-label"><b style="color:red">P <?php echo $total_balance_input ?> </b></label>   -->

          </div>

        <?php } else { ?>

          <div class="row">
            <label class="col-sm-3 col-form-label"> <?php if ($result_room_form[0]['status_payment'] == 'Unpaid') { ?>
                <a href="" data-tamount="<?php echo $total_balance_input ?>" data-ad_card="<?php echo $advance ?>" data-ad_cash="<?php echo $card_advance ?>" data-toggle="modal" data-target="#Complete" class="complete btn btn-primary">Complete Order</a>

              <?php } else { ?>

                <h1 class="btn btn-danger">Paid</h1>

              <?php } ?>

            </label>

            <label class="col-sm-3 col-form-label"><strong></strong></label>
            <label class="col-sm-3 col-form-label"><strong>TOTAL BALANCE</strong></label>
            <label class="col-sm-3 col-form-label"><b style="color:red">P <?php echo number_format("$total_balance_input", 2) ?> </b></label>
            <!-- <label class="col-sm-3 col-form-label">P <b style="color:red"><?php echo $total_balance_input ?> </b></label>  -->

          </div>

        <?php } ?>
        <label>Notes</label>
        <form action="<?php echo base_url('index.php/main/updateNotes') ?>" method="post">
          <input type="hidden" value="<?php echo $result_room_form[0]['id'] ?>" name="check_in_id">
          <textarea class="form-control" name="notes"><?php echo $result_room_form[0]['notes'] ?></textarea>
          <?php if ($result_room_form[0]['status'] == 'Locked') {
          } else { ?>
            <input type="submit" value="Save Notes" class="btn btn-success" name="">
          <?php   } ?>
        </form>

        <hr>
        <span class="badge badge-pill badge-danger">Frontdesk Logs</span>
        <table id="datatables" class="table table-striped table-bordered" cellspacing="0" width="100%">

          <thead>
            <tr>

              <th>User</th>
              <th>Activity</th>
              <th>Date Modified</th>

            </tr>
          </thead>
          <tbody>
            <?php foreach ($getFrontLogs as $row1) {
              # code...
            ?>
              <tr>
                <td><?php echo $row1['user'] ?></td>
                <td><?php echo str_replace("%20", " ", $row1['content']); ?></td>
                <td><?php echo $row1['date_entered'] ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>

  <div class="modal fade" id="ModalRoom" tabindex="-1" role="dialog" aria-labelledby="roomLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="nc-icon nc-simple-remove"></i>
          </button>
          <h4 class="title title-up" id="LabelRoom">Add Room</h4>
        </div>

        <?php $attributes = array('id' => 'formRoom'); ?>

        <?= form_open('main/insertRoomForCheckIn', $attributes); ?>

        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" value="<?php echo $result_room_form[0]['id'] ?>" name="check_id">
            <input type="hidden" name="room_id" id="room_id">
            <div class="form-group">

              <!-- 
                                <div class="form-group"> 

                                  <label >Checkin-out Date</label>

                                 

                                      <input type="text" class="form-control" name="daterange" id="daterange"  required>

                                    

                                </div> -->



              <!--  <div class="form-group"> 

                                  <label>Room Type</label> 

                                  <select class="form-control" name="room_type" id="room_type" required>

                                    <option value="">Select</option>

                                    <?php //foreach ($result_room_type as $data) {

                                    # code...

                                    ?>

                                    <option value="<? php // echo $data['id'] 
                                                    ?>"><?php echo $data['room_type'] ?></option>

                                    <?php //} 
                                    ?>

                                  </select>

                                </div> 



                                 <div class="form-group"> 

                                  <label>Room Number</label> 

                                  <select class="form-control" name="room_number" id="room_number" required >

                                    <option value="">Select</option>

                                    <?php //foreach ($room_number as $data) {

                                    # code...

                                    ?>

                                    <option id="<?php //echo $data['room_type_id'] 
                                                ?>"><?php //echo $data['room_number'] 
                                                                                        ?></option>

                                    <?php //} 
                                    ?>

                                  </select>

                                </div>  -->


              <input type="hidden" name="room_number" id="room_number">

              <div class="form-group">
                <label>Extra Person(s)</label>
                <input type="number" class="form-control" name="add_person" required id="add_person">
              </div>

              <div class="form-group">
                <label>Extra Bed(s)</label>
                <input type="number" class="form-control" name="add_bed" required id="add_bed">
              </div>

              <div class="form-group">
                <label>Discount Type</label>
                <select class="form-control" name="deduction" id="deduction" required>
                  <option value="">Select</option>
                  <?php foreach ($result_deduction as $data) {

                    # code...

                  ?>
                    <option value="<?php echo $data['id_ded'] ?>"><?php echo $data['name'];
                                                                  echo "-";
                                                                  echo $data['deduction']; ?>%</option>
                  <?php } ?>
                </select>
              </div>

              <div class="form-group">
                <label></label>
                <select style="display: none" class="form-control" name="breakfast" id="breakfasts" required>

                  <!-- <option value="">Select</option>

                                    <option value="0">N/A</option>
 -->
                  <option value="200">With Breakfast</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="left-side">
              <?php if ($result_room_form[0]['status_payment'] == 'Unpaid') { ?>
                <input type="submit" value="Update" class="btn btn-danger btn-link">
              <?php } ?>
            </div>
            <div class="divider"></div>
            <div class="right-side">
              <button type="button" class="btn btn-default btn-link" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>

        <?= form_close() ?>

      </div>
    </div>
  </div>

  <!-- room update -->

  <div class="modal fade" id="ModalRoom5" tabindex="-1" role="dialog" aria-labelledby="roomLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="nc-icon nc-simple-remove"></i>
          </button>
          <h4 class="title title-up" id="LabelRoom">Add Room</h4>
        </div>
        <?php $attributes = array('id' => 'formRoom'); ?>
        <?= form_open('main/insertRoomForCheckIn', $attributes); ?>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" value="<?php echo $result_room_form[0]['id'] ?>" name="check_id">
            <input type="hidden" name="room_id" id="room_id">
            <div class="form-group">

              <div class="form-group">
                <label>Checkin-out Date</label>
                <input type="text" class="form-control" name="daterange" id="daterange" required>
              </div>

              <div class="form-group">
                <label>Room Type</label>
                <select class="form-control" name="room_type" id="room_type1" required>
                  <option value="">Select</option>
                  <?php foreach ($result_room_type as $data) {

                    # code...

                  ?>
                    <option value="<?php echo $data['id'] ?>"><?php echo $data['room_type'] ?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="form-group">
                <label>Room Number</label>
                <select class="form-control" name="room_number" id="room_number1" required>
                  <option value="">Select</option>
                  <?php foreach ($room_number as $data) {

                    # code...

                  ?>
                    <option id="<?php echo $data['room_type_id'] ?>"><?php echo $data['room_number'] ?></option>
                  <?php } ?>
                </select>
              </div>

              <script type="text/javascript">
                $("#room_type1").change(function() {

                  $("#room_number1 option").css({
                    "display": "block"
                  });

                  var val = $("#room_type1").find(":selected").val();
                  $("#room_number1 option[id!=" + val + "]").css({
                    "display": "none"
                  });

                });
              </script>

              <div class="form-group">
                <label>Add Person</label>
                <input type="text" class="form-control" name="add_person" required id="add_person">
              </div>

              <div class="form-group">
                <label>Add Bed</label>
                <input type="text" class="form-control" name="add_bed" required id="add_bed">
              </div>

              <div class="form-group">
                <label>Deduction</label>
                <select class="form-control" name="deduction" id="deduction" required>
                  <option value="">Select</option>
                  <?php foreach ($result_deduction as $data) {

                    # code...

                  ?>
                    <option value="<?php echo $data['id_ded'] ?>"><?php echo $data['name'] ?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="form-group">
                <label>Break Fast</label>
                <select class="form-control" name="breakfast" id="breakfast" required>
                  <option value="">Select</option>
                  <option value="0">N/A</option>
                  <option value="200">With Breakfast</option>
                </select>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <div class="left-side">
              <input type="submit" value="Save" class="btn btn-danger btn-link">
            </div>
            <div class="divider"></div>
            <div class="right-side">
              <button type="button" class="btn btn-default btn-link" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>

        <?= form_close() ?>

      </div>
    </div>
  </div>

  <!-- end room update -->

  <!-- complete details -->

  <div class="modal fade" id="Complete" tabindex="-1" role="dialog" aria-labelledby="roomLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="nc-icon nc-simple-remove"></i>
          </button>
          <h4 class="title title-up" id="LabelRoomComplete">Payment</h4>
        </div>

        <?php $attributes = array('id' => 'formRoomComplete'); ?>
        <?= form_open('', $attributes); ?>

        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" value="<?php echo $days_ren ?>" name="days_ren">
            <input type="hidden" value="<?php echo $date1 ?>" name="date1">
            <input type="hidden" value="<?php echo $date2 ?>" name="date2">
            <label>Payment Type</label>
            <select class="form-control" required onchange="toViewInputifCash(this);" name="type">
              <option value="">Select</option>
              <option value="cash">Cash</option>
              <option value="card">Card</option>
            </select>
          </div>
          <input type="hidden" value="<?php echo $result_room_form[0]['id'] ?>" name="check_id">
          <input type="hidden" id="tamount" name="tamount">
          <input type="hidden" id="ad_card" name="ad_card">
          <input type="hidden" id="ad_cash" name="ad_cash">
          <div class="form-group" id="cardnumber" style="display: none;">
            <label>Card Number</label>
            <input type="number" class="form-control" name="card">
          </div>
          <div class="form-group" id="appcode" style="display: none;">
            <label>Approval Code</label>
            <input type="text" class="form-control" name="appcode">
          </div>
          <div class="form-group">
            <label>Enter Amount</label>
            <input type="number" class="form-control" name="amount">
          </div>
        </div>
        <div class="modal-footer">
          <div class="left-side">
            <input type="submit" value="Proceed" class="btn btn-danger btn-link">
          </div>
          <div class="divider"></div>
          <div class="right-side">
            <button type="button" class="btn btn-default btn-link" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>

<!-- complete details -->

<!-- completed order details -->

<div class="modal fade" id="completed" tabindex="-1" role="dialog" aria-labelledby="roomLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width:650px">
      <div class="modal-header justify-content-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="nc-icon nc-simple-remove"></i>
        </button>
        <h4 class="title title-up" id="LabelRoom">Payment Reciept</h4>
      </div>

      <div class="modal-body">
        <div class="row">
          <label class="col-sm-3 col-form-label"><strong>OR # <b style="color: red;">FHDF <?php echo $id_reports ?></b></strong></label>
        </div>

        <div class="row">
          <label class="col-sm-3 col-form-label"><b>ROOM(S) #</b></label>
          <label class="col-sm-3 col-form-label"></label>
          <label class="col-sm-3 col-form-label"><b>UNIT COST</b></label>
          <label class="col-sm-3 col-form-label"><b>TOTAL COST</b></label>
        </div>

        <hr>

        <?php

        foreach ($result_room_checked as $data) {

          $date1 = $connect_book[0]['start_date'];
          $date2 = $connect_book[0]['end_date'];
          $start = new DateTime($date1);
          $end = new DateTime($date2);
          $diff = $start->diff($end);
          $days_ren = $diff->format('%r%a');
          $id = $data['id_rooms'];
          $breakfast = $data['breakfast_id'];
          $price_room = $data['price_room'] + $breakfast;
          $price_room_days = $price_room * $days_ren;
          $price_person = $data['price_person'];
          $add_person = $data['add_person'];
          $total_person = $price_person * $add_person;
          $price_bed = $data['price_bed'];
          $add_bed = $data['add_bed'];
          $total_bed = $price_bed * $add_bed;
          $deduction = $data['name'];
          $ded_percent = $data['price_deduct'];
          // $total_in = $total_person + $total_bed + $price_room_days +$price_amen_amount +$price_coffe_charge + $price_resto_charge; 
          $total_percent = $price_room_days * ".$ded_percent";
          $resamount = $data['restaurant_amount'];
          $cofamount = $data['cof_amount'];
          $total_in_all = ($total_in - $total_percent) + $resamount + $cofamount;

          // $this->db->query('update rooms_checked set total_balance="'.$total_in_all.'" where id_rooms="'.$id.'"'); 

        ?>

          <div class="row">
            <label class="col-sm-3 col-form-label"><strong><?php echo $data['room_number'] ?></strong></label>
            <!-- <label class="col-sm-3 col-form-label"><strong><?php echo $days_ren ?> Day/s</strong></label>    -->
            <label class="col-sm-3 col-form-label"><b style="color:red">(<?php echo $days_ren ?>)</b> <strong>Night(s)</strong></label>
            <label class="col-sm-3 col-form-label"><strong>P <?php echo number_format("$price_room", 2) ?></strong></label>
            <!-- <label class="col-sm-3 col-form-label">P <?php echo $price_room ?></label> -->
            <label class="col-sm-3 col-form-label"><strong>P <?php echo number_format("$price_room_days", 2) ?></strong></label>
            <!-- <label class="col-sm-3 col-form-label">P <?php echo $price_room_days ?></label>   -->
          </div>

          <div class="row">
            <label class="col-sm-3 col-form-label"><strong>Discount</strong></label>
            <label class="col-sm-3 col-form-label"><strong><?php echo $deduction ?></strong></label>
            <label class="col-sm-3 col-form-label"><strong><?php echo $ded_percent ?> %</strong></label>
            <label class="col-sm-3 col-form-label"><strong>P -<?php echo number_format("$total_percent", 2) ?></strong></label>
          </div>


          <div class="row">
            <label class="col-sm-3 col-form-label"><strong></strong></label>
            <label class="col-sm-3 col-form-label"><strong><b style="color:red">(<?php echo $add_bed ?>)</b> Extra Bed(s)</strong></label>
            <label class="col-sm-3 col-form-label"><strong>P <?php echo number_format($data['price_bed'], 2) ?></strong></label>
            <label class="col-sm-3 col-form-label"><strong>P <?php echo number_format("$total_bed", 2) ?></strong></label>
            <!-- <label class="col-sm-3 col-form-label">P <?php echo $total_bed ?></label>   -->
          </div>

          <div class="row">
            <label class="col-sm-3 col-form-label"></label>
            <label class="col-sm-3 col-form-label"><b style="color:red">(<?php echo $add_person ?>)</b> <strong>Extra Person(s)</strong></label>
            <label class="col-sm-3 col-form-label"><strong>P <?php echo number_format($data['price_person'], 2) ?></strong></label>
            <label class="col-sm-3 col-form-label"><strong>P <?php echo number_format("$total_person", 2) ?></strong></label>
            <!-- <label class="col-sm-3 col-form-label"><strong>P <?php echo $total_bed ?></strong></label>    -->
          </div>

          <!--  <div class="row">
                              <label class="col-sm-3 col-form-label"></label>
                              <label class="col-sm-3 col-form-label"><b style="color:red"></b> <strong>Amenities</strong></label>   
                              <label class="col-sm-3 col-form-label"><strong>P <?php //echo number_format($result_room_form[0]['amenities_amount'],2) 
                                                                                ?></strong></label>
                              <label class="col-sm-3 col-form-label"><strong>P <?php //echo number_format($result_room_form[0]['amenities_amount'],2) 
                                                                                ?></strong></label>
                               <label class="col-sm-3 col-form-label"><strong>P <?php //echo $total_person 
                                                                                ?></strong></label>    -->

          <!-- </div> -->


          <!-- <div class="row">
                              <label class="col-sm-3 col-form-label"><strong>Charge To:</strong></label>
                              <label class="col-sm-3 col-form-label"><strong>Restaurant</strong></label>   
                              <label class="col-sm-3 col-form-label"><strong></strong></label>
                              <label class="col-sm-3 col-form-label"><strong>P <?php //echo number_format($price_resto_charge,2) 
                                                                                ?></strong></label>   
                            </div>

                            <div class="row">
                              <label class="col-sm-3 col-form-label"><strong>Charge To:</strong></label>
                              <label class="col-sm-3 col-form-label"><strong>Coffee Shop</strong></label>   
                              <label class="col-sm-3 col-form-label"><strong></strong></label>
                              <label class="col-sm-3 col-form-label"><strong>P <?php //echo number_format($price_coffe_charge,2) 
                                                                                ?></strong></label>   
                            </div> -->
          <!-- /////////update 2.0//////// -->
          <?php if (!empty($get_charge_amen)) : ?>
            <?php foreach ($get_charge_amen as $rowamen) { ?>
              <div class="row">
                <label class="col-sm-3 col-form-label"><strong></strong></label>
                <label class="col-sm-3 col-form-label"><strong><?php echo $rowamen['amen_name'] ?></strong></label>
                <label class="col-sm-3 col-form-label"><strong></strong></label>
                <label class="col-sm-2 col-form-label"><strong>P <?php echo number_format($rowamen['amen_amount'] * $rowamen['amen_qty'], 2) ?></strong></label>
                <label class="col-sm-1 col-form-label"><strong></strong></label>
              </div>
            <?php } ?>
          <?php endif ?>


          <?php if (!empty($get_charge_resto)) : ?>
            <?php foreach ($get_charge_resto as $rowrest) { ?>
              <div class="row">
                <label class="col-sm-3 col-form-label"><strong></strong></label>
                <label class="col-sm-3 col-form-label"><strong><?php echo $rowrest['charge_name'] ?></strong></label>
                <label class="col-sm-3 col-form-label"><strong></strong></label>
                <label class="col-sm-2 col-form-label"><strong>P <?php echo number_format($rowrest['charge_amount'], 2) ?></strong></label>
                <label class="col-sm-1 col-form-label"><strong></strong></label>
              </div>
            <?php } ?>
          <?php endif ?>


          <?php if (!empty($get_charge_coffee)) : ?>
            <?php foreach ($get_charge_coffee as $rowcoff) { ?>
              <div class="row">
                <label class="col-sm-3 col-form-label"><strong></strong></label>
                <label class="col-sm-3 col-form-label"><strong><?php echo $rowcoff['charge_name'] ?></strong></label>
                <label class="col-sm-3 col-form-label"><strong></strong></label>
                <label class="col-sm-2 col-form-label"><strong>P <?php echo number_format($rowcoff['charge_amount'], 2) ?></strong></label>
                <label class="col-sm-1 col-form-label"><strong></strong></label>
              </div>
            <?php } ?>
          <?php endif ?>

          <!-- ////end update 2.0 /////// -->
          <!-- if restaurant -->

          <?php if (!empty($data['restaurant_charge'])) : ?>

            <div class="row">
              <label class="col-sm-3 col-form-label"><strong>Charge To:</strong></label>
              <label class="col-sm-3 col-form-label"><strong>Restaurant</strong></label>
              <label class="col-sm-3 col-form-label"><strong></strong></label>
              <label class="col-sm-3 col-form-label"><strong>P <?php echo number_format($data['restaurant_amount'], 2) ?></strong></label>
              <!-- <label class="col-sm-3 col-form-label">P <?php echo $data['restaurant_amount'] ?></label>    -->
            </div>

          <?php endif ?>

          <!-- end if -->

          <!-- if coffee -->

          <?php if (!empty($data['cof_charge'])) : ?>

            <div class="row">
              <label class="col-sm-3 col-form-label"><strong>Charge To:</strong></label>
              <label class="col-sm-3 col-form-label"><strong>Coffee Shop</strong></label>
              <label class="col-sm-3 col-form-label"><strong></strong></label>
              <label class="col-sm-3 col-form-label"><strong>P <?php echo number_format($data['cof_amount'], 2) ?></strong></label>
            </div>

          <?php endif ?>

          <!-- end if -->

          <hr>

          <div class="row">
            <label class="col-sm-3 col-form-label"><strong></strong></label>
            <label class="col-sm-3 col-form-label"><strong></strong></label>
            <label class="col-sm-3 col-form-label"><strong>TOTAL</strong></label>
            <label class="col-sm-3 col-form-label"><b style="color:red">P <?php echo number_format("$total_in_all", 2) ?></b></label>
          </div>

          <hr>

        <?php }
        $advance = $result_room_form[0]['advance_payment'];
        $amen = $result_room_form[0]['amenities_amount'];
        $total_balance_input = $result_total[0]['total'] - $advance - $price_ref_amount - $card_advance;
        ?>

        <hr>

        <div class="row">
          <label class="col-sm-3 col-form-label"><strong></strong></label>
          <label class="col-sm-3 col-form-label"><strong></strong></label>
          <label class="col-sm-3 col-form-label"><strong>REFUND AMOUNT</strong></label>
          <label class="col-sm-3 col-form-label"><strong>P -<?php echo number_format($price_ref_amount, 2) ?></strong></label>
        </div>

        <div class="row">
          <label class="col-sm-3 col-form-label"><strong></strong></label>
          <label class="col-sm-3 col-form-label"><strong></strong></label>
          <label class="col-sm-3 col-form-label"><strong>ADVANCE PAYMENT CASH</strong></label>
          <label class="col-sm-3 col-form-label"><strong>P -<?php echo number_format($advance, 2) ?></strong></label>
        </div>

        <div class="row">
          <label class="col-sm-3 col-form-label"><strong></strong></label>
          <label class="col-sm-3 col-form-label"><strong></strong></label>
          <label class="col-sm-3 col-form-label"><strong>ADVANCE PAYMENT CARD</strong></label>
          <label class="col-sm-3 col-form-label"><strong>P -<?php echo number_format($card_advance, 2) ?></strong></label>
        </div>

        <hr>

        <?php if (!empty($result_restaurant_charge)) { ?>

          <div class="row">
            <label class="col-sm-3 col-form-label"><strong></strong></label>
            <label class="col-sm-3 col-form-label"><strong></strong></label>
            <label class="col-sm-3 col-form-label"><strong>TOTAL AMOUNT</strong></label>
            <label class="col-sm-3 col-form-label"><b style="color:red">P <?php echo number_format("$total_balance_input", 2) ?> </b></label>
            <!-- <label class="col-sm-3 col-form-label">P <b style="color:red"><?php echo $total_balance_input ?> </b></label>     -->
          </div>

        <?php } else { ?>

          <div class="row">
            <label class="col-sm-3 col-form-label"><strong></strong></label>
            <label class="col-sm-3 col-form-label"><strong></strong></label>
            <label class="col-sm-3 col-form-label"><strong>TOTAL AMOUNT</strong></label>
            <label class="col-sm-3 col-form-label"><b style="color:red">P <?php echo number_format("$total_balance_input", 2) ?> </b></label>
            <!-- <label class="col-sm-3 col-form-label">P <b style="color:red"><?php echo $total_balance_input ?> </b></label>  -->
          </div>

        <?php } ?>

        <div class="row">
          <label class="col-sm-3 col-form-label"><strong></strong></label>
          <label class="col-sm-3 col-form-label"><strong></strong></label>
          <label class="col-sm-3 col-form-label"><strong>AMOUNT PAID</strong></label>
          <label class="col-sm-3 col-form-label"><b style="color:red">P <?php echo number_format("$amount_give", 2) ?> </b></label>
          <!-- <label class="col-sm-3 col-form-label">P <b style="color:red"><?php echo $amount_give ?> </b></label>     -->

        </div>

        <div class="row">
          <label class="col-sm-3 col-form-label"><strong></strong></label>
          <label class="col-sm-3 col-form-label"><strong></strong></label>
          <label class="col-sm-3 col-form-label"><strong>CHANGE</strong></label>
          <label class="col-sm-3 col-form-label"><b style="color:red">P <?php echo number_format($amount_give - $total_balance_input, 2) ?> </b></label>
        </div>

      </div>
      <div class="modal-footer">
        <div class="left-side">
          <button class="btn btn-primary btn-link" onclick="popupCenter('<?php echo base_url('index.php/main/printReciept/' . $result_room_form[0]['id']) ?>',  'myPop1', 600,600); return false;">Print</button>
        </div>

        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-default btn-link" data-dismiss="modal">CLOSE</button>
        </div>
      </div>
    </div>
  </div>

  <!-- completed order -->

  <!--details per room  -->

  <div class="modal fade" id="ModalRoom2" tabindex="-1" role="dialog" aria-labelledby="roomLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="nc-icon nc-simple-remove"></i>
          </button>
          <h4 class="title title-up" id="LabelRoom2">Add Details</h4>
        </div>

        <?php $attributes = array('id' => 'formRoom2'); ?>
        <?= form_open('', $attributes); ?>

        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" class="form-control" name="id" id="id">
            <input type="hidden" value="<?php echo $result_room_form[0]['id'] ?>" name="check_id">
            <div class="form-group">
              <label>Guest Name</label>
              <input type="text" class="form-control" name="name" id="name" required placeholder="Enter guest name">
            </div>

            <div class="form-group">
              <label>Contact Number</label>
              <input type="text" class="form-control" name="contact" id="contact" required placeholder="Enter contact number">
            </div>

            <div class="form-group">
              <label>E-mail</label>
              <input type="text" class="form-control" name="email" id="email" required placeholder="Enter email">
            </div>
          </div>
        </div>

        <div class="modal-footer">

          <div class="left-side">
            <input type="submit" value="Save" class="btn btn-danger btn-link">
          </div>
          <div class="divider"></div>
          <div class="right-side">
            <button type="button" class="btn btn-default btn-link" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
      <?= form_close() ?>
    </div>
  </div>

  <!--  detail senior-->

  <div class="modal fade" id="ModalRoom3" tabindex="-1" role="dialog" aria-labelledby="roomLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="nc-icon nc-simple-remove"></i>
          </button>
          <h4 class="title title-up" id="LabelRoom3">Add Details</h4>
        </div>

        <?php $attributes = array('id' => 'formRoom3'); ?>
        <?= form_open('', $attributes); ?>

        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" class="form-control" name="id" id="id">
            <input type="hidden" value="<?php echo $result_room_form[0]['id'] ?>" name="check_id">
            <div class="form-group">
              <label>ID Number</label>
              <input type="text" class="form-control" name="idnum" id="idnum" required>
            </div>
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="namedis" id="namedis" required>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <div class="left-side">
            <input type="submit" value="Save" class="btn btn-danger btn-link">
          </div>
          <div class="divider"></div>
          <div class="right-side">
            <button type="button" class="btn btn-default btn-link" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>

<!-- details Room -->

<div class="modal fade" id="ModalRoom4" tabindex="-1" role="dialog" aria-labelledby="roomLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header justify-content-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="nc-icon nc-simple-remove"></i>
        </button>
        <h4 class="title title-up" id="LabelRoom3">Reservation Details</h4>
      </div>

      <div class="modal-body">
        <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Room Type</th>
              <th>Number of Room/s</th>
            </tr>
          </thead>
          <?php foreach ($result_reservation as $data) {

            # code...

          ?>
            <tr>
              <td><?php echo $data['room_type_id'] ?></td>
              <td><?php echo $data['room_number_res'] ?></td>
            </tr>
          <?php } ?>
          <tbody>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <div class="right-side">
          <button type="button" class="btn btn-default btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
    <?= form_close() ?>
  </div>
</div>
</div>


<!-- /////////////////////// update 2.0 modal charges-->
<div class="modal fade" id="charges" tabindex="-1" role="dialog" aria-labelledby="roomLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header justify-content-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="nc-icon nc-simple-remove"></i>
        </button>
        <h4 class="title title-up" id="LabelRoom3">Resto and Coffee Shop Charges</h4>
      </div>
      <form action="<?php echo base_url('index.php/main/insertChargestoFO') ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $result_room_form[0]['id']; ?>">
            <label>Type</label>
            <select class="form-control" name="charge_type" required="">
              <option value="">Select</option>
              <option>Resto</option>
              <option>Coffee Shop</option>
            </select>
          </div>
          <div class="form-group">
            <label>Particulars</label>
            <input type="" class="form-control" name="charge_name" required="">
          </div>

          <div class="form-group">
            <label>Refference</label>
            <input type="" class="form-control" name="charge_ref" required="">
          </div>

          <div class="form-group">
            <label>Total Amount</label>
            <input type="number" class="form-control" name="charge_amount" required="">
          </div>

        </div>
        <div class="modal-footer">
          <div class="left-side">
            <?php if ($result_room_form[0]['status_payment'] == 'Unpaid') { ?>
              <input type="submit" class="btn btn-success btn-link" value="Add Charges" onclick="return confirm('Are you sure to add charges?')">
            <?php } ?>

          </div>
          <div class="right-side">
            <button type="button" class="btn btn-default btn-link" data-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
    <?= form_close() ?>
  </div>
</div>
</div>



<!-- ////update 2.0 -->
<div class="modal fade" id="chargesAmen" tabindex="-1" role="dialog" aria-labelledby="roomLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header justify-content-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="nc-icon nc-simple-remove"></i>
        </button>
        <h4 class="title title-up" id="LabelRoom3">Amenities and Other Charges</h4>
      </div>
      <form action="<?php echo base_url('index.php/main/insertChargestoAmenities') ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $result_room_form[0]['id']; ?>">

        <div class="modal-body">

          <div class="form-group">
            <label>Type Of Charges</label>
            <select class="form-control" onchange="toview(this);" required="" name="type">
              <option value="">Select</option>
              <option value="1">Broken/Damaged Item(s)</option>
              <option value="2">Additional Amenities</option>
              <option value="3">Lost Item(s)</option>
              <option value="4">Stained Item(s)</option>
              <option value="5">Early and Late Charges</option>
            </select>
          </div>



          <div class="form-group" id="1" style="display: none;">
            <label>Broken/Damaged Item(s)</label>
            <select class="form-control" name="B">
              <!-- <option value="">Select</option> -->
              <option value="B1">Broken Glass (Dental Glass) - 70.00</option>
              <option value="B2">Cup - 70.00</option>
              <option value="B3">Lamp Shade - 1500.00</option>
              <option value="B4">Curtain - 2000.00</option>
              <option value="B5">Wall Décor - 350.00</option>
              <option value="B6">Damage Chair - 350.00</option>
              <option value="B7">Damaged Wall (Stickers from parties) - 800.00</option>
            </select>
          </div>

          <div class="form-group" id="2" style="display: none;">
            <label>Additional Amenities</label>
            <select class="form-control" name="A">
              <!-- <option value="">Select</option> -->
              <option value="A1">Towel - 75.00</option>
              <option value="A2">Pillow - 35.00</option>
              <option value="A3">Dental Kit - 20.00</option>
              <option value="A4">Bottled Water (500 ml) -25.00</option>
              <option value="A5">Bottled Water (250 ml)- 15.00</option>
              <option value="A6">Soap - 10.00</option>
              <option value="A7">Shampoo & Conditioner- 35.00</option>
              <option value="A8">Lotion - 35.00</option>
              <option value="A9">Shower Gel - 35.00</option>
              <option value="A10">Vanity Kit - 20.00</option>
              <option value="A11">Linen/Sheet - 100.00</option>
              <option value="A12">Comforter - 100.00</option>
              <option value="A13">Slippers - 15.00</option>
            </select>
          </div>

          <div class="form-group" id="3" style="display: none;">
            <label>Lost Item(s)</label>
            <select class="form-control" name="L">
              <!-- <option value="">Select</option> -->
              <option value="L1">Keycard - 350.00</option>
              <option value="L2">Towel - 300.00</option>
              <option value="L3">Bathmat - 100.00</option>
              <option value="L4">Hanger - 80.00</option>
              <option value="L5">Flashlight - 100.00</option>
              <option value="L6">Remote - 500.00</option>
              <option value="L7">Linen - 1000.00</option>
              <option value="L8">Comforter - 2500</option>
            </select>
          </div>

          <div class="form-group" id="4" style="display: none;">
            <label>Stained Item(s)</label>
            <select class="form-control" name="S">
              <!-- <option value="">Select</option> -->
              <option value="S1">Linens - 250.00</option>
              <option value="S2">Towel - 200.00</option>
              <option value="S3">Bathmat - 100.00</option>
              <option value="S4">Smoking inside the room - 2500.00</option>
            </select>
          </div>

          <div class="form-group" id="5" style="display: none;">
            <label>Early and Late Charges</label>
            <select class="form-control" name="E">
              <!-- <option value="">Select</option> -->
              <option value="E1">Early Check In</option>
              <option value="E2">Late Check Out</option>
            </select>
          </div>

          <div class="form-group">
            <!-- <label>Quantity</label> -->
            <input type="hidden" class="form-control" name="qty" value="1">


          </div>






















        </div>
        <div class="modal-footer">
          <div class="left-side">
            <?php if ($result_room_form[0]['status_payment'] == 'Unpaid') { ?>
              <input type="submit" class="btn btn-success btn-link" value="Add Charges" onclick="return confirm('Are you sure to add  this charges?')">
            <?php } ?>

          </div>
          <div class="right-side">
            <button type="button" class="btn btn-default btn-link" data-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
    onclick="return confirm('Are you sure to add this charges?')
  </div>
</div>
</div>

<!-- /// end update 2.0 -->

<!-- ////////////
      ///////////
      //////////////// -->

<script type="text/javascript">
  // $("#room_type2").change(function(){
  //     $("#room_number2 option").css({"display":"block"});
  //     var val=$("#room_type").find(":selected").val();
  //     $("#room_number2 option[id!="+val+"]").css({"display":"none"});
  // });

  function toViewInputifCash(that) {

    if (that.value == "card") {
      document.getElementById("cardnumber").style.display = "block";
      document.getElementById("appcode").style.display = "block";
    } else {
      document.getElementById("cardnumber").style.display = "none";
      document.getElementById("appcode").style.display = "none";
    }
  }
</script>

<!-- complete -->
<!-- update 2.2 -->
<script type="text/javascript">
  $('.complete').click(function() {
    $('#Complete').on('show.bs.modal', function(e) {
      $('#formRoomComplete').attr('action', '<?= base_url('index.php/main/frontdeskCompleteOrder') ?>');
      $('#LabelRoomComplete').text('Payment Details');
      $('#tamount').val($(e.relatedTarget).data('tamount'));
      $('#ad_card').val($(e.relatedTarget).data('ad_card'));
      $('#ad_cash').val($(e.relatedTarget).data('ad_cash'));

    })
  });
</script>
<!-- update 2.2 -->

<!-- end complete -->

<script type="text/javascript">
  $('.editRoom').click(function() {
    $('#ModalRoom').on('show.bs.modal', function(e) {
      $('#formRoom').attr('action', '<?= base_url('index.php/main/updateChecked') ?>');
      $('#LabelRoom').text('Update Reservation');
      $('#room_number').val($(e.relatedTarget).data('room-number'));
      $('#room_id').val($(e.relatedTarget).data('room-id'));
      $('#room_type').val($(e.relatedTarget).data('room-type'));
      $('#breakfast').val($(e.relatedTarget).data('breakfast'));
      $('#add_bed').val($(e.relatedTarget).data('add-bed'));
      $('#add_person').val($(e.relatedTarget).data('add-person'));
      $('#deduction').val($(e.relatedTarget).data('add-deduction'));
      $('#daterange').val($(e.relatedTarget).data('date'));
    })
  });

  //

  $('.details_room').click(function() {
    $('#ModalRoom2').on('show.bs.modal', function(e) {
      $('#formRoom2').attr('action', '<?= base_url('index.php/main/addDetailsChekedPerRoom') ?>');
      $('#LabelRoom2').text('Guest Details');
      $('#id').val($(e.relatedTarget).data('id'));
      $('#name').val($(e.relatedTarget).data('name'));
      $('#contact').val($(e.relatedTarget).data('contact'));
      $('#email').val($(e.relatedTarget).data('email'));
    })
  });
  $('.details_deduction').click(function() {
    $('#ModalRoom3').on('show.bs.modal', function(e) {
      $('#formRoom3').attr('action', '<?= base_url('index.php/main/addDetailsChekedRoom') ?>');
      $('#LabelRoom3').text('Discount Details');
      $('#id').val($(e.relatedTarget).data('id'));
      $('#idnum').val($(e.relatedTarget).data('idnum'));
      $('#namedis').val($(e.relatedTarget).data('namedis'));
    })
  });
</script>

<script>
  function popupCenter(url, title, w, h) {
    var left = (screen.width / 2) - (w / 2);
    var top = (screen.height / 2) - (h / 2);
    return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
  }
</script>

<script type="text/javascript">
  $('.cancel').click(function() {
    swal({
      title: 'Are you sure to cancel?',
      text: '',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Delete',
      cancelButtonText: 'Cancel',
      confirmButtonClass: "btn btn-success",
      cancelButtonClass: "btn btn-danger",
      buttonsStyling: false
    }).then((result) => {
      if (!result.value) {
        window.location.replace(this.id);
      }
    });
  });

  $('.update').click(function() {
    swal({
      title: 'Are you sure to update form?',
      text: '',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Confirm',
      cancelButtonText: 'Cancel',
      confirmButtonClass: "btn btn-success",
      cancelButtonClass: "btn btn-danger",
      buttonsStyling: false
    }).then((result) => {
      if (!result.value) {
        window.location.replace(this.id);
      }
    });
  });

  $('.lock').click(function() {

    swal({

      title: 'Lock Transaction?',
      text: 'Note: This process cannot be reverted.',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes',
      cancelButtonText: 'Cancel',
      confirmButtonClass: "btn btn-success",
      cancelButtonClass: "btn btn-danger",
      buttonsStyling: false
    }).then((result) => {
      if (!result.value) {
        window.location.replace(this.id);
      }
    });
  });
</script>

<script type="text/javascript">
  function toview(that) {

    if (that.value == "1") {
      document.getElementById("1").style.display = "block";
      document.getElementById("2").style.display = "None";
      document.getElementById("3").style.display = "None";
      document.getElementById("4").style.display = "None";
      document.getElementById("5").style.display = "None";
    } else if (that.value == "2") {
      document.getElementById("1").style.display = "None";
      document.getElementById("2").style.display = "Block";
      document.getElementById("3").style.display = "None";
      document.getElementById("4").style.display = "None";
      document.getElementById("5").style.display = "None";

    } else if (that.value == "3") {
      document.getElementById("1").style.display = "None";
      document.getElementById("2").style.display = "None";
      document.getElementById("3").style.display = "Block";
      document.getElementById("4").style.display = "None";
      document.getElementById("5").style.display = "None";
    } else if (that.value == "4") {
      document.getElementById("1").style.display = "None";
      document.getElementById("2").style.display = "None";
      document.getElementById("3").style.display = "None";
      document.getElementById("4").style.display = "Block";
      document.getElementById("5").style.display = "None";
    } else if (that.value == "5") {
      document.getElementById("1").style.display = "None";
      document.getElementById("2").style.display = "None";
      document.getElementById("3").style.display = "None";
      document.getElementById("4").style.display = "None";
      document.getElementById("5").style.display = "Block";
    } else {
      document.getElementById("1").style.display = "None";
      document.getElementById("2").style.display = "None";
      document.getElementById("3").style.display = "None";
      document.getElementById("4").style.display = "none";
      document.getElementById("5").style.display = "none";

    }

  }
</script>
<?php

// $date = $result_room_form[0]['date_modified'];

//      echo $sdate = date_format($date, 'G:ia');

// if ($sdate >= "10:00am" && $sdate <= "1:00am") {
//   $this->db->query('insert into charge_amen set amen_name="Early Check In", amen_amount="560" ,amen_qty="1", amen_to_charge="'.$result_room_form[0]['id'].'"');
// } 
?>

<?php if ($result_room_form[0]['status_payment'] == 'Paid') { ?>
  <script>
    $(document).ready(function() {
      $("#completed").modal('show');
    });
  </script>
<?php } ?>

<script src="<?php echo base_url() ?>assets/js/core/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/core/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/core/popper.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/core/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/moment.min.js"></script>

<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->

<script src="<?php echo base_url() ?>assets/js/plugins/bootstrap-switch.js"></script>

<!--  Plugin for Sweet Alert -->

<script src="<?php echo base_url() ?>assets/js/plugins/sweetalert2.min.js"></script>

<!-- Forms Validations Plugin -->

<script src="<?php echo base_url() ?>assets/js/plugins/jquery.validate.min.js"></script>

<!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->

<script src="<?php echo base_url() ?>assets/js/plugins/jquery.bootstrap-wizard.js"></script>

<!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->

<script src="<?php echo base_url() ?>assets/js/plugins/bootstrap-selectpicker.js"></script>

<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->

<script src="<?php echo base_url() ?>assets/js/plugins/bootstrap-datetimepicker.js"></script>

<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->

<script src="<?php echo base_url() ?>assets/js/plugins/jquery.dataTables.min.js"></script>

<!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->

<script src="<?php echo base_url() ?>assets/js/plugins/bootstrap-tagsinput.js"></script>

<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->

<script src="<?php echo base_url() ?>assets/js/plugins/jasny-bootstrap.min.js"></script>

<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->

<script src="<?php echo base_url() ?>assets/js/plugins/fullcalendar.min.js"></script>

<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->

<script src="<?php echo base_url() ?>assets/js/plugins/jquery-jvectormap.js"></script>

<!--  Plugin for the Bootstrap Table -->

<script src="<?php echo base_url() ?>assets/js/plugins/nouislider.min.js"></script>

<!--  Google Maps Plugin    -->

<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<!-- Chart JS -->

<script src="<?php echo base_url() ?>assets/js/plugins/chartjs.min.js"></script>

<!--  Notifications Plugin    -->

<script src="<?php echo base_url() ?>assets/js/plugins/bootstrap-notify.js"></script>

<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->

<script src="<?php echo base_url() ?>assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>

<!-- Paper Dashboard DEMO methods, don't include it in your project! -->

<script src="<?php echo base_url() ?>assets/demo/demo.js"></script>
<script>
  $(document).ready(function() {

    $('#datatables').DataTable({

      "pagingType": "full_numbers",
      "order": [
        [3, "desc"]
      ],

      "lengthMenu": [

        [10, 25, 50, -1],

        [10, 25, 50, "All"]

      ],

      responsive: true,

      language: {

        search: "_INPUT_",

        searchPlaceholder: "Search records",

      }



    });



    var table = $('#datatables').DataTable();



    // Edit record

    table.on('click', '.edit', function() {

      $tr = $(this).closest('tr');



      var data = table.row($tr).data();

      alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');

    });



    // Delete a record

    table.on('click', '.remove', function(e) {

      $tr = $(this).closest('tr');

      table.row($tr).remove().draw();

      e.preventDefault();

    });



    //Like record

    table.on('click', '.like', function() {

      alert('You clicked on Like button');

    });

  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('.datepicker').datetimepicker({
      icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calender",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: "fa fa-chevron-left",
        next: "fa fa-chevron-right",
        today: "fa fa-screenshot",
        clear: "fa fa-trash",
        close: "fa fa-remove",
      },
      format: 'L',
    });
  });
</script>