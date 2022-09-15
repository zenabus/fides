<div class="card">
  <div class="card-header border-bottom px-4 pt-4 pb-3">
    <h6 class="mx-1">Collection Details</h6>
  </div>
  <div class="card-body p-0">
    <table class="table table-sm table-hover mb-0">
      <thead>
        <tr class="bg-default text-white">
          <th class="pl-4">Name</th>
          <th>Unit</th>
          <th>Unit Cost</th>
          <th>Subtotal</th>
          <th>Remaining</th>
        </tr>
      </thead>
      <tbody>
        <?php $grand_total = 0 ?>
        <?php foreach ($booked_rooms as $row) { ?>
          <tr>
            <td class="pl-4">Room <?= $row['room_number'] ?> - <?= $row['room_type'] ?></td>
            <td>(<?= $row['nights'] ?>) Night<?= $row['nights'] != 1 ? 's' : ''  ?></td>
            <td>₱ <?= number_format($row['pricing_type']) ?></td>
            <?php $total = $row['pricing_type'] * $row['nights'] ?>
            <?php $discount = $total * ($row['percentage'] / 100) ?>
            <?php $subtotal = $total - $discount ?>
            <?php $grand_total += $subtotal ?>
            <td>₱ <?= number_format($subtotal) ?> <small data-placement="left" title="<?= $row['discount_type'] ?><br>-₱ <?= number_format($discount) ?>" rel="tooltip" data-html="true">(-<?= $row['percentage'] ?>%)</small></td>
            <td>
              asd
            </td>
          </tr>

          <?php if ($row['extra_bed']) { ?>
            <tr>
              <td class="pl-4"><span class="fa fa-bed text-info"></span></td>
              <td>(<?= $row['extra_bed'] ?>) Extra Bed<?= $row['extra_bed'] != 1 ? 's' : ''  ?></td>
              <?php $bed_total = $bed->price * $row['extra_bed'] ?>
              <td>₱ <?= number_format($bed->price) ?></td>
              <td>
                ₱ <?= number_format($bed->price * $row['extra_bed']) ?>
                <a href="<?= base_url('index.php/main/removeExtra/extra_bed/' . $row['booked_room_id']) ?>" class="float-right mt-1 text-danger confirm hidable" data-placement="left" title="Remove Extra Bed" rel="tooltip">
                  <span class="fa fa-times"></span>
                </a>
              </td>
              <td>asd</td>
              <?php $grand_total += $bed_total ?>
            </tr>
          <?php } ?>

          <?php if ($row['extra_person']) { ?>
            <tr>
              <td class="pl-4"><span class="fa fa-user text-info"></span></td>
              <td>(<?= $row['extra_person'] ?>) Extra Person<?= $row['extra_person'] != 1 ? 's' : ''  ?></td>
              <?php $person_total = $person->price * $row['extra_person'] ?>
              <td>₱ <?= number_format($person->price) ?></td>
              <td>
                ₱ <?= number_format($person_total) ?>
                <a href="<?= base_url('index.php/main/removeExtra/extra_person/' . $row['booked_room_id']) ?>" class="float-right mt-1 text-danger confirm hidable" data-placement="left" title="Remove Extra Person" rel="tooltip">
                  <span class="fa fa-times"></span>
                </a>
              </td>
              <td>asd</td>
              <?php $grand_total += $person_total ?>
            </tr>
          <?php } ?>

          <?php foreach ($row['restaurant'] as $charges) { ?>
            <tr>
              <td class="pl-4"><i class="fa-solid fa-utensils text-success mr-1"></i> <?= $charges['reference'] ?></td>
              <td>(<?= $charges['charges_food_quantity'] ?>) <?= $charges['particulars'] ?></td>
              <td>₱ <?= number_format($charges['charges_food_amount']) ?></td>
              <td>
                ₱ <?= number_format($charges['charges_food_amount'] * $charges['charges_food_quantity']) ?>
                <a href="<?= base_url('index.php/main/removeCharge/charges_food/' . $charges['charges_food_id']) ?>" class="float-right mt-1 text-danger confirm hidable" data-placement="left" title="Remove Restaurant Charge" rel="tooltip">
                  <span class="fa fa-times"></span>
                </a>
              </td>
              <td>asd</td>
            </tr>
          <?php } ?>

          <?php foreach ($row['coffeeshop'] as $charges) { ?>
            <tr>
              <td class="pl-4"><i class="fa-solid fa-mug-saucer text-primary mr-1"></i> <?= $charges['reference'] ?></td>
              <td>(<?= $charges['charges_food_quantity'] ?>) <?= $charges['particulars'] ?></td>
              <td>₱ <?= number_format($charges['charges_food_amount']) ?></td>
              <td>
                ₱ <?= number_format($charges['charges_food_amount'] * $charges['charges_food_quantity']) ?>
                <a href="<?= base_url('index.php/main/removeCharge/charges_food/' . $charges['charges_food_id']) ?>" class="float-right mt-1 text-danger confirm hidable" data-placement="left" title="Remove Coffeeshop Charge" rel="tooltip">
                  <span class="fa fa-times"></span>
                </a>
              </td>
              <td>asd</td>
            </tr>
          <?php } ?>

          <?php $type = ''; ?>
          <?php foreach ($row['amenities'] as $charges) { ?>
            <tr>
              <td class="pl-4"><?= $type != $charges['category'] ? $charges['category'] : '↳' ?></td>
              <td>(<?= $charges['charge_quantity'] ?>) <?= $charges['charge'] ?></td>
              <?php $charge_price =  $charges['charge_id'] == 39 ? $row['pricing_type'] : $charges['charge_amount'] ?>
              <td>₱ <?= number_format($charge_price) ?></td>
              <?php
              if ($charges['charge_id'] == 39) {
                $total = $charge_price;
                $discount = $total * ($row['percentage'] / 100);
                $subtotal = $total - $discount;
                $grand_total += $subtotal;
              ?>
                <td>
                  ₱ <?= number_format($subtotal) ?>
                  <small data-placement="left" title="<?= $row['discount_type'] ?>
                  <br>-₱ <?= number_format($discount) ?>" rel="tooltip" data-html="true">(-<?= $row['percentage'] ?>%)
                  </small>
                  <a href="<?= base_url('index.php/main/removeCharge/charges_other/' . $charges['charges_other_id']) ?>" class="float-right mt-1 text-danger confirm hidable" data-placement="left" title="Remove Amenity / Charge" rel="tooltip">
                    <span class="fa fa-times"></span>
                  </a>
                </td>
              <?php } else { ?>
                <td>
                  ₱ <?= number_format($charge_price * $charges['charge_quantity']) ?>
                  <a href="<?= base_url('index.php/main/removeCharge/charges_other/' . $charges['charges_other_id']) ?>" class="float-right mt-1 text-danger confirm hidable" data-placement="left" title="Remove Amenity / Charge" rel="tooltip">
                    <span class="fa fa-times"></span>
                  </a>
                </td>
              <?php } ?>
              <?php $type = $charges['category'] ?>
              <td>asd</td>
            </tr>
          <?php } ?>

          <tr>
            <td class="pl-4">Refund</td>
            <td></td>
            <td></td>
            <td>
              <?php
              $room_refund = 0;
              foreach ($refunds as $data) {
                if ($data['booked_room_id'] == $row['booked_room_id']) {
                  $room_refund += $data['booking_refund'];
                }
              }
              echo '₱ ' . number_format($room_refund);
              ?>
            </td>
            <td>asd</td>
          </tr>

          <tr>
            <td class="pl-4">Payment</td>
            <td></td>
            <td></td>
            <td>
              <?php
              $room_refund = 0;
              foreach ($refunds as $data) {
                if ($data['booked_room_id'] == $row['booked_room_id']) {
                  $room_refund += $data['booking_refund'];
                }
              }
              echo '₱ ' . number_format($room_refund);
              ?>
            </td>
            <td>asd</td>
          </tr>

          <tr class="bg-default">
            <td colspan="5" style="padding:0.5px !important"></td>
          </tr>
        <?php } ?>

        <tr>
          <td class="pl-4">Total</td>
          <td></td>
          <td></td>
          <td>₱ <?= number_format($grand_total + $charges_total) ?></td>
          <td>asd</td>
        </tr>
        <tr>
          <td class="pl-4">Total Refund</td>
          <td></td>
          <td></td>
          <td>₱ <?= number_format($refund->booking_refund) ?></td>
          <td>asd</td>
        </tr>
        <tr>
          <td class="pl-4">Total Payment</td>
          <td></td>
          <td></td>
          <td>₱ <?= number_format($payment->amount) ?></td>
          <td>asd</td>
        </tr>
        <tr class="bg-default text-white">
          <th class="pl-4">TOTAL BALANCE</th>
          <th></th>
          <th></th>
          <?php $charges_grand_total = $grand_total + $charges_total ?>
          <?php $payment_grand_total = 0 + $payment->amount ?>
          <?php $overall_total = $charges_grand_total - $payment_grand_total ?>
          <td style="vertical-align: middle !important;">₱ <?= number_format($overall_total > 0 ? $overall_total : 0) ?></td>
          <td>asd</td>
        </tr>
        <tr>
          <td class="pl-4">Petty Cash</td>
          <td></td>
          <td></td>
          <?php $petty_cash = ($charges_grand_total - $payment_grand_total) * -1 ?>
          <td>₱ <?= number_format($petty_cash > 0 ? $petty_cash : 0) ?></td>
          <td>asd</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="card-footer mb-2 mt-0 border-top px-4 d-flex justify-content-between">
    <div>
      <a href="<?= base_url('index.php/main/completeOrder/' . $booking->booking_id . '/' . $booking->booking_number) ?>" class="btn confirm hidable" <?= $overall_total > 0 ? 'disabled' : '' ?>>Complete Order</a>
      <button type="button" class="btn mt-0 btn-success hidable" data-toggle="modal" data-target="#modalPayment">Payment</button>
      <button type="button" class="btn mt-0 btn-danger" data-toggle="modal" data-target="#modalRefund">Refund</button>
    </div>
    <a href="<?= base_url('index.php/main/receipt/' . $booking->booking_id) ?>" class="btn mt-0 btn-info receipt">Print Receipt</a>
  </div>
