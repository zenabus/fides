<div class="content pb-0">
  <div class="row">
    <div class="col-md-12">
      <h5>Online Reservations</h5>
      <div class="wizard-container">
        <div class="card card-wizard active" data-color="primary" id="wizardProfile">
          <div class="card-header text-center">
            <div class="wizard-navigation">
              <ul>
                <li class="nav-item">
                  <a class="nav-link active" href="#verified" data-toggle="tab" role="tab" aria-controls="verified" aria-selected="true">
                    <i class="fa fa-check"></i> Verified
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#pending" data-toggle="tab" role="tab" aria-controls="pending" aria-selected="true">
                    <i class="fa fa-hourglass"></i> Pending
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#cancelled" data-toggle="tab" role="tab" aria-controls="cancelled" aria-selected="true">
                    <i class="fa fa-ban"></i> Cancelled
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane show active" id="verified">
                <table class="table table-striped table-bordered tbl_reservations" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Booking No.</th>
                      <th>Guest Name</th>
                      <th>Contact Details</th>
                      <th>Room Details</th>
                      <th>Payment Details</th>
                      <th>Date</th>
                      <th class="disabled-sorting">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($reservations as $row) { ?>
                      <?php if ($row['reservation_status'] == 5) { ?>
                        <tr>
                          <td>
                            <?= $row['booking_number'] ?>
                            <?php if ($row['remarks']) { ?>
                              <span class="fa fa-info-circle ml-1 text-info" rel="tooltip" data-original-title="<?= $row['remarks'] ?>"></span>
                            <?php } ?><br>
                            <small><?= date_format(date_create($row['booking_added']), "F d, Y h:i a") ?></small>
                          </td>
                          <td>
                            <?= $row['last_name'] ?>, <?= $row['first_name'] ?> <?= $row['middle_name'] ?><br>
                            <small><?= $row['address'] ?></small>
                          </td>
                          <td>
                            <?= $row['contact'] ?><br>
                            <small><?= $row['email'] ?></small>
                          </td>
                          <td>
                            Room <?= $row['room_number'] ?> - <?= $row['room_type'] ?><br>
                            <small>₱ <?= number_format($row['pricing_type'], 2) ?> / ₱ <?= number_format($row['pricing_type'] * 0.25, 2) ?> (25%)</small>
                          </td>
                          <td>
                            ₱ <?= number_format($row['amount'], 2) ?><br>
                            <?php if ($row['amount'] != 0) { ?>
                              <?php if ($row['payment_option'] == 'Cash') { ?>
                                <small><?= $row['payment_option'] ?></small>
                              <?php } else { ?>
                                <small><?= $row['card_number'] ?> / <?= $row['card_name'] ?></small>
                              <?php } ?>
                            <?php } ?>
                          </td>
                          <td>
                            <?= $row['check_in'] ?> - <?= $row['check_out'] ?><br>
                            <small>Number of nights: <?= $row['nights'] ?></small>
                          </td>
                          <td class="action">
                            <a href="javascript:" class="btn btn-sm btn-default">Check In</a>
                            <a href="<?= base_url('index.php/main/updateReservationStatus/4/' . $row['booking_id']) ?>" class="btn btn-sm btn-danger confirm">Cancel</a>
                          </td>
                        </tr>
                    <?php }
                    } ?>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane" id="pending">
                <table class="table table-striped table-bordered tbl_reservations" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Booking No.</th>
                      <th>Guest Name</th>
                      <th>Contact Details</th>
                      <th>Room Details</th>
                      <th>Payment Details</th>
                      <th>Date</th>
                      <th class="disabled-sorting">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($reservations as $row) { ?>
                      <?php if ($row['reservation_status'] == 2 || $row['reservation_status'] == 3) { ?>
                        <tr>
                          <td>
                            <?= $row['booking_number'] ?>
                            <?php if ($row['remarks']) { ?>
                              <span class="fa fa-info-circle ml-1 text-info" rel="tooltip" data-original-title="<?= $row['remarks'] ?>"></span>
                            <?php } ?><br>
                            <small><?= date_format(date_create($row['booking_added']), "F d, Y h:i a") ?></small>
                          </td>
                          <td>
                            <?= $row['last_name'] ?>, <?= $row['first_name'] ?> <?= $row['middle_name'] ?>
                            <?php if ($row['reservation_status'] == 3) { ?>
                              <span class="fa fa-check ml-1 text-info" rel="tooltip" data-original-title="Reservation Email Verified"></span>
                            <?php } ?>
                            <br><small><?= $row['address'] ?></small>
                          </td>
                          <td>
                            <?= $row['contact'] ?><br>
                            <small><?= $row['email'] ?></small>
                          </td>
                          <td>
                            Room <?= $row['room_number'] ?> - <?= $row['room_type'] ?><br>
                            <small>₱ <?= number_format($row['pricing_type'], 2) ?> / ₱ <?= number_format($row['pricing_type'] * 0.25, 2) ?> (25%)</small>
                          </td>
                          <td>
                            ₱ <?= number_format($row['amount'], 2) ?><br>
                            <?php if ($row['amount'] != 0) { ?>
                              <?php if ($row['payment_option'] == 'Cash') { ?>
                                <small><?= $row['payment_option'] ?></small>
                              <?php } else { ?>
                                <small><?= $row['card_number'] ?> / <?= $row['card_name'] ?></small>
                              <?php } ?>
                            <?php } ?>
                          </td>
                          <td>
                            <?= $row['check_in'] ?> - <?= $row['check_out'] ?><br>
                            <small>Number of nights: <?= $row['nights'] ?></small>
                          </td>
                          <td>
                            <a href="javascript:" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modalVerify">Verify</a>
                            <a href="<?= base_url('index.php/main/updateReservationStatus/4/' . $row['booking_id']) ?>" class="btn btn-sm btn-danger confirm">Cancel</a>
                          </td>
                        </tr>
                    <?php }
                    } ?>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane" id="cancelled">
                <table class="table table-striped table-bordered tbl_reservations" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Booking No.</th>
                      <th>Guest Name</th>
                      <th>Contact Details</th>
                      <th>Room Details</th>
                      <th>Payment Details</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($reservations as $row) { ?>
                      <?php if ($row['reservation_status'] == 4) { ?>
                        <tr>
                          <td>
                            <?= $row['booking_number'] ?>
                            <?php if ($row['remarks']) { ?>
                              <span class="fa fa-info-circle ml-1 text-info" rel="tooltip" data-original-title="<?= $row['remarks'] ?>"></span>
                            <?php } ?><br>
                            <small><?= date_format(date_create($row['booking_added']), "F d, Y h:i a") ?></small>
                          </td>
                          <td>
                            <?= $row['last_name'] ?>, <?= $row['first_name'] ?> <?= $row['middle_name'] ?><br>
                            <small><?= $row['address'] ?></small>
                          </td>
                          <td>
                            <?= $row['contact'] ?><br>
                            <small><?= $row['email'] ?></small>
                          </td>
                          <td>
                            Room <?= $row['room_number'] ?> - <?= $row['room_type'] ?><br>
                            <small>₱ <?= number_format($row['pricing_type'], 2) ?> / ₱ <?= number_format($row['pricing_type'] * 0.25, 2) ?> (25%)</small>
                          </td>
                          <td>
                            ₱ <?= number_format($row['amount'], 2) ?><br>
                            <?php if ($row['amount'] != 0) { ?>
                              <?php if ($row['payment_option'] == 'Cash') { ?>
                                <small><?= $row['payment_option'] ?></small>
                              <?php } else { ?>
                                <small><?= $row['card_number'] ?> / <?= $row['card_name'] ?></small>
                              <?php } ?>
                            <?php } ?>
                          </td>
                          <td>
                            <?= $row['check_in'] ?> - <?= $row['check_out'] ?><br>
                            <small>Number of nights: <?= $row['nights'] ?></small>
                          </td>
                        </tr>
                    <?php }
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="card-footer">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalVerify" tabindex="-1" role="dialog">
  <div class="modal-dialog pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="nc-icon nc-simple-remove"></i>
        </button>
        <h4 class="title title-up titleBooking">Booking Details</h4>
      </div>
      <div class="modal-body">
        <?= form_open('main/book', ['id' => 'frmBook']) ?>
        <input type="hidden" name="room_id">
        <input type="hidden" name="guest_id">
        <input type="hidden" name="booking_type">
        <div class="form-group reservation-div">
          <label>Reservation Type</label>
          <div class="d-flex justify-content-around">
            <div class="form-check-radio">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="reservation_type" id="reservation_type" value="Arrival/Tentative" checked>
                Arrival/Tentative
                <span class="form-check-sign"></span>
              </label>
            </div>
            <div class="form-check-radio">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="reservation_type" id="reservation_type" value="Confirmed">
                Confirmed
                <span class="form-check-sign"></span>
              </label>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-8">
            <label>Room Type</label>
            <input type="text" class="form-control" id="room_type" readonly>
          </div>
          <div class="form-group col-md-4">
            <label>Room Number</label>
            <input type="number" class="form-control text-center" id="room_number" readonly>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Check In</label>
            <input type="text" class="form-control datepicker text-center" name="check_in" readonly>
          </div>
          <div class="form-group col-md-4">
            <label>Check Out</label>
            <input type="text" class="form-control datepicker text-center" name="check_out">
          </div>
          <div class="form-group col-md-4">
            <label>Night(s)</label>
            <input type="number" class="form-control text-center" name="nights" value="1" min="0">
          </div>
        </div>
        <div class="form-group text-center">
          <a href="javascript:" id="returning_guest">Returning Guest?</a>
          <a href="javascript:" id="new_guest">New Guest?</a>
        </div>
        <div class=" form-row">
          <div class="form-group col-md-4">
            <label>First Name</label>
            <input type="text" class="form-control guest_details" name="first_name" required>
          </div>
          <div class="form-group col-md-4">
            <label>Middle Name</label>
            <input type="text" class="form-control guest_details" name="middle_name">
          </div>
          <div class="form-group col-md-4">
            <label>Last Name</label>
            <input type="text" class="form-control guest_details" name="last_name" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Contact Number</label>
            <input type="text" class="form-control guest_details" name="contact" required>
          </div>
          <div class="form-group col-md-8">
            <label>E-mail <small>(optional)</small></label>
            <input type="text" class="form-control guest_details" name="email">
          </div>
        </div>
        <div class="form-group">
          <label>Company Name <small>(optional)</small></label>
          <input type="text" class="form-control guest_details" name="company_name">
        </div>
        <div class="form-group">
          <label>Advance Payment Option</label>
          <div class="d-flex justify-content-around">
            <div class="form-check-radio mb-0">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="payment_option" value="Cash" checked>
                Cash
                <span class="form-check-sign"></span>
              </label>
            </div>
            <div class="form-check-radio mb-0">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="payment_option" value="Card">
                Card
                <span class="form-check-sign"></span>
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Amount</label>
          <input type="number" name="amount" class="form-control" value="0" min="0">
        </div>
        <div class="card-div">
          <div class="row">
            <div class="form-group col-md-6">
              <label>Account Number</label>
              <input type="text" name="card_number" class="form-control" placeholder="XXXX XXXX XXXX XXXX" maxlength="19">
            </div>
            <div class="form-group col-md-6">
              <label>Account Name</label>
              <input type="text" name="card_name" class="form-control">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Notes / Remarks</label>
          <textarea name="remarks" rows="10" class="form-control"></textarea>
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <input type="submit" value="Check In" class="btn btn-link" form="frmBook" id="btnBooking">
        </div>
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    demo.initWizard();

    $('.tbl_reservations').DataTable({
      "autoWidth": false,
      "columnDefs": [
      { "width": "11%", "targets": 0 },
      { "width": "16%", "targets": 1 },
      { "width": "16%", "targets": 2 },
      { "width": "16%", "targets": 3 },
      { "width": "12%", "targets": 4 },
      { "width": "16%", "targets": 5 },
    ]});
  });
</script>