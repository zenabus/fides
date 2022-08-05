<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.ui.position.js"></script>

<style type="text/css">
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
  }

  .no-data {
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
</style>

<div class="content pb-0">
  <div class="row">
    <div class="col-md-12">
      <div class="d-flex justify-content-between">
        <h5 id="title">Room Calendar</h5>
        <div>
          <a href="<?= base_url('index.php/main/calendar/' . $y . '/' . str_pad(($m - 1), 2, '0', STR_PAD_LEFT)) ?>" class="btn btn-primary btn-sm" title="Previous Month" <?= $m == '01' ? 'disabled' : '' ?>>
            <span class="fa fa-arrow-left"></span>
          </a>
          <?php if ($y == date('Y') && $m == date('m')) { ?>
            <a href="javascript:" class="btn btn-success btn-sm" title="Go to Current" id="current">
              <span class="fa fa-undo"></span>
            </a>
          <?php } else { ?>
            <a href="<?= base_url('index.php/main/calendar/' . date('Y') . '/' . date('m')) ?>" class="btn btn-success btn-sm" title="Go to Current">
              <span class="fa fa-undo"></span>
            </a>
          <?php } ?>
          <a href="javascript:" class="btn btn-success btn-sm" title="Select Month" data-toggle="modal" data-target="#modalMonth">
            <span class="fa fa-calendar"></span>
          </a>
          <a href="<?= base_url('index.php/main/calendar/' . $y . '/' . str_pad(($m + 1), 2, '0', STR_PAD_LEFT)) ?>" class="btn btn-primary btn-sm" title="Next Month" <?= $m == '12' ? 'disabled' : '' ?>>
            <span class="fa fa-arrow-right"></span>
          </a>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="table-container">
            <table class="table table-bordered mb-1">
              <thead>
                <tr>
                  <th class="white sticky-top border-shadow-1 text-center"><?= $y ?></th>
                  <?php for ($i = 1; $i <= $days; $i++) { ?>
                    <th colspan="2" class="text-center sticky-top border-shadow<?= $i % 2 ? ' bg-light' : '' ?>" id="<?= date('Y-m-d') == $y . '-' . $m . '-' . str_pad($i, 2, '0', STR_PAD_LEFT) ? 'today' : '' ?>">
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
                    <td class="text-center d-flex border-0">
                      <div class="d-inline-block" style="width:50px;"><?= $row['room_number'] ?> <?= $row['room_type_abbr'] ?></div>
                      <div class="d-inline-block" style="width:50px;"><?= $row['name'] ?></div>
                    </td>
                    <?php for ($i = 1; $i <= $days; $i++) { ?>
                      <?php
                      $data = array_filter($bookings, function ($booking) use ($i, $m, $y, $row) {
                        return $booking['check_in'] == $m . '/' . str_pad($i, 2, '0', STR_PAD_LEFT) . '/' . $y && $row['room_number'] == $booking['room_number'];
                      });
                      ?>
                      <?php if ($data) { ?>
                        <?php $data = array_merge(...$data); ?>
                        <?php
                        $color = 'success';
                        if ($data['booking_type'] == 'Reservation') {
                          if ($data['reservation_type'] == 'Arrival/Tentative') {
                            $color = 'warning';
                          } else if ($data['reservation_type'] == 'Confirmed') {
                            $color = 'info';
                          }
                        }
                        ?>
                        <td class="with-data bg-<?= $color ?>" date="<?= $m . '/' . str_pad($i, 2, '0', STR_PAD_LEFT) . '/' . $y ?>" data='<?= json_encode($row) ?>'><?= $data['last_name'] ?>, <?= $data['first_name'] ?> <?= $data['middle_name'] ?></td>
                        <td class="with-data bg-<?= $color ?>" date="<?= $m . '/' . str_pad($i, 2, '0', STR_PAD_LEFT) . '/' . $y ?>" data='<?= json_encode($row) ?>'><?= $data['remarks'] ?></td>
                      <?php } else { ?>
                        <td class="no-data first" date="<?= $m . '/' . str_pad($i, 2, '0', STR_PAD_LEFT) . '/' . $y ?>" data='<?= json_encode($row) ?>'></td>
                        <td class="no-data second" date="<?= $m . '/' . str_pad($i, 2, '0', STR_PAD_LEFT) . '/' . $y ?>" data='<?= json_encode($row) ?>'></td>
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="nc-icon nc-simple-remove"></i>
        </button>
        <h4 class="title title-up">Select Month</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="form-group col-md-6">
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
          <div class="form-group col-md-6">
            <label>Year</label>
            <input type="number" class="form-control" id="year" value="<?= $y ?>" min="2021">
          </div>
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

<script>
  const guests = JSON.parse('<?= json_encode($guests) ?>');
</script>
<script defer src="<?= base_url('assets/js/modal-reservation.js') ?>"></script>
<script>
  const base_url = ' <?= base_url() ?>';

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

  $(document).ready(function() {
    const today = document.getElementById("today");
    if (today) {
      today.scrollIntoView({
        behavior: "smooth",
        block: "end",
        inline: "start"
      });
    }
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
  });

  $.contextMenu({
    selector: '.no-data',
    events: {
      show: function() {
        const date = $(this).attr('date');
        const data = JSON.parse($(this).attr('data'));
        setTimeout(() => {
          $('#title').text(`Room Calendar [ROOM: ${data.room_number} - ${date}]`);
          toggleHovered(this);
        });
      },
      hide: function() {
        toggleHovered(this, false);
      }
    },
    callback: function(key) {
      console.log(key);
      modalBooking(this, key == 'Check In' ? key : 'Reservation');
    },
    items: {
      "Check In": {
        name: "Check In",
        icon: "fa-check"
      },
      "Reservation": {
        name: "Reserve",
        icon: "fa-hourglass"
      },
    }
  });

  $('.no-data').click(function() {
    modalBooking(this, 'Check In');
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
</script>