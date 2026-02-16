<div class="content pb-0">
  <div class="row">
    <div class="col-md-12">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="mb-0">Transaction History - <?= $guest->first_name ?> <?= $guest->middle_name ?> <?= $guest->last_name ?> <?= $guest->suffix ?></h5>
        <button class="btn btn-primary my-0 back" onclick="history.back()">Back</button>
      </div>
      <div class="wizard-container">
        <div class="card card-wizard active" data-color="primary" id="wizardProfile">
          <div class="card-header text-center">
            <div class="wizard-navigation">
              <ul>
                <li class="nav-item">
                  <a class="nav-link active" href="#bookings" data-toggle="tab" role="tab">
                    <i class="fa fa-book"></i> Bookings
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#collectables" data-toggle="tab" role="tab">
                    <i class="fa fa-money"></i> Collectables
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#reservations" data-toggle="tab" role="tab">
                    <i class="fa fa-hourglass"></i> Reservations
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <div class="tab-content pt-0">
              <div class="tab-pane show active" id="bookings">
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
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane show" id="collectables">
                <h5 class="pl-3 mb-4">Total Collectables: ₱ <?= number_format($total_collectable, 2) ?></h5>
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
                    <?php foreach ($charged as $row) { ?>
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
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane show" id="reservations">
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
                    <?php foreach ($reservations as $row) { ?>
                      <tr>
                        <?php $data['row'] = $row ?>
                        <?php $this->load->view('body/frontdesk/components/booking_table_data', $data) ?>
                        <td class="action"></td>
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
</script>