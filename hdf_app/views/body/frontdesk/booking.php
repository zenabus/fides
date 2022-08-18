<script src="<?= base_url() ?>assets/demo/demo.js"></script>

<div class="content pb-0">
  <div class="d-flex justify-content-between align-items-center mb-2">
    <h5 class="mb-0">Booking Number: <?= $booking->booking_number ?></h5>
    <button class="btn btn-primary my-0" onclick="history.back()">Back</button>
  </div>
  <div class="row">
    <div class="col-md-6">
      <?php $this->load->view('body/frontdesk/components/room_details') ?>
      <div class="card">
        <div class="card-header border-bottom px-4 pt-4 pb-2">
          <h6>Guest Details</h6>
        </div>
        <div class="card-body p-0">
          <div class="form-row px-4 py-3">
            <div class="form-group col-md-4">
              <label>Arrival</label>
              <input type="text" class="form-control datepicker" name="arrival" value="<?= $booking->arrival ?>">
            </div>
            <div class="form-group col-md-4">
              <label>Departure</label>
              <input type="text" class="form-control datepicker" name="departure" value="<?= $booking->departure ?>">
            </div>
            <?php
            $arrival = new DateTime($booking->arrival);
            $departure = new DateTime($booking->departure);
            $nights = $arrival->diff($departure);
            ?>
            <div class="form-group col-md-1">
              <label>Nights</label>
              <input type="text" class="form-control text-center" value="<?= $nights->d ?>" readonly>
            </div>
            <div class="form-group col-md-3">
              <label>&nbsp;</label>
              <input type="button" class="btn btn-default btn-block mt-0" value="Change Dates">
            </div>
          </div>

          <div class="px-4 py-3 border-bottom border-top">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>First Name</label>
                <input type="text" class="form-control" value="<?= $booking->first_name ?>">
              </div>
              <div class="form-group col-md-4">
                <label>Middle Name</label>
                <input type="text" class="form-control" value="<?= $booking->middle_name ?>">
              </div>
              <div class="form-group col-md-4">
                <label>Last Name</label>
                <input type="text" class="form-control" value="<?= $booking->last_name ?>">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Contact Number</label>
                <input type="text" class="form-control" value="<?= $booking->contact ?>">
              </div>
              <div class="form-group col-md-4">
                <label>Email</label>
                <input type="text" class="form-control" value="<?= $booking->email ?>">
              </div>
              <div class="form-group col-md-4">
                <label>Address</label>
                <input type="text" class="form-control" value="<?= $booking->address ?>">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Company Name</label>
                <input type="text" class="form-control" value="<?= $booking->company_name ?>">
              </div>
              <div class="form-group col-md-6">
                <label>Company Address</label>
                <input type="text" class="form-control" value="<?= $booking->company_address ?>">
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer my-2">
          <button class="btn btn-default">Update Details</button>
          <button class="btn btn-success text-light" onclick="popupCenter('<?= base_url('index.php/main/printForm/') ?>',  'myPop1', 600,600); return false;">Print Form </button>
        </div>
      </div>

      <div class="card">
        <div class="card-header border-bottom px-4 pt-4 pb-2">
          <h6>Notes</h6>
        </div>
        <div class="card-body px-4">
          <textarea class="form-control px-2 pt-1" name="notes"></textarea>
        </div>
        <div class="card-footer my-2 border-top px-4">
          <input type="submit" value="Save Notes" class="btn btn-default">
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-header border-bottom px-4 pt-4 pb-2">
          <h6>Collection Details</h6>
        </div>
        <div class="card-body px-0">
          <div class="px-4">
            <button class="btn mt-0 btn-success btn-sm px-2" data-toggle="modal" data-target="#modalPayment">Payment</button>
            <button class="btn mt-0 btn-danger btn-sm px-2" data-toggle="modal" data-target="#modalRefund">Refund</button>
          </div>
          <table class="table table-sm mb-0">
            <thead>
              <tr class="bg-default text-white">
                <th class="pl-4">Name</th>
                <th>Unit</th>
                <th>Unit Cost</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <?php $grand_total = 0 ?>
              <?php foreach ($booked_rooms as $row) { ?>
                <tr>
                  <td class="pl-4">Room <?= $row['room_number'] ?> - <?= $row['room_type'] ?></td>
                  <td>(<?= $row['nights'] ?>) Day<?= $row['nights'] != 1 ? 's' : ''  ?></td>
                  <td>₱ <?= number_format($row['pricing_type']) ?></td>
                  <?php $total = $row['pricing_type'] * $row['nights'] ?>
                  <?php $discount = $total * ($row['percentage'] / 100) ?>
                  <?php $subtotal = $total - $discount; ?>
                  <?php $grand_total += $subtotal ?>
                  <td>₱ <?= number_format($subtotal) ?> <small data-placement="top" title="-₱ <?= number_format($discount) ?>" rel="tooltip">(-<?= $row['percentage'] ?>%)</small></td>
                </tr>
                <tr>
                  <td></td>
                  <td>(<?= $row['extra_person'] ?>) Extra Bed<?= $row['extra_person'] != 1 ? 's' : ''  ?></td>
                  <td>₱ <?= number_format($person->price) ?></td>
                  <td>₱ <?= number_format($person->price * $row['extra_person']) ?></td>
                </tr>
                <tr>
                  <td></td>
                  <td>(<?= $row['extra_bed'] ?>) Extra Person<?= $row['extra_bed'] != 1 ? 's' : ''  ?></td>
                  <td>₱ <?= number_format($bed->price) ?></td>
                  <td>₱ <?= number_format($bed->price * $row['extra_bed']) ?></td>
                </tr>
                <?php foreach ($row['room_charges'] as $charges) { ?>
                  <tr>
                    <td class="pl-4">Room <?= $row['room_number'] ?> - <?= $charges['charge_type'] ?> Charges</td>
                    <td>(1) <?= $charges['particulars'] ?></td>
                    <td>₱ <?= number_format($charges['charges_food_amount']) ?></td>
                    <td>₱ <?= number_format($charges['charges_food_amount']) ?></td>
                  </tr>
                <?php } ?>
              <?php } ?>
              <tr>
                <td class="pl-4">Total</td>
                <td></td>
                <td></td>
                <td>₱ <?= number_format($grand_total) ?></td>
              </tr>
              <tr>
                <td class="pl-4">Refund Amount</td>
                <td></td>
                <td></td>
                <td>₱ <?= number_format($booking->refund) ?></td>
              </tr>
              <tr>
                <td class="pl-4">Advanced Payment</td>
                <td></td>
                <td></td>
                <td>₱ 0.00</td>
              </tr>
              <tr class="bg-default text-white">
                <th class="pl-4">TOTAL BALANCE</th>
                <th></th>
                <th></th>
                <th>₱ 0.00</th>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="card-footer my-2 border-top px-4">
          <button class="btn btn-default">Complete Order</button>
        </div>
      </div>

      <div class="card">
        <div class="card-header border-bottom px-4 pt-4 pb-2">
          <h6>Logs</h6>
        </div>
        <div class="card-body p-4">
          <table class="table table-striped table-bordered mb-0">
            <thead>
              <tr>
                <th>User</th>
                <th>Activity</th>
                <th>Date Modified</th>
              </tr>
            </thead>
            <tbody>
              <?php $logs = [] ?>
              <?php if (!count($logs)) { ?>
                <tr>
                  <td class="text-center" colspan="3">No record found</td>
                </tr>
              <?php } ?>
              <?php foreach ($logs as $row1) { ?>
                <tr>
                  <td><?= $row1['user'] ?></td>
                  <td><?= str_replace("%20", " ", $row1['content']); ?></td>
                  <td><?= $row1['date_entered'] ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalPayment" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Add Payment</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('main/addPayment', ['id' => 'frmPayment']) ?>
        <input type="hidden" name="booking_id" value="<?= $booking->booking_id ?>">
        <div class="form-row">
          <div class="form-group col-md-12">
            <label>Payment Option</label>
            <div class="d-flex justify-content-around my-3">
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
        </div>
        <div class="form-group">
          <label>Amount</label>
          <input type="number" class="form-control" name="amount" required>
          <small>Payment will be added up.</small>
        </div>
        <div class="form-group card-div d-none">
          <label>Account Number</label>
          <input type="text" class="form-control" name="card_number" placeholder="XXXX XXXX XXXX XXXX" maxlength="19">
        </div>
        <div class="form-group card-div d-none">
          <label>Account Name</label>
          <input type="text" class="form-control" name="card_name">
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <input type="submit" value="Add Payment" class="btn btn-link" form="frmPayment">
        </div>
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalRefund" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Update Refund</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('main/updateRefund', ['id' => 'frmRefund']) ?>
        <input type="hidden" name="booking_id" value="<?= $booking->booking_id ?>">
        <div class="form-group">
          <label>Refund Amount</label>
          <input type="number" class="form-control" name="refund" required min="0" value="<?= round($booking->refund) ?>">
          <small>Refund amount will be changed.</small>
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <input type="submit" value="Update" class="btn btn-link" form="frmRefund">
        </div>
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
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
  });


  $('[name=card_number]').on('input', function() {
    const value = $(this).val();
    const newValue = value.replace(/[^\dA-Z]/g, '').replace(/(.{4})/g, '$1 ').trim();
    $(this).val(newValue);
  });

  $('[name=payment_option]').change(function() {
    const option = $(this).val();
    $('[name=amount]').focus();
    if (option == 'Cash') {
      $('.card-div').addClass('d-none');
      $('[name=card_number]').val('');
      $('[name=card_name]').val('');
      $('[name=card_number]').removeAttr('required');
      $('[name=card_name]').removeAttr('required');
    } else {
      $('[name=card_number]').attr('required', true);
      $('[name=card_name]').attr('required', true);
      $('.card-div').removeClass('d-none');
    }
  });
</script>