<td>
  <?= $row['booking_number'] ?>
  <?php if ($row['reservation_status'] == -1) { ?>
    <span class="fa fa-lock"></span>
  <?php } ?>
  <?php if ($row['remarks']) { ?>
    <span class="fa fa-info-circle ml-1 text-info" rel="tooltip" data-original-title="<?= $row['remarks'] ?>"></span>
  <?php } ?><br>
  <small><?= date_format(date_create($row['booking_added']), "F d, Y h:i a") ?></small><br>
  <?php if ($row['cancel_reason']) { ?>
    <small style="font-style:italic">(Cancel Reason - <?= $row['cancel_reason'] ?>)</small>
  <?php } ?>
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
  <?php foreach ($row['rooms'] as $room) { ?>
    <details>
      <summary>Room <?= $room['room_number'] ?> - <?= $room['room_type'] ?>
        <?php if ($room['check_out'] == date('m/d/Y')) { ?>
          <i class="fa-solid fa-calendar-day heart"></i>
        <?php } ?>
      </summary>
      <small class="ml-3">Check In: <?= $room['check_in'] ?></small><br>
      <small class="ml-3">Check Out: <?= $room['check_out'] ?></small><br>
      <small class="ml-3">No. Nights: <?= $room['nights'] ?> night<?= $room['nights'] ? '' : 's' ?></small><br>
      <small class="ml-3">Room Price: ₱ <?= number_format($room['pricing_type']) ?></small><br>
      <small class="ml-3">Discount: <?= $room['discount_type'] ?> (<?= $room['percentage'] ?>%)</small>
    </details>
  <?php } ?>
</td>
<td>
  <details>
    <summary>₱ <?= number_format($row['payment']->amount) ?> <small>Payment</small></summary>
    <?php foreach ($row['payments'] as $payment) { ?>
      <?php if ($payment['payment_option'] == 'Cash') {
        $icon = 'fa-solid fa-money-bill text-success';
      } else if ($payment['payment_option'] == 'Card') {
        $icon = 'fa-solid fa-credit-card text-warning';
      } else if ($payment['payment_option'] == 'Check') {
        $icon = 'fa-solid fa-money-check text-info';
      } else if ($payment['payment_option'] == 'Bank Transfer') {
        $icon = 'fa fa-bank text-danger';
      }
      $tooltip =  $payment['payment_option'] . '<br>' . $payment['payment_details']; ?>
      <small class="mb-0">
        <span class="<?= $icon ?> mr-1" data-placement="top" title="<?= $tooltip ?>" rel="tooltip" data-html="true"></span>
        ₱ <?= number_format($payment['amount']) ?> - <?= date_format(date_create($payment['booking_payment_added']), 'm/d/y g:ia') ?>
      </small><br>
    <?php } ?>
  </details>

  <details>
    <summary>₱ <?= number_format($row['refund']->booking_refund) ?> <small>Refund</small></summary>
    <?php foreach ($row['refunds'] as $refund) { ?>
      <small class="mb-0">
        <span class="fa fa-info-circle text-info mr-1" data-placement="top" title="<?= $refund['booking_refund_reason'] ?>" rel="tooltip" data-html="true"></span>
        ₱ <?= number_format($refund['booking_refund']) ?> - <?= date_format(date_create($payment['booking_payment_added']), 'm/d/y g:ia') ?>
      </small><br>
    <?php } ?>
  </details>
</td>
<td>
  <?= $row['arrival'] ?> - <?= $row['departure'] ?><br>
  <?php
  $arrival = new DateTime($row['arrival']);
  $departure = new DateTime($row['departure']);
  $nights = $arrival->diff($departure);
  ?>
  <small>Number of nights: <?= $nights->d ?></small>
</td>