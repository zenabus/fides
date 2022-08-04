<script type="text/javascript">
  window.onload = function() {
    if (!window.location.hash) {
      window.location = window.location + '#loaded';
      window.location.reload();
    }
  }
</script>

<?php if (validation_errors()) : ?>
  <script>
    $(document).ready(function() {
      demo.showNotification_error('top', 'right');
    });
  </script>
<?php endif; ?>

<?php if ($this->session->flashdata('success')) : ?>
  <script>
    $(document).ready(function() {
      demo.showNotification('top', 'right');
    });
  </script>
<?php endif; ?>

<style type="text/css">
  th {
    white-space: pre;
  }
</style>

<div class="content pb-0">
  <div class="row">
    <div class="col-md-12">
      <h5>BOOKINGS</h5>
      <div class="wizard-container">
        <div class="card card-wizard" data-color="primary" id="wizardProfile">
          <div class="card-header text-center">
            <div class="wizard-navigation">
              <ul>
                <li class="nav-item">
                  <a class="nav-link active" href="#active" data-toggle="tab" role="tab" aria-controls="active" aria-selected="true">
                    <i class="fa fa-check"></i> Active
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#locked" data-toggle="tab" role="tab" aria-controls="locked" aria-selected="false">
                    <i class="fa fa-lock"></i> Locked
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <div class="tab-content pt-0">
              <div class="tab-pane show active" id="active">
                <h6 class="mb-3 ml-3">Active Booking(s)</h6>
                <table class="table table-striped table-bordered datatables" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Guest Name</th>
                      <th>Contact No.</th>
                      <th>E-mail</th>
                      <th>Room no.</th>
                      <th>Room Type</th>
                      <th>Check-In Date</th>
                      <th>Check-Out Date</th>
                      <th>Payment Status</th>
                      <th class="disabled-sorting text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($result_checked as $data) { ?>
                      <tr>
                        <td><?= $data['last_name'] ?>, <?= $data['first_name'] ?> <?= $data['middle_name'] ?></td>
                        <td><?= $data['contact'] ?></td>
                        <td><?= $data['email'] ?></td>
                        <td><?= $data['label'] ?></td>
                        <td><?= $data['room_type'] ?></td>
                        <td><?= $data['start_date'] ?></td>
                        <td><?= $data['end_date'] ?></td>
                        <td><?= $data['status_payment'] == 'Paid' ? "<span class='badge badge-success'>Paid</span>" : "<span class='badge badge-danger'>Unpaid</span>" ?></td>
                        <td>
                          <a href="<?= base_url('index.php/main/refresh/' . $data['che_id']) ?>" class="btn btn-info btn-icon btn-sm"><i class="fa fa-edit"></i></a>
                          <?php if ($data['status_payment'] == 'Paid') { ?>
                            <a href="<?= base_url('index.php/main/deleteBookingCancel/' . $data['che_id']) ?>" class="btn btn-warning btn-icon btn-sm" disabled><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>
                          <?php } else { ?>
                            <a style="cursor: pointer;" id="<?= base_url('index.php/main/deleteBookingCancel/' . $data['che_id']) ?>" class="cancel btn btn-warning btn-icon btn-sm"><i class="fa fa-trash"></i></a>
                          <?php } ?>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane show" id="locked">
                <h6 class="mb-3 ml-3">Locked Booking(s)</h6>
                <table class="table table-striped table-bordered datatables" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Guest Name</th>
                      <th>Contact No.</th>
                      <th>E-mail</th>
                      <th>Room no.</th>
                      <th>Room Type</th>
                      <th>Check-In Date</th>
                      <th>Check-Out Date</th>
                      <th>Payment Status</th>
                      <th class="disabled-sorting text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($result_locked as $data) { ?>
                      <tr>
                        <td><?= $data['last_name'] ?>, <?= $data['first_name'] ?> <?= $data['middle_name'] ?></td>
                        <td><?= $data['contact'] ?></td>
                        <td><?= $data['email'] ?></td>
                        <td><?= $data['label'] ?></td>
                        <td><?= $data['room_type'] ?></td>
                        <td><?= $data['start_date'] ?></td>
                        <td><?= $data['end_date'] ?></td>
                        <td><?= $data['status_payment'] == 'Paid' ? "<span class='badge badge-success'>Paid</span>" : "<span class='badge badge-danger'>Unpaid</span>" ?></td>
                        <td class="text-center">
                          <a href="<?= base_url('index.php/main/refresh/' . $data['che_id']) ?>" class="btn btn-info btn-icon btn-sm"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Details"></i></a>
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

<script type="text/javascript">
  $(document).ready(function() {
    window.setTimeout(function() {
      location.href = "https://booking.hoteldefides.com/index.php/main/listOfCheckedIn";
    }, 200000);

    demo.initWizard();
    setTimeout(function() {
      $('.card.card-wizard').addClass('active');
    }, 600);
  });
</script>
<script src="<?= base_url() ?>assets/js/core/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/js/core/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/js/core/popper.min.js"></script>
<script src="<?= base_url() ?>assets/js/core/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/moment.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/bootstrap-switch.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/sweetalert2.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/jquery.validate.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/jquery.bootstrap-wizard.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/bootstrap-selectpicker.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/bootstrap-datetimepicker.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/bootstrap-tagsinput.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/jasny-bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/fullcalendar.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/jquery-jvectormap.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/nouislider.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/chartjs.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/bootstrap-notify.js"></script>
<script src="<?= base_url() ?>assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/demo/demo.js"></script>
<script>
  $(document).ready(function() {
    $('.datatables').DataTable({
      "pagingType": "full_numbers",
      "order": [
        [6, "desc"]
      ],
      "lengthMenu": [
        [25, 10, 50, 75, 100, -1],
        [25, 10, 50, 75, 100, "All"]
      ],
      responsive: true,
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Search records",
      }
    });

    var table = $('#datatable').DataTable();
    // Edit record
    table.on('click', '.edit', function() {
      $tr = $(this).closest('tr');
      var data = table.row($tr).data();
      alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
    });

    // Delete a record
    table.on('click', '.remove', function(e) {
      $tr = $(this).closest('tr');
      table.row($tr).remove().draw();
      e.preventDefault();
    });

    //Like record
    table.on('click', '.like', function() {
      alert('You clicked on Like button');
    });
  });
</script>
<script type="text/javascript">
  $('.cancel').click(function() {
    swal({
      title: 'Are you sure to Delete?',
      text: '',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Delete',
      cancelButtonText: 'Cancel',
      confirmButtonClass: "btn btn-success",
      cancelButtonClass: "btn btn-danger",
      buttonsStyling: false
    }).then((result) => {
      if (!result.value) {
        window.location.replace(this.id);
      }
    });
  });
</script>