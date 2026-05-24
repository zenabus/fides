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

    .table {
      border-collapse: collapse;
      width: 99.6%;
      font-size: 5pt;
    }

    .table thead th {
      border-collapse: collapse;
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
          <td colspan="3" class="bb br-0"></td>
          <td class="nb bgw"></td>
        </tr>
        <tr>
          <th rowspan="2" class="br bl w-150">Room</th>
          <th rowspan="2" class="br">Guest Name</th>
          <th rowspan="2" class="br w-150">Room Rate</th>
          <th colspan="2" class="br">Meal Charge</th>
          <th rowspan="2" class="br nw w-150">Add Ons</th>
          <th rowspan="2" class="br w-150">Reservation</th>
          <th rowspan="2" class="br w-150">Hotel/<br>Event/Pool</th>
          <th rowspan="2" class="br w-150">Room Rate</th>
          <th colspan="2" class="br">Meal Charge</th>
          <th rowspan="2" class="br nw w-150">Add Ons</th>
          <th rowspan="2" class="br w-150">Reservation</th>
          <th rowspan="2" class="br w-150">Hotel/<br>Event/Pool</th>
          <th rowspan="2" class="br w-150">Hotel</th>
          <th rowspan="2" class="br">Event</th>
          <th rowspan="2" class="br">OR Name</th>
          <th rowspan="2" class="br nw">OR No.</th>
          <th rowspan="2" class="br">Remarks</th>
          <th rowspan="2" class="nb bgw" style="width: 5px;"></th>
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
            <td class="nw tl"><span style="color: #e59866; font-size: 5pt; vertical-align: middle; margin-right: 3px; display:none">▶</span> <?= $row['first_name'] ?> <?= $row['middle_name'] ?> <?= $row['last_name'] ?> <?= $row['suffix'] ?></td>
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
            <td class="nb bgw"></td>
          </tr>
        <?php } ?>
        <?php
        if (isset($inhouse_guests) && !empty($inhouse_guests)) {
          $paid_room_ids = array_column($payments, 'booked_room_id');
          foreach ($inhouse_guests as $row) {
            if (in_array($row['booked_room_id'], $paid_room_ids)) {
              continue;
            }
        ?>
            <tr>
              <td class="bl"><?= $row['room_number'] ?> <?= $row['room_type_abbr'] ?></td>
              <td class="nw tl"><?= $row['first_name'] ?> <?= $row['middle_name'] ?> <?= $row['last_name'] ?><?= $row['suffix'] ?><span style="color: #27ae60; font-size: 5pt; vertical-align: middle; margin-left: 3px;">⌂</span></td>
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
              <td></td>
              <td></td>
              <td></td>
              <td>IN-HOUSE</td>
              <td class="nb bgw"></td>
            </tr>
        <?php
          }
        }
        ?>
        <?php
        $hotel_collectables = 0;
        ?>

        <?php
        $event_sales_total = 0;
        $event_card_total = 0;
        foreach ($sales as $row) {
          if ($row['sales_type'] == 'Event' || $row['sales_type'] == 'Pool' || $row['sales_type'] == 'Hotel') {
            $is_cash = ($row['sales_method'] == 'Cash');
            if ($is_cash) {
              $event_sales_total += $row['sales_amount'];
            } else {
              $event_card_total += $row['sales_amount'];
            }
        ?>
            <tr>
              <td class="bl"></td>
              <td><?= strtoupper($row['sales_type']) ?> PAYMENT / <?= $row['sales_remarks'] ?></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td><?= $is_cash ? number_format($row['sales_amount'], 2) : '' ?></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td><?= !$is_cash ? number_format($row['sales_amount'], 2) : '' ?></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td class="nb bgw"></td>
            </tr>
        <?php }
        } ?>

        <?php
        $event_collectables = 0;
        foreach ($collectables as $row) {
          $is_hotel = (isset($row['collectable_type']) && $row['collectable_type'] == 'Hotel');
          if ($is_hotel) {
            $hotel_collectables += $row['collectable_amount'];
          } else {
            $event_collectables += $row['collectable_amount'];
          }
        ?>
          <tr>
            <td class="bl"></td>
            <td><?= $is_hotel ? 'HOTEL' : 'EVENT' ?> COLLECTABLE / <?= $row['collectable_remarks'] ?></td>
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
            <td><?= $is_hotel ? number_format($row['collectable_amount'], 2) : '' ?></td>
            <td><?= !$is_hotel ? number_format($row['collectable_amount'], 2) : '' ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="nb bgw"></td>
          </tr>
        <?php } ?>

        <tr>
          <td class="bgw nb" colspan="2"></td>
          <td class="bgw nb"><?= number_format($room_rate, 2) ?></td>
          <td class="bgw nb"><?= number_format($restaurant, 2) ?></td>
          <td class="bgw nb"><?= number_format($coffeeshop, 2) ?></td>
          <td class="bgw nb"><?= number_format($addons, 2) ?></td>
          <td class="bgw nb"><?= number_format($reservation, 2) ?></td>
          <td class="bgw nb"><?= number_format($event_sales_total, 2) ?></td>
          <td class="bgw nb"><?= number_format($room_rate_card, 2) ?></td>
          <td class="bgw nb"><?= number_format($restaurant_card, 2) ?></td>
          <td class="bgw nb"><?= number_format($coffeeshop_card, 2) ?></td>
          <td class="bgw nb"><?= number_format($addons_card, 2) ?></td>
          <td class="bgw nb"><?= number_format($reservation_card, 2) ?></td>
          <td class="bgw nb"><?= number_format($event_card_total, 2) ?></td>
          <td class="bgw nb"></td>
          <td class="bgw nb"></td>
          <td class="bgw nb"></td>
          <td class="bgw nb"></td>
          <td class="bgw nb" colspan="4"></td>
        </tr>
        <tr>
          <td class="bgw nb" colspan="20">&nbsp;</td>
        </tr>
        <tr>
          <td class="bgw nb" colspan="2"></td>
          <td class="bgw nb">TOTAL:</td>
          <td class="bgy nb" colspan="5"><?= number_format($room_rate + $restaurant + $coffeeshop + $addons + $reservation + $event_sales_total, 2) ?></td>
          <td class="bgw nb">TOTAL:</td>
          <td class="bgy nb" colspan="5"><?= number_format($room_rate_card + $restaurant_card + $coffeeshop_card + $addons_card + $reservation_card + $event_card_total, 2) ?></td>
          <td class="bgw nb" colspan="6"></td>
        </tr>
        <tr>
          <td class="bgw nb" colspan="20">&nbsp;</td>
        </tr>
        <tr>
          <td class="bgw nb"></td>
          <td class="nw bt bl bgw">IN-HOUSE<span style="color: #27ae60; font-size: 5pt; vertical-align: middle; margin-left: 3px;">⌂</span></td>
          <td class="bt bgw"><?= $inhouse_count ?></td><!-- guests checked in from previous days -->
          <td class="nb bgw" colspan="10"></td>
          <td class="nb bgy">HOTEL</td>
          <td class="nb bgy">EVENT</td>
          <td class="nb bgy">POOL</td>
          <td class="nb bgy">RESTO</td>
          <td class="nb bgy">OTILLA'S</td>
          <td class="nb bgy">TOTAL</td>
          <td class="nb bgw"></td>
        </tr>
        <tr>
          <td class="nb bgw"></td>
          <td class="nw bt bl bgw"><?= $type ?> CHECK-IN</td>
          <td class="bgw"><?= $checkin_count ?></td><!-- check in count -->
          <td class="nb bgw" colspan="9"></td>
          <td class="bt bgw bl">CASH</td>
          <?php $hotel = $room_rate + $addons + $reservation + floatval($sales_hotel_cash->sales_amount) ?>
          <td class="bt bgw"><?= number_format($hotel, 2) ?></td>
          <td class="bt bgw"><?= number_format(floatval($sales_event_cash->sales_amount), 2) ?></td>
          <td class="bt bgw"><?= number_format(floatval($sales_pool_cash->sales_amount), 2) ?></td>
          <td class="bt bgw"><?= number_format($restaurant, 2) ?></td>
          <td class="bt bgw"><?= number_format($coffeeshop, 2) ?></td>
          <?php $event = floatval($sales_event_cash->sales_amount); ?>
          <?php $pool = floatval($sales_pool_cash->sales_amount); ?>
          <?php $total = $hotel + $event + $pool + $restaurant + $coffeeshop ?>
          <td class="bt bgw br"><?= number_format($total, 2) ?></td>
          <td class="nb bgw"></td>
        </tr>
        <tr>
          <td class="nb bgw"></td>
          <td class="nw bt bl bgw">CHECK-OUT</td>
          <td class="bgw"><?= $checkout_count ?></td><!-- checkout count -->
          <td class="nb bgw" colspan="9"></td>
          <td class="bgw bl">CARD</td>
          <?php $hotel_card = $room_rate_card + $addons_card + $reservation_card + floatval($sales_hotel_card->sales_amount) ?>
          <td class="bgw"><?= number_format($hotel_card, 2) ?></td>
          <td class="bgw"><?= number_format(floatval($sales_event_card->sales_amount), 2) ?></td>
          <td class="bgw"><?= number_format(floatval($sales_pool_card->sales_amount), 2) ?></td>
          <td class="bt bgw"><?= number_format($restaurant_card, 2) ?></td>
          <td class="bt bgw"><?= number_format($coffeeshop_card, 2) ?></td>
          <?php $total_card = $hotel_card + floatval($sales_event_card->sales_amount) + floatval($sales_pool_card->sales_amount) + $restaurant_card + $coffeeshop_card; ?>
          <td class="bt bgw br"><?= number_format($total_card, 2) ?></td>
          <td class="nb bgw"></td>
        </tr>
        <tr>
          <td class="nb bgw"></td>
          <td class="nw bt bl bb bgw">TOTAL ROOMS OCCUPIED</td>
          <td class="bb bgw"><?= $inhouse_count + $checkin_count ?></td><!-- IN-HOUSE + CHECK-IN -->
          <td class="nb bgw" colspan="9"></td>
          <td class="bgw bl">COLLECTABLE</td>
          <td class="bgw"><?= number_format($hotel_collectables, 2) ?></td>
          <td class="bgw"><?= number_format($event_collectables, 2) ?></td>
          <td class="bgw">0.00</td>
          <td class="bgw">0.00</td>
          <td class="bgw">0.00</td>
          <td class="bgw br"><?= number_format($hotel_collectables + $event_collectables, 2) ?></td>
          <td class="nb bgw"></td>
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
          <td class="bgw br"><?= number_format($total_expense, 2) ?></td>
          <td class="nb bgw"></td>
        </tr>
        <tr>
          <td class="nb bgw"></td>
          <td class="nb bgw tl">Prepared By:</td>
          <td class="nb bgw" colspan="10"></td>
          <td class="bgw bl">TOTAL</td>
          <td class="bgw"><?= number_format($hotel + $hotel_card + $hotel_collectables - $expenses_hotel->expense_amount, 2) ?></td>
          <td class="bgw"><?= number_format(floatval($sales_event_cash->sales_amount) + floatval($sales_event_card->sales_amount) + $event_collectables - $expenses_event->expense_amount, 2) ?></td>
          <td class="bgw"><?= number_format(floatval($sales_pool_cash->sales_amount) + floatval($sales_pool_card->sales_amount) - $expenses_pool->expense_amount, 2) ?></td>
          <td class="bgw nw"><?= number_format($restaurant + $restaurant_card - $expenses_resto->expense_amount, 2) ?></td>
          <td class="bgw"><?= number_format($coffeeshop + $coffeeshop_card - $expenses_otillas->expense_amount, 2) ?></td>
          <td class="bgy bb-0 br"><?= number_format($total + $total_card + $hotel_collectables + $event_collectables - $total_expense, 2) ?></td>
          <td class="nb bgw"></td>
        </tr>
        <tr>
          <td class="bgw nb" colspan="18">&nbsp;</td>
          <td class="bgy bb bl br nw">GRAND TOTAL</td>
          <td class="nb bgw"></td>
        </tr>
        <tr>
          <td class="nb bgw"></td>
          <td class="nb bgw"><?= mb_strtoupper(isset($remitted) ? $remitted->name : $_SESSION['name']) ?></td>
          <td class="nb bgw" colspan="18"></td>
        </tr>
        <tr>
          <td class="nb bgw"></td>
          <td class="nb bgw"><?= $date ?></td>
          <td class="nb bgw" colspan="18"></td>
        </tr>
        <tr>
          <td class="bgw nb" colspan="20">&nbsp;</td>
        </tr>
        <tr>
          <td class="bgw nb" colspan="20">&nbsp;</td>
        </tr>
        <tr>
          <td class="bgw nb" colspan="15">&nbsp;</td>
          <td class="bgy bt bl"></td>
          <td class="bgy bt">AM</td>
          <td class="bgy bt">PM</td>
          <td class="bgw bt tr br">TOTAL</td>
          <td class="nb bgw"></td>
        </tr>
        <tr>
          <td class="bgw nb" colspan="15">&nbsp;</td>
          <td class="bgw bt bl nw">HOTEL SALES</td>
          <td class="bgw bt"><?= number_format($hotel_sales_am, 2) ?></td>
          <td class="bgw bt"><?= number_format($hotel_sales_pm, 2) ?></td>
          <td class="bgw bt tr br"><?= number_format($hotel_sales_am + $hotel_sales_pm, 2) ?></td>
          <td class="nb bgw"></td>
        </tr>
        <tr>
          <td class="nb bgw"></td>
          <td class="nb bgw tl">Noted By:</td>
          <td class="bgw nb" colspan="13">&nbsp;</td>
          <td class="bgw bt bl nw">
            EVENT SALES
          </td>
          <td class="bgw bt"><?= number_format($event_sales_am, 2) ?></td>
          <td class="bgw bt"><?= number_format($event_sales_pm, 2) ?></td>
          <td class="bgw bt tr br"><?= number_format($event_sales_am + $event_sales_pm, 2) ?></td>
          <td class="nb bgw"></td>
        </tr>
        <tr>
          <td class="nb bgw"></td>
          <td class="nb bgw nw">MS. JOANNE ORTIZ/SIR CARLOS ORTIZ</td>
          <td class="bgw nb" colspan="14">&nbsp;</td>
          <td class="bgy bt bl" colspan="2">GRAND TOTAL</td>
          <td class="bgw bt tr br"><?= number_format($hotel_sales_am + $hotel_sales_pm + $event_sales_am + $event_sales_pm, 2) ?></td>
          <td class="nb bgw"></td>
        </tr>
      </tbody>
    </table>
  </div>
</body>

</html>