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
                <li class="nav-item">
                  <a class="nav-link" href="#cancel" data-toggle="tab" role="tab" aria-controls="cancel" aria-selected="false">
                    <i class="fa fa-ban"></i> Cancelled
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
                          <?php $this->load->view('body/frontdesk/components/booking_table_data', $data) ?>
                          <td class="action">
                            <a href="<?= base_url('index.php/main/booking/' . $row['booking_number']) ?>" class="btn btn-sm" data-placement="top" title="View Booking" rel="tooltip">
                              <span class="fa fa-address-book"></span>
                            </a>
                            <a href="<?= base_url('index.php/main/receipt/' . $row['booking_id']) ?>" class="btn btn-sm btn-info receipt" data-placement="top" title="View Receipt" rel="tooltip">
                              <i class="fa-solid fa-receipt"></i>
                            </a>
                            <a href="javascript:" id="<?= $row['booking_id'] ?>" class="btn btn-sm btn-danger cancelBooking" data-placement="top" title="Cancel Booking" rel="tooltip">
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
                          <?php $this->load->view('body/frontdesk/components/booking_table_data', $data) ?>
                          <td class="action">
                            <a href="<?= base_url('index.php/main/booking/' . $row['booking_number']) ?>" class="btn btn-sm" data-placement="top" title="View Booking" rel="tooltip">
                              <span class="fa fa-address-book"></span>
                            </a>
                            <a href="<?= base_url('index.php/main/receipt/' . $row['booking_id']) ?>" class="btn btn-sm btn-info receipt" data-placement="top" title="View Receipt" rel="tooltip">
                              <i class="fa-solid fa-receipt"></i>
                            </a>
                          </td>
                        </tr>
                    <?php }
                    } ?>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane show" id="cancel">
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
                      <?php if ($row['reservation_status'] == 6) { ?>
                        <tr>
                          <?php $data['row'] = $row ?>
                          <?php $this->load->view('body/frontdesk/components/booking_table_data', $data) ?>
                          <td class="action">
                            <a href="<?= base_url('index.php/main/booking/' . $row['booking_number']) ?>" class="btn btn-sm" data-placement="top" title="View Booking" rel="tooltip">
                              <span class="fa fa-address-book"></span>
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

<div class="modal fade" id="modalReason" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Cancel Booking</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('main/cancelReservation', ['id' => 'frmCancel']) ?>
        <input type="hidden" name="booking_id">
        <input type="hidden" name="type" value="booking">
        <div class="form-group">
          <label>Reason</label>
          <textarea class="form-control" name="cancel_reason" required></textarea>
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <button type="submit" class="btn btn-link" form="frmCancel">Confirm</button>
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
  $(document).ready(function() {
    demo.initWizard();

    $('.tbl_booking').dataTable({
      order: [
        [0, 'desc']
      ],
      autoWidth: false,
      columnDefs: [{
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

  $(document).on('click', '.receipt', function(e) {
    e.preventDefault();
    const size = ['height=' + screen.height / 2, 'width=' + screen.width / 2].join(',');
    window.open($(this).attr('href'), size, size);
  });

  $(document).on('click', '.cancelBooking', function(e) {
    e.preventDefault();
    const booking_id = this.id;
    $('[name=booking_id]').val(booking_id);
    $("#modalReason").modal("show");
  });
</script>