<div class="content pb-0">
  <h5>Booking Number: <?= $booking->booking_number ?></h5>
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header px-4 pt-4 d-flex justify-content-between align-items-center">
          <h6>Room Details</h6>
          <button class="btn btn-sm btn-default mb-2 mt-0" id="addRoom" data-target="#modalRoom" data-toggle="modal">Add Room</button>
        </div>
        <div class="card-body px-0 py-2">
          <table class="table table-bordered border-right-0 border-left-0">
            <thead>
              <tr>
                <th class="pl-4">Room</th>
                <th>Room Rate</th>
                <th>Discount</th>
                <th>Subtotal</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($booked_rooms as $row) { ?>
                <tr>
                  <td class="border-left-0 pl-4">
                    Room <?= $row['room_number'] ?> - <?= $row['room_type'] ?><br>
                    <small><?= $row['check_in'] ?> - <?= $row['check_out'] ?> (<?= $row['nights'] ?> night<?= $row['nights'] == 1 ? '' : 's' ?>)</small>
                  </td>
                  <td>
                    ₱ <?= number_format($row['pricing_type'], 2) ?> x <?= $row['nights'] ?><br>
                    <small>Per night</small>
                  </td>
                  <td>
                    ₱ -<?= number_format($row['pricing_type'] * $row['nights'] * ($row['percentage'] / 100), 2) ?><br>
                    <small><?= $row['discount_type'] ?> (<?= $row['percentage'] ?>%)</small>
                  </td>
                  <td>
                    ₱ <?= number_format($row['pricing_type'] * $row['nights']  - ($row['pricing_type'] * $row['nights'] * ($row['percentage'] / 100)), 2) ?><br>
                    <small><?= $row['discount_type'] ?> (<?= $row['percentage'] ?>%)</small>
                  </td>
                  <td class="border-right-0 action">
                    <button class="btn btn-info btn-sm extra" id='<?= json_encode($row) ?>' data-placement="top" title="Change Room" rel="tooltip" data-target="#modalRoom" data-toggle="modal">
                      <span class=" fa fa-refresh"></span>
                    </button>
                    <button class="btn btn-primary btn-sm extra" id='<?= json_encode($row) ?>' data-placement="top" title="Update Extras" rel="tooltip" data-target="#modalExtra" data-toggle="modal">
                      <span class=" fa fa-plus"></span>
                    </button>
                    <button class="btn btn-warning btn-sm discount" id='<?= json_encode($row) ?>' data-placement="top" title="Update Discount" rel="tooltip" data-target="#modalDiscount" data-toggle="modal">
                      <span class="fa fa-percent"></span>
                    </button>
                  </td>
                </tr>
              <?php }  ?>
            </tbody>
          </table>
        </div>
      </div>
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

          <div class="px-4 py-3 border-bottom">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Payment Option</label>
                <div class="d-flex justify-content-around my-3">
                  <div class="form-check-radio mb-0">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="payment_option" value="Cash" <?= $booking->payment_option == 'Cash' ? 'checked' : '' ?>>
                      Cash
                      <span class="form-check-sign"></span>
                    </label>
                  </div>
                  <div class="form-check-radio mb-0">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="payment_option" value="Card" <?= $booking->payment_option == 'Card' ? 'checked' : '' ?>>
                      Card
                      <span class="form-check-sign"></span>
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Amount Paid</label>
                <input type="text" class="form-control">
              </div>
              <div class="form-group col-md-6">
                <label>Refund</label>
                <input type="text" class="form-control">
              </div>
            </div>
            <div class="form-row card-div <?= $booking->payment_option == 'Cash' ? 'd-none' : '' ?>">
              <div class="form-group col-md-6">
                <label>Card Account Number</label>
                <input type="text" class="form-control" name="card_number" placeholder="XXXX XXXX XXXX XXXX" maxlength="19">
              </div>
              <div class="form-group col-md-6">
                <label>Card Account Name</label>
                <input type="text" class="form-control" name="card_name">
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
            <a href="javascript:" class="btn mt-0 btn-info btn-sm" data-toggle="modal" data-target="#charges">Charges</a>
            <a href="javascript:" class="btn mt-0 btn-info btn-sm" data-toggle="modal" data-target="#chargesAmen">Amenities</a>
            <a href="javascript:" class="btn mt-0 btn-primary btn-sm" data-toggle="modal" data-target="#ModalRoom">Extra</a>
            <a href="javascript:" class="btn mt-0 btn-success btn-sm">Payment</a>
            <a href="javascript:" class="btn mt-0 btn-danger btn-sm">Refund</a>
          </div>
          <table class="table mb-0">
            <thead>
              <tr class="bg-default text-white">
                <th class="pl-4">Name</th>
                <th>Unit</th>
                <th>Unit Cost</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="pl-4">202</td>
                <td>(0) Day(s)</td>
                <td>₱ 0.00</td>
                <td>₱ 0.00</td>
              </tr>
              <tr>
                <td></td>
                <td>(0) Extra Bed(s)</td>
                <td>₱ 0.00</td>
                <td>₱ 0.00</td>
              </tr>
              <tr>
                <td></td>
                <td>(0) Extra Person(s)</td>
                <td>₱ 0.00</td>
                <td>₱ 0.00</td>
              </tr>
              <tr>
                <td class="pl-4">Discount(s)</td>
                <td>N/A</td>
                <td>0%</td>
                <td>₱ -0.00</td>
              </tr>
              <tr>
                <td class="pl-4">Total</td>
                <td></td>
                <td></td>
                <td>₱ 0.00</td>
              </tr>
              <tr>
                <td class="pl-4">Refund Amount</td>
                <td></td>
                <td></td>
                <td>₱ 0.00</td>
              </tr>
              <tr>
                <td class="pl-4">Advanced Payment</td>
                <td></td>
                <td></td>
                <td>₱ 0.00</td>
              </tr>
              <tr class="bg-default text-white">
                <td class="pl-4">Total Balance</td>
                <td></td>
                <td></td>
                <td>₱ 0.00</td>
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

