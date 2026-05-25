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
            </div>
          </div>
          <div class="px-4 pt-3">
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
                  <div class="col-lg-2 col-md-6 col-sm-6 float-left <?= $data['room_type_abbr'] ?>">
                    <div class="card card-stats border <?= $is_occupied ? 'border-danger' : 'border-success' ?> shadow-none room <?= $booking ? 'with-data pointer' : '' ?>" data='<?= json_encode($data) ?>' <?= $booking ? 'booking="' . htmlspecialchars(json_encode($booking), ENT_QUOTES, 'UTF-8') . '"' : '' ?>>
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
                  <div class="col-lg-2 col-md-6 col-sm-6 float-left <?= $data['room_type_abbr'] ?>">
                    <div class="card card-stats border <?= $is_occupied ? 'border-danger' : 'border-success' ?> shadow-none room <?= $booking ? 'with-data pointer' : '' ?>" data='<?= json_encode($data) ?>' <?= $booking ? 'booking="' . htmlspecialchars(json_encode($booking), ENT_QUOTES, 'UTF-8') . '"' : '' ?>>
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
                  <div class="col-lg-2 col-md-6 col-sm-6 float-left <?= $data['room_type_abbr'] ?>">
                    <div class="card card-stats border <?= $is_occupied ? 'border-danger' : 'border-success' ?> shadow-none room <?= $booking ? 'with-data pointer' : '' ?>" data='<?= json_encode($data) ?>' <?= $booking ? 'booking="' . htmlspecialchars(json_encode($booking), ENT_QUOTES, 'UTF-8') . '"' : '' ?>>
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

  <style>
    .card.room.border-success {
      border-width: 2px !important;
      background-color: #f0fff4 !important;
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

    $('.room').click(function() {
      modalBooking(this, 'Check In');
    });

    $('.room_types').change(function() {
      const checked = $(this).val();
      if (this.checked) {
        $(`.${checked}`).fadeIn();
        if ($('.room_types:checked').length == 6) $('.all').prop('checked', true);
      } else {
        $(`.${checked}`).fadeOut();
        $('.all').prop('checked', false);
      }
    });

    $('.all').change(function() {
      const checked = $(this).val();
      $('.room_types').prop('checked', this.checked).trigger('change');
    });
  </script>