<div class="content pb-0">
  <h5>Room <?= $booking->room_number ?> - <?= $booking->last_name ?>, <?= $booking->first_name ?> <?= $booking->middle_name ?></h5>
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header px-4 pt-4">
          <h6>Room Details</h6>
        </div>
        <div class="card-body px-0 py-2">
          <table class="table table-bordered border-right-0 border-left-0">
            <thead>
              <tr>
                <th class="pl-4">Room Type</th>
                <th>Room No.</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="border-left-0 pl-4"><?= $booking->room_type ?></td>
                <td><?= $booking->room_number ?></td>
                <td><?= STATUS[$booking->reservation_status] ?></td>
                <td class="border-right-0">
                  <button class="btn btn-info btn-sm" data-placement="top" title="Change Room" rel="tooltip">
                    <span class="fa fa-refresh"></span>
                  </button>
                  <button class="btn btn-primary btn-sm" data-placement="top" title="Add Extras" rel="tooltip">
                    <span class="fa fa-plus"></span>
                  </button>
                  <button class="btn btn-success btn-sm" data-placement="top" title="Update Guest" rel="tooltip">
                    <span class="fa fa-user"></span>
                  </button>
                  <button class="btn btn-danger btn-sm" data-placement="top" title="Checkout" rel="tooltip">
                    <span class="fa fa-sign-out"></span>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card">
        <div class="card-header border-bottom px-4 pt-4 pb-2">
          <h6>Guest Details</h6>
        </div>
        <div class="card-body p-0">
          <div class="form-row px-4 py-3 border-bottom">
            <div class="form-group col-md-3">
              <label>Check In</label>
              <input type="text" class="form-control datepicker" name="check_in" value="<?= $booking->check_in ?>">
            </div>
            <div class="form-group col-md-3">
              <label>Check Out</label>
              <input type="text" class="form-control datepicker" name="check_out" value="<?= $booking->check_out ?>">
            </div>
            <div class="form-group col-md-3">
              <label>Nights</label>
              <input type="number" class="form-control" name="nights" value="<?= $booking->nights ?>">
            </div>
            <div class="form-group col-md-3">
              <label>&nbsp;</label>
              <input type="button" class="btn btn-default btn-block mt-0" value="Change Dates">
            </div>
          </div>

          <div class="px-4 py-3 border-bottom">
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
        <div class="card-body">
          <textarea class="form-control px-2 pt-1" name="notes"></textarea>
        </div>
        <div class="card-footer my-2 border-top">
          <input type="submit" value="Save Notes" class="btn btn-default">
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-header border-bottom px-4 pt-4 pb-2">
          <h6>Collection Details</h6>
        </div>
        <div class="card-body">
          <a href="javascript:" class="btn mt-0 btn-info btn-sm" data-toggle="modal" data-target="#charges">Charges</a>
          <a href="javascript:" class="btn mt-0 btn-info btn-sm" data-toggle="modal" data-target="#chargesAmen">Amenities</a>
          <a href="javascript:" class="btn mt-0 btn-primary btn-sm" data-toggle="modal" data-target="#ModalRoom">Extra</a>
          <a href="javascript:" class="btn mt-0 btn-success btn-sm">Payment</a>
          <a href="javascript:" class="btn mt-0 btn-warning btn-sm">Discount</a>
          <a href="javascript:" class="btn mt-0 btn-danger btn-sm">Refund</a>
          <table class="table mb-0">
            <thead>
              <tr class="bg-default text-white">
                <th>Name</th>
                <th>Unit</th>
                <th>Unit Cost</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>202</td>
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
                <td>Discount(s)</td>
                <td>N/A</td>
                <td>0%</td>
                <td>₱ -0.00</td>
              </tr>
              <tr>
                <td>Total</td>
                <td></td>
                <td></td>
                <td>₱ 0.00</td>
              </tr>
              <tr>
                <td>Refund Amount</td>
                <td></td>
                <td></td>
                <td>₱ 0.00</td>
              </tr>
              <tr>
                <td>Advanced Payment</td>
                <td></td>
                <td></td>
                <td>₱ 0.00</td>
              </tr>
              <tr class="bg-default text-white">
                <td>Total Balance</td>
                <td></td>
                <td></td>
                <td>₱ 0.00</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="card-footer my-2 border-top">
          <button class="btn btn-default">Complete Order</button>
        </div>
      </div>

      <div class="card">
        <div class="card-header border-bottom px-4 pt-4 pb-2">
          <h6>Logs</h6>
        </div>
        <div class="card-body">
          <table class="table table-striped table-bordered mb-2">
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
          <input type="hidden" value="<?= $result_room_form[0]['id'] ?>" name="check_id">
          <input type="hidden" name="room_id" id="room_id">
          <div class="form-group">
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
                <?php foreach ($result_deduction as $data) { ?>
                  <option value="<?= $data['id_ded'] ?>"><?= $data['name'];
                                                          echo "-";
                                                          echo $data['deduction']; ?>%</option>
                <?php } ?>
              </select>
            </div>

            <div class="form-group">
              <label></label>
              <select style="display: none" class="form-control" name="breakfast" id="breakfasts" required>
                <option value="200">With Breakfast</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="left-side">
            <input type="submit" value="Update" class="btn btn-danger btn-link">
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
          <input type="hidden" value="" name="check_id">
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
                <?php foreach ($result_room_type as $data) { ?>
                  <option value="<?= $data['id'] ?>"><?= $data['room_type'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Room Number</label>
              <select class="form-control" name="room_number" id="room_number1" required>
                <option value="">Select</option>
                <?php foreach ($room_number as $data) { ?>
                  <option id="<?= $data['room_type_id'] ?>"><?= $data['room_number'] ?></option>
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
                <?php foreach ($result_deduction as $data) { ?>
                  <option value="<?= $data['id_ded'] ?>"><?= $data['name'] ?></option>
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
        <table id="" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Room Type</th>
              <th>Number of Room/s</th>
            </tr>
          </thead>
          <?php foreach ($result_reservation as $data) { ?>
            <tr>
              <td><?= $data['room_type_id'] ?></td>
              <td><?= $data['room_number_res'] ?></td>
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

<div class="modal fade" id="charges" tabindex="-1" role="dialog" aria-labelledby="roomLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header justify-content-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="nc-icon nc-simple-remove"></i>
        </button>
        <h4 class="title title-up" id="LabelRoom3">Resto and Coffee Shop Charges</h4>
      </div>
      <form action="<?= base_url('index.php/main/insertChargestoFO') ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="id" value="">
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
            <input type="submit" class="btn btn-success btn-link" value="Add Charges" onclick="return confirm('Are you sure to add charges?')">
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

<div class="modal fade" id="chargesAmen" tabindex="-1" role="dialog" aria-labelledby="roomLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header justify-content-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="nc-icon nc-simple-remove"></i>
        </button>
        <h4 class="title title-up" id="LabelRoom3">Amenities and Other Charges</h4>
      </div>
      <form action="<?= base_url('index.php/main/insertChargestoAmenities') ?>" method="post">
        <input type="hidden" name="id" value="">
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
              <option value="S1">Linens - 250.00</option>
              <option value="S2">Towel - 200.00</option>
              <option value="S3">Bathmat - 100.00</option>
              <option value="S4">Smoking inside the room - 2500.00</option>
            </select>
          </div>

          <div class="form-group" id="5" style="display: none;">
            <label>Early and Late Charges</label>
            <select class="form-control" name="E">
              <option value="E1">Early Check In</option>
              <option value="E2">Late Check Out</option>
            </select>
          </div>

          <div class="form-group">
            <input type="hidden" class="form-control" name="qty" value="1">
          </div>
        </div>
        <div class="modal-footer">
          <div class="left-side">
            <input type="submit" class="btn btn-success btn-link" value="Add Charges" onclick="return confirm('Are you sure to add  this charges?')">
          </div>
          <div class="right-side">
            <button type="button" class="btn btn-default btn-link" data-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
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



<script src="<?= base_url() ?>assets/demo/demo.js"></script>

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
</script>