<div class="modal fade" id="modalExtra" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Update Extras</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('main/updateExtras', ['id' => 'frmExtra']) ?>
        <input type="hidden" name="booked_room_id">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Extra Bed</label>
            <input type="number" class="form-control" value="0" min="0" required name="extra_bed">
          </div>
          <div class="form-group col-md-6">
            <label>Subtotal</label>
            <input type="text" class="form-control" readonly value="₱ <?= number_format($bed->price, 2) ?>" tabindex="-1" id="subtotal_bed">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Extra Person</label>
            <input type="number" class="form-control" value="0" min="0" required name="extra_person">
          </div>
          <div class="form-group col-md-6">
            <label>Subtotal</label>
            <input type="text" class="form-control" readonly value="₱ <?= number_format($person->price, 2) ?>" tabindex="-1" id="subtotal_person">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6 offset-md-6">
            <label>Total</label>
            <input type="text" class="form-control" readonly value="₱ 0.00" tabindex="-1" id="total">
          </div>
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <input type="submit" value="Update Extras" class="btn btn-link" form="frmExtra">
        </div>
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalDiscount" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Discount</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('main/updateDiscount', ['id' => 'frmDiscount']) ?>
        <input type="hidden" name="booked_room_id">
        <div class="form-group">
          <label>Discount Type</label>
          <select name="discount_id" class="form-control" required>
            <?php foreach ($discounts as $row) { ?>
              <option value="<?= $row['discount_id'] ?>" percentage="<?= $row['percentage'] ?>"><?= $row['discount_type'] ?> (<?= $row['percentage'] ?>%)</option>
            <?php } ?>
          </select>
        </div>
        <div class=" form-row">
          <div class="form-group col-md-6">
            <label>Room Rate</label>
            <input type="text" class="form-control" id="room_rate" readonly tabindex="-1">
          </div>
          <div class="form-group col-md-6">
            <label>Nights</label>
            <input type="text" class="form-control" id="nights" readonly tabindex="-1">
          </div>
        </div>
        <div class="form-group">
          <label>Subtotal</label>
          <input type="text" class="form-control" id="discount_subtotal" readonly tabindex="-1">
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <input type="submit" value="Discount" class="btn btn-link" form="frmDiscount">
        </div>
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalRoom" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Add Room</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('main/addRoom', ['id' => 'frmRoom']) ?>
        <input type="hidden" name="booked_room" value="<?= $booking->booking_id ?>">
        <a href="javascript:" class="btn btn-default btn-block" id="calendar">Open Express Calendar <span class="fa fa-window-restore"></span></a>
        <div class="form-group">
          <label>Room Type</label>
          <input type="text" class="form-control room_type" readonly>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Room No.</label>
            <input type="text" class="form-control room_number" readonly>
          </div>
          <div class="form-group col-md-6">
            <label>Nights</label>
            <input type="text" class="form-control nights" readonly>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Check In Date</label>
            <input type="text" class="form-control check_in">
          </div>
          <div class="form-group col-md-6">
            <label>Check Out Date</label>
            <input type="text" class="form-control check_out">
          </div>
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <input type="submit" value="Add Room" class="btn btn-link" form="frmRoom">
        </div>
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>


