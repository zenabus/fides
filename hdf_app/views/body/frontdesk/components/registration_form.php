<!DOCTYPE html>
<html>

<head>
  <title><?= TITLE ?> - Guest Registration Form</title>
  <style type="text/css">
    * {
      font-family: 'DejaVu Serif' !important;
      font-size: 36px;
    }

    body,
    html {
      margin: 0 !important;
      background-image: url(<?= $image ?>);
      background-repeat: no-repeat;
      background-size: 100%;
      /* font-weight: bold; */
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

    .room_no {
      top: 191px;
      right: 525px;
    }

    .room_type,
    .room_rate {
      left: 345px;
    }

    .room_type,
    .check_in {
      top: 297px;
    }

    .room_rate,
    .check_out {
      top: 373px;
    }

    .check_in,
    .check_out,
    .middle_name {
      left: 1544px;
    }

    .last_name,
    .first_name,
    .middle_name,
    .suffix {
      top: 562px;
    }

    .last_name {
      left: 207px;
    }

    .first_name {
      left: 848px;
    }

    .suffix {
      left: 2088px;
    }

    .address,
    .contact,
    .email,
    .company_name,
    .company_address,
    .plate_no {
      left: 424px;
    }

    .address {
      top: 733px;
    }

    .birthday,
    .nationality {
      left: 1620px;
    }

    .contact,
    .birthday {
      top: 811px;
    }

    .email,
    .nationality {
      top: 887px;
    }

    .company_name {
      top: 965px;
    }

    .company_address {
      top: 1041px;
    }

    .request {
      top: 1119px;
      left: 624px;
    }

    .plate_no {
      top: 1195px;
    }

    .ci,
    .co {
      bottom: -60px;
    }

    .ci {
      left: 100px;
    }

    .co {
      left: 1200px;
    }

    .remarks {
      bottom: 100px;
      left: 35px;
      font-weight: normal;
      font-size: 28px;
    }
  </style>
</head>

<body>
  <footer>
    Document generated: <?= date('F d, Y h:ia'); ?>
  </footer>
  <div class="page">
    <p class="absolute room_no"><?= $booking->room_number ?></p>
    <p class="absolute room_type"><?= $booked_rooms[0]['room_type'] ?></p>
    <p class="absolute room_rate">₱ <?= number_format($booked_rooms[0]['pricing_type']) ?></p>
    <p class="absolute check_in"><?= $booking->check_in ?></p>
    <p class="absolute check_out"><?= $booking->check_out ?></p>
    <p class="absolute last_name"><?= $booking->last_name ?></p>
    <p class="absolute first_name"><?= $booking->first_name ?></p>
    <p class="absolute middle_name"><?= $booking->middle_name ?></p>
    <p class="absolute suffix"><?= $booking->suffix ?></p>
    <p class="absolute address"><?= $booking->address ?></p>
    <p class="absolute contact"><?= $booking->contact ?></p>
    <p class="absolute birthday"><?= $booking->birthday ?></p>
    <p class="absolute email"><?= $booking->email ?></p>
    <p class="absolute nationality"><?= $booking->nationality ?></p>
    <p class="absolute company_name"><?= $booking->company_name ?></p>
    <p class="absolute company_address"><?= $booking->company_address ?></p>
    <p class="absolute request"><?= $booking->request ?></p>
    <p class="absolute plate_no"><?= $booking->plate_no ?></p>
    <p class="absolute ci"><?= $booking->check_in ?></p>
    <p class="absolute co"><?= $booking->check_out ?></p>
    <p class="absolute remarks"><?= $booking->remarks ?></p>
  </div>
</body>

</html>