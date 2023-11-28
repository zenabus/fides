<script src="<?= base_url() ?>assets/demo/demo.js"></script>

<div class="content pb-0">
  <div class="d-flex justify-content-between align-items-center mb-2">
    <div>
      <h5 class="mb-0">Booking Number: <?= $booking->booking_number ?></h5>
      <?php if ($booking->cancel_reason) { ?>
        <small>Cancellation Reason: <?= $booking->cancel_reason ?></small>
      <?php } ?>
    </div>
    <button class="btn btn-primary my-0 back" onclick="history.back()">Back</button>
  </div>
  <div class="row">
    <div class="col-md-6">
      <?php $this->load->view('body/frontdesk/components/room_details') ?>

      <div class="card">
        <div class="card-header border-bottom px-4 pt-4 pb-2">
          <h6 class="mb-0">Guest Details</h6>
          <small><a href="<?= base_url('index.php/main/guest/' . $booking->guest_id); ?>">View Guest</a></small>
        </div>
        <div class="card-body p-0">
          <?= form_open('main/updateGuest', ['id' => 'frmGuest']) ?>
          <input type="hidden" name="guest_id" value="<?= $booking->guest_id ?>">
          <input type="hidden" name="booking_number" value="<?= $booking->booking_number ?>">
          <input type="hidden" name="booking_id" value="<?= $booking->booking_id ?>">
          <div class="form-row px-4 py-3">
            <div class="form-group col-md-4 mb-0">
              <label>Arrival</label>
              <input type="text" class="form-control-plaintext" tabindex="-1" value="<?= $booking->arrival ?>" readonly>
            </div>
            <div class="form-group col-md-4 mb-0">
              <label>Departure</label>
              <input type="text" class="form-control-plaintext" tabindex="-1" value="<?= $booking->departure ?>" readonly>
            </div>
            <?php
            try {
              $arrival = new DateTime($booking->arrival);
              $departure = new DateTime($booking->departure);
              $nights = $arrival->diff($departure);
              $nights = $nights->d;
            } catch (Exception $e) {
              $nights =  0;
            }
            ?>
            <div class="form-group col-md-4 mb-0">
              <label>Nights</label>
              <input type="text" class="form-control-plaintext" tabindex="-1" value="<?= $nights ?>" readonly>
            </div>
          </div>

          <div class="px-4 py-3 border-bottom border-top">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>First Name</label>
                <input type="text" class="form-control-plaintext editable" name="first_name" value="<?= $booking->first_name ?>" tabindex="-1" readonly>
              </div>
              <div class="form-group col-md-3">
                <label>Middle Name</label>
                <input type="text" class="form-control-plaintext editable" name="middle_name" value="<?= $booking->middle_name ?>" tabindex="-1" readonly>
              </div>
              <div class="form-group col-md-4">
                <label>Last Name</label>
                <input type="text" class="form-control-plaintext editable" name="last_name" value="<?= $booking->last_name ?>" tabindex="-1" readonly>
              </div>
              <div class="form-group col-md-1">
                <label>Suffix</label>
                <input type="text" class="form-control-plaintext editable" name="suffix" value="<?= $booking->suffix ?>" tabindex="-1" readonly>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Birthday</label>
                <input type="text" class="form-control-plaintext editable datepicker" name="birthday" value="<?= $booking->birthday ?>" tabindex="-1" readonly>
              </div>
              <div class="form-group col-md-4">
                <label>Nationality</label>
                <input type="text" class="form-control-plaintext editable" name="nationality" value="<?= $booking->nationality ?>" tabindex="-1" readonly>
              </div>
              <div class="form-group col-md-4">
                <label>Car Plate No.</label>
                <input type="text" class="form-control-plaintext editable" name="plate_no" value="<?= $booking->plate_no ?>" tabindex="-1" readonly>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-3">
                <label>Contact Number</label>
                <input type="text" class="form-control-plaintext editable" name="contact" value="<?= $booking->contact ?>" tabindex="-1" readonly>
              </div>
              <div class="form-group col-md-4">
                <label>Email</label>
                <input type="text" class="form-control-plaintext editable" name="email" value="<?= $booking->email ?>" tabindex="-1" readonly>
              </div>
              <div class="form-group col-md-5">
                <label>Address</label>
                <input type="text" class="form-control-plaintext editable" name="address" value="<?= $booking->address ?>" tabindex="-1" readonly>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6 mb-0">
                <label>Company Name</label>
                <input type="text" class="form-control-plaintext editable" name="company_name" value="<?= $booking->company_name ?>" tabindex="-1" readonly>
              </div>
              <div class="form-group col-md-6 mb-0">
                <label>Company Address</label>
                <input type="text" class="form-control-plaintext editable" name="company_address" value="<?= $booking->company_address ?>" tabindex="-1" readonly>
              </div>
            </div>
          </div>
          <?= form_close() ?>
        </div>
        <div class="card-footer my-2 d-flex justify-content-between">
          <div>
            <button class="btn btn-sm hidable updateDetails" type="button">Update</button>
            <button class="btn btn-sm saveChanges" form="frmGuest">Save Changes</button>
            <button class="btn btn-sm btn-primary cancelUpdate" type="button">Cancel</button>
          </div>
          <a href="<?= base_url('index.php/main/registration/' . $booking->booking_id) ?>" class="btn btn-sm btn-info registration">Print Form</a>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header border-bottom px-4 pt-4 pb-2">
              <h6>Special Request(s) / Allergence</h6>
            </div>
            <?= form_open('main/updateRequest', ['id' => 'frmRequest']) ?>
            <input type="hidden" name="booking_id" value="<?= $booking->booking_id ?>">
            <div class="card-body px-4">
              <textarea class="form-control-plaintext px-2 pt-1" tabindex="-1" name="request" rows="3" readonly><?= $booking->request ?></textarea>
            </div>
            <div class="card-footer my-2 border-top px-4">
              <input type="button" value="Update" class="btn btn-sm updateRequest hidable">
              <input type="submit" value="Save" class="btn btn-sm saveRequest" form="frmRequest">
              <input type="button" value="Cancel" class="btn btn-sm btn-primary cancelRequest">
            </div>
            <?= form_close() ?>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card">
            <div class="card-header border-bottom px-4 pt-4 pb-2">
              <h6>Notes</h6>
            </div>
            <?= form_open('main/updateNotes', ['id' => 'frmNotes']) ?>
            <input type="hidden" name="booking_id" value="<?= $booking->booking_id ?>">
            <div class="card-body px-4">
              <textarea class="form-control-plaintext px-2 pt-1" tabindex="-1" name="remarks" rows="3" readonly><?= $booking->remarks ?></textarea>
            </div>
            <?= form_close() ?>
            <div class="card-footer my-2 border-top px-4">
              <input type="button" value="Update" class="btn btn-sm updateNotes hidable">
              <input type="submit" value="Save" class="btn btn-sm saveNotes" form="frmNotes">
              <input type="button" value="Cancel" class="btn btn-sm btn-primary cancelNotes">
            </div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header border-bottom px-4 pt-4 pb-2">
          <h6>Logs</h6>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-sm mb-0" id="datatable">
            <thead>
              <tr>
                <th>User</th>
                <th>Activity</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!count($logs)) { ?>
                <tr>
                  <td class="text-center" colspan="3">No record found</td>
                </tr>
              <?php } ?>
              <?php foreach ($logs as $row) { ?>
                <tr>
                  <td style="white-space: pre;"><?= $row['name'] ?><br><small><?= $row['user_type'] ?></small></td>
                  <td>
                    <?php
                    $content = explode('→', $row['activity']);
                    if (count($content) >= 2) {
                      if (count($content) == 2) {
                        $content = $content[1];
                      } else {
                        $content = $content[2];
                      }
                    } else {
                      $content = $content[0];
                    }
                    ?>
                    <?= $content ?>
                  </td>
                  <?php
                  $date_time = date_create($row['booking_log_added']);
                  $date_time = date_format($date_time, "M d, Y h:i a");
                  ?>
                  <td style="white-space: pre;"><?= ucfirst($row['ago']) ?><br><small><?= $date_time ?></small></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <?php $this->load->view('body/frontdesk/components/collection_details') ?>

      <div class="card">
        <div class="card-header border-bottom px-4 pt-4 pb-2">
          <h6>Payment Details</h6>
        </div>
        <div class="card-body p-0">
          <table class="table">
            <thead>
              <tr>
                <th class="pl-4">Room</th>
                <th>Amount Paid</th>
                <th>Date Paid</th>
                <th class="hidable p-0" width="15px"></th>
              </tr>
            </thead>
            <tbody>
              <?php if (!count($payments)) { ?>
                <tr>
                  <td colspan="3" class="text-center">No record found</td>
                </tr>
              <?php } ?>
              <?php foreach ($payments as $row) { ?>
                <tr>
                  <td class="pl-4">
                    <?= $row['room_number'] ?> <?= $row['room_type_abbr'] ?><br>
                    <small>
                      <span class="<?= ICON[$row['payment_for']] ?>"></span>
                      <?= ucfirst($row['payment_for']) ?>
                    </small>
                  </td>
                  <td>
                    ₱ <?= number_format($row['amount'], 2) ?>
                    <?php if ($row['payment_option'] == 'Card') { ?>
                      <span class="fa-solid fa-credit-card text-warning" data-placement="top" title="XXXX XXXX XXXX <?= $row['payment_details'] ?>" rel="tooltip"></span>
                    <?php } else if ($row['payment_option'] == 'Check') {
                      [$check_name, $check_number, $check_branch, $check_date] = explode('|', $row['payment_details']);
                      $payment_details = "{$check_name}<br>{$check_number}<br>{$check_branch}<br>{$check_date}";
                    ?>
                      <span class="fa-solid fa-money-check text-info" data-placement="top" title="<?= $payment_details ?>" rel="tooltip" data-html="true"></span>
                    <?php } else if ($row['payment_option'] == 'Bank Transfer') {
                      [$bank_name, $bank_number, $bank_date] = explode('|', $row['payment_details']);
                      $payment_details = "{$bank_name}<br>{$bank_number}<br>{$bank_date}";
                    ?>
                      <span class="fa fa-bank text-danger" data-placement="top" title="<?= $payment_details ?>" rel="tooltip" data-html="true"></span>
                    <?php } else { ?>
                      <i class="fa-solid fa-money-bill text-success"></i>
                    <?php } ?>
                    <br>
                    <small><?= $row['name'] ?></small>
                  </td>
                  <td>
                    <?php
                    $date_time = date_create($row['booking_payment_added']);
                    $date = date_format($date_time, "F d, Y");
                    $time = date_format($date_time, "l, h:i a");
                    ?>
                    <?= $date ?><br>
                    <small><?= $time ?></small>
                  </td>
                  <td class="action hidable p-0" width="15px">
                    <a href="<?= base_url('index.php/main/deletePayment/' . $row['booking_payment_id']) ?>" class="float-right mt-1 text-danger confirm" data-placement="left" title="Remove Payment" rel="tooltip">
                      <span class="fa fa-times"></span>
                    </a>
                  </td>
                </tr>
              <?php } ?>
              <tr class="bg-default text-white">
                <th class="pl-4">TOTAL PAYMENT</th>
                <th>₱ <?= number_format($payment->amount ?? 0, 2) ?></th>
                <th></th>
                <th></th>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card">
        <div class="card-header border-bottom px-4 pt-4 pb-2">
          <h6>Refund Details</h6>
        </div>
        <div class="card-body p-0">
          <table class="table">
            <thead>
              <tr>
                <th class="pl-4">Room</th>
                <th>Amount Refunded</th>
                <th>Date Refund</th>
                <th class="hidable p-0" width="15px"></th>
              </tr>
            </thead>
            <tbody>
              <?php if (!count($refunds)) { ?>
                <tr>
                  <td colspan="3" class="text-center">No record found</td>
                </tr>
              <?php } ?>
              <?php foreach ($refunds as $row) { ?>
                <tr>
                  <td class="pl-4">
                    <?= $row['room_number'] ?> <?= $row['room_type_abbr'] ?><br>
                    <small><?= $row['booking_refund_reason'] ?></small>
                  </td>
                  <td>
                    ₱ <?= number_format($row['booking_refund'], 2) ?><br>
                    <small><?= $row['name'] ?></small>
                  </td>
                  <td>
                    <?php
                    $date_time = date_create($row['booking_refund_added']);
                    $date = date_format($date_time, "F d, Y");
                    $time = date_format($date_time, "l, h:i a");
                    ?>
                    <?= $date ?><br>
                    <small><?= $time ?></small>
                  </td>
                  <td class="action hidable p-0" width="15px">
                    <a href="<?= base_url('index.php/main/deleteRefund/' . $row['booking_refund_id']) ?>" class="float-right mt-1 text-danger confirm" data-placement="left" title="Remove Refund" rel="tooltip">
                      <span class="fa fa-times"></span>
                    </a>
                  </td>
                </tr>
              <?php } ?>
              <tr class="bg-default text-white">
                <th class="pl-4">TOTAL REFUND</th>
                <th>₱ <?= number_format($refund->booking_refund ?? 0, 2) ?></th>
                <th></th>
                <th></th>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

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

    $('#datatable').dataTable({
      "ordering": false
    });

    $('.payment-div').perfectScrollbar();
  });

  $('.cancelUpdate, .saveChanges').hide();
  $('.saveNotes, .cancelNotes').hide();
  $('.saveRequest, .cancelRequest').hide();
  if (reservation_status == -1) {
    $('.hidable').attr('disabled', true).hide();
    $('.form-control').attr('readonly', true);
    $('[type=search], [name=refund], [name=refund_reason], [name=datatable_length]').removeAttr('readonly');
    $('.removeReadOnly').removeAttr('readonly');
  } else if (reservation_status == 6) {
    $('.btn').attr('disabled', true).hide();
  }

  $('.updateDetails').click(function() {
    $('.editable').removeClass('form-control-plaintext').addClass('form-control').removeAttr('readonly').removeAttr('tabindex');
    $('.updateDetails').hide();
    $('.cancelUpdate').show();
    $('.saveChanges').show();
    $('[name=first_name]').focus();
  });

  $('.cancelUpdate').click(function() {
    $('.editable').addClass('form-control-plaintext').removeClass('form-control').attr('readonly', true).attr('tabindex', -1);
    $('.updateDetails').show();
    $('.cancelUpdate').hide();
    $('.saveChanges').hide();
    $('#frmGuest').trigger('reset');
  });

  $('.updateNotes').click(function() {
    $('[name=remarks]').removeClass('form-control-plaintext').addClass('form-control').removeAttr('readonly').removeAttr('tabindex');
    $('.updateNotes').hide();
    $('.cancelNotes').show();
    $('.saveNotes').show();
    $('[name=remarks]').focus();
  });

  $('.cancelNotes').click(function() {
    $('[name=remarks]').addClass('form-control-plaintext').removeClass('form-control').attr('readonly', true).attr('tabindex', -1);
    $('.updateNotes').show();
    $('.cancelNotes').hide();
    $('.saveNotes').hide();
    $('#frmNotes').trigger('reset');
  });

  $('.updateRequest').click(function() {
    $('[name=request]').removeClass('form-control-plaintext').addClass('form-control').removeAttr('readonly').removeAttr('tabindex');
    $('.updateRequest').hide();
    $('.cancelRequest').show();
    $('.saveRequest').show();
    $('[name=request]').focus();

  });

  $('.cancelRequest').click(function() {
    $('[name=request]').addClass('form-control-plaintext').removeClass('form-control').attr('readonly', true).attr('tabindex', -1);
    $('.updateRequest').show();
    $('.cancelRequest').hide();
    $('.saveRequest').hide();
    $('#frmRequest').trigger('reset');
  });

  $('.registration').click(function(e) {
    e.preventDefault();
    const size = ['height=' + screen.height / 2, 'width=' + screen.width / 2].join(',');
    window.open($(this).attr('href'), size, size);
  });
</script>