</div>

<div class="modal fade" id="modalRefund" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Add Refund</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('main/addRefund', ['id' => 'frmRefund']) ?>
        <input type="hidden" name="booking_id" value="<?= $booking->booking_id ?>">
        <input type="hidden" name="booking_number" value="<?= $booking->booking_number ?>">
        <div class="form-group">
          <label>Room</label>
          <select name="booked_room_id" class="form-control" required>
            <option value="">-</option>
            <?php foreach ($booked_rooms as $room) { ?>
              <option value="<?= $room['booked_room_id'] ?>"><?= $room['room_number'] ?> <?= $room['room_type'] ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label>Refund Amount</label>
          <input type="number" class="form-control" name="booking_refund" required min="0">
        </div>
        <div class="form-group">
          <label>Refund reason</label>
          <textarea name="booking_refund_reason" class="form-control"></textarea>
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <input type="submit" value="Add" class="btn btn-link" form="frmRefund">
        </div>
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
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
        <input type="hidden" name="booking_number" value="<?= $booking->booking_number ?>">
        <div class="form-row">
          <div class="form-group col-md-12">
            <label>Payment Option</label>
            <div class="d-flex justify-content-around my-2">
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
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Room</label>
            <select name="booked_room_id" class="form-control" required>
              <option value="">-</option>
              <?php foreach ($booked_rooms as $room) { ?>
                <option value="<?= $room['booked_room_id'] ?>"><?= $room['room_number'] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group col-md-8">
            <label>Payment For</label>
            <select name="payment_for" class="form-control" required>
              <option value="">-</option>
              <option value="room">Room Rate</option>
              <option value="restaurant">Resto</option>
              <option value="coffeeshop">Otilla's</option>
              <option value="addons">Add Ons</option>
              <option value="reservation">Room Reservation</option>
              <option value="event">Event</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label>Amount</label>
          <input type="number" class="form-control" name="amount" required value="0" min="0">
        </div>
        <div class="form-group card-div d-none mb-0">
          <label>Account Number</label>
          <input type="number" class="form-control" name="card_number" placeholder="XXXX" maxlength="4">
          <small>Last 4 digit only.</small>
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <button type="submit" class="btn btn-link" form="frmPayment">Add</button>
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
  $('[name=payment_option]').change(function() {
    const option = $(this).val();
    $('[name=amount]').focus();
    if (option == 'Cash') {
      $('.card-div').addClass('d-none');
      $('[name=card_number]').val('');
      $('[name=card_number]').removeAttr('required');
    } else {
      $('[name=card_number]').attr('required', true);
      $('.card-div').removeClass('d-none');
    }
  });

  $(document).on('click', '.receipt', function(e) {
    e.preventDefault();
    const size = ['height=' + screen.height / 2, 'width=' + screen.width / 2].join(',');
    window.open($(this).attr('href'), size, size);
  });
</script>