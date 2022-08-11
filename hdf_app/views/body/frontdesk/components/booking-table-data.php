<td>
  <?= $row['booking_number'] ?>
  <?php if ($row['remarks']) { ?>
    <span class="fa fa-info-circle ml-1 text-info" rel="tooltip" data-original-title="<?= $row['remarks'] ?>"></span>
  <?php } ?><br>
  <small><?= date_format(date_create($row['booking_added']), "F d, Y h:i a") ?></small>
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
      <summary>Room <?= $room['room_number'] ?> - <?= $room['room_type'] ?></summary>
      <small class="ml-3">Check In: <?= $room['check_in'] ?></small><br>
      <small class="ml-3">Check Out: <?= $room['check_out'] ?></small><br>
      <small class="ml-3">No. Nights: <?= $room['nights'] ?> night<?= $room['nights'] ? '' : 's' ?></small><br>
      <small class="ml-3">Room Price: ₱ <?= number_format($room['pricing_type'], 2) ?></small><br>
      <small class="ml-3">25% Percent: ₱ <?= number_format($room['pricing_type'] * 0.25 * $room['nights'], 2) ?> (25%)</small>
    </details>
  <?php } ?>
</td>
<td>
  ₱ <?= number_format($row['amount'], 2) ?><br>
  <?php if ($row['amount'] != 0) { ?>
    <?php if ($row['payment_option'] == 'Cash') { ?>
      <small><?= $row['payment_option'] ?></small>
    <?php } else { ?>
      <small><?= $row['card_number'] ?> / <?= $row['card_name'] ?></small>
    <?php } ?>
  <?php } ?>
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