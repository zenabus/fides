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
                <p class="card-title">0</p>
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
                <p class="card-title">0</p>
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
                <i class="fa fa-thumbs-o-up text-primary"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Available</p>
                <p class="card-title"><?= count($available) ?></p>
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
                <i class="fa fa-thumbs-o-down text-danger"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Unavailable</p>
                <p class="card-title"><?= count($unavailable) ?></p>
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
        <div class="card-header text-center">
          <div class="wizard-navigation">
            <ul>
              <li class="nav-item">
                <a class="nav-link active" href="#available" data-toggle="tab" role="tab" aria-controls="available" aria-selected="true">
                  <i class="fa fa-thumbs-o-up"></i> Available
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#unavailable" data-toggle="tab" role="tab" aria-controls="unavailable" aria-selected="true">
                  <i class="fa fa-thumbs-o-down"></i> Unavailable
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="card-body shadow-none">
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
          <div class="tab-content pt-3">
            <div class="tab-pane show active px-4" id="available">
              <div class="separator mb-4">2nd Floor</div>
              <div class="row">
                <?php foreach ($available as $data) { ?>
                  <?php if ($data['room_number'] < 299) { ?>
                    <div class="col-lg-2 col-md-6 col-sm-6 float-left <?= $data['room_type_abbr'] ?>">
                      <div class="card card-stats border shadow-none room" data='<?= json_encode($data) ?>'>
                        <div class="card-body ">
                          <div class="row">
                            <div class="col-md-7 text-success">
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
                          <div class="stats text-center">
                            <span class="fa fa-<?= $data['icon'] ?>"></span> <?= $data['description'] ?>
                          </div>
                        </div>
                      </div>
                    </div>
                <?php }
                } ?>
              </div>
              <div class="separator mb-4">3rd Floor</div>
              <div class="row">
                <?php foreach ($available as $data) { ?>
                  <?php if ($data['room_number'] < 399 && $data['room_number'] > 300) { ?>
                    <div class="col-lg-2 col-md-6 col-sm-6 float-left <?= $data['room_type_abbr'] ?>">
                      <div class="card card-stats border shadow-none room" data='<?= json_encode($data) ?>'>
                        <div class="card-body ">
                          <div class="row">
                            <div class="col-md-7 text-success">
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
                          <div class="stats text-center">
                            <span class="fa fa-<?= $data['icon'] ?>"></span> <?= $data['description'] ?>
                          </div>
                        </div>
                      </div>
                    </div>
                <?php }
                } ?>
              </div>
              <div class="separator mb-4">4th Floor</div>
              <div class="row">
                <?php foreach ($available as $data) { ?>
                  <?php if ($data['room_number'] < 499 && $data['room_number'] > 400) { ?>
                    <div class="col-lg-2 col-md-6 col-sm-6 float-left <?= $data['room_type_abbr'] ?>">
                      <div class="card card-stats border shadow-none room" data='<?= json_encode($data) ?>'>
                        <div class="card-body ">
                          <div class="row">
                            <div class="col-md-7 text-success">
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
                          <div class="stats text-center">
                            <span class="fa fa-<?= $data['icon'] ?>"></span> <?= $data['description'] ?>
                          </div>
                        </div>
                      </div>
                    </div>
                <?php }
                } ?>
              </div>
            </div>
            <div class="tab-pane px-4" id="unavailable">
              <div class="separator mb-4">2nd Floor</div>
              <div class="row">
                <?php foreach ($unavailable as $data) { ?>
                  <?php if ($data['room_number'] < 299) { ?>
                    <div class="col-lg-2 col-md-6 col-sm-6 float-left <?= $data['room_type_abbr'] ?>">
                      <div class="card card-stats border shadow-none room">
                        <div class="card-body ">
                          <div class="row">
                            <div class="col-md-7 text-danger">
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
                          <div class="stats text-center">
                            <span class="fa fa-<?= $data['icon'] ?>"></span> <?= $data['description'] ?>
                          </div>
                        </div>
                      </div>
                    </div>
                <?php }
                } ?>
              </div>
              <div class="separator mb-4">3rd Floor</div>
              <div class="row">
                <?php foreach ($unavailable as $data) { ?>
                  <?php if ($data['room_number'] < 399 && $data['room_number'] > 300) { ?>
                    <div class="col-lg-2 col-md-6 col-sm-6 float-left <?= $data['room_type_abbr'] ?>">
                      <div class="card card-stats border shadow-none room">
                        <div class="card-body ">
                          <div class="row">
                            <div class="col-md-7 text-danger">
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
                          <div class="stats text-center">
                            <span class="fa fa-<?= $data['icon'] ?>"></span> <?= $data['description'] ?>
                          </div>
                        </div>
                      </div>
                    </div>
                <?php }
                } ?>
              </div>
              <div class="separator mb-4">4th Floor</div>
              <div class="row">
                <?php foreach ($unavailable as $data) { ?>
                  <?php if ($data['room_number'] < 499 && $data['room_number'] > 400) { ?>
                    <div class="col-lg-2 col-md-6 col-sm-6 float-left <?= $data['room_type_abbr'] ?>">
                      <div class="card card-stats border shadow-none room">
                        <div class="card-body ">
                          <div class="row">
                            <div class="col-md-7 text-danger">
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
                          <div class="stats text-center">
                            <span class="fa fa-<?= $data['icon'] ?>"></span> <?= $data['description'] ?>
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

  <script>
    const guests = JSON.parse(`<?= json_encode($guests) ?>`);
  </script>
  <script defer src="<?= base_url('assets/js/modal-reservation.js') ?>"></script>
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