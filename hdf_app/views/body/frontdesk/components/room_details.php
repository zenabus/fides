<div class="card">
  <div class="card-header px-4 pt-4 d-flex justify-content-between align-items-center">
    <h6>Room Details</h6>
    <button class="btn btn-sm mb-2 mt-0 hidable" id="addRoom">Add Room</button>
  </div>
  <div class="card-body px-0 py-2">
    <table class="table table-bordered border-right-0 border-left-0">
      <thead>
        <tr>
          <th class="pl-4">Room</th>
          <th>Duration</th>
          <th>Occupant</th>
          <th class="hidable">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($booked_rooms as $row) { ?>
          <tr>
            <td class="border-left-0 pl-4">
              Room <?= $row['room_number'] ?><br>
              <small><?= $row['room_type'] ?></small><br>
              <?php if ($row['change_reason']) { ?>
                <small style="font-style:italic">(Change room - <?= $row['change_reason'] ?>)</small>
              <?php } ?>
            </td>
            <td class="action">
              <?= $row['nights'] ?> night<?= $row['nights'] == 1 ? '' : 's' ?><br>
              <small class="px-0"><?= $row['check_in'] ?> - <?= $row['check_out'] ?></small>
              <?php if ($row['check_out'] == date('m/d/Y')) { ?>
                <i class="fa-solid fa-calendar-day heart px-0"></i>
              <?php } ?>
              <?php if ($row['booked_room_archived'] == 2) { ?>
                <br>
                <button class="btn btn-success btn-sm change mt-2" id='<?= json_encode($row) ?>' data-placement="top" title="Update Room" rel="tooltip">
                  <span class=" fa fa-refresh"></span>
                </button>
              <?php } ?>
            </td>
            <td>
              <?php [$name, $contact, $email] = explode(' / ', $row['occupant']) ?>
              <?= $name ?><br><small><?= $email ?><br><?= $contact ?></small>
            </td>
            <td class="border-right-0 action">
              <?php if ($row['booked_room_archived'] == 2) { ?>
                <small class="<?= $row['early_check_out'] ? 'text-danger' : '' ?>"><b>THIS ROOM WAS CHECKED OUT <?= $row['early_check_out'] ? 'EARLY' : '' ?></b></small> <br>
                <small>Note: <?= $row['process_reason'] ?></small><br>
                <small>Processed: <?= $row['processed_by'] ?></small><br>
                <?php
                $date_time = date_create($row['booked_room_updated']);
                $date_time = date_format($date_time, "M d, Y h:i a");
                ?>
                <small>Date: <?= $date_time ?></small><br>
                <?php if ($_SESSION['user_type'] == 'Front Desk') { ?>
                  <!-- <a href="<?= base_url('index.php/main/revert/request') ?>" class="btn btn-sm ml-2 mt-1 btn-success" data-placement="top" title="Request Revert Checkout" rel="tooltip">
                    <i class="fa-solid fa-rotate-left"></i>
                  </a> -->
                <?php } elseif ($_SESSION['user_type'] == 'Admin' || $_SESSION['user_type'] == 'Superadmin') { ?>
                  <!-- <a href="<?= base_url('index.php/main/revert/approve') ?>" class="btn btn-sm ml-2 mt-1 btn-success" data-placement="top" title="Revert Checkout" rel="tooltip">
                    <i class="fa-solid fa-rotate-left"></i>
                  </a> -->
                <?php } ?>
              <?php } elseif ($row['booked_room_archived'] == 0) { ?>
                <button class="btn btn-secondary btn-sm occupant ml-2" id='<?= json_encode($row) ?>' data-placement="top" title="Room Occupant" rel="tooltip">
                  <span class=" fa fa-user"></span>
                </button>
                <button class="btn btn-success btn-sm change" id='<?= json_encode($row) ?>' data-placement="top" title="Change Room" rel="tooltip">
                  <span class=" fa fa-refresh"></span>
                </button>
                <button class="btn btn-info btn-sm extra" id='<?= json_encode($row) ?>' data-placement="top" title="Extra Bed & Person" rel="tooltip">
                  <i class="fa-solid fa-bed"></i>
                </button>
                <button class="btn btn-warning btn-sm discount" id='<?= json_encode($row) ?>' data-placement="top" title="Update Discount" rel="tooltip">
                  <span class="fa fa-percent"></span>
                </button>
                <a href="<?= base_url('index.php/main/soa/' . $row['booked_room_id']) ?>" class="btn btn-warning btn-sm soa" data-placement="top" title="Statement of Account" rel="tooltip">
                  <span class="fa fa-receipt"></span>
                </a>
                <br>
                <button class="btn btn-primary btn-sm mt-1 charges ml-2" id='<?= $row['booked_room_id'] ?>' data-placement="top" title="Restaurant & Coffeeshop Charges" rel="tooltip">
                  <i class="fa-solid fa-utensils"></i>
                  <i class="fa-solid fa-mug-saucer"></i>
                </button>
                <button class="btn btn-primary btn-sm mt-1 amenities" id='<?= $row['booked_room_id'] ?>' data-placement="top" title="Amenities & Other Charges" rel="tooltip">
                  <i class="fa-solid fa-tv"></i>
                  <i class="fa-solid fa-person-circle-exclamation"></i>
                </button>
                <a href="javascript:" id="<?= $row['booked_room_id'] ?>" class="btn btn-success btn-sm mt-1 checkout" data-placement="top" title="Checkout Room" rel="tooltip">
                  <i class="fa-solid fa-right-from-bracket"></i>
                </a>
                <?php if (count($booked_rooms) != 1) { ?>
                  <a href="javascript:" id="<?= $row['booked_room_id'] ?>" class="btn btn-danger btn-sm mt-1 removeRoom" data-placement="top" title="Remove Room" rel="tooltip">
                    <span class="fa fa-trash"></span>
                  </a>
              <?php }
              } ?>
            </td>
          </tr>
        <?php }  ?>
        <?php foreach ($archived_rooms as $row) { ?>
          <tr>
            <td class="border-left-0 pl-4">
              Room <?= $row['room_number'] ?><br>
              <small><?= $row['room_type'] ?></small><br>
              <?php if ($row['change_reason']) { ?>
                <small style="font-style:italic">(Change room - <?= $row['change_reason'] ?>)</small>
              <?php } ?>
            </td>
            <td>
              <?= $row['nights'] ?> night<?= $row['nights'] == 1 ? '' : 's' ?><br>
              <small><?= $row['check_in'] ?> - <?= $row['check_out'] ?></small>
            </td>
            <td>
              <?php [$name, $contact, $email] = explode(' / ', $row['occupant']) ?>
              <?= $name ?><br><small><?= $email ?><br><?= $contact ?></small>
            </td>
            <td class="border-right-0 action hidable">
              <small><b>THIS ROOM WAS DELETED</b></small> <br>
              <small>Reason: <?= $row['process_reason'] ?></small><br>
              <small>Processed: <?= $row['processed_by'] ?></small><br>
              <?php
              $date_time = date_create($row['booked_room_updated']);
              $date_time = date_format($date_time, "M d, Y h:i a");
              ?>
              <small>Date: <?= $date_time ?></small>
            </td>
          </tr>
        <?php }  ?>
      </tbody>
    </table>
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
        <input type="hidden" name="booking_id" value="<?= $booking->booking_id ?>">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Bed</label>
            <input type="number" class="form-control" value="0" min="0" required name="extra_bed">
          </div>
          <!-- <div class="form-group col-md-3">
            <label>Nights</label>
            <input type="number" class="form-control" value="1" min="1" required name="extra_bed_nights">
          </div> -->
          <div class="form-group col-md-6">
            <label>Subtotal</label>
            <input type="text" class="form-control" readonly value="₱ <?= number_format($bed->price) ?>" tabindex="-1" id="subtotal_bed">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Person</label>
            <input type="number" class="form-control" value="0" min="0" required name="extra_person">
          </div>
          <!-- <div class="form-group col-md-3">
            <label>Nights</label>
            <input type="number" class="form-control" value="1" min="1" required name="extra_person_nights">
          </div> -->
          <div class="form-group col-md-6">
            <label>Subtotal</label>
            <input type="text" class="form-control" readonly value="₱ <?= number_format($person->price) ?>" tabindex="-1" id="subtotal_person">
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
          <input type="submit" value="Update" class="btn btn-link" form="frmExtra">
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
        <h4 class="title title-up">Update Discount</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('main/updateDiscount', ['id' => 'frmDiscount']) ?>
        <input type="hidden" name="booked_room_id">
        <input type="hidden" name="booking_id" value="<?= $booking->booking_id ?>">
        <div class="form-group">
          <label>Discount Type</label>
          <select name="discount_id" class="form-control" required>
            <?php foreach ($discounts as $row) { ?>
              <?php if ($row['discount_type'] == 'N/A') { ?>
                <option value="<?= $row['discount_id'] ?>" using_formula="<?= $row['percentage'] ?>" percentage="<?= $row['percentage'] ?>"><?= $row['discount_type'] ?> (<?= $row['percentage'] ?><?= $row['using_formula'] ? '' : '%' ?>)</option>
              <?php } ?>
            <?php } ?>
            <?php foreach ($discounts as $row) { ?>
              <?php if ($row['discount_type'] != 'N/A') {
                if ($row['using_formula'] == 0) { ?>
                  <option value="<?= $row['discount_id'] ?>" using_formula="0" percentage="<?= $row['percentage'] ?>"><?= $row['discount_type'] ?> (<?= $row['percentage'] ?>%)</option>
                <?php } else { ?>
                  <?php $discount_type = explode(' ', $row['discount_type']);
                    if(count($discount_type)==4) {
                      [$id, $label, $occupants] = $discount_type;
                    }
                    if ($occupants) { ?>
                      <option class="using_formula id<?= $id ?> occupants<?= $occupants ?>" value="<?= $row['discount_id'] ?>" using_formula="1" percentage="<?= $row['percentage'] ?>"><?= 'SC/PWD (' . $id . ' ' . $label . ')' ?></option>
                  <?php } ?>
              <?php }
              } ?>
            <?php } ?>
          </select>
        </div>
        <div class="form-row">
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
          <input type="submit" value="Apply" class="btn btn-link" form="frmDiscount">
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
        <h4 class="title title-up room-title ">Add Room</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('main/bookRoom', ['id' => 'frmRoom']) ?>
        <input type="hidden" name="booked_room_id">
        <input type="hidden" name="booking_id" value="<?= $booking->booking_id ?>">
        <input type="hidden" name="room_id">
        <a href="javascript:" class="btn btn-block" id="calendar">Open Express Calendar <span class="fa fa-window-restore"></span></a>
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
            <input type="number" class="form-control" name="nights" required autocomplete="off" min="1" value="1" readonly>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label>Check In</label>
            <input type="text" class="form-control" name="check_in" readonly>
          </div>
          <div class="form-group col-md-6">
            <label>Check Out</label>
            <input type="text" class="form-control checkoutpicker" name="check_out" required>
          </div>
        </div>
        <div class="form-group div-reason">
          <label>Change Room Reason</label>
          <textarea name="change_reason" class="form-control"></textarea>
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <input type="submit" value="Add Room" class="btn btn-link btn-room" form="frmRoom" disabled>
        </div>
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalCharges" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up mb-0">Charges</h4>
        <h6 class="mt-0 text-muted">Restaurant & Coffeeshop</h6>
      </div>
      <div class="modal-body px-4">
        <?= form_open('main/addCharges', ['id' => 'frmCharges']) ?>
        <input type="hidden" name="booking_id" value="<?= $booking->booking_id ?>">
        <input type="hidden" name="booked_room_id">
        <div class="form-row d-flex justify-content-around mb-3">
          <div class="form-check-radio mb-0">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="charge_type" value="Restaurant" checked>
              Restaurant
              <span class="form-check-sign"></span>
            </label>
          </div>
          <div class="form-check-radio mb-0">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="charge_type" value="Coffeeshop">
              Coffeeshop
              <span class="form-check-sign"></span>
            </label>
          </div>
        </div>
        <div class="form-group">
          <label>Particulars</label>
          <input type="text" class="form-control" name="particulars" required>
        </div>
        <div class="form-group">
          <label>Reference</label>
          <input type="text" class="form-control" name="reference">
        </div>
        <div class="form-group">
          <label>Unit Cost</label>
          <input type="number" class="form-control" name="charges_food_amount" min="1" value="1">
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <input type="submit" value="Add" class="btn btn-link" form="frmCharges">
        </div>
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalAmenities" tabindex="-1" role="dialog">
  <div class="modal-dialog pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up mb-0">Amenities</h4>
        <h6 class="mt-0 text-muted">And Other Charges</h6>
      </div>
      <div class="modal-body px-4">
        <?= form_open('main/addOtherCharges', ['id' => 'frmAmenities']) ?>
        <input type="hidden" name="booked_room_id">
        <input type="hidden" name="booking_id" value="<?= $booking->booking_id ?>">
        <div class="form-group">
          <label>Category</label>
          <select id="category" class="form-control" required>
            <option value="">- select category -</option>
            <?php foreach ($categories as $row) { ?>
              <option value="<?= $row['category_id'] ?>"><?= $row['category'] ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label>Charge Type</label>
          <select name="charge_id" id="charge_type" class="form-control" required>
            <option value="">- select charge type -</option>
          </select>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Quantity</label>
            <input type="number" class="form-control" name="charge_quantity" min="1" value="1" required>
          </div>
          <div class="form-group col-md-4">
            <label>Unit Cost</label>
            <input type="text" class="form-control" id="charge_amount" readonly>
          </div>
          <div class="form-group col-md-4">
            <label>Subtotal</label>
            <input type="text" class="form-control" id="charge_total_amount" readonly>
          </div>
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <input type="submit" value="Add" class="btn btn-link" form="frmAmenities">
        </div>
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalOccupant" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up mb-0">Occupant</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('main/updateOccupant', ['id' => 'frmOccupant']) ?>
        <input type="hidden" name="booked_room_id">
        <input type="hidden" name="booking_id" value="<?= $booking->booking_id ?>">
        <div class="form-group">
          <label>Guest Name</label>
          <input type="text" class="form-control" id="guest" name="guest" required>
        </div>
        <div class="form-group">
          <label>Contact Number</label>
          <input type="text" class="form-control" id="contact" name="contact">
        </div>
        <div class="form-group">
          <label>Email Address</label>
          <input type="email" class="form-control" id="email" name="email">
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <input type="submit" value="Update" class="btn btn-link" form="frmOccupant">
        </div>
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalReason" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Remove Room</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('main/removeRoom', ['id' => 'frmRemove']) ?>
        <input type="hidden" name="booked_room_id">
        <div class="form-group">
          <label>Reason</label>
          <textarea class="form-control" name="process_reason" required></textarea>
          <small>Note: All charges in this room will be deleted</small>
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <button type="submit" class="btn btn-link" form="frmRemove">Confirm</button>
        </div>
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalCheckout" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Checkout Room</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('main/checkoutRoom', ['id' => 'frmCheckout']) ?>
        <input type="hidden" name="booked_room_id">
        <div class="form-group">
          <label>Note</label>
          <textarea class="form-control" name="process_reason" required></textarea>
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <button type="submit" class="btn btn-link" form="frmCheckout">Confirm</button>
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
  const base_url = '<?= base_url() ?>';
  const price_bed = '<?= $bed->price ?>';
  const price_person = '<?= $person->price ?>';
  const charges = JSON.parse(`<?= json_encode($charges) ?>`);
  const reservation_status = '<?= $booking->reservation_status ?>';
  let charge_amount = 0;
  let quantity = 1;
  let subtotal_bed = 0;
  let subtotal_person = 0;
  let room_rate = 0;
  let nights = 0;
  let food_quantity = 1;
  let food_cost = 1;

  let minDate = new Date();
  minDate.setDate(minDate.getDate() - 1);
  $(".checkoutpicker").datetimepicker({
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
    format: "L",
    defaultDate: new Date(),
    minDate,
  });

  $("[name=nights]").on("input", function() {
    const nights = parseInt($(this).val());
    const checkin = moment($("[name=check_in]").val());
    const additional = moment(checkin).add(nights, "days");
    $("[name=check_out]").data("DateTimePicker").date(additional);
    // if (!nights || nights > 0) {
    //   $(this).val(1);
    // }
    $("[name=check_out]").data("DateTimePicker").date(checkout);
    $('.btn-room').removeAttr('disabled');
  });

  $('[name=check_in], [name=check_out]').on('dp.change', function(e) {
    const checkin = moment($('[name=check_in]').val());
    const checkout = moment($('[name=check_out]').val());
    const nights = checkout.diff(checkin, 'days');
    $('[name=nights]').val(nights);
    $('.btn-room').removeAttr('disabled');
  });

  $('.extra').click(function() {
    const data = JSON.parse(this.id);
    subtotal_bed = data.extra_bed * price_bed;
    subtotal_person = data.extra_person * price_person;
    $('[name=booked_room_id]').val(data.booked_room_id);
    $('[name=extra_bed]').val(data.extra_bed);
    $('[name=extra_person]').val(data.extra_person);
    extraPrices();
    $('#modalExtra').modal('show');
  });

  $('.discount').click(function() {
    const data = JSON.parse(this.id);
    let value = data.percentage
    let discounted = 0;

    console.log(data);
    console.log(data.max_persons);
    console.log(data.room_type_abbr);

    if (data.max_persons == 2) {
      $('.occupants3').hide();
    } else {
      $('.occupants3').show();
    }

    if (data.max_persons == 3) {
      $('.occupants2').hide();
    } else {
      $('.occupants2').show();
    }

    room_rate = data.pricing_type;
    nights = data.nights;

    if (data.using_formula == '1') {
      const [multiplicand, multiplier] = value.split('x');
      discounted = parseFloat(room_rate - (room_rate / parseFloat(multiplicand) * parseFloat(multiplier))).toFixed(2);
    } else {
      value = value / 100;
      discounted = room_rate - room_rate * value;
    }

    $('[name=booked_room_id]').val(data.booked_room_id);
    $('[name=discount_id').val(data.discount_id);
    $('#room_rate').val('₱ ' + formatNumber(room_rate));
    $('#nights').val(nights);
    $('#discount_subtotal').val('₱ ' + formatNumber(discounted * nights));
    $('#modalDiscount').modal('show');
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
    $('#subtotal_bed').val('₱ ' + formatNumber(subtotal_bed));
    $('#subtotal_person').val('₱ ' + formatNumber(subtotal_person));
    $('#total').val('₱ ' + formatNumber(subtotal_bed + subtotal_person));
  }

  $('[name=discount_id').change(function() {
    const using_formula = parseInt($(this).find(':selected').attr('using_formula'));
    let value = $(this).find(':selected').attr('percentage');
    let discounted = 0;

    if (using_formula) {
      const [multiplicand, multiplier] = value.split('x');
      discounted = parseFloat(room_rate - (room_rate / parseFloat(multiplicand) * parseFloat(multiplier))).toFixed(2);
    } else {
      value = value / 100;
      discounted = room_rate - room_rate * value
    }
    $('#discount_subtotal').val('₱ ' + formatNumber(discounted * nights));
  });

  $('#calendar').click(function() {
    const date = new Date();
    const size = ['height=' + screen.height / 2, 'width=' + screen.width / 2].join(',');
    const calendar = window.open(`${base_url}index.php/main/calendar/${date.getFullYear()}/${pad(date.getMonth()+1)}/1`, "Calendar", size);
    calendar.onbeforeunload = function() {
      $('.btn-room').attr('disabled', false)
      $('[name=check_in]').val(localStorage.getItem('check_in'));
      $('[name=check_out]').val(localStorage.getItem('check_out'));
      $('[name=room_id]').val(localStorage.getItem('room_id'));
      $('.room_type').val(localStorage.getItem('room_type'));
      $('.room_number').val(localStorage.getItem('room_number'));
      $('[name=nights]').val(localStorage.getItem('nights'));
      localStorage.removeItem('check_in');
      localStorage.removeItem('check_out');
      localStorage.removeItem('room_id');
      localStorage.removeItem('room_type');
      localStorage.removeItem('room_number');
      localStorage.removeItem('nights');
    }
  });

  $('#addRoom').click(function() {
    $('#frmRoom').attr('action', `${base_url}index.php/main/bookRoom`).trigger('reset');
    $('.div-reason').hide();
    $('.room-title').text('Add Room');
    $('.btn-room').val('Add')
    $('#modalRoom').modal('show');
    $('[name=nights]').attr('readonly', true);
    $('[name=check_out]').attr('readonly', true);
  });

  $('.change').click(function() {
    const data = JSON.parse(this.id);
    console.log(data);

    localStorage.setItem('highlight_room_id', data.room_id);
    localStorage.setItem('highlight_between', JSON.stringify(getDatesBetween(data.check_in, data.check_out)));

    $('[name=booked_room_id]').val(data.booked_room_id);
    $('[name=room_id]').val(data.room_id);
    $('[name=check_in]').val(data.check_in);
    $('[name=check_out]').val(data.check_out).removeAttr('readonly');
    $('.room_type').val(data.room_type);
    $('.room_number').val(data.room_number);
    $('[name=nights]').val(data.nights);
    $('#frmRoom').attr('action', `${base_url}index.php/main/changeRoom`);
    $('.room-title').text('Change Room');
    $('.btn-room').val('Update');
    $('.div-reason').show();
    $('#modalRoom').modal('show');
  });

  $('.charges').click(function() {
    $('[name=booked_room_id]').val(this.id);
    $('#modalCharges').modal('show');
  });

  $('.amenities').click(function() {
    $('[name=booked_room_id]').val(this.id);
    $('#modalAmenities').modal('show');
  });

  $('.occupant').click(function() {
    const data = JSON.parse(this.id)
    const [guest, contact, email] = data.occupant.split(' / ');
    $('[name=booked_room_id]').val(data.booked_room_id);
    $('#guest').val(guest);
    $('#contact').val(contact);
    $('#email').val(email);
    $('#modalOccupant').modal('show');
  });

  $('#category').change(function() {
    const charge = charges.filter(charge => charge.category_id == this.value);
    $("#charge_type").empty().trigger('change');
    $("#charge_type").append('<option>- select charge type -</option>');
    charge.map(c => {
      const text = c.charge_amount == '0.00' ? `₱ ${formatNumber(Math.round(c.charge_amount))} - ${c.charge}` : c.charge;;
      const option = $('<option></option>')
        .attr("value", c.charge_id)
        .attr("amount", c.charge_amount)
        .text(text);
      $("#charge_type").append(option);
    });
  });

  $('#charge_type').change(function() {
    charge_amount = $(this).find(':selected').attr('amount') || 0;
    $('#charge_amount').val(`₱ ${formatNumber(Math.round(charge_amount))}`);
    $('#charge_total_amount').val(`₱ ${formatNumber(Math.round(charge_amount * quantity))}`);
  });

  $('[name=charge_quantity]').on('input', function() {
    quantity = $(this).val();
    $('#charge_total_amount').val(`₱ ${formatNumber(Math.round(charge_amount * quantity))}`);
  });

  $('[name=charges_food_quantity]').on('input', function() {
    food_quantity = $(this).val();
    $('#charges_food_total').val(`₱ ${formatNumber(Math.round(food_cost * food_quantity))}`);
  });

  $('[name=charges_food_amount]').on('input', function() {
    food_cost = $(this).val();
    $('#charges_food_total').val(`₱ ${formatNumber(Math.round(food_cost * food_quantity))}`);
  });

  $('.removeRoom').click(function() {
    $('[name=booked_room_id]').val(this.id);
    $('#modalReason').modal('show')
  });

  $('.checkout').click(function() {
    $('[name=booked_room_id]').val(this.id);
    $('#modalCheckout').modal('show')
  });

  $(document).on('click', '.soa', function(e) {
    e.preventDefault();
    const size = ['height=' + screen.height / 2, 'width=' + screen.width / 2].join(',');
    window.open($(this).attr('href'), size, size);
  });
</script>