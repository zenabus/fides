<div class="card">
  <div class="card-header border-bottom px-4 pt-4 pb-2">
    <h6>Collection Details</h6>
  </div>
  <div class="card-body p-0">
    <table class="table table-sm table-hover mb-0">
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
            <td>(<?= $row['nights'] ?>) Night<?= $row['nights'] != 1 ? 's' : ''  ?></td>
            <td>₱ <?= number_format($row['pricing_type']) ?></td>
            <?php $total = $row['pricing_type'] * $row['nights'] ?>
            <?php $discount = $total * ($row['percentage'] / 100) ?>
            <?php $subtotal = $total - $discount ?>
            <?php $grand_total += $subtotal ?>
            <td>₱ <?= number_format($subtotal) ?> <small data-placement="left" title="<?= $row['discount_type'] ?><br>-₱ <?= number_format($discount) ?>" rel="tooltip" data-html="true">(-<?= $row['percentage'] ?>%)</small></td>
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
            </tr>
          <?php } ?>

          <?php $type = ''; ?>
          <?php foreach ($row['amenities'] as $charges) { ?>
            <tr>
              <td class="pl-4"><?= $type != $charges['category'] ? $charges['category'] : '↳' ?></td>
              <td>(<?= $charges['charge_quantity'] ?>) <?= $charges['charge'] ?></td>
              <td>₱ <?= number_format($charges['charge_amount']) ?></td>
              <td>
                ₱ <?= number_format($charges['charge_amount'] * $charges['charge_quantity']) ?>
                <a href="<?= base_url('index.php/main/removeCharge/charges_other/' . $charges['charges_other_id']) ?>" class="float-right mt-1 text-danger confirm hidable" data-placement="left" title="Remove Amenity / Charge" rel="tooltip">
                  <span class="fa fa-times"></span>
                </a>
              </td>
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
          <td>₱ <?= number_format($payment->amount) ?></td>
        </tr>
        <tr class="bg-default text-white">
          <th class="pl-4">TOTAL BALANCE</th>
          <th></th>
          <th></th>
          <?php $charges_grand_total = $grand_total + $charges_total ?>
          <?php $payment_grand_total = $booking->refund + $payment->amount ?>
          <?php $overall_total = $charges_grand_total - $payment_grand_total ?>
          <td style="vertical-align: middle !important;">₱ <?= number_format($overall_total > 0 ? $overall_total : 0) ?></td>
        </tr>
        <tr>
          <td class="pl-4">Petty Cash</td>
          <td></td>
          <td></td>
          <?php $petty_cash = ($charges_grand_total - $payment_grand_total) * -1 ?>
          <td>₱ <?= number_format($petty_cash > 0 ? $petty_cash : 0) ?></td>
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
        <h4 class="title title-up">Update Refund</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('main/updateRefund', ['id' => 'frmRefund']) ?>
        <input type="hidden" name="booking_id" value="<?= $booking->booking_id ?>">
        <input type="hidden" name="booking_number" value="<?= $booking->booking_number ?>">
        <div class="form-group">
          <label>Refund Amount</label>
          <input type="number" class="form-control" name="refund" required min="0" value="<?= round($booking->refund) ?>">
        </div>
        <div class="form-group">
          <label>Refund reason</label>
          <textarea name="refund_reason" class="form-control"><?= $booking->refund_reason ?></textarea>
          <small>Refund amount and reason will be changed.</small>
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
        <div class="form-group">
          <label>Amount</label>
          <input type="number" class="form-control" name="amount" required value="0" min="0">
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
        <div class="form-group card-div d-none">
          <label>Account Card</label>
          <select name="card_type" class="form-control">
            <option value="">- select card type -</option>
            <option value="BDO">Banco de Oro (BDO)</option>
            <option value="Landbank">Land Bank of the Philippines</option>
          </select>
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <button type="submit" class="btn btn-link" form="frmPayment">Add Payment</button>
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
      $('[name=card_type]').removeAttr('required');
    } else {
      $('[name=card_number]').attr('required', true);
      $('[name=card_name]').attr('required', true);
      $('[name=card_type]').attr('required', true);
      $('.card-div').removeClass('d-none');
    }
  });

  $('[name=card_number]').on('input', function() {
    const value = $(this).val();
    const newValue = value.replace(/[^\dA-Z]/g, '').replace(/(.{4})/g, '$1 ').trim();
    $(this).val(newValue);
  });

  $(document).on('click', '.receipt', function(e) {
    e.preventDefault();
    const size = ['height=' + screen.height / 2, 'width=' + screen.width / 2].join(',');
    window.open($(this).attr('href'), size, size);
  });
</script>