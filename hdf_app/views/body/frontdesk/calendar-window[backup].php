<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="icon" type="jpeg" href="<?= base_url('assets/img/logo.jpg') ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title><?= TITLE ?> | iHotelier by WSM IT Services</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--  Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?= base_url() ?>assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?= base_url() ?>assets/demo/demo.css" rel="stylesheet" />
  <!-- Scripts -->
  <script src="<?= base_url() ?>assets/js/core/jquery.min.js"></script>
  <script src="<?= base_url() ?>assets/js/core/popper.min.js"></script>
  <script src="<?= base_url() ?>assets/js/core/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>assets/js/plugins/moment.min.js"></script>
  <script src="<?= base_url() ?>assets/js/plugins/bootstrap-datetimepicker.js"></script>
  <script src="<?= base_url() ?>assets/js/functions.js"></script>
</head>

<style type="text/css">
  [disabled] {
    pointer-events: none;
  }

  .table-container table td:first-child,
  .table-container table th:first-child {
    position: sticky;
    left: 0;
    background-color: #B6DDE8;
  }

  .table-container table {
    border-top: 0 !important;
  }

  .table-container th {
    font-size: 12px !important;
  }

  .table-container td {
    padding: 4px 8px !important;
    font-size: 12px;
  }

  .sticky-top {
    top: 63px;
    background: white;
    z-index: 9999999999;
  }

  .sticky {
    top: 106px;
  }

  .page-break {
    background-color: #66615B !important;
  }

  .sticky-page-break {
    display: sticky;
    top: 43px;
    z-index: 9999;
  }

  .mw {
    min-width: 80px;
  }

  .border-shadow {
    box-shadow: inset 0 1px 0 #dee2e6, inset 1px 0 0 #dee2e6;
  }

  .border-shadow-1 {
    box-shadow: inset 0 1px 0 #dee2e6
  }

  .table-bordered td,
  table {
    border-color: #dee2e6 !important
  }

  .labels th {
    background-color: #FBD4B4 !important;
    text-align: text-center;
  }

  .with-data {
    background-color: #85C65F;
    text-align: center;
    border: 1px solid #dee2e6 !important;
  }

  .no-data {
    cursor: pointer;
  }

  .no-data:hover {
    background-color: #dee2e6;
  }

  .dashboard {
    top: 0;
    position: fixed;
    background-color: white;
    width: 100%;
    z-index: 99999999;
  }
</style>

<div class="dashboard p-3 d-flex justify-content-between">
  <div class="d-flex">
    <div class="mr-5">
      <h6 class="mb-0">Room #: <span id="room_number">0</span></h6>
      <small id="room_type"></small>
    </div>
    <div>
      <h6 class="mb-0">Date: <span id="start">0</span> - <span id="end">0</span></h6>
      <small id="nights">0</small>
    </div>
  </div>
  <div>
    <button class="btn btn-sm mt-1" id="proceed" disabled>Proceed</button>
  </div>
</div>

