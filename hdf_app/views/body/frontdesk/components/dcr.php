<!DOCTYPE html>
<html>

<head>
  <title>Daily Collection Report <?= $m ?>/<?= $d ?>/<?= $y ?> <?= $type ?> Shift</title>
  <style type="text/css">
    * {
      font-family: 'DejaVu Serif' !important;
      font-size: 6pt;
    }

    body,
    html {
      margin: 8pt;
    }

    .absolute {
      position: absolute;
    }

    footer {
      position: absolute;
      font-size: 24px;
      font-weight: normal;
      bottom: 32px;
      left: 32px;
    }

    .table,
    .table thead th {
      border-collapse: collapse;
      width: 100%;
      font-size: 5pt;
    }

    th {
      border-top: 1px solid black;
      border-bottom: 1px solid black;
    }

    td {
      font-size: 5pt;
      padding-left: 8px;
      padding-right: 8px;
      vertical-align: top;
      border-bottom: 1px solid black;
      border-right: 1px solid black;
      text-align: center;
    }

    .bt {
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

    .tc {
      text-align: center !important;
    }

    .bold {
      font-weight: bold;
    }

    .title {
      font-size: 6pt;
    }

    .nw {
      white-space: nowrap;
    }

    tr:nth-child(odd) {
      background-color: #ddd;
    }

    .bgw {
      background-color: white;
    }

    .bgy {
      background-color: yellow;
    }

    .nb {
      border: 0 !important
    }

    .bt-0 {
      border-top: 0 !important;
    }

    .bb-0 {
      border-bottom: 0 !important;
    }

    .br-0 {
      border-right: 0 !important;
    }

    .bl-0 {
      border-left: 0 !important;
    }

    .w-150 {
      width: 130px !important;
    }
  </style>
</head>

<body>
  <footer>
    Document generated: <?= date('F d, Y h:ia'); ?>
  </footer>
  <div class="page">
    <h1 class="tc title">Daily Collection Report (<?= $type ?>)</h1>
    <table class="table">
      <thead>
        <tr class="bgw">
          <td colspan="2"></td>
          <th colspan="6" class="bl br">Sales Detail Cash Payment</th>
          <th colspan="6" class="br">Sales Detail Card Payment</th>
          <th colspan="2" class="br">Collectables</th>
          <td colspan="2"></td>
        </tr>
        <tr>
          <th rowspan="2" class="br bl w-150">Room</th>
          <th rowspan="2" class="br">Guest Name</th>
          <th rowspan="2" class="br w-150">Room Rate</th>
          <th colspan="2" class="br">Meal Charge</th>
          <th rowspan="2" class="br nw w-150">Add Ons</th>
          <th rowspan="2" class="br w-150">Reservation</th>
          <th rowspan="2" class="br w-150">Event</th>
          <th rowspan="2" class="br w-150">Room Rate</th>
          <th colspan="2" class="br">Meal Charge</th>
          <th rowspan="2" class="br nw w-150">Add Ons</th>
          <th rowspan="2" class="br w-150">Reservation</th>
          <th rowspan="2" class="br w-150">Event</th>
          <th rowspan="2" class="br w-150">Hotel</th>
          <th rowspan="2" class="br">Event</th>
          <th rowspan="2" class="br">OR Name</th>
          <th rowspan="2" class="br nw">OR No.</th>
          <th rowspan="2" class="br">Remarks</th>
        </tr>
        <tr class="bgw">
          <th class="br w-150">Resto</th>
          <th class="br w-150">Otilla's</th>
          <th class="br w-150">Resto</th>
          <th class="br w-150">Otilla's</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $room_rate = 0;
        $restaurant = 0;
        $coffeeshop = 0;
        $addons = 0;
        $reservation = 0;

        $room_rate_card = 0;
        $restaurant_card = 0;
        $coffeeshop_card = 0;
        $addons_card = 0;
        $reservation_card = 0;
        $event_card = 0;

        foreach ($payments as $row) {
          $room_rate += $row['cash_room']->amount;
          $restaurant += $row['cash_restaurant']->amount;
          $coffeeshop += $row['cash_coffeeshop']->amount;
          $addons += $row['cash_addons']->amount;
          $reservation += $row['cash_reservation']->amount;

          $room_rate_card += $row['card_room']->amount;
          $restaurant_card += $row['card_restaurant']->amount;
          $coffeeshop_card += $row['card_coffeeshop']->amount;
          $addons_card += $row['card_addons']->amount;
          $reservation_card += $row['card_reservation']->amount;
        ?>
          <tr>
            <td class="bl"><?= $row['room_number'] ?> <?= $row['room_type_abbr'] ?></td>
            <td class="nw"><?= $row['first_name'] ?> <?= $row['middle_name'] ?> <?= $row['last_name'] ?> <?= $row['suffix'] ?></td>
            <td><?= $row['cash_room']->amount ? number_format($row['cash_room']->amount, 2) : '' ?></td>
            <td><?= $row['cash_restaurant']->amount ? number_format($row['cash_restaurant']->amount, 2) : '' ?></td>
            <td><?= $row['cash_coffeeshop']->amount ? number_format($row['cash_coffeeshop']->amount, 2) : '' ?></td>
            <td><?= $row['cash_addons']->amount ? number_format($row['cash_addons']->amount, 2) : '' ?></td>
            <td><?= $row['cash_reservation']->amount ? number_format($row['cash_reservation']->amount, 2) : '' ?></td>
            <td></td>
            <td><?= $row['card_room']->amount ? number_format($row['card_room']->amount, 2) : '' ?></td>
            <td><?= $row['card_restaurant']->amount ? number_format($row['card_restaurant']->amount, 2) : '' ?></td>
            <td><?= $row['card_coffeeshop']->amount ? number_format($row['card_coffeeshop']->amount, 2) : '' ?></td>
            <td><?= $row['card_addons']->amount ? number_format($row['card_addons']->amount, 2) : '' ?></td>
            <td><?= $row['card_reservation']->amount ? number_format($row['card_reservation']->amount, 2) : '' ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><?= $row['remarks'] ?></td>
          </tr>
        <?php } ?>
        <?php
        $hotel_collectables = 0;
        foreach ($charged as $row) {
          $hotel_collectables += $row['collectables'];
        ?>
          <tr style="display:none">
            <td class="bl"><?= $row['room_number'] ?> <?= $row['room_type_abbr'] ?></td>
            <td class="nw"><?= $row['first_name'] ?> <?= $row['middle_name'] ?> <?= $row['last_name'] ?> <?= $row['suffix'] ?> / <?= $row['charged_guest']->first_name ?> <?= $row['charged_guest']->middle_name ?> <?= $row['charged_guest']->last_name ?> <?= $row['charged_guest']->suffix ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><?= number_format($row['collectables'], 2) ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td><?= $row['remarks'] ?></td>
          </tr>
        <?php } ?>

        <?php
        $event_sales = 0;
        foreach ($sales as $row) {
          if ($row['sales_type'] == 'Event') {
            $event_sales += $row['sales_amount'];
        ?>
            <tr>
              <td class="bl"></td>
              <td>EVENT PAYMENT / <?= $row['sales_remarks'] ?></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td><?= number_format($row['sales_amount'], 2) ?></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
        <?php }
        } ?>

        <?php
        $event_collectables = 0;
        foreach ($collectables as $row) {
          $event_collectables += $row['collectable_amount'];
        ?>
          <tr>
            <td class="bl"></td>
            <td>EVENT COLLECTABLE / <?= $row['collectable_remarks'] ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><?= number_format($row['collectable_amount'], 2) ?></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        <?php } ?>

        <tr>
          <td class="bgw nb" colspan="2"></td>
          <td class="bgw nb"><?= number_format($room_rate, 2) ?></td>
          <td class="bgw nb"><?= number_format($restaurant, 2) ?></td>
          <td class="bgw nb"><?= number_format($coffeeshop, 2) ?></td>
          <td class="bgw nb"><?= number_format($addons, 2) ?></td>
          <td class="bgw nb"><?= number_format($reservation, 2) ?></td>
          <td class="bgw nb"><?= number_format($event_sales, 2) ?></td>
          <td class="bgw nb"><?= number_format($room_rate_card, 2) ?></td>
          <td class="bgw nb"><?= number_format($restaurant_card, 2) ?></td>
          <td class="bgw nb"><?= number_format($coffeeshop_card, 2) ?></td>
          <td class="bgw nb"><?= number_format($addons_card, 2) ?></td>
          <td class="bgw nb"><?= number_format($reservation_card, 2) ?></td>
          <td class="bgw nb"><?= number_format($event_card, 2) ?></td>
          <td class="bgw nb" style="display: none;"><?= number_format($hotel_collectables, 2) ?></td>
          <td class="bgw nb" style="display: none;"><?= number_format($event_collectables, 2) ?></td>
          <td class="bgw nb"></td>
          <td class="bgw nb"></td>
          <td class="bgw nb" colspan="3"></td>
        </tr>
        <tr>
          <td class="bgw nb" colspan="19">&nbsp;</td>
        </tr>
        <tr>
          <td class="bgw nb" colspan="2"></td>
          <td class="bgw nb">TOTAL:</td>
          <td class="bgy nb" colspan="5"><?= number_format($room_rate + $restaurant + $coffeeshop + $addons + $reservation + $event_sales, 2) ?></td>
          <td class="bgw nb">TOTAL:</td>
          <td class="bgy nb" colspan="5"><?= number_format($room_rate_card + $restaurant_card + $coffeeshop_card + $addons_card + $reservation_card + $event_card, 2) ?></td>
          <td class="bgw nb" colspan="5"></td>
        </tr>
        <tr>
          <td class="bgw nb">&nbsp;</td>
        </tr>
        <tr>
          <td class="bgw nb"></td>
          <td class="nw bt bl bgw">EXTENDED STAY</td>
          <td class="bt bgw">0</td><!-- extended stay -->
          <td class="nb bgw" colspan="10"></td>
          <td class="nb bgy">HOTEL</td>
          <td class="nb bgy">EVENT</td>
          <td class="nb bgy">POOL</td>
          <td class="nb bgy">RESTO</td>
          <td class="nb bgy">OTILLA'S</td>
          <td class="nb bgy">TOTAL</td>
        </tr>
        <tr>
          <td class="nb bgw"></td>
          <td class="nw bt bl bgw">PM CHECK-IN</td>
          <td class="bgw">0</td><!-- pm check in -->
          <td class="nb bgw" colspan="9"></td>
          <td class="bt bgw bl">CASH</td>
          <?php $hotel = $room_rate + $addons + $reservation ?>
          <td class="bt bgw"><?= number_format($hotel, 2) ?></td>
          <td class="bt bgw"><?= number_format(floatval($sales_event->sales_amount), 2) ?></td>
          <td class="bt bgw"><?= number_format(floatval($sales_pool->sales_amount), 2) ?></td>
          <td class="bt bgw"><?= number_format($restaurant, 2) ?></td>
          <td class="bt bgw"><?= number_format($coffeeshop, 2) ?></td>
          <?php $event = $sales_event->sales_amount; ?>
          <?php $pool = $sales_pool->sales_amount; ?>
          <?php $total = $hotel + $event + $pool + $restaurant + $coffeeshop ?>
          <td class="bt bgw"><?= number_format($total, 2) ?></td>
        </tr>
        <tr>
          <td class="nb bgw"></td>
          <td class="nw bl bgw">TOTAL ROOMS OCCUPIED</td>
          <td class="bgw"><?= count($occupied) ?></td>
          <td class="nb bgw" colspan="9"></td>
          <td class="bgw bl">CARD</td>
          <?php $hotel_card = $room_rate_card + $addons_card + $reservation_card ?>
          <td class="bgw"><?= number_format($hotel_card, 2) ?></td>
          <td class="bgw">0.00</td>
          <td class="bgw">0.00</td>
          <td class="bt bgw"><?= number_format($restaurant_card, 2) ?></td>
          <td class="bt bgw"><?= number_format($coffeeshop_card, 2) ?></td>
          <?php $total_card = $hotel_card + $restaurant_card + $coffeeshop_card; ?>
          <td class="bt bgw"><?= number_format($total_card, 2) ?></td>
        </tr>
        <tr>
          <td class="nb bgw" colspan="12"></td>
          <td class="bgw bl">COLLECTABLE</td>
          <td class="bgw"><?= number_format($hotel_collectables, 2) ?></td>
          <td class="bgw"><?= number_format($event_collectables, 2) ?></td>
          <td class="bgw">0.00</td>
          <td class="bgw">0.00</td>
          <td class="bgw">0.00</td>
          <td class="bgw"><?= number_format($hotel_collectables + $event_collectables, 2) ?></td>
        </tr>
        <tr>
          <td class="nb bgw" colspan="12"></td>
          <td class="bgw bl">EXPENSES</td>
          <td class="bgw"><?= number_format(floatval($expenses_hotel->expense_amount), 2) ?></td>
          <td class="bgw"><?= number_format(floatval($expenses_event->expense_amount), 2) ?></td>
          <td class="bgw"><?= number_format(floatval($expenses_pool->expense_amount), 2) ?></td>
          <td class="bgw"><?= number_format(floatval($expenses_resto->expense_amount), 2) ?></td>
          <td class="bgw"><?= number_format(floatval($expenses_otillas->expense_amount), 2) ?></td>
          <?php $total_expense = $expenses_hotel->expense_amount + $expenses_event->expense_amount + $expenses_pool->expense_amount + $expenses_resto->expense_amount + $expenses_otillas->expense_amount ?>
          <td class="bgw"><?= number_format($total_expense, 2) ?></td>
        </tr>
        <tr>
          <td class="nb bgw"></td>
          <td class="nb bgw tl">Prepared By:</td>
          <td class="nb bgw" colspan="10"></td>
          <td class="bgw bl">TOTAL</td>
          <td class="bgw"><?= number_format($hotel + $hotel_card + $hotel_collectables - $expenses_hotel->expense_amount, 2) ?></td>
          <td class="bgw"><?= number_format($sales_event->sales_amount + $event_collectables - $expenses_event->expense_amount, 2) ?></td>
          <td class="bgw"><?= number_format($sales_pool->sales_amount - $expenses_pool->expense_amount, 2) ?></td>
          <td class="bgw nw"><?= number_format($restaurant + $restaurant_card - $expenses_resto->expense_amount, 2) ?></td>
          <td class="bgw"><?= number_format($coffeeshop + $coffeeshop_card - $expenses_otillas->expense_amount, 2) ?></td>
          <td class="bgy bb-0"><?= number_format($total + $total_card + $hotel_collectables + $event_collectables - $total_expense, 2) ?></td>
        </tr>
        <tr>
          <td class="bgw nb" colspan="18">&nbsp;</td>
          <td class="bgy bb bl nw">GRAND TOTAL</td>
        </tr>
        <tr>
          <td class="nb bgw"></td>
          <td class="nb bgw"><?= mb_strtoupper(isset($remitted) ? $remitted->name : $_SESSION['name']) ?></td>
          <td class="nb bgw" colspan="17"></td>
        </tr>
        <tr>
          <td class="nb bgw"></td>
          <td class="nb bgw"><?= $date ?></td>
        </tr>
        <tr>
          <td class="bgw nb" colspan="19">&nbsp;</td>
        </tr>
        <tr>
          <td class="bgw nb" colspan="19">&nbsp;</td>
        </tr>
        <tr>
          <td class="bgw nb" colspan="15">&nbsp;</td>
          <td class="bgy bt bl"></td>
          <td class="bgy bt">AM</td>
          <td class="bgy bt">PM</td>
          <td class="bgw bt tr">TOTAL</td>
        </tr>
        <tr>
          <td class="bgw nb" colspan="15">&nbsp;</td>
          <td class="bgw bt bl nw">HOTEL SALES</td>
          <td class="bgw bt"><?= number_format($hotel_sales_am, 2) ?></td>
          <td class="bgw bt"><?= number_format($hotel_sales_pm, 2) ?></td>
          <td class="bgw bt tr"><?= number_format($hotel_sales_am + $hotel_sales_pm, 2) ?></td>
        </tr>
        <tr>
          <td class="nb bgw"></td>
          <td class="nb bgw tl">Noted By:</td>
          <td class="bgw nb" colspan="13">&nbsp;</td>
          <td class="bgw bt bl nw">
            EVENT SALES<br>
            (Event + Pool)
          </td>
          <td class="bgw bt"><?= number_format($event_sales_am, 2) ?></td>
          <td class="bgw bt"><?= number_format($event_sales_pm, 2) ?></td>
          <td class="bgw bt tr"><?= number_format($event_sales_am + $event_sales_pm, 2) ?></td>
        </tr>
        <tr>
          <td class="nb bgw"></td>
          <td class="nb bgw nw">MS. JOANNE ORTIZ/SIR CARLOS ORTIZ</td>
          <td class="bgw nb" colspan="14">&nbsp;</td>
          <td class="bgy bt bl" colspan="2">GRAND TOTAL</td>
          <td class="bgw bt tr"><?= number_format($hotel_sales_am + $hotel_sales_pm + $event_sales_am + $event_sales_pm, 2) ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</body>

</html>