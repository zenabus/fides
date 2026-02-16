<?php
function round_format($num) {
  return number_format($num ?? 0, 2);
}
?>

<style>
  .payment-click {
    cursor: pointer;
  }
</style>

<div class="card">
  <div class="card-header px-4 pt-4 d-flex justify-content-between align-items-center">
    <h6>Collection Details</h6>
    <a class="btn btn-sm mb-2 mt-0 px-2 toggle-collapse" data-toggle="collapse" href="#collapseCollection" role="button" aria-expanded="true" aria-controls="collapseCollection">
      <span class="fa fa-minus"></span>
    </a>
  </div>
  <div class="card-body px-0 py-2 collapse show" id="collapseCollection">
    <table class="table table-sm table-hover mb-0">
      <thead>
        <tr class="bg-default text-white">
          <th class="pl-4">Name</th>
          <th>Unit</th>
          <th>Subtotal</th>
          <th>Balance</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $grand_total = 0;
        $balance_total = 0;
        ?>
        <?php foreach ($booked_rooms as $row) {
          $addons = $row['payment_addons']->amount;
          $restaurant = $row['payment_restaurant']->amount;
          $coffeeshop = $row['payment_coffeeshop']->amount;
        ?>

          <!-- ------------------------------------------------------------ ROOM ------------------------------------------------------------ -->

          <?php
          $room_total = 0;
          $room_balance = 0;
          $room_paid = 0;

          $room_subtotal = $row['pricing_type'] * $row['nights'];

          if ($row['using_formula'] == 1) {
            [$multiplicand, $multiplier] = explode('x', $row['percentage']);
            if ($multiplicand == 1.12) {
              $subtotal = $room_subtotal / $multiplicand * $multiplier;
            } else {
              $subtotal = $room_subtotal - ($room_subtotal / $multiplicand * $multiplier);
            }
          } else {
            $discount = $room_subtotal * ($row['percentage'] / 100);
            $subtotal = $room_subtotal - $discount;
          }

          $balance = $subtotal - $row['payment_room'];

          $room_total += $subtotal;
          $room_balance += $balance;
          $room_paid += $row['payment_room'];
          ?>

          <tr class="<?= $balance >= 0.01 ? 'payment-click'  : '' ?>" booked-room-id="<?= $row['booked_room_id'] ?>" payment-for="room" amount="<?= $balance ?>">
            <td class="pl-4">
              Room <?= $row['room_number'] ?><br>
              <small><?= $row['room_type'] ?></small>
            </td>
            <td>
              (<?= $row['nights'] ?>) Night<?= $row['nights'] != 1 ? 's' : ''  ?><br>
              <small>₱ <?= round_format($row['pricing_type']) ?> per night</small>
            </td>
            <td>
              ₱ <?= round_format($subtotal) ?> <br>
              <?php if ($row['discount_type'] != 'N/A') { ?>
                <small data-placement="left" title="Less ₱ <?= round_format($subtotal - $room_subtotal) ?>" rel="tooltip" data-html="true"><?= $row['discount_type'] ?> (<?= $row['percentage'] ?><?= $row['using_formula'] ? '' : '%' ?>)</small>
              <?php } else { ?>
                <small>No discount</small>
              <?php } ?>
            </td>
            <td>
              <?php if ($balance <= 0.01) { ?>
                <span class="fa fa-check-circle text-success"></span> Paid
              <?php } else { ?>
                ₱ <?= round_format($balance) ?>
              <?php } ?><br>
              <small>₱ <?= round_format($row['payment_room']) ?></small>
            </td>
          </tr>

          <!-- ------------------------------------------------------------ RESTAURANT ------------------------------------------------------------ -->

          <?php foreach ($row['restaurant'] as $charges) {
            $food_total = $charges['charges_food_amount'] * $charges['charges_food_quantity'];
            if ($restaurant > $food_total) {
              $balance = 0;
              $paid = $food_total;
              $restaurant = $restaurant - $food_total;
            } else {
              $balance = $food_total - $restaurant;
              $paid = $restaurant;
              $restaurant = 0;
            }
            $room_total += $food_total;
            $room_balance += $balance;
            $room_paid += $paid;
          ?>
            <tr class="<?= $balance >= 0.01 ? 'payment-click'  : '' ?>" booked-room-id="<?= $row['booked_room_id'] ?>" payment-for="restaurant" amount="<?= $balance ?>">
              <td class="pl-4">
                <i class="fa-solid fa-utensils text-success mr-1"></i><br>
                <?php if ($charges['reference']) { ?>
                  <small>Ref: <?= $charges['reference'] ?></small>
                <?php } ?>
              </td>
              <td>
                (<?= $charges['charges_food_quantity'] ?>) <?= $charges['particulars'] ?><br>
                <small>₱ <?= round_format($charges['charges_food_amount']) ?></small>
              </td>
              <td>₱ <?= round_format($food_total) ?></td>
              <td>
                <?php if ($balance == $food_total) { ?>
                  <a href="<?= base_url('index.php/main/removeCharge/charges_food/' . $charges['charges_food_id']) ?>" class="float-right text-danger confirm hidable" data-placement="left" title="Remove Resto Charge" rel="tooltip">
                    <span class="fa fa-times"></span>
                  </a>
                <?php } ?>
                <?php if ($balance <= 0.01) { ?>
                  <span class="fa fa-check-circle text-success"></span> Paid
                <?php } else { ?>
                  ₱ <?= round_format($balance) ?>
                <?php } ?><br>
                <small>₱ <?= round_format($paid) ?></small>
              </td>
            </tr>

          <?php } ?>

          <!-- ------------------------------------------------------------ COFFEESHOP ------------------------------------------------------------ -->

          <?php foreach ($row['coffeeshop'] as $charges) {
            $coffee_total = $charges['charges_food_amount'] * $charges['charges_food_quantity'];
            if ($coffeeshop > $coffee_total) {
              $balance = 0;
              $paid = $coffee_total;
              $coffeeshop = $coffeeshop - $coffee_total;
            } else {
              $balance = $coffee_total - $coffeeshop;
              $paid = $coffeeshop;
              $coffeeshop = 0;
            }
            $room_balance += $balance;
            $room_total += $coffee_total;
            $room_paid += $paid;
          ?>
            <tr class="<?= $balance >= 0.01 ? 'payment-click'  : '' ?>" booked-room-id="<?= $row['booked_room_id'] ?>" payment-for="coffeeshop" amount="<?= $balance ?>">
              <td class="pl-4">
                <i class="fa-solid fa-mug-saucer text-primary mr-1"></i><br>
                <?php if ($charges['reference']) { ?>
                  <small>Ref: <?= $charges['reference'] ?></small>
                <?php } ?>
              </td>
              <td>
                (<?= $charges['charges_food_quantity'] ?>) <?= $charges['particulars'] ?><br>
                <small>₱ <?= round_format($charges['charges_food_amount']) ?></small>
              </td>
              <td>₱ <?= round_format($coffee_total) ?></td>
              <td>
                <?php if ($balance == $coffee_total) { ?>
                  <a href="<?= base_url('index.php/main/removeCharge/charges_food/' . $charges['charges_food_id']) ?>" class="float-right text-danger confirm hidable" data-placement="left" title="Remove Otilla's Charge" rel="tooltip">
                    <span class="fa fa-times"></span>
                  </a>
                <?php } ?>
                <?php if ($balance <= 0.01) { ?>
                  <span class="fa fa-check-circle text-success"></span> Paid
                <?php } else { ?>
                  ₱ <?= round_format($balance) ?>
                <?php } ?><br>
                <small>₱ <?= round_format($paid) ?></small>
              </td>
            </tr>
          <?php } ?>

          <!-- ------------------------------------------------------------ BED ------------------------------------------------------------ -->

          <?php if ($row['extra_bed']) { ?>
            <?php
            $bed_total = $bed->price * $row['extra_bed'];
            if ($addons > $bed_total) {
              $balance = 0;
              $paid = $bed_total;
              $addons = $addons - $bed_total;
            } else {
              $balance = $bed_total - $addons;
              $paid = $addons;
              $addons = 0;
            }
            $room_total += $bed_total;
            $room_balance += $balance;
            $room_paid += $paid;
            ?>
            <tr class="<?= $balance >= 0.01 ? 'payment-click'  : '' ?>" booked-room-id="<?= $row['booked_room_id'] ?>" payment-for="addons" amount="<?= $balance ?>">
              <td class="pl-4"><span class="fa fa-bed text-info"></span></td>
              <td>
                (<?= $row['extra_bed'] ?>) Extra Bed<?= $row['extra_bed'] != 1 ? 's' : ''  ?><br>
                <small>₱ <?= round_format($bed->price) ?> per bed</small>
              </td>
              <td>₱ <?= round_format($bed->price * $row['extra_bed']) ?></td>
              <td>
                <?php if ($balance == $bed_total) { ?>
                  <a href="<?= base_url('index.php/main/removeExtra/extra_bed/' . $row['booked_room_id']) ?>" class="float-right text-danger confirm hidable" data-placement="left" title="Remove Extra Bed" rel="tooltip">
                    <span class="fa fa-times"></span>
                  </a>
                <?php } ?>
                <?php if ($balance <= 0.01) { ?>
                  <span class="fa fa-check-circle text-success"></span> Paid
                <?php } else { ?>
                  ₱ <?= round_format($balance) ?>
                <?php } ?><br>
                <small>₱ <?= round_format($paid) ?></small>
              </td>
            </tr>

          <?php } ?>

          <!-- ------------------------------------------------------------ PERSON ------------------------------------------------------------ -->

          <?php if ($row['extra_person']) { ?>
            <?php
            $person_total = $person->price * $row['extra_person'];
            if ($addons > $person_total) {
              $balance = 0;
              $paid = $person_total;
              $addons = $addons - $person_total;
            } else {
              $balance = $person_total - $addons;
              $paid = $addons;
              $addons = 0;
            }
            $room_total += $person_total;
            $room_balance += $balance;
            $room_paid += $paid;
            ?>
            <tr class="<?= $balance >= 0.01 ? 'payment-click'  : '' ?>" booked-room-id="<?= $row['booked_room_id'] ?>" payment-for="addons" amount="<?= $balance ?>">
              <td class="pl-4"><span class="fa fa-user text-info"></span></td>
              <td>
                (<?= $row['extra_person'] ?>) Extra Person<?= $row['extra_person'] != 1 ? 's' : ''  ?><br>
                <small>₱ <?= round_format($person->price) ?> per person</small>
              </td>
              <td>₱ <?= round_format($person_total) ?></td>
              <td>
                <?php if ($balance == $person_total) { ?>
                  <a href="<?= base_url('index.php/main/removeExtra/extra_person/' . $row['booked_room_id']) ?>" class="float-right text-danger confirm hidable" data-placement="left" title="Remove Extra Person" rel="tooltip">
                    <span class="fa fa-times"></span>
                  </a>
                <?php } ?>
                <?php if ($balance <= 0.01) { ?>
                  <span class="fa fa-check-circle text-success"></span> Paid
                <?php } else { ?>
                  ₱ <?= round_format($balance) ?>
                <?php } ?><br>
                <small>₱ <?= round_format($paid) ?></small>
              </td>
            </tr>

          <?php } ?>

          <!-- ------------------------------------------------------------ AMENITIES ------------------------------------------------------------ -->

          <?php $type = ''; ?>
          <?php foreach ($row['amenities'] as $charges) { ?>
            <?php $charge_price =  $charges['charge_id'] == 39 ? $row['pricing_type'] : $charges['charge_amount']; ?>
            <tr class="payment-click" booked-room-id="<?= $row['booked_room_id'] ?>" payment-for="addons" amount="<?= $balance ?>">
              <td class="pl-4"><?= $type != $charges['category'] ? $charges['category'] : '↳' ?></td>
              <td>
                (<?= $charges['charge_quantity'] ?>) <?= $charges['charge'] ?><br>
                <small>₱ <?= round_format($charge_price) ?>
                  <?php if (!in_array($charges['charge_id'], [39, 32, 33])) { ?>
                    each
                  <?php } ?>
                </small>
              </td>
              <?php
              if ($charges['charge_id'] == 39) {
                if ($row['using_formula'] == 1) {
                  [$multiplicand, $multiplier] = explode('x', $row['percentage']);
                  if ($multiplicand == 1.12) {
                    $total = $row['pricing_type'] / $multiplicand * $multiplier;
                  } else {
                    $total = $row['pricing_type'] - ($row['pricing_type'] / $multiplicand * $multiplier);
                  }
                  $discount = $row['pricing_type'] - $total;
                } else {
                  $discount = $row['pricing_type'] * ($row['percentage'] / 100);
                  $total = $row['pricing_type'] - $discount;
                }
              ?>
                <td>
                  ₱ <?= round_format($total) ?><br>
                  <?php if ($discount != 0) { ?>
                    <small data-placement="left" title="Less ₱ <?= round_format($discount) ?>" rel="tooltip" data-html="true"><?= $row['discount_type'] ?> (<?= $row['percentage'] ?><?= $row['using_formula'] ? '' : '%' ?>)</small>
                  <?php } else { ?>
                    <small>No discount</small>
                  <?php } ?>
                </td>
              <?php } else { ?>
                <?php $total = $charge_price * $charges['charge_quantity']; ?>
                <td>₱ <?= round_format($total) ?></td>
              <?php } ?>
              <?php
              $type = $charges['category'];
              if ($addons > $total) {
                $balance = 0;
                $paid = $total;
                $addons = $addons - $total;
              } else {
                $balance = $total - $addons;
                $paid = $addons;
                $addons = 0;
              }
              $room_total += $total;
              $room_balance += $balance;
              $room_paid += $paid;
              ?>
              <td class="<?= $balance <= 0.01 ? 'paid balance' : 'balance' ?>" balance="<?= $balance ?>">
                <?php if ($balance == $total) { ?>
                  <a href="<?= base_url('index.php/main/removeCharge/charges_other/' . $charges['charges_other_id']) ?>" class="float-right mt-1 text-danger confirm hidable" data-placement="left" title="Remove Amenity / Charge" rel="tooltip">
                    <span class="fa fa-times"></span>
                  </a>
                <?php } ?>
                <?php if ($balance <= 0.01) { ?>
                  <span class="fa fa-check-circle text-success"></span> Paid
                <?php } else { ?>
                  ₱ <?= round_format($balance) ?>
                <?php } ?><br>
                <small>₱ <?= round_format($paid) ?></small>
              </td>
            </tr>
          <?php } ?>

          <!-- ------------------------------------------------------------ TOTAL ------------------------------------------------------------ -->

          <tr class="bg-default text-white <?= $room_balance ? 'payment-click'  : '' ?>" booked-room-id="<?= $row['booked_room_id'] ?>" payment-for="All Types" amount="<?= $room_balance ?>">
            <td class="pl-4">Room Total</td>
            <td></td>
            <td>₱ <?= round_format($room_total) ?></td>
            <td>₱ <?= round_format($room_balance) ?></td>
          </tr>
          <tr>
            <td class="pl-4"><small>Room Refund</small></td>
            <td></td>
            <td></td>
            <td><small>₱ <?= round_format($row['refund']->booking_refund) ?></small></td>
          </tr>
          <tr>
            <td class="pl-4"><small>Room Payment</small></td>
            <td></td>
            <td></td>
            <td><small>₱ <?= round_format($room_paid) ?></small></td>
          </tr>
          <tr class="bg-default">
            <td colspan="5" style="padding:0.5px !important"></td>
          </tr>
        <?php
          $balance_total += $room_balance;
          $grand_total += $room_total;
        } ?>

        <!-- ------------------------------------------------------------ END LOOP ------------------------------------------------------------ -->

        <tr>
          <td class="pl-4">Total Refund</td>
          <td></td>
          <td></td>
          <td>₱ <?= round_format($refund->booking_refund) ?></td>
        </tr>

        <tr>
          <td class="pl-4">Total Payment</td>
          <td></td>
          <td></td>
          <td>₱ <?= round_format($payment->amount) ?></td>
        </tr>

        <tr class="bg-default text-white <?= $balance_total ? 'payment-click'  : '' ?>" booked-room-id="All Rooms" payment-for="" amount="<?= $balance_total ?>">
          <th class="pl-4">GRAND TOTAL</th>
          <th></th>
          <th>₱ <?= round_format($grand_total) ?></th>
          <th style="vertical-align: middle !important;">₱ <?= round_format($balance_total) ?></th>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="card-footer mb-2 mt-0 border-top px-4 d-flex justify-content-between align-items-start">
    <div>
      <a href="<?= base_url('index.php/main/completeOrder/' . $booking->booking_id . '/' . $booking->booking_number) ?>" class="btn btn-sm confirm <?= $balance_total > 0.01 ? '' : 'hidable' ?>" <?= $balance_total > 0.01 ? 'disabled' : '' ?>>Complete Order</a>
      <button type="button" class="btn btn-sm mt-0 btn-success hidable" data-toggle="modal" data-target="#modalPayment">Payment</button>
      <button type="button" class="btn btn-sm mt-0 btn-danger" data-toggle="modal" data-target="#modalRefund">Refund</button>
      <?php if (!$booking->charged_to) { ?>
        <button type="button" class="btn btn-sm mt-0 btn-warning" data-toggle="modal" data-target="#modalCharge">Charge To</button>
      <?php } else { ?>
        <div class="mt-2">
          <small>This booking is charged to <a href="<?= base_url('index.php/main/guest/' . $charged_to->guest_id) ?>"><?= $charged_to->first_name ?> <?= $charged_to->middle_name ?> <?= $charged_to->last_name ?> <?= $charged_to->suffix ?></a></small>
        </div>
      <?php } ?>
    </div>
    <!-- <a href="<?= base_url('index.php/main/receipt/' . $booking->booking_id) ?>" class="btn btn-sm mt-0 btn-info receipt">Print Receipt</a> -->
    <a href="<?= base_url('index.php/main/receiptv2/' . $booking->booking_id) ?>" class="btn btn-sm mt-0 btn-info receipt">Print Receipt</a>
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
            <select name="payment_option" class="form-control removeReadOnly" required>
              <option value="">- payment option -</option>
              <option value="Cash">Cash</option>
              <option value="Card">Card</option>
              <option value="Check">Check</option>
              <option value="Bank Transfer">Bank Transfer</option>
            </select>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Room</label>
            <select name="booked_room_id" class="form-control removeReadOnly" required>
              <option value="">-</option>
              <option value="All Rooms">All</option>
              <?php foreach ($booked_rooms as $room) { ?>
                <option value="<?= $room['booked_room_id'] ?>"><?= $room['room_number'] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group col-md-8">
            <label>Payment For</label>
            <select name="payment_for" class="form-control removeReadOnly" required>
              <option value="">-</option>
              <option value="All Types">All</option>
              <option value="room">Room Rate</option>
              <option value="restaurant">Resto</option>
              <option value="coffeeshop">Otilla's</option>
              <option value="addons">Add Ons</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label>Amount</label>
          <input type="number" class="form-control removeReadOnly" name="amount" required value="0" min="0" step="0.01">
        </div>
        <div class="form-group card-div all-div d-none mb-0">
          <label>Account Number</label>
          <input type="number" class="form-control removeReadOnly" name="card_number" placeholder="XXXX" maxlength="4">
          <small>Last 4 digit only.</small>
        </div>
        <div class="check-div all-div d-none">
          <div class="form-group">
            <label>Account Name</label>
            <input type="text" class="form-control removeReadOnly" name="check_name">
          </div>
          <div class="form-group">
            <label>Account Number</label>
            <input type="text" class="form-control removeReadOnly" name="check_number">
          </div>
          <div class="form-group">
            <label>Branch</label>
            <input type="text" class="form-control removeReadOnly" name="check_branch">
          </div>
          <div class="form-group">
            <label>Date</label>
            <input type="date" class="form-control removeReadOnly" name="check_date">
          </div>
        </div>
        <div class="bank-div all-div d-none">
          <div class="form-group">
            <label>Bank Name</label>
            <input type="text" class="form-control removeReadOnly" name="bank_name">
          </div>
          <div class="form-group">
            <label>Account Number</label>
            <input type="text" class="form-control removeReadOnly" name="bank_number">
          </div>
          <div class="form-group">
            <label>Date</label>
            <input type="date" class="form-control removeReadOnly" name="bank_date">
          </div>
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

<div class="modal fade" id="modalCharge" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Charge To</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('main/chargeTo', ['id' => 'frmCharge']) ?>
        <input type="hidden" name="booking_id" value="<?= $booking->booking_id ?>">
        <input type="hidden" name="booking_number" value="<?= $booking->booking_number ?>">
        <div class="form-group">
          <label>Guest</label>
          <select name="guest_id" class="selectpicker" required data-live-search="true" data-width="100%" data-size="8">
            <?php foreach ($guests as $guest) { ?>
              <option value="<?= $guest['guest_id'] ?>" style="text-transform: uppercase"><?= $guest['first_name'] ?> <?= $guest['middle_name'] ?> <?= $guest['last_name'] ?> <?= $guest['suffix'] ?></option>
            <?php } ?>
          </select>
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <button type="submit" class="btn btn-link" form="frmCharge">Charge</button>
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
    $('.balance').each(function(i) {
      const balance = $(this).attr('balance');
      $(this).parent().attr('amount', balance);
    });
    $('.paid').parent().removeClass('payment-click');
  });

  $('[name=payment_option]').change(function() {
    const option = $(this).val();
    $('[name=amount]').focus();

    $('.all-div').addClass('d-none');
    $('.all-div .form-control').removeAttr('required');

    if (option == 'Card') {
      $('.card-div').removeClass('d-none');
      $('.card-div .form-control').attr('required', true);
    } else if (option == 'Check') {
      $('.check-div').removeClass('d-none');
      $('.check-div .form-control').attr('required', true);
    } else if (option == 'Bank Transfer') {
      $('.bank-div').removeClass('d-none');
      $('.bank-div .form-control').attr('required', true);
    }
  });

  $(document).on('click', '.receipt', function(e) {
    e.preventDefault();
    const size = ['height=' + screen.height / 2, 'width=' + screen.width / 2].join(',');
    window.open($(this).attr('href'), size, size);
  });

  let collapse = false;

  $('.toggle-collapse').click(function() {
    if (collapse) {
      $(this).children().removeClass('fa-plus').addClass('fa-minus');
      collapse = false;
    } else {
      $(this).children().removeClass('fa-minus').addClass('fa-plus');
      collapse = true;
    }
    $(this).attr('disabled', true);
    setTimeout(() => $(this).attr('disabled', false), 300);
  });

  $(document).on('click', '.payment-click', function(e) {
    if (e.target.nodeName != 'SPAN') {
      const booked_room_id = $(this).attr('booked-room-id');
      const payment_for = $(this).attr('payment-for');
      const amount = parseFloat($(this).attr('amount')).toFixed(2);
      $('[name=booked_room_id]').val(booked_room_id);
      $('[name=payment_for]').val(payment_for);
      $('#modalPayment').modal('show');
      if (booked_room_id == 'All Rooms') {
        console.log('1');
        $('[name=payment_for]').attr('readonly', true).css('pointer-events', 'none').val('All Types');
        $('[name=amount]').val(amount);
      } else {
        console.log('2', amount);
        $('[name=payment_for]').removeAttr('readonly').css('pointer-events', '');
        $('[name=amount]').val(amount);
      }
      setTimeout(() => {
        $('[name=amount]').focus();
      }, 500);
    }
  });

  $('#modalPayment').on('hidden.bs.modal', function(e) {
    $('[name=booked_room_id]').val('');
    $('[name=payment_for]').val('');
  });

  $('[name=booked_room_id]').change(function() {
    if ($(this).val() == 'All Rooms') {
      $('[name=payment_for]').attr('readonly', true).css('pointer-events', 'none').val('All Types');
    } else {
      $('[name=payment_for]').removeAttr('readonly').css('pointer-events', '');
    }
  });
</script>