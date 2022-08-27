<div class="content pb-0">
  <div class="row">
    <div class="col-md-12">
      <h5>Bookings</h5>
      <div class="wizard-container">
        <div class="card card-wizard active" data-color="primary" id="wizardProfile">
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
                <table class="table table-striped table-bordered tbl_booking">
                  <thead>
                    <tr>
                      <th>Booking No.</th>
                      <th>Guest Name</th>
                      <th>Contact Details</th>
                      <th>Room Details</th>
                      <th>Payment Details</th>
                      <th>Date(s)</th>
                      <th class="disabled-sorting">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($bookings as $row) { ?>
                      <?php if ($row['reservation_status'] == 0) { ?>
                        <tr>
                          <?php $data['row'] = $row ?>
                          <?php $this->load->view('body/frontdesk/components/booking-table-data', $data) ?>
                          <td class="action">
                            <a href="<?= base_url('index.php/main/booking/' . $row['booking_number']) ?>" class="btn btn-sm" data-placement="top" title="View Booking" rel="tooltip">
                              <span class="fa fa-eye"></span>
                            </a>
                            <a href="<?= base_url('index.php/main/updateReservationStatus/4/' . $row['booking_id']) ?>" class="btn btn-sm btn-danger confirm" data-placement="top" title="Cancel Booking" rel="tooltip">
                              <span class="fa fa-ban"></span>
                            </a>
                          </td>
                        </tr>
                    <?php }
                    } ?>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane show" id="locked">
                <table class="table table-striped table-bordered tbl_booking">
                  <thead>
                    <tr>
                      <th>Booking No.</th>
                      <th>Guest Name</th>
                      <th>Contact Details</th>
                      <th>Room Details</th>
                      <th>Payment Details</th>
                      <th>Date(s)</th>
                      <th class="disabled-sorting">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($bookings as $row) { ?>
                      <?php if ($row['reservation_status'] == -1) { ?>
                        <tr>
                          <?php $data['row'] = $row ?>
                          <?php $this->load->view('body/frontdesk/components/booking-table-data', $data) ?>
                          <td class="action">
                            <a href="<?= base_url('index.php/main/booking/' . $row['booking_number']) ?>" class="btn btn-sm" data-placement="top" title="View Booking" rel="tooltip">
                              <span class="fa fa-eye"></span>
                            </a>
                          </td>
                        </tr>
                    <?php }
                    } ?>
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

<script>
  $(document).ready(function() {
    demo.initWizard();

    $('.tbl_booking').dataTable({
      "autoWidth": false,
      "columnDefs": [{
          "width": "12%",
          "targets": 0
        },
        {
          "width": "12%",
          "targets": 1
        },
        {
          "width": "12%",
          "targets": 2
        },
        {
          "width": "15%",
          "targets": 4
        },
        {
          "width": "13%",
          "targets": 5
        },
        {
          "width": "10%",
          "targets": 6
        },
      ]
    });
  });
</script>