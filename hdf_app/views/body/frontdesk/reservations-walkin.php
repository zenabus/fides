<div class="content pb-0">
  <div class="row">
    <div class="col-md-12">
      <h5>Walk In Reservations</h5>
      <div class="wizard-container">
        <div class="card card-wizard active" data-color="primary" id="wizardProfile">
          <div class="card-header text-center">
            <div class="wizard-navigation">
              <ul>
                <li class="nav-item">
                  <a class="nav-link active" href="#active" data-toggle="tab" role="tab" aria-controls="active" aria-selected="true">
                    <i class="fa fa-check" title="1"></i> Active
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#cancelled" data-toggle="tab" role="tab" aria-controls="cancelled" aria-selected="true">
                    <i class="fa fa-ban" title="4"></i> Cancelled
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane show active" id="active">
                <table class="table table-striped table-bordered tbl_reservations">
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
                    <?php foreach ($reservations as $row) { ?>
                      <?php if ($row['reservation_status'] == 1) { ?>
                        <tr>
                          <?php $data['row'] = $row ?>
                          <?php $this->load->view('body/frontdesk/components/booking_table_data', $data) ?>
                          <td class="action">
                            <?php if($row['arrival']==date('m/d/Y')){ ?>
                            <a href="javascript:" class="btn btn-sm btn-default checkIn" onclick="popup(event, 'Proceed Check In', 'Are you sure do you want to check in this reservation?', '<?= base_url('index.php/main/checkIn/' . $row['booking_id']) ?>')" data-placement="top" title="Check In Reservation" rel="tooltip">
                              <i class="fa-solid fa-calendar-check"></i>
                            </a>
                            <?php } ?>
                            <a href="<?= base_url('index.php/main/cancelReservation/' . $row['booking_id']) ?>" class="btn btn-sm btn-danger confirm" data-placement="top" title="Cancel Reservation" rel="tooltip">
                              <span class="fa fa-ban"></span>
                            </a>
                          </td>
                        </tr>
                    <?php }
                    } ?>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane" id="cancelled">
                <table class="table table-striped table-bordered tbl_reservations">
                  <thead>
                    <tr>
                      <th>Booking No.</th>
                      <th>Guest Name</th>
                      <th>Contact Details</th>
                      <th>Room Details</th>
                      <th>Payment Details</th>
                      <th>Date</th>
                      <th class="disabled-sorting">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($reservations as $row) { ?>
                      <?php if ($row['reservation_status'] == 4) { ?>
                        <tr>
                          <?php $data['row'] = $row ?>
                          <?php $this->load->view('body/frontdesk/components/booking_table_data', $data) ?>
                          <td></td>
                        </tr>
                    <?php }
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="card-footer">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    demo.initWizard();

    $('.tbl_reservations').DataTable({
      order: [
        [0, 'desc']
      ],
      autoWidth: false,
      columnDefs: [{
          "width": "11%",
          "targets": 0
        },
        {
          "width": "16%",
          "targets": 1
        },
        {
          "width": "16%",
          "targets": 2
        },
        {
          "width": "16%",
          "targets": 3
        },
        {
          "width": "12%",
          "targets": 4
        },
        {
          "width": "16%",
          "targets": 5
        },
      ]
    });
  });
</script>