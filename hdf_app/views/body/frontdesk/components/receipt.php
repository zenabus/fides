<!DOCTYPE html>
<html>

<head>
  <title><?= TITLE ?> - Acknowledgment Receipt</title>
  <style type="text/css">
    * {
      font-family: 'DejaVu Serif' !important;
      font-size: 36px;
    }

    body,
    html {
      margin: 0;
      margin-top: 80px !important;
    }

    .absolute {
      position: absolute;
    }

    footer {
      position: absolute;
      font-size: 24px;
      font-weight: normal;
      bottom: 32px;
      right: 32px;
    }

    .page {
      position: relative;
      margin: 180px;
    }

    .date {
      top: 31px;
      left: 1500px;
    }

    .name,
    .contact,
    .address,
    .company_name {
      left: 385px;
      /* left: 0; */
    }

    .name {
      top: 140px;
    }

    .address {
      top: 217px;
    }

    .contact,
    .email {
      top: 294px;
    }

    .company_name,
    .company_address {
      top: 373px;
    }

    .email,
    .company_address {
      left: 1560px
    }

    .table,
    .table th {
      border-collapse: collapse;
      width: 100%;
      font-size: 28px;
    }

    th {
      border-top: 1px solid black;
      border-bottom: 1px solid black;
    }

    td {
      font-size: 32px;
      padding-left: 8px;
      padding-right: 8px;
      vertical-align: top;
    }

    td:last-child,
    td:nth-child(3) {
      width: 300px;
    }

    .bt,
    table {
      border-top: 1px solid black;
    }

    .br {
      border-right: 1px solid black;
    }

    .bb {
      border-bottom: 1px solid black;
    }

    .bl {
      border-left: 1px solid black;
    }

    .tl {
      text-align: left !important;
    }

    .tr {
      text-align: right !important;
    }

    .cost td,
    .cost th {
      border-right: 1px solid black
    }

    .bold {
      font-weight: bold;
    }

    .space {
      height: 510px;
    }

    img {
      top: -80px;
      width: 2565px;
    }
  </style>
</head>

