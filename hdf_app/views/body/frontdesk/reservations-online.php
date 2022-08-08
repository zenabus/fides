<style>
  #new_guest {
    display: none;
  }
</style>

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
                  <a class="nav-link active" href="#confirmed" data-toggle="tab" role="tab" aria-controls="confirmed" aria-selected="true">
                    <i class="fa fa-check" title="5"></i> Confirmed
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#pending" data-toggle="tab" role="tab" aria-controls="pending" aria-selected="true">
                    <i class="fa fa-hourglass" title="2/3"></i> Pending
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#cancelled" data-toggle="tab" role="tab" aria-controls="cancelled" aria-selected="true">
                    <i class="fa fa-ban" title="4"></i> Cancelled
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane show active" id="confirmed">
                <table class="table table-striped table-bordered tbl_reservations" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Booking No.</th>
                      <th>Guest Name</th>
                      <th>Contact Details</th>
                      <th>Room Details</th>
                      <th>Payment Details</th>
                      <th>Date(s)</th>
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
                                <small>(<?= $row['payment_option'] ?>) <?= $row['card_number'] ?> / <?= $row['card_name'] ?></small>
                              <?php } ?>
                            <?php } ?>
                          </td>
                          <td>
                            <?= $row['check_in'] ?> - <?= $row['check_out'] ?><br>
                            <small>Number of night(s): <?= $row['nights'] ?></small>
                          </td>
                          <td class="action">
                            <a href="<?= base_url('index.php/main/checked/') ?>" class="btn btn-sm btn-default mb-2">Check In</a>
                            <a href="<?= base_url('index.php/main/updateReservationStatus/4/' . $row['booking_id']) ?>" class="btn btn-sm btn-danger confirm mb-2">Cancel</a>
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
                                <small>(<?= $row['payment_option'] ?>) <?= $row['card_number'] ?> / <?= $row['card_name'] ?></small>
                              <?php } ?>
                            <?php } ?>
                          </td>
                          <td>
                            <?= $row['check_in'] ?> - <?= $row['check_out'] ?><br>
                            <small>Number of night(s): <?= $row['nights'] ?></small>
                          </td>
                          <td>
                            <a href="javascript:" class="btn btn-sm btn-default confirm-reservation" data='<?= json_encode($row) ?>'>Confirm</a>
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
                                <small>(<?= $row['payment_option'] ?>) <?= $row['card_number'] ?> / <?= $row['card_name'] ?></small>
                              <?php } ?>
                            <?php } ?>
                          </td>
                          <td>
                            <?= $row['check_in'] ?> - <?= $row['check_out'] ?><br>
                            <small>Number of night(s): <?= $row['nights'] ?></small>
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

<div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog">
  <div class="modal-dialog pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="nc-icon nc-simple-remove"></i>
        </button>
        <h4 class="title title-up titleBooking">Verify Reservation</h4>
      </div>
      <div class="modal-body">
        <?= form_open('main/confirm', ['id' => 'frmConfirm']) ?>
        <input type="hidden" name="booking_id">
        <div class="form-group">
          <label>Advance Payment Option</label>
          <div class="d-flex justify-content-around">
            <div class="form-check-radio mb-0">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="payment_option" value="Cash">
                Cash
                <span class="form-check-sign"></span>
              </label>
            </div>
            <div class="form-check-radio mb-0">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="payment_option" value="Card" checked>
                Card
                <span class="form-check-sign"></span>
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Amount</label>
          <input type="number" name="amount" class="form-control" value="0" min="0" required>
        </div>
        <div class="card-div">
          <div class="row">
            <div class="form-group col-md-6">
              <label>Account Number</label>
              <input type="text" name="card_number" class="form-control" placeholder="XXXX XXXX XXXX XXXX" maxlength="19" required>
            </div>
            <div class="form-group col-md-6">
              <label>Account Name</label>
              <input type="text" name="card_name" class="form-control" required>
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
          <input type="submit" value="Confirm" class="btn btn-link" form="frmConfirm">
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
  const guests = JSON.parse('<?= json_encode($guests) ?>');
</script>
<script defer src="<?= base_url('assets/js/modal-reservation.js') ?>"></script>
<script>
  $(document).ready(function() {
    demo.initWizard();

    $('.tbl_reservations').DataTable({
      "autoWidth": false,
      "columnDefs": [{
          "width": "11%",
          "targets": 0
        },
        {
          "width": "16%",
          "targets": 1
        },
        {
          "width": "16%",
          "targets": 2
        },
        {
          "width": "16%",
          "targets": 3
        },
        {
          "width": "12%",
          "targets": 4
        },
        {
          "width": "16%",
          "targets": 5
        },
      ]
    });
  });

  $('.confirm-reservation').click(function() {
    const data = JSON.parse($(this).attr('data'));
    $('[name=booking_id]').val(data.booking_id);
    $('[name=amount]').val(data.amount);
    $('[name=card_number]').val(data.card_number);
    $('[name=card_name]').val(data.card_name);
    $('[name=remarks]').val(data.remarks);
    $('#modalConfirm').modal('show');
  });
</script>