<script src="<?= base_url() ?>assets/demo/demo.js"></script>

<script type="text/javascript">
  const base_url = '<?= base_url() ?>'
  const price_bed = '<?= $bed->price ?>';
  const price_person = '<?= $person->price ?>';
  let subtotal_bed = 0;
  let subtotal_person = 0;
  let room_rate = 0;
  let nights = 0;

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

  $('[name=check_in], [name=check_out]').on('dp.change', function(e) {
    const checkin = moment($('[name=check_in]').val());
    const checkout = moment($('[name=check_out]').val());
    const nights = checkout.diff(checkin, 'days');
    $('[name=nights]').val(nights)
  });

  $('.extra').click(function() {
    const data = JSON.parse(this.id);
    subtotal_bed = data.extra_bed * price_bed;
    subtotal_person = data.extra_person * price_person;
    $('[name=booked_room_id]').val(data.booked_room_id);
    $('[name=extra_bed]').val(data.extra_bed);
    $('[name=extra_person]').val(data.extra_person);
    extraPrices();
  });

  $('.discount').click(function() {
    const data = JSON.parse(this.id);
    const percentage = data.percentage / 100;
    room_rate = data.pricing_type;
    nights = data.nights;
    subtotal = room_rate * nights;
    $('[name=booked_room_id]').val(data.booked_room_id);
    $('[name=discount_id').val(data.discount_id);
    $('#room_rate').val('₱ ' + formatNumber(room_rate) + '.00');
    $('#nights').val(nights);
    $('#discount_subtotal').val('₱ ' + formatNumber(subtotal - subtotal * percentage) + '.00');
  });

  $('[name=extra_bed]').on('input', function() {
    subtotal_bed = $(this).val() * price_bed;
    extraPrices();
  });

  $('[name=extra_person]').on('input', function() {
    subtotal_person = $(this).val() * price_person;
    extraPrices();
  });

  function extraPrices() {
    $('#subtotal_bed').val('₱ ' + formatNumber(subtotal_bed) + '.00');
    $('#subtotal_person').val('₱ ' + formatNumber(subtotal_person) + '.00');
    $('#total').val('₱ ' + formatNumber(subtotal_bed + subtotal_person) + '.00');
  }

  $('[name=discount_id').change(function() {
    const percentage = $(this).find(':selected').attr('percentage') / 100;
    const subtotal = room_rate * nights;
    $('#discount_subtotal').val('₱ ' + formatNumber(subtotal - subtotal * percentage) + '.00');
  });

  $('#calendar').click(function() {
    const size = [
      'height=' + screen.height / 2,
      'width=' + screen.width / 2
    ].join(',');
    const calendar = window.open(`${base_url}index.php/main/calendarWindow/2022/08`, "Calendar", size);
    calendar.onbeforeunload = function() {
      console.log('close');
      console.log(localStorage.getItem('test'));
    }
  });
</script>