<div class="content pb-0" style="margin-top:63px">
  <div class="table-container">
    <table class="table table-bordered mb-1">
      <thead>
        <tr>
          <th class="white sticky-top border-shadow-1 text-center"><?= $y ?></th>
          <?php for ($i = 1; $i <= $days; $i++) { ?>
            <?php
            $today = '';
            $bg = '';
            if (date('Y-m-d') == $y . '-' . $m . '-' . str_pad($i, 2, '0', STR_PAD_LEFT)) {
              $bg = 'bg-default text-white';
            }
            if (date('Y-m-d') == $y . '-' . $m . '-' . str_pad($i + 2, 2, '0', STR_PAD_LEFT)) {
              $today = 'today';
            } elseif (date('Y-m-d') == $y . '-' . $m . '-' . str_pad($i, 2, '0', STR_PAD_LEFT)) {
              $today = 'today';
            }
            ?>
            <th class="text-center mw sticky-top border-shadow<?= $i % 2 ? ' bg-light' : '' ?> <?= $bg ?>" id="<?= $today ?>"><?= $i ?>-<?= substr($month, 0, 3) ?></th>
          <?php } ?>
          <?php for ($j = 1; $j <= 10; $j++) { ?>
            <!-- <th class="text-center mw sticky-top border-shadow"><?= $j ?>-<?= substr($next_month, 0, 3) ?></th> -->
          <?php } ?>
        </tr>
        <tr>
          <td colspan="99" class="page-break sticky-page-break"></td>
        </tr>
      </thead>
      <tbody>
        <?php $prev = 0; ?>
        <?php foreach ($rooms as $row) { ?>
          <?php if ($row['room_number'] - $prev > 50) { ?>
            <tr>
              <td colspan="99" class="page-break"></td>
            </tr>
          <?php } ?>
          <tr>
            <td class="text-center border-0 sticky">
              <div class="d-flex">
                <div class="d-inline-block" style="width:50px;"><?= $row['room_number'] ?> <?= $row['room_type_abbr'] ?></div>
              </div>
            </td>
            <?php
            $yesterday = date('Y-m-d', strtotime('-1 day'));
            $today = date('Y-m-d');
            $now = date('H');
            ?>
            <?php for ($i = 1; $i <= $days; $i++) { ?>
              <?php
              $disabled = '';
              $text = '';
              $checkin = '';
              $type = 'Reservation';
              $date_dash = $y . '-' .  $m . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
              if ($yesterday > $date_dash) {
                $disabled = 'disabled';
                $text = '<center><i class="fa-solid fa-xmark"></i></center>';
              } elseif ($yesterday == $date_dash) {
                if ($now >= 10) {
                  $disabled = 'disabled';
                  $text = '<center><i class="fa-solid fa-xmark"></i></center>';
                } else {
                  $type = 'Check In';
                }
              } elseif ($today == $date_dash) {
                if ($now >= 10) {
                  $type = 'Check In';
                }
              }

              $date = $m . '/' . str_pad($i, 2, '0', STR_PAD_LEFT) . '/' . $y;
              $data = array_filter($bookings, function ($booking) use ($date, $row) {
                return in_array($date, $booking['dates_between']) && $row['room_number'] == $booking['room_number'];
              });
              ?>
              <?php if ($data) { ?>
                <?php $data = array_merge(...$data); ?>
                <?php
                if ($data['reservation_status'] == 0 || $data['reservation_status'] == -1) {
                  $color = 'success';
                } elseif ($data['reservation_type'] == 'Confirmed') {
                  $color = 'info';
                } else {
                  $color = 'warning';
                }
                if ($data['booked_room_archived'] == 2) {
                  $color = 'danger';
                }
                ?>
                <td class="with-data bg-<?= $color ?>" room_id="<?= $row['room_id'] ?>" date="<?= $date ?>" data='<?= json_encode($row) ?>'></td>
              <?php } else { ?>
                <td class="no-data first room room<?= $row['room_number'] ?> " day="<?= $i ?>" date=" <?= $date ?>" data='<?= json_encode($row) ?>' <?= $disabled ?>></td>
            <?php }
            } ?>
            <?php for ($j = 1; $j <= 10; $j++) { ?>
              <!-- <td class="no-data first room room<?= $row['room_number'] ?>" day="<?= $j ?>" date=" <?= $m + 1 . '/' . str_pad($j, 2, '0', STR_PAD_LEFT) . '/' . $y ?>" data='<?= json_encode($row) ?>'>s</td> -->
            <?php } ?>
          </tr>
          <?php $prev = $row['room_number']; ?>
        <?php } ?>
        <tr>
          <td colspan="99" class="page-break"></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<script>
  const base_url = ' <?= base_url() ?>';
  let room_number = null;
  let start = 0;
  let end = 0;
  let data = null;

  $(document).ready(function() {
    const today = document.getElementById("today");
    if (today) {
      today.scrollIntoView({
        behavior: "smooth",
        block: "end",
        inline: "start"
      });
    }

    $('.with-data').css('opacity', 0.5);
    const dates_between = JSON.parse(localStorage.getItem('highlight_between'));
    for (const date of dates_between) {
      $(`[room_id="${localStorage.getItem('highlight_room_id')}"][date="${$.escapeSelector(date)}"]`).css('opacity', 1);
    }
  });

  function clearAll() {
    $('.no-data').removeClass('bg-default');
    $('#end').text('');
    $('#proceed').attr('disabled', true);
    room_number = null;
    start = 0;
    end = 0;
  }

  function setStart(that, this_day, data) {
    $(that).addClass('bg-default');
    room_number = data.room_number;
    start = this_day;
    $('#room_number').text(room_number);
    $('#room_type').text(data.room_type);
    $('#start').text(`${getMonth()}, ${start}`);
  }

  $('.room').click(function() {
    const this_day = parseInt($(this).attr('day'));
    const date = $(this).attr('date');
    data = JSON.parse($(this).attr('data'));

    if (data.room_number != room_number) {
      clearAll();
    }

    if (start != 0) {
      end = this_day;
      let nights = end - start;
      nights = nights <= 0 ? 0 : nights;
      $('#proceed').attr('disabled', nights <= 0);
      $('#end').text(end);
      $('#nights').text(`${nights} night${nights==1?'':'s'}`);
      if (nights == 0) clearAll();
    }

    if (!room_number) {
      setStart(this, this_day, data);
    }

    if (data.room_number == room_number && this_day > start) {
      $('.no-data').removeClass('bg-default');
      $(this).addClass('bg-default');
      for (let i = start; i <= this_day; i++) {
        $(`[day=${i}].room${room_number}`).addClass('bg-default');
      }
    } else if (data.room_number == room_number && this_day < start) {
      clearAll();
      setStart(this, this_day, data);
    }
  });

  $('#proceed').click(function() {
    const today = new Date();
    const month = pad(today.getMonth() + 1);
    const year = today.getFullYear();
    const check_in = `${month}/${pad(start)}/${year}`;
    const check_out = `${month}/${pad(end)}/${year}`;
    localStorage.setItem('check_in', check_in);
    localStorage.setItem('check_out', check_out);
    localStorage.setItem('room_id', data.room_id);
    localStorage.setItem('room_type', data.room_type);
    localStorage.setItem('room_number', data.room_number);
    localStorage.setItem('nights', end - start);
    self.close();
  });
</script>