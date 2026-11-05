<style>
  #available .room {
    cursor: pointer;
  }

  #unavailable .room {
    cursor: not-allowed;
  }

  .room_type {
    font-size: 3.5em;
    line-height: 1.1;
    margin-bottom: 0;
    margin-top: 4px;
    text-align: center;
  }

  .card-div,
  #new_guest {
    display: none;
  }

  .modal {
    overflow-y: scroll !important;
  }
</style>

<div class="content pb-0">
  <h5>Dashboard</h5>
  <div class="row">
    <div class="col-lg-2 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="fa fa-tags text-info"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Room Types</p>
                <p class="card-title"><?= count($room_types) ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer"></div>
      </div>
    </div>
    <div class="col-lg-2 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="fa fa-bed text-primary"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Rooms</p>
                <p class="card-title"><?= count($rooms) ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer"></div>
      </div>
    </div>
    <div class="col-lg-2 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="fa fa-car text-success"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Arrivals</p>
                <p class="card-title"><?= $arrivals_count ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer"></div>
      </div>
    </div>
    <div class="col-lg-2 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="fa fa-sign-out text-warning"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Check-outs</p>
                <p class="card-title"><?= $checkouts_count ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer"></div>
      </div>
    </div>
    <div class="col-lg-2 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="fa fa-check text-success"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Vacant</p>
                <p class="card-title"><?= count($rooms) - count($occupied_room_ids) ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer"></div>
      </div>
    </div>
    <div class="col-lg-2 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="fa fa-bed text-danger"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Occupied</p>
                <p class="card-title"><?= count($occupied_room_ids) ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer"></div>
      </div>
    </div>
  </div>


  <div class="content pb-0">
    <div class="wizard-container">
      <div class="card card-wizard active mb-0" data-color="primary" id="wizardProfile">
        <div class="card-body shadow-none pt-4">
          <div class="row text-center">
            <div class="col-md-12">
              <div class="form-check form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input all" type="checkbox" value="All" checked>
                  <span class="form-check-sign"></span>
                  All
                </label>
              </div>
              <?php foreach ($room_types as $row) { ?>
                <div class="form-check form-check-inline">
                  <label class="form-check-label">
                    <input class="form-check-input room_types" type="checkbox" value="<?= $row['room_type_abbr'] ?>" checked>
                    <span class="form-check-sign"></span>
                    <?= $row['room_type'] ?>
                  </label>
                </div>
              <?php } ?>
              <div class="d-inline-block ml-3 align-middle">
                <label class="switch-vacant-label d-inline-flex align-items-center mb-0" style="cursor: pointer;">
                  <span class="switch-toggle mr-2">
                    <input type="checkbox" id="toggle_vacant_only">
                    <span class="slider round"></span>
                  </span>
                  <span class="font-weight-bold text-success" style="font-size: 13px;">Show Vacant Only</span>
                </label>
              </div>
            </div>
          </div>
          <div class="px-4 pt-3">
            <div class="floor-section" id="floor_2">
              <div class="separator mb-4">2nd Floor</div>
              <div class="row">
                <?php foreach ($rooms as $data) { ?>
                  <?php if ($data['room_number'] < 299) { ?>
                    <?php
                    $is_occupied = array_key_exists($data['room_id'], $occupied_room_ids);
                    $date_format = date('m/d/Y');
                    $booking = array_filter($bookings, function ($b) use ($date_format, $data) {
                      return in_array($date_format, $b['dates_between']) && $data['room_number'] == $b['room_number'];
                    });
                    $booking = $booking ? array_merge(...$booking) : null;
                    ?>
                    <div class="col-lg-2 col-md-6 col-sm-6 float-left room-item <?= $data['room_type_abbr'] ?> <?= $is_occupied ? 'room-occupied' : 'room-vacant' ?>">
                      <div class="card card-stats border <?= $is_occupied ? 'border-danger' : 'border-success' ?> shadow-none room <?= ($is_occupied && $booking) ? 'with-data pointer' : '' ?>" data='<?= json_encode($data) ?>' <?= ($is_occupied && $booking) ? 'booking="' . htmlspecialchars(json_encode($booking), ENT_QUOTES, 'UTF-8') . '"' : '' ?>>
                        <div class="card-body ">
                          <div class="row">
                            <div class="col-md-7 <?= $is_occupied ? 'text-danger' : 'text-success' ?>">
                              <h1 class="room_type"><?= $data['room_type_abbr'] ?></h1>
                            </div>
                            <div class="col-md-5">
                              <div class="numbers">
                                <p class="card-category">Room</p>
                                <p class="card-title"><?= $data['room_number'] ?></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card-footer ">
                          <hr>
                          <div class="stats text-center" style="font-size: 13px;">
                            <span class="fa fa-<?= $is_occupied ? 'bed' : 'check' ?>"></span> <?= $is_occupied ? $occupied_room_ids[$data['room_id']]['name'] : 'Vacant' ?>
                          </div>
                        </div>
                      </div>
                    </div>
                <?php }
                } ?>
              </div>
            </div>
            <div class="floor-section" id="floor_3">
              <div class="separator mb-4">3rd Floor</div>
              <div class="row">
                <?php foreach ($rooms as $data) { ?>
                  <?php if ($data['room_number'] < 399 && $data['room_number'] > 300) { ?>
                    <?php
                    $is_occupied = array_key_exists($data['room_id'], $occupied_room_ids);
                    $date_format = date('m/d/Y');
                    $booking = array_filter($bookings, function ($b) use ($date_format, $data) {
                      return in_array($date_format, $b['dates_between']) && $data['room_number'] == $b['room_number'];
                    });
                    $booking = $booking ? array_merge(...$booking) : null;
                    ?>
                    <div class="col-lg-2 col-md-6 col-sm-6 float-left room-item <?= $data['room_type_abbr'] ?> <?= $is_occupied ? 'room-occupied' : 'room-vacant' ?>">
                      <div class="card card-stats border <?= $is_occupied ? 'border-danger' : 'border-success' ?> shadow-none room <?= ($is_occupied && $booking) ? 'with-data pointer' : '' ?>" data='<?= json_encode($data) ?>' <?= ($is_occupied && $booking) ? 'booking="' . htmlspecialchars(json_encode($booking), ENT_QUOTES, 'UTF-8') . '"' : '' ?>>
                        <div class="card-body ">
                          <div class="row">
                            <div class="col-md-7 <?= $is_occupied ? 'text-danger' : 'text-success' ?>">
                              <h1 class="room_type"><?= $data['room_type_abbr'] ?></h1>
                            </div>
                            <div class="col-md-5">
                              <div class="numbers">
                                <p class="card-category">Room</p>
                                <p class="card-title"><?= $data['room_number'] ?></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card-footer ">
                          <hr>
                          <div class="stats text-center" style="font-size: 13px;">
                            <span class="fa fa-<?= $is_occupied ? 'bed' : 'check' ?>"></span> <?= $is_occupied ? $occupied_room_ids[$data['room_id']]['name'] : 'Vacant' ?>
                          </div>
                        </div>
                      </div>
                    </div>
                <?php }
                } ?>
              </div>
            </div>
            <div class="floor-section" id="floor_4">
              <div class="separator mb-4">4th Floor</div>
              <div class="row">
                <?php foreach ($rooms as $data) { ?>
                  <?php if ($data['room_number'] < 499 && $data['room_number'] > 400) { ?>
                    <?php
                    $is_occupied = array_key_exists($data['room_id'], $occupied_room_ids);
                    $date_format = date('m/d/Y');
                    $booking = array_filter($bookings, function ($b) use ($date_format, $data) {
                      return in_array($date_format, $b['dates_between']) && $data['room_number'] == $b['room_number'];
                    });
                    $booking = $booking ? array_merge(...$booking) : null;
                    ?>
                    <div class="col-lg-2 col-md-6 col-sm-6 float-left room-item <?= $data['room_type_abbr'] ?> <?= $is_occupied ? 'room-occupied' : 'room-vacant' ?>">
                      <div class="card card-stats border <?= $is_occupied ? 'border-danger' : 'border-success' ?> shadow-none room <?= ($is_occupied && $booking) ? 'with-data pointer' : '' ?>" data='<?= json_encode($data) ?>' <?= ($is_occupied && $booking) ? 'booking="' . htmlspecialchars(json_encode($booking), ENT_QUOTES, 'UTF-8') . '"' : '' ?>>
                        <div class="card-body ">
                          <div class="row">
                            <div class="col-md-7 <?= $is_occupied ? 'text-danger' : 'text-success' ?>">
                              <h1 class="room_type"><?= $data['room_type_abbr'] ?></h1>
                            </div>
                            <div class="col-md-5">
                              <div class="numbers">
                                <p class="card-category">Room</p>
                                <p class="card-title"><?= $data['room_number'] ?></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card-footer ">
                          <hr>
                          <div class="stats text-center" style="font-size: 13px;">
                            <span class="fa fa-<?= $is_occupied ? 'bed' : 'check' ?>"></span> <?= $is_occupied ? $occupied_room_ids[$data['room_id']]['name'] : 'Vacant' ?>
                          </div>
                        </div>
                      </div>
                    </div>
                <?php }
                } ?>
              </div>
            </div>
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

  <style>
    .card.room.border-success {
      border-width: 2px !important;
      background-color: #f0fff4 !important;
      cursor: pointer;
    }

    .switch-toggle {
      position: relative;
      display: inline-block;
      width: 38px;
      height: 20px;
    }

    .switch-toggle input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .switch-toggle .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #cfcfca;
      transition: .3s;
      border-radius: 20px;
    }

    .switch-toggle .slider:before {
      position: absolute;
      content: "";
      height: 14px;
      width: 14px;
      left: 3px;
      bottom: 3px;
      background-color: white;
      transition: .3s;
      border-radius: 50%;
    }

    .switch-toggle input:checked + .slider {
      background-color: #7AC29A;
    }

    .switch-toggle input:checked + .slider:before {
      transform: translateX(18px);
    }

    #modalPay,
    #modalPayments {
      z-index: 999999;
    }
  </style>

  <script>
    const guests = JSON.parse(`<?= json_encode($guests) ?>`);
    // const pad already declared globally
    const base_url = ' <?= base_url() ?>';
    const now = new Date();
    let hour = `${pad(now.getHours())}`;
    let time = `${pad(now.getHours())}:${pad(now.getMinutes())}:${pad(now.getSeconds())}`;
    let today = `${now.getFullYear()}-${pad(now.getMonth()+1)}-${pad(now.getDate())}`;
  </script>
  <script defer src="<?= base_url('assets/js/modal-reservation.js?v=') . date('YmdHis') ?>"></script>
  <script>
    $(document).ready(function() {
      demo.initWizard();
    });

    $('.room').hover(function() {
      $(this).removeClass('shadow-none');
    }, function() {
      $(this).addClass('shadow-none');
    });

    $('.room:not(.with-data)').click(function() {
      $('#returning_guest').show();
      $('.form-control').val('').removeAttr('disabled');
      modalBooking(this, 'Check In');

      $("#rdo_checkin").prop("checked", true);

      $('#frmBook').attr('action', `${base_url}index.php/main/book`);
      $('.action-div').addClass('d-none');
      $('[name=check_in]').attr('readonly', true);
      $('[name=remarks]').removeAttr('readonly');
      $('#btnBooking').show();
      $('#btnRedirect').addClass('d-none');
      $('#btnCancel, #btnChange, #btnPay, #btnPayments, #btnConfirm').addClass('d-none');
      $('.payment_option').show();
      
      if (hour >= 6 && hour <= 12) {
        $('.reservation-div').hide();
        $('[name=booking_type]').val('Check In');
        $('#btnBooking').val('Check In');
      }
      $('.type-div').removeClass('d-none');
      
      let date = new Date();
      let checkin = moment(date).format("YYYY-MM-DD");
      let checkout = moment(date).add(1, "days").format("YYYY-MM-DD");
      booked_room_id = null;
      updateAvailableRoom(checkin, checkout);
    });

    function updateDashboardFilters() {
      const vacantOnly = $('#toggle_vacant_only').is(':checked');

      $('.floor-section').each(function() {
        const floor = $(this);
        let visibleCount = 0;

        floor.find('.room-item').each(function() {
          const room = $(this);
          const isOccupied = room.hasClass('room-occupied');
          const typeMatch = room.is(function() {
            let matched = false;
            $('.room_types:checked').each(function() {
              if (room.hasClass($(this).val())) {
                matched = true;
                return false;
              }
            });
            return matched;
          });

          if (typeMatch && (!vacantOnly || !isOccupied)) {
            room.show();
            visibleCount++;
          } else {
            room.hide();
          }
        });

        if (visibleCount === 0) {
          floor.hide();
        } else {
          floor.show();
        }
      });
    }

    $('#toggle_vacant_only').change(function() {
      updateDashboardFilters();
    });

    $('.room_types').change(function() {
      if ($('.room_types:checked').length == 6) {
        $('.all').prop('checked', true);
      } else {
        $('.all').prop('checked', false);
      }
      updateDashboardFilters();
    });

    $('.all').change(function() {
      $('.room_types').prop('checked', this.checked);
      updateDashboardFilters();
    });
  </script>