<body>
  <footer>
    Document generated: <?= date('F d, Y h:ia'); ?>
  </footer>
  <img src="<?= $image ?>" width="100%" class="absolute">
  <div class="page">
    <p class="absolute date"><?= date('m/d/Y'); ?></p>
    <p class="absolute name"><?= $booking->first_name ?> <?= $booking->middle_name ?> <?= $booking->last_name ?> <?= $booking->suffix ?></p>
    <p class="absolute address"><?= $booking->address ?></p>
    <p class="absolute contact"><?= $booking->contact ?></p>
    <p class="absolute company_name"><?= $booking->company_name ?></p>
    <p class="absolute email"><?= $booking->email ?></p>
    <p class="absolute company_address"><?= $booking->company_address ?></p>

    <div class="space"></div>

    <table class="table">
      <thead>
        <tr class="bl br cost">
          <th style="width:1099px">Description</th>
          <th>Unit</th>
          <th>Unit Cost</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <?php $grand_total = 0 ?>
        <?php foreach ($booked_rooms as $row) { ?>
          <tr class="bt bl br cost">
            <td>Room <?= $row['room_number'] ?> - <?= $row['room_type'] ?> (<?= $row['percentage'] ?><?= $row['using_formula'] ? '' : '%' ?>)</td>
            <td>(<?= $row['nights'] ?>) Night<?= $row['nights'] != 1 ? 's' : ''  ?></td>
            <td class="tr"><?= number_format($row['pricing_type'], 2) ?></td>
            <?php
            $total = $row['pricing_type'] * $row['nights'];

            if ($row['using_formula'] == 1) {
              [$multiplicand, $multiplier] = explode('x', $row['percentage']);
              if ($multiplicand == 1.12) {
                $subtotal = $total / $multiplicand * $multiplier;
              } else {
                $subtotal = $total - ($total / $multiplicand * $multiplier);
              }
            } else {
              $discount = $total * ($row['percentage'] / 100);
              $subtotal = $total - $discount;
            }
            $grand_total += $subtotal;
            ?>
            <td class="tr"><?= number_format($subtotal, 2) ?></td>
          </tr>

          <?php if ($row['extra_bed']) { ?>
            <tr class="bl br cost">
              <td>↳</td>
              <td>(<?= $row['extra_bed'] ?>) Extra Bed<?= $row['extra_bed'] != 1 ? 's' : ''  ?></td>
              <?php $bed_total = $bed->price * $row['extra_bed'] ?>
              <td class="tr"><?= number_format($bed->price, 2) ?></td>
              <td class="tr"><?= number_format($bed->price * $row['extra_bed'], 2) ?></td>
              <?php $grand_total += $bed_total ?>
            </tr>
          <?php } ?>

          <?php if ($row['extra_person']) { ?>
            <tr class="bl br cost">
              <td>↳</td>
              <td>(<?= $row['extra_person'] ?>) Extra Person<?= $row['extra_person'] != 1 ? 's' : ''  ?></td>
              <?php $person_total = $person->price * $row['extra_person'] ?>
              <td class="tr"><?= number_format($person->price, 2) ?></td>
              <td class="tr"><?= number_format($person_total, 2) ?></td>
              <?php $grand_total += $person_total ?>
            </tr>
          <?php } ?>

          <?php foreach ($row['restaurant'] as $charges) {
            $restaurant_total = $charges['charges_food_amount'] * $charges['charges_food_quantity'];
            $grand_total += $restaurant_total;
          ?>
            <tr class="bl br cost">
              <td>Resto Ref.: <?= $charges['reference'] ?></td>
              <td>(<?= $charges['charges_food_quantity'] ?>) <?= $charges['particulars'] ?></td>
              <td class="tr"><?= number_format($charges['charges_food_amount'], 2) ?></td>
              <td class="tr"><?= number_format($restaurant_total, 2) ?></td>
            </tr>
          <?php } ?>

          <?php foreach ($row['coffeeshop'] as $charges) {
            $coffeeshop_total = $charges['charges_food_amount'] * $charges['charges_food_quantity'];
            $grand_total += $coffeeshop_total;
          ?>
            <tr class="bl br cost">
              <td>Otilla's Ref.: <?= $charges['reference'] ?></td>
              <td>(<?= $charges['charges_food_quantity'] ?>) <?= $charges['particulars'] ?></td>
              <td class="tr"><?= number_format($charges['charges_food_amount'], 2) ?></td>
              <td class="tr"><?= number_format($charges['charges_food_amount'] * $charges['charges_food_quantity'], 2) ?></td>
            </tr>
          <?php } ?>

          <?php $type = ''; ?>
          <?php foreach ($row['amenities'] as $charges) { ?>
            <tr class="bl br cost">
              <td><?= $type != $charges['category'] ? $charges['category'] : '↳' ?></td>
              <td>(<?= $charges['charge_quantity'] ?>) <?= $charges['charge'] ?></td>
              <?php
              $charge_price =  $charges['charge_id'] == 39 ? $row['pricing_type'] : $charges['charge_amount'];
              if ($charges['charge_id'] == 39) {
                $total = $charge_price;
                $discount = $total * ($row['percentage'] / 100);
                $subtotal = $total - $discount;
                $grand_total += $subtotal;
              ?>
                <td class="tr"><?= number_format($total, 2) ?></td>
                <td class="tr"><?= number_format($subtotal, 2) ?></td>
              <?php } else {
                $charges_total = $charges['charge_amount'] * $charges['charge_quantity'];
                $grand_total += $charges_total;
              ?>
                <td class="tr"><?= number_format($charges['charge_amount'], 2) ?></td>
                <td class="tr"> <?= number_format($charges_total, 2) ?></td>
              <?php } ?>
              <?php $type = $charges['category'] ?>
            </tr>
          <?php } ?>
        <?php } ?>

        <tr class="bt">
          <td colspan="4">&nbsp;</td>
        </tr>
      </tbody>
    </table>
    <table class="table" style="border-top: none">
      <tr class="br">
        <td style="width: 1085px"></td>
        <td class="bl bt bb">Grand Total</td>
        <td class="bt br bb bt"></td>
        <td class="bt tr bb bt"><?= number_format($grand_total, 2) ?></td>
      </tr>
      <tr class="br">
        <td></td>
        <td class="bl bb bt">Refund Amount</td>
        <td class="br bb bt"></td>
        <td class="tr bb bt"><?= number_format($refund->booking_refund, 2) ?></td>
      </tr>
      <tr class="br">
        <td></td>
        <td class="bl bb bt">Paid Amount</td>
        <td class="br bb bt"></td>
        <td class="tr bb bt"><?= number_format($payment, 2) ?></td>
      </tr>
      <tr class="br">
        <td></td>
        <td class="bl bb bt">Remaining Balance</td>
        <td class="br bb bt"></td>
        <?php $payment_total = $refund->booking_refund + $payment ?>
        <td class="tr bb bt bold"><?= number_format($grand_total - $payment_total, 2) ?></td>
      </tr>
    </table>
  </div>
</body>

</html>