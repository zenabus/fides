<div class="content pb-0">
  <div class="row">
    <div class="col-md-12">
      <h5 class="mb-0">Guests</h5>
      <button class="btn" id="addGuest">Add New Guest</button>
      <div class="wizard-container">
        <div class="card card-wizard active" data-color="primary" id="wizardProfile">
          <div class="card-header text-center">
            <div class="wizard-navigation">
              <ul>
                <li class="nav-item">
                  <a class="nav-link active" href="#available" data-toggle="tab" role="tab" aria-controls="available" aria-selected="true">
                    <i class="fa fa-check"></i> Active
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#unavailable" data-toggle="tab" role="tab" aria-controls="unavailable">
                    <i class="fa fa-ban"></i> Inactive
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body pt-0">
            <div class="tab-content pt-0">
              <div class="tab-pane show active" id="available">
                <table class="table table-striped table-bordered tbl_guest">
                  <thead>
                    <tr>
                      <th>Guest Name</th>
                      <th>Contact Details</th>
                      <th>Company Details</th>
                      <th>Birthday</th>
                      <th>Last Check-In</th>
                      <th class="disabled-sorting text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($guests_active as $row) { ?>
                      <tr>
                        <td>
                          <?= $row['last_name'] ?>, <?= $row['first_name'] ?> <?= $row['middle_name'] ?> <?= $row['suffix'] ?><br>
                          <small><?= $row['address'] ?></small>
                        </td>
                        <td>
                          <?= $row['contact'] ?><br>
                          <small><?= $row['email'] ?></small>
                        </td>
                        <td>
                          <?= $row['company_name'] ?><br>
                          <small><?= $row['company_address'] ?></small>
                        </td>
                        <td>
                          <?= $row['birthday'] ?><br>
                          <small><?= $row['nationality'] ?></small>
                        </td>
                        <td>
                          <?php
                          $date_time = date_create($row['last_checkin']);
                          $date_time = date_format($date_time, "M d, Y h:i a");
                          ?>
                          <?php if ($row['last_checkin']) { ?>
                            <?= ucfirst($row['last_checkin_ago']) ?><br>
                            <small><?= $date_time ?></small>
                          <?php } ?>
                        </td>
                        <td class="action">
                          <a href="<?= base_url('index.php/main/guest/' . $row['guest_id']) ?>" class="btn btn-sm mb-1" data-placement="top" title="View Guest" rel="tooltip">
                            <span class="fa fa-eye"></span>
                          </a>
                          <button class="btn btn-success btn-sm updateGuest mb-1" data='<?= json_encode($row) ?>' data-placement="top" title="Update Guest" rel="tooltip">
                            <i class="fa-solid fa-user-pen"></i>
                          </button>
                          <a href="<?= base_url('index.php/main/statusGuest/1/' . $row['guest_id']) ?>" class="btn btn-warning btn-sm confirm mb-1" data-placement="top" title="Disable Guest" rel="tooltip">
                            <i class="fa-solid fa-user-xmark"></i>
                          </a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane" id="unavailable">
                <table class="table table-striped table-bordered tbl_guest">
                  <thead>
                    <tr>
                      <th>Guest Name</th>
                      <th>Contact Details</th>
                      <th>Company Details</th>
                      <th>Birthday</th>
                      <th>Last Check-In</th>
                      <th class="disabled-sorting text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($guests_inactive as $row) { ?>
                      <tr>
                        <td>
                          <?= $row['last_name'] ?>, <?= $row['first_name'] ?> <?= $row['middle_name'] ?><br>
                          <small><?= $row['address'] ?></small>
                        </td>
                        <td>
                          <?= $row['contact'] ?><br>
                          <small><?= $row['email'] ?></small>
                        </td>
                        <td>
                          <?= $row['company_name'] ?><br>
                          <small><?= $row['company_address'] ?></small>
                        </td>
                        <td>
                          <?= $row['birthday'] ?><br>
                          <small><?= $row['nationality'] ?></small>
                        </td>
                        <td>
                          <?php
                          $date_time = date_create($row['last_checkin']);
                          $date_time = date_format($date_time, "M d, Y h:i a");
                          ?>
                          <?php if ($row['last_checkin']) { ?>
                            <?= ucfirst($row['last_checkin_ago']) ?><br>
                            <small><?= $date_time ?></small>
                          <?php } ?>
                        </td>
                        <td class="action">
                          <a href="<?= base_url('index.php/main/guest/' . $row['guest_id']) ?>" class="btn btn-sm mb-1" data-placement="top" title="View Guest" rel="tooltip">
                            <span class="fa fa-eye"></span>
                          </a>
                          <a href="javascript:" class="btn mb-1 btn-success btn-sm updateGuest" data='<?= json_encode($row) ?>' data-placement="top" title="Update Guest" rel="tooltip">
                            <i class="fa-solid fa-user-pen"></i>
                          </a>
                          <a href="<?= base_url('index.php/main/statusGuest/0/' . $row['guest_id']) ?>" class="btn mb-1 btn-primary btn-sm confirm" data-placement="top" title="Enable Guest" rel="tooltip">
                            <i class="fa-solid fa-user-check"></i>
                          </a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalGuest" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header justify-content-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="nc-icon nc-simple-remove"></i>
        </button>
        <h4 class="title title-up">Guest Details</h4>
      </div>
      <?= form_open('main/addGuest', ['id' => 'frmGuest']); ?>
      <input type="hidden" name="guest_id">
      <div class="modal-body">
        <div class="row">
          <div class="form-group col-md-4">
            <label>First Name</label>
            <input type="text" class="form-control" name="first_name" required>
          </div>
          <div class="form-group col-md-4">
            <label>Middle Name</label>
            <input type="text" class="form-control" name="middle_name">
          </div>
          <div class="form-group col-md-4">
            <label>Last Name</label>
            <input type="text" class="form-control" name="last_name" required>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-5">
            <label>Contact Number</label>
            <input type="text" class="form-control" name="contact" required>
            <small class="text-muted" id="txt-contact"></small>
          </div>
          <div class="form-group col-md-7">
            <label>Email <small>(optional)</small></label>
            <input type="text" class="form-control" name="email">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label>Company Name</label>
            <input type="text" class="form-control" name="company_name">
          </div>
          <div class="form-group col-md-6">
            <label>Company Address</label>
            <input type="text" class="form-control" name="company_address">
          </div>
        </div>
        <div class="form-group">
          <label>Address <small>(optional)</small></label>
          <input type="text" class="form-control" name="address">
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label>Birthday <small>(optional)</small></label>
            <input type="text" class="form-control datepicker" name="birthday">
          </div>
          <div class="form-group col-md-6">
            <label>Nationality <small>(optional)</small></label>
            <input type="text" class="form-control" name="nationality">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <button type="submit" class="btn btn-link" form="frmGuest" id="btnGuest">Add Guest</button>
        </div>
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
    <?= form_close() ?>
  </div>
