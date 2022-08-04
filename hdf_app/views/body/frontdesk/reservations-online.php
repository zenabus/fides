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
                <table class="table table-striped table-bordered datatables" cellspacing="0" width="100%">
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
                            Room <?= $row['room_number'] ?><br>
                            <small><?= $row['room_type'] ?></small>
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
                            <a href="<?= base_url('index.php/main/updateReservationStatus/5/' . $row['booking_id']) ?>" class="btn btn-sm btn-danger confirm">Cancel</a>
                          </td>
                        </tr>
                    <?php }
                    } ?>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane" id="pending">
                <table class="table table-striped table-bordered datatables" cellspacing="0" width="100%">
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
                      <?php if ($row['reservation_status'] == 3) { ?>
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
                            Room <?= $row['room_number'] ?><br>
                            <small><?= $row['room_type'] ?></small>
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
                            <a href="javascript:" class="btn btn-sm btn-default">Check In</a>
                            <a href="<?= base_url('index.php/main/updateReservationStatus/5/' . $row['booking_id']) ?>" class="btn btn-sm btn-danger confirm">Cancel</a>
                          </td>
                        </tr>
                    <?php }
                    } ?>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane" id="cancelled">
                <table class="table table-striped table-bordered datatables" cellspacing="0" width="100%">
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
                            Room <?= $row['room_number'] ?><br>
                            <small><?= $row['room_type'] ?></small>
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

<script>
  $(document).ready(function() {
    demo.initWizard();
  });
</script>