<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.ui.position.js"></script>

<style type="text/css">
  [disabled] {
    pointer-events: none;
  }

  .wait {
    cursor: wait;
  }

  .table-container {
    overflow-x: auto;
    max-height: calc(100vh - 200px);
    padding-right: 16px;
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
    padding: 8px 12px !important;
    font-size: 12px;
  }

  .sticky,
  .sticky-top {
    position: sticky;
    z-index: 999;
  }

  .sticky-top {
    top: 0;
    background: white;
  }

  .sticky {
    top: 43px;
  }

  .page-break {
    background-color: #66615B !important;
  }

  .white {
    background-color: white !important;
  }

  .mw-200 {
    min-width: 200px;
  }

  .wsp {
    white-space: pre;
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
    cursor: pointer;
  }

  .hovered {
    background-color: #dee2e6;
  }

  .card-div,
  .reservation-div,
  #new_guest {
    display: none;
  }

  .modal {
    overflow-y: scroll !important;
  }

  td.min {
    box-shadow: inset 0 1px 0 0 #66615B, inset 1px 0 0 0 #66615B, inset 0 -1px 0 0 #66615B;
    border-width: 0 !important;
  }

  td.max {
    box-shadow: inset 0 1px 0 0 #66615B, inset -1px 0 0 0 #66615B, inset 0 -1px 0 0 #66615B;
    border-width: 0 !important;
  }

  td.mid {
    box-shadow: inset 0 1px 0 0 #66615B, inset 0 -1px 0 0 #66615B;
    border-width: 0 !important;
  }

  #modalPay,
  #modalPayments {
    z-index: 999999;
  }

  .swal2-container {
    z-index: 9999999 !important;
  }

  .draggable {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>

<?php

$yesterday = date('Y-m-d', strtotime('-1 day'));
$todate = date('Y-m-d');
$now = date('H');

?>

<div class="content pb-0">
  <div class="row">
    <div class="col-md-12">
      <div class="d-flex justify-content-between">
        <h5 id="title">Room Calendar</h5>
        <div>
          <a href="<?= base_url('index.php/main/calendar/' . $y . '/' . str_pad(($m - 1), 2, '0', STR_PAD_LEFT)) ?>" class="btn btn-primary btn-sm" title="Previous Month" <?= $m == '01' ? 'disabled' : '' ?> data-placement="top" rel="tooltip">
            <span class="fa fa-arrow-left"></span>
          </a>
          <?php if ($y == date('Y') && $m == date('m')) { ?>
            <a href="javascript:" class="btn btn-success btn-sm" title="Go to Current" id="current" data-placement="top" rel="tooltip">
              <span class="fa fa-undo"></span>
            </a>
          <?php } else { ?>
            <a href="<?= base_url('index.php/main/calendar/' . date('Y') . '/' . date('m')) ?>" class="btn btn-success btn-sm" title="Go to Current" data-placement="top" rel="tooltip">
              <span class="fa fa-undo"></span>
            </a>
          <?php } ?>
          <a href="javascript:" class="btn btn-success btn-sm" title="Select Month" data-toggle="modal" data-target="#modalMonth" data-placement="top" rel="tooltip">
            <span class="fa fa-calendar"></span>
          </a>
          <a href="<?= base_url('index.php/main/calendar/' . $y . '/' . str_pad(($m + 1), 2, '0', STR_PAD_LEFT)) ?>" class="btn btn-primary btn-sm" title="Next Month" <?= $m == '12' ? 'disabled' : '' ?> data-placement="top" rel="tooltip">
            <span class="fa fa-arrow-right"></span>
          </a>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="table-container">
            <table class="table mb-1">
              <thead>
                <tr>
                  <th class="white sticky-top border-shadow-1 text-center"><?= $y ?></th>
                  <?php for ($i = 1; $i <= $days; $i++) { ?>
                    <?php
                    $icon = '';
                    $today = '';
                    $bg = '';

                    if ($i % 2) {
                      $bg = 'bg-light';
                    }
                    if (date('Y-m-d') == $y . '-' . $m . '-' . str_pad($i, 2, '0', STR_PAD_LEFT)) {
                      $bg = 'bg-default text-white';
                    }

                    if (date('Y-m-d') == $y . '-' . $m . '-' . str_pad($i + 1, 2, '0', STR_PAD_LEFT)) {
                      $today = 'today';
                    } elseif (date('Y-m-d') == $y . '-' . $m . '-' . str_pad($i, 2, '0', STR_PAD_LEFT)) {
                      $today = 'today';
                    }

                    $disabled = FALSE;
                    $checkin = '';
                    $type = 'Reservation';
                    $date_dash = $y . '-' .  $m . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
                    if ($yesterday > $date_dash) {
                      $disabled = TRUE;
                    } elseif ($yesterday == $date_dash) {
                      if ($now >= 10) {
                        $disabled = TRUE;
                      } else {
                        $type = 'Check In';
                      }
                    } elseif ($todate == $date_dash) {
                      if ($now >= 10) {
                        $type = 'Check In';
                      }
                    }

                    ?>
                    <th colspan="2" class="text-center sticky-top border-shadow <?= $disabled ? '' : 'mass' ?> <?= $bg ?>" id="<?= $today ?>" date="<?= $date_dash ?>" type="<?= $type ?>">
                      <?= $i ?>-<?= substr($month, 0, 3) ?>
                    </th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>
                <tr class="labels">
                  <th class="wsp text-center sticky">ROOM</th>
                  <?php for ($i = 1; $i <= $days; $i++) { ?>
                    <th class="text-center mw-200 sticky">GUEST NAME</th>
                    <th class="text-center mw-200 sticky">REMARKS</th>
                  <?php } ?>
                </tr>
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
                        <div class="d-inline-block" style="width:50px;"><?= $row['name'] ?></div>
                      </div>
                    </td>
                    <?php for ($i = 1; $i <= $days; $i++) { ?>
                      <?php
                      $disabled = '';
                      $text = '';
                      $checkin = '';
                      $type = 'Reservation';
                      $both = 0;
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
                      } elseif ($todate == $date_dash) {
                        if ($now >= 10) {
                          $type = 'Check In';
                        }
                        $both = 1;
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
                        $occupant = explode(' / ', $data['occupant'])[0];
                        $name = "{$data['first_name']} {$data['middle_name']} {$data['last_name']} {$data['suffix']}";
                        $guest = $occupant ? $name . ' / ' . $occupant : $name;

                        $min = $date == min($data['dates_between']) ? 'min' : 'mid';
                        $max = $date == max($data['dates_between']) ? 'max' : 'mid';
                        ?>
                        <td class="with-data <?= $min ?> bg-<?= $color ?> position-relative first-drag" date="<?= $date ?>" data='<?= json_encode($row) ?>' booking='<?= json_encode($data) ?>' both="<?= $both ?>">
                          <div draggable="true" class="draggable" id="drag<?= $date_dash ?>-<?= $data['room_id'] ?>"><?= character_limiter($guest, 15) ?></div>
                        </td>
                        <td class="with-data <?= $max ?> bg-<?= $color ?> position-relative second-drag" date="<?= $date ?>" data='<?= json_encode($row) ?>' booking='<?= json_encode($data) ?>' both="<?= $both ?>">
                          <div draggable="true" class="draggable" id="drag<?= $date_dash ?>-<?= $data['room_id'] ?>"><?= character_limiter($data['remarks'], 15) ?></div>
                        </td>
                      <?php } else { ?>
                        <td class="<?= $checkout ? '' : 'no-data pointer' ?> droppable first" date="<?= $date ?>" data='<?= json_encode($row) ?>' type="<?= $type ?>" both="<?= $both ?>" <?= $disabled ?>><?= $text ?></td>
                        <td class="<?= $checkout ? '' : 'no-data pointer' ?> droppable second" date="<?= $date ?>" data='<?= json_encode($row) ?>' type="<?= $type ?>" both="<?= $both ?>" <?= $disabled ?>><?= $text ?></td>
                    <?php }
                    } ?>
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
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalMonth" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Select Month</h4>
      </div>
      <div class="modal-body px-4">
        <div class="form-group">
          <label>Month</label>
          <select id="month" class="form-control">
            <option value="01" <?= $m == '01' ? 'selected' : '' ?>>January</option>
            <option value="02" <?= $m == '02' ? 'selected' : '' ?>>February</option>
            <option value="03" <?= $m == '03' ? 'selected' : '' ?>>March</option>
            <option value="04" <?= $m == '04' ? 'selected' : '' ?>>April</option>
            <option value="05" <?= $m == '05' ? 'selected' : '' ?>>May</option>
            <option value="06" <?= $m == '06' ? 'selected' : '' ?>>June</option>
            <option value="07" <?= $m == '07' ? 'selected' : '' ?>>July</option>
            <option value="08" <?= $m == '08' ? 'selected' : '' ?>>August</option>
            <option value="09" <?= $m == '09' ? 'selected' : '' ?>>September</option>
            <option value="10" <?= $m == '10' ? 'selected' : '' ?>>October</option>
            <option value="11" <?= $m == '11' ? 'selected' : '' ?>>November</option>
            <option value="12" <?= $m == '12' ? 'selected' : '' ?>>December</option>>
          </select>
        </div>
        <div class="form-group">
          <label>Year</label>
          <select name="" id="year" class="form-control">
            <?php for ($i = 2021; $i <= date('Y'); $i++) {  ?>
              <option value="<?= $i ?>" <?= $y == $i ? 'selected' : '' ?>><?= $i ?></option>
            <?php  } ?>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <a href="<?= base_url('index.php/main/calendar/' . $y . '/' . $m) ?>" class="btn btn-link" id="selectMonth">Select</a>
        </div>
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modalPay" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Add Payment</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('admin/addPayment', ['id' => 'frmPayment']) ?>
        <input type="hidden" name="payment_booking_id">
        <input type="hidden" name="payment_booked_room_id">

        <div class="payment-advanced-div">
          <div class="form-row">
            <div class="form-group col-md-12">
              <label>Payment Option</label>
              <div class="d-flex justify-content-around my-2">
                <div class="form-check-radio mb-0">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="payment_payment_option" value="Cash" checked>
                    Cash
                    <span class="form-check-sign"></span>
                  </label>
                </div>
                <div class="form-check-radio mb-0">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="payment_payment_option" value="Card">
                    Card
                    <span class="form-check-sign"></span>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Advance Payment</label>
            <input type="number" class="form-control" name="payment_amount" min="0" step="0.01" required>
          </div>
          <div class="form-group payment-card-div d-none mb-0">
            <label>Account Number</label>
            <input type="number" class="form-control" name="payment_card_number" placeholder="XXXX" maxlength="4">
            <small>Last 4 digit only.</small>
          </div>
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


<div class="modal fade" id="modalPayments" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Advance Payments</h4>
      </div>
      <div class="modal-body px-4">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Amount</th>
              <th>Processed By</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="payments-tbody">
            <!-- javascript -->
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  let bookings = <?= json_encode($bookings) ?>;
  let rooms = <?= json_encode($rooms) ?>;
  let guests = <?= json_encode($guests) ?>;
</script>
<script defer src="<?= base_url('assets/js/modal-reservation.js') ?>"></script>
<script>
  const base_url = ' <?= base_url() ?>';
  const now = new Date();
  let hour = `${pad(now.getHours())}`;
  let time = `${pad(now.getHours())}:${pad(now.getMinutes())}:${pad(now.getSeconds())}`;
  let today = `${now.getFullYear()}-${pad(now.getMonth()+1)}-${pad(now.getDate())}`;

  const toggleHovered = (obj, add = true) => {
    if (add) {
      if ($(obj).hasClass('first')) {
        $(obj).addClass('hovered');
        $(obj).next().addClass('hovered');
      } else if ($(obj).hasClass('second')) {
        $(obj).addClass('hovered');
        $(obj).prev().addClass('hovered');
      }
    } else {
      if ($(obj).hasClass('first')) {
        $(obj).removeClass('hovered');
        $(obj).next().removeClass('hovered');
      } else if ($(obj).hasClass('second')) {
        $(obj).removeClass('hovered');
        $(obj).prev().removeClass('hovered');
      }
    }
  }

  $('#current').click(function() {
    const today = document.getElementById("today");
    if (today) {
      today.scrollIntoView({
        behavior: "smooth",
        block: "end",
        inline: "start"
      });
    }
  });

  $(".table-container").scroll(function() {
    const top = $(this).scrollTop();
    const left = $(this).scrollLeft();
    localStorage.setItem('top', top);
    localStorage.setItem('left', left);
  });

  $(document).ready(function() {
    const top = localStorage.getItem('top');
    const left = localStorage.getItem('left');
    $(".table-container").scrollTop(top);
    $(".table-container").scrollLeft(left);

    // const today = document.getElementById("today");
    // if (today) {
    //   today.scrollIntoView({
    //     behavior: "smooth",
    //     block: "end",
    //     inline: "start"
    //   });
    // }
    $('.datepicker').datetimepicker({
      icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calender",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: "fa fa-chevron-left",
        next: "fa fa-chevron-right",
        today: "fa fa-screenshot",
        clear: "fa fa-trash",
        close: "fa fa-remove",
      },
      format: 'L',
      defaultDate: new Date(),
    });
    $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');
    $('.sidebar .sidebar-wrapper, .main-panel').css('overflow', 'hidden');
    $('.first, .second, .with-data').hover(function() {
      const date = $(this).attr('date');
      const data = JSON.parse($(this).attr('data'));
      $('#title').text(`Room Calendar [ROOM: ${data.room_number} - ${date}]`);
      toggleHovered(this);
    }, function() {
      $('#title').text(`Room Calendar`);
      toggleHovered(this, false);
    });

    setInterval(() => {
      const now = new Date();
      const timeNow = `${pad(now.getHours())}:${pad(now.getMinutes())}:${pad(now.getSeconds())}`;
      time = timeNow;
    }, 1000);
  });

  $('#month').change(function() {
    const month = $(this).val();
    const year = $('#year').val();
    $('#selectMonth').attr('href', `${base_url}index.php/main/calendar/${year}/${month}`)
  });

  $('#year').change(function() {
    const year = $('#year').val();
    const month = $('#month').val();
    $('#selectMonth').attr('href', `${base_url}index.php/main/calendar/${year}/${month}`)
  });

  $('.no-data').click(function() {
    const room = JSON.parse($(this).attr('data'));
    const type = $(this).attr('type');
    const date = $(this).attr('date');
    type_booking = '';
    // let date = new Date();
    // date = `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()}`;
    $('#returning_guest').show();
    $('.form-control').val('').removeAttr('disabled');
    modalBooking(this, type, 1);

    if (type == 'Reservation') {
      $("#rdo_reservation").prop("checked", true);
    } else {
      $("#rdo_checkin").prop("checked", true);
    }

    $('#frmBook').attr('action', `${base_url}index.php/main/book`);
    $('.action-div').addClass('d-none');
    $('[name=check_in]').attr('readonly', true);
    $('[name=remarks]').removeAttr('readonly');
    $('#btnBooking').show();
    $('#btnRedirect').addClass('d-none');
    $('#btnCancel, #btnChange, #btnPay, #btnPayments').addClass('d-none');
    $('.payment_option').show();
    $('.type-div').addClass('d-none');

    if (toDashed(date) == today) {
      if (hour >= 6 && hour <= 12) {
        $('.reservation-div').hide();
        $('[name=booking_type]').val('Check In');
        $('#btnBooking').val('Check In');
      }
      $('.type-div').removeClass('d-none');
    }
    let checkin = moment(date).format("YYYY-MM-DD");
    let checkout = moment(date).add(1, "days").format("YYYY-MM-DD");
    booked_room_id = null;
    updateAvailableRoom(checkin, checkout);
  });

  let booked_room_id;
  let type_booking;
  let withdata;

  $(document).on('click', '.with-data', function() {
    const room = JSON.parse($(this).attr('data'));
    const booking = JSON.parse($(this).attr('booking'));
    booked_room_id = booking.booked_room_id;
    type_booking = booking.booking_type;

    $('[name=payment_booked_room_id]').val(booked_room_id);
    $('[name=payment_booking_id]').val(booking.booking_id);

    $('#returning_guest').hide();
    $('[name=guest_id]').val(booking.guest_id);
    $('[name=first_name]').val(booking.first_name).attr('disabled', true);
    $('[name=middle_name]').val(booking.middle_name).attr('disabled', true);
    $('[name=last_name]').val(booking.last_name).attr('disabled', true);
    $('[name=suffix]').val(booking.suffix).attr('disabled', true);
    $('[name=contact]').val(booking.contact).attr('disabled', true);
    $("#txt-contact").text(`${booking.contact.length} digits`);
    $('[name=booked_room_id]').val(booking.booked_room_id);

    if (booking.reservation_status == 0 || booking.reservation_status == -1) {
      modalBooking(this, 'Check In', 0, booking.booking_number);
      $('#frmBook').attr('action', `${base_url}index.php/main/updateBooking`);
      $('[name=booking_id]').val(booking.booking_id);
      if (booking.booked_room_archived == 0) {
        $('.form-control').attr('disabled', false);
        $('[name=nights]').attr('readonly', true);
        $('textarea').attr('disabled', false).attr('readonly', false);
        $('#btnUpdate').removeClass('d-none');
      } else {
        $('.form-control').attr('disabled', true);
        $('textarea').attr('disabled', false).attr('readonly', true);
        $('#btnUpdate').addClass('d-none');
      }
      $('.action-div').addClass('d-none');
      $('#btnBooking').hide();
      $('#btnRedirect').removeClass('d-none').attr('href', `${base_url}index.php/main/booking/${booking.booking_number}`);
      $('#btnCancel, #btnChange, #btnPay, #btnPayments').addClass('d-none');
      $('.payment_option').show();
    } else if (booking.reservation_status == 1) {
      const [month, day, year] = booking.check_in.split('/')
      const checkin = `${year}-${month}-${day}`;
      modalBooking(this, 'Reservation', 0, booking.booking_number);
      $('[name=remarks]').removeAttr('readonly');
      if (checkin == today) {
        if (hour >= 6 && hour <= 12) {
          $("#rdo_check").prop("checked", true);
          $('.action-div').removeClass('d-none');
          $('#frmBook').attr('action', `${base_url}index.php/main/checkIn`);
          $('#btnBooking').show().val('Check In');
          $(".reservation-div").hide();
        } else if (hour > 12) {
          $("#rdo_check").prop("checked", true);
          $('.action-div').removeClass('d-none');
          $('#frmBook').attr('action', `${base_url}index.php/main/checkIn`);
          $('#btnBooking').show().val('Check In');
          $(".reservation-div").hide();
        } else {
          $('#frmBook').attr('action', `${base_url}index.php/main/updateReservation`);
          $('.action-div').addClass('d-none');
          $('#btnBooking').show().val('Update');
        }
      } else {
        $("#rdo_check").prop("checked", true);
        $('.action-div').removeClass('d-none');
        $('#frmBook').attr('action', `${base_url}index.php/main/checkIn`);
        $('#btnBooking').show().val('Check In');
        $(".reservation-div").hide();
      }

      $(booking.reservation_type == 'Confirmed' ? "#rdo_confirmed" : '#rdo_arrival').prop("checked", true);

      $('[name=booking_id]').val(booking.booking_id);
      $('[name=check_in]').removeAttr('readonly');
      $('.form-control').removeAttr('disabled');
      $('#btnRedirect').addClass('d-none');
      $('#btnCancel, #btnChange, #btnPay, #btnPayments').removeClass('d-none');
      $('.payment_option').hide();

      if (booking.reservation_type == 'Confirmed') {
        if (booking.payments) {
          $("[name=payment_option][value=" + booking.payments.payment_option + "]").prop('checked', true).trigger('change');
          $('[name=amount]').val(booking.advanced_total).attr('disabled', true);
          $('[name=card_number]').attr('disabled', true);
          $('[name=payment_option]').attr('disabled', true);
        }
        $(".advanced-div").show();
      }
    } else {
      modalBooking(this, 'Check In', 0, booking.booking_number);
      $('.action-div').addClass('d-none');
      $('#btnBooking').hide();
      $('#btnRedirect').removeClass('d-none');
      $('#btnCancel, #btnChange, #btnPay, #btnPayments').removeClass('d-none');
      $('.payment_option').hide();
    }

    $('[name=check_in]').val(booking.check_in);
    $('[name=check_out]').val(booking.check_out);
    $('[name=nights]').val(booking.nights);
    $('[name=request]').val(booking.request);
    $('[name=remarks]').val(booking.remarks);


    let checkin = moment(booking.check_in).format("YYYY-MM-DD");
    let checkout = moment(booking.check_out).format("YYYY-MM-DD");
    updateAvailableRoom(checkin, checkout);
  });

  let booking_id_drag;
  let booked_room_id_drag;
  let nights_drag;
  let bg_drag;
  let type_drag;
  let html_drag;
  let html_drag2;
  let booking_drag;

  const addClass = (element, cls) => {
    if (element.hasClass('no-data')) {
      element.addClass(`${bg_drag} ${cls}`);
    }
  }

  const removeClass = (element, cls) => {
    if (element.hasClass('no-data')) {
      element.removeClass(`${bg_drag} ${cls}`);
    }
  }

  const toggleDragOver = (obj, add = true) => {
    let current = $(obj);
    if (add) {
      if (nights_drag == 1) {
        if (current.hasClass('first')) {
          addClass(current, 'min');
          addClass(current.next(), 'max');
        } else if (current.hasClass('second')) {
          addClass(current, 'max');
          addClass(current.prev(), 'min');
        }
      } else {
        if (current.hasClass('second')) {
          current = current.prev();
        }
        addClass(current, 'min');
        current = current.next();
        for (let i = 1; i <= (nights_drag - 1) * 2; i++) {
          addClass(current, 'mid');
          current = current.next();
        }
        addClass(current, 'max')
      }
    } else {
      if (nights_drag == 1) {
        if (current.hasClass('first')) {
          removeClass(current, 'min');
          removeClass(current.next(), 'max');
        } else if (current.hasClass('second')) {
          removeClass(current, 'max');
          removeClass(current.prev(), 'min');
        }
      } else {
        if (current.hasClass('second')) {
          current = current.prev();
        }
        removeClass(current, 'min');
        current = current.next();
        for (let i = 1; i <= (nights_drag - 1) * 2; i++) {
          removeClass(current, 'mid');
          current = current.next();
        }
        removeClass(current, 'max');
      }
    }
  }


  $(document).on("dragstart", ".draggable", function(e) {
    e.originalEvent.dataTransfer.setData("text", e.target.id);
    const parent = $(e.target).parent();
    const data = JSON.parse(parent.attr('data'));
    const {
      booking_id,
      booked_room_id,
      nights,
    } = JSON.parse(parent.attr('booking'));

    const check_in = parent.hasClass('bg-success');
    const confirmed = parent.hasClass('bg-info');
    const tentative = parent.hasClass('bg-warning');

    if (check_in) {
      bg_drag = 'bg-success';
      type_drag = 'Check In';
    } else if (confirmed) {
      bg_drag = 'bg-info';
      type_drag = 'Reservation';
    } else if (tentative) {
      bg_drag = 'bg-warning';
      type_drag = 'Reservation';
    }

    booking_id_drag = booking_id;
    booked_room_id_drag = booked_room_id;
    nights_drag = nights;
  });

  $(document).on("dragover", ".droppable", function(e) {
    e.preventDefault();
    const type = $(this).attr('type');
    const both = $(this).attr('both');

    if (type == type_drag || both == 1) {
      toggleDragOver(this);
    }
  });

  $(document).on("dragleave", ".droppable", function(e) {
    const type = $(this).attr('type');
    const both = $(this).attr('both');

    if (type == type_drag || both == 1) {
      toggleDragOver(this, false);
    }
  });

  const remove = (draggedParent, ordinal, toRemove) => {
    draggedParent.addClass(`${ordinal} no-data droppable pointer`);
    draggedParent.attr('type', type_drag);
    draggedParent.removeClass(`with-data position-relative ${toRemove} ${bg_drag} ${ordinal}-drag`);
    draggedParent.removeAttr('booking');
    draggedParent.html('');
  }

  const removeNext = (draggedParent, ordinal, toRemove) => {
    const hasMid = draggedParent.next().hasClass('mid');
    const hasMax = draggedParent.next().hasClass('max');
    const newOrdinal = draggedParent.next().hasClass('first-drag') ? 'first' : 'second';

    remove(draggedParent, ordinal, toRemove);

    if (hasMid) {
      removeNext(draggedParent.next(), newOrdinal, 'mid');
    } else if (hasMax) {
      removeNext(draggedParent.next(), newOrdinal, 'max');
    }
  }

  const removePrev = (draggedParent, ordinal, toRemove) => {
    const hasMid = draggedParent.prev().hasClass('mid');
    const hasMin = draggedParent.prev().hasClass('min');
    const newOrdinal = draggedParent.prev().hasClass('first-drag') ? 'first' : 'second';

    remove(draggedParent, ordinal, toRemove);

    if (hasMid) {
      removePrev(draggedParent.prev(), newOrdinal, 'mid');
    } else if (hasMin) {
      removePrev(draggedParent.prev(), newOrdinal, 'min');
    }
  }

  const removeDragged = (id, check_in, room_id) => {
    const draggedParent = $('#' + id).parent();
    booking_drag = JSON.parse(draggedParent.attr('booking'));

    const ordinal = draggedParent.hasClass('first-drag') ? 'first' : 'second';
    const hasMin = draggedParent.hasClass('min');
    const hasMid = draggedParent.hasClass('mid');
    const hasMax = draggedParent.hasClass('max');

    if (ordinal == 'first') {
      draggedParent.children().first().attr('id', `drag${toDashed(check_in)}-${room_id}`);
      draggedParent.next().children().first().attr('id', `drag${toDashed(check_in)}-${room_id}`);
      html_drag = draggedParent.html();
      html_drag2 = draggedParent.next().html();
    } else {
      draggedParent.children().first().attr('id', `drag${toDashed(check_in)}-${room_id}`);
      draggedParent.prev().children().first().attr('id', `drag${toDashed(check_in)}-${room_id}`);
      html_drag2 = draggedParent.html();
      html_drag = draggedParent.prev().html();
    }

    if (hasMin) {
      removeNext(draggedParent, ordinal, 'min');
    } else if (hasMax) {
      removePrev(draggedParent, ordinal, 'max');
    } else if (hasMid) {
      removePrev(draggedParent, ordinal, 'mid');
      removeNext(draggedParent, ordinal, 'mid');
    }
  }

  const addNext = (e) => {
    const hasMid = e.next().hasClass('mid');
    const hasMax = e.next().hasClass('max');

    if ($(e).hasClass('first')) {
      e.removeClass('first no-data droppable pointer').addClass('first-drag with-data position-relative').html(html_drag);
    } else if ($(e).hasClass('second')) {
      e.removeClass('second no-data droppable pointer').addClass('second-drag with-data position-relative').html(html_drag2);
    }
    e.attr('booking', JSON.stringify(booking_drag));

    if (hasMid || hasMax) {
      addNext($(e).next());
    }
  }

  const addDraggable = (e, check_in, check_out, room_id) => {
    booking_drag.check_in = check_in;
    booking_drag.check_out = check_out;
    booking_drag.nights = nights_drag;
    booking_drag.room_id = room_id;

    addNext(e);
  }

  // const addDraggable = (e, check_in, check_out, room_id) => {
  //   booking_drag.check_in = check_in;
  //   booking_drag.check_out = check_out;
  //   booking_drag.nights = nights_drag;
  //   booking_drag.room_id = room_id;

  //   if (e.hasClass('first')) {
  //     e.removeClass('first no-data droppable pointer').addClass('first-drag with-data position-relative').html(html_drag);
  //     e.next().removeClass('second no-data droppable pointer').addClass('second-drag with-data position-relative').html(html_drag2);
  //     e.attr('booking', JSON.stringify(booking_drag));
  //     e.next().attr('booking', JSON.stringify(booking_drag));
  //   } else {
  //     e.removeClass('second no-data droppable pointer').addClass('second-drag with-data position-relative').html(html_drag2);
  //     e.prev().removeClass('first no-data droppable pointer').addClass('first-drag with-data position-relative').html(html_drag);
  //     e.attr('booking', JSON.stringify(booking_drag));
  //     e.prev().attr('booking', JSON.stringify(booking_drag));
  //   }
  // }

  $(document).on("drop", ".droppable", function(e) {
    e.preventDefault();
    const id = e.originalEvent.dataTransfer.getData("text");

    let current = $(this);
    let conflict = false;

    for (let index = 0; index < nights_drag; index++) {
      if (current.hasClass('with-data')) {
        conflict = true;
      }
      current = current.next();
    }

    if (conflict) {
      swal({
        title: "Already booked.",
        text: "Please choose another schedule or room for your rescheduled booking.",
        type: "error",
        buttonsStyling: false,
        confirmButtonClass: "btn btn-primary",
      });
      $('.hovered').removeClass('hovered');
      $('body').removeClass('wait');
      $('.no-data').removeClass('wait');
      $('.droppable').removeClass('bg-success bg-warning bg-info min max mid')
      return;
    }

    const {
      room_id
    } = JSON.parse($(this).attr('data'));
    const check_in = $(this).attr('date');
    const check_out = addDays(check_in, nights_drag);

    const data = {
      nights: nights_drag,
      room_id,
      check_in,
      check_out,
      booking_id: booking_id_drag,
      booked_room_id: booked_room_id_drag,
    };

    const success = $(this).hasClass('bg-success');
    const info = $(this).hasClass('bg-info');
    const warning = $(this).hasClass('bg-warning');

    if (success || info || warning) {
      $('body').addClass('wait');
      $('.no-data').addClass('wait');

      swal({
        title: "Are you sure?",
        text: "Please confirm your selected action",
        type: "warning",
        buttonsStyling: false,
        showCancelButton: true,
        cancelButtonClass: "btn",
        confirmButtonClass: "btn btn-primary mr-2",
      }).then((result) => {
        if (result) {
          fetch(`${base_url}index.php/main/changeRoomAjax`, {
              method: "POST",
              headers: {
                "Content-Type": "application/json"
              },
              body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(data => {
              removeDragged(id, check_in, room_id);
              addDraggable($(this), check_in, check_out, room_id);
              $('.hovered').removeClass('hovered');
              $('body').removeClass('wait');
              $('.no-data').removeClass('wait');
            })
            .catch(error => {
              console.error("Error:", error);
            });
        }
      }, function(dismiss) {
        // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
        if (dismiss) {
          $('.hovered').removeClass('hovered');
          $('body').removeClass('wait');
          $('.no-data').removeClass('wait');
          $('.droppable').removeClass('bg-success bg-warning bg-info min max mid')
        }
      });
    }
  });
</script>