</div>

<script>
  $(document).ready(function() {
    demo.initWizard();
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
    });
    $('.tbl_guest').dataTable({
      autoWidth: false,
      columnDefs: [{
          "width": "18%",
          "targets": 0
        },
        {
          "width": "18%",
          "targets": 1
        },
        {
          "width": "18%",
          "targets": 2
        },
        {
          "width": "18%",
          "targets": 3
        },
        {
          "width": "18%",
          "targets": 4
        }, {
          "width": "120px",
          "targets": 5
        }
      ]
    });
  });

  $('.updateGuest').click(function() {
    const data = JSON.parse($(this).attr('data'));
    $('[name=guest_id]').val(data.guest_id);
    $('[name=first_name]').val(data.first_name);
    $('[name=middle_name]').val(data.middle_name);
    $('[name=last_name]').val(data.last_name);
    $('[name=company_name]').val(data.company_name);
    $('[name=company_address]').val(data.company_address);
    $('[name=contact]').val(data.contact);
    $('[name=email]').val(data.email);
    $('[name=address]').val(data.address);
    $('[name=birthday]').val(data.birthday);
    $('[name=nationality]').val(data.nationality);
    $("#txt-contact").text(`${data.contact.length} digits`);
    $('#frmGuest').attr('action', 'updateGuest');
    $('#btnGuest').text('Update Guest');
    $('#modalGuest').modal('show');
  });

  $('#addGuest').click(function() {
    $('#frmGuest').attr('action', 'addGuest');
    $('#frmGuest').trigger('reset');
    $('#btnGuest').text('Add Guest');
    $('#modalGuest').modal('show');
  });

  $("#modalGuest").on("hide.bs.modal", function(e) {
    $("#txt-contact").text("");
  });
</script>