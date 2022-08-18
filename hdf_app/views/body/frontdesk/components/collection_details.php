<div class="card">
  <div class="card-header border-bottom px-4 pt-4 pb-2">
    <h6>Collection Details</h6>
  </div>
  <div class="card-body p-0">
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
            <?php $subtotal = $total - $discount ?>
            <?php $grand_total += $subtotal ?>
            <td>₱ <?= number_format($subtotal) ?> <small data-placement="top" title="<?=$row['discount_type']?><br>-₱ <?= number_format($discount) ?>" rel="tooltip" data-html="true">(-<?= $row['percentage'] ?>%)</small></td>
          </tr>
          <tr>
            <td class="pl-4">↳</td>
            <td>(<?= $row['extra_person'] ?>) Extra Bed<?= $row['extra_person'] != 1 ? 's' : ''  ?></td>
            <?php $person_total = $person->price * $row['extra_person'] ?>
            <td>₱ <?= number_format($person->price) ?></td>
            <td>₱ <?= number_format($person_total) ?></td>
            <?php $grand_total += $person_total ?>
          </tr>
          <tr>
            <td class="pl-4">↳</td>
            <td>(<?= $row['extra_bed'] ?>) Extra Person<?= $row['extra_bed'] != 1 ? 's' : ''  ?></td>
            <?php $bed_total = $bed->price * $row['extra_bed'] ?>
            <td>₱ <?= number_format($bed->price) ?></td>
            <td>₱ <?= number_format($bed->price * $row['extra_bed']) ?></td>
            <?php $grand_total += $bed_total ?>
          </tr>
          <?php $type = ''; ?>
          <?php foreach ($row['restaurant'] as $charges) { ?>
            <tr>
              <?php $restaurant = "Room {$row['room_number']} - {$charges['charge_type']} Charges" ?>
              <td class="pl-4"><?=$type!=$charges['charge_type'] ? $restaurant : '↳'?></td>
              <td>(<?= $charges['charges_food_quantity'] ?>) <?= $charges['particulars'] ?></td>
              <td>₱ <?= number_format($charges['charges_food_amount']) ?></td>
              <td>₱ <?= number_format($charges['charges_food_amount'] * $charges['charges_food_quantity']) ?></td>
              <?php $type = $charges['charge_type'] ?>
            </tr>
          <?php } ?>
          <?php $coffeeshop = ''; ?>
          <?php $type = ''; ?>
          <?php foreach ($row['coffeeshop'] as $charges) { ?>
            <tr>
              <?php $coffeeshop = "Room {$row['room_number']} - {$charges['charge_type']} Charges" ?>
              <td class="pl-4"><?=$type!=$charges['charge_type'] ? $coffeeshop : '↳'?></td>
              <td>(<?= $charges['charges_food_quantity'] ?>) <?= $charges['particulars'] ?></td>
              <td>₱ <?= number_format($charges['charges_food_amount']) ?></td>
              <td>₱ <?= number_format($charges['charges_food_amount'] * $charges['charges_food_quantity']) ?></td>
              <?php $type = $charges['charge_type'] ?>
            </tr>
          <?php } ?>
          <?php $type = ''; ?>
          <?php foreach ($row['amenities'] as $charges) { ?>
            <tr>
              <td class="pl-4"><?=$type!=$charges['category'] ? $charges['category'] : '↳'?></td>
              <td>(<?= $charges['charge_quantity'] ?>) <?= $charges['charge'] ?></td>
              <td>₱ <?= number_format($charges['charge_amount']) ?></td>
              <td>₱ <?= number_format($charges['charge_amount'] * $charges['charge_quantity']) ?></td>
              <?php $type = $charges['category'] ?>
            </tr>
          <?php } ?>
          <tr class="bg-default">
            <td colspan="5" style="padding:0.5px !important"></td>
          </tr>
        <?php } ?>
        <tr>
          <td class="pl-4">Total</td>
          <td></td>
          <td></td>
          <td>₱ <?= number_format($grand_total + $charges_total) ?></td>
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
          <td>₱ <?=number_format($payment->amount) ?></td>
        </tr>
        <tr class="bg-default text-white">
          <th class="pl-4">TOTAL BALANCE</th>
          <th></th>
          <th></th>
          <?php $charges_grand_total = $grand_total + $charges_total ?>
          <?php $payment_grand_total = $booking->refund + $payment->amount ?>
          <?php $overall_total = $charges_grand_total - $payment_grand_total ?>
          <td>₱ <?=number_format($overall_total > 0 ? $overall_total : 0) ?></td>
        </tr>
        <tr>
          <td class="pl-4">Petty Cash</td>
          <td></td>
          <td></td>
          <?php $petty_cash = ($charges_grand_total - $payment_grand_total) * -1 ?>
          <td>₱ <?=number_format($petty_cash > 0 ? $petty_cash : 0) ?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="card-footer my-2 border-top px-4">          
    <a href="<?=base_url('index.php/main/completeOrder/'.$booking->booking_id) ?>" class="btn btn-default confirm">Complete Order</a>
    <button class="btn mt-0 btn-success" data-toggle="modal" data-target="#modalPayment">Payment</button>
    <button class="btn mt-0 btn-danger" data-toggle="modal" data-target="#modalRefund">Refund</button>
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

<script>
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