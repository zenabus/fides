<style>
  #new_guest {
    display: none;
  }
</style>

<div class="content pb-0">
  <div class="row">
    <div class="col-md-12">
      <h5>Online Reservations</h5>
      <div class="wizard-container">
        <div class="card card-wizard active" data-color="primary" id="wizardProfile">
          <div class="card-header text-center">
            <div class="wizard-navigation">
              <ul>
                <li class="nav-item">
                  <a class="nav-link active" href="#confirmed" data-toggle="tab" role="tab" aria-controls="confirmed" aria-selected="true">
                    <i class="fa fa-check" title="5"></i> Confirmed
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#pending" data-toggle="tab" role="tab" aria-controls="pending" aria-selected="true">
                    <i class="fa fa-hourglass" title="2/3"></i> Pending
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
              <div class="tab-pane show active" id="confirmed">
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
                      <?php if ($row['reservation_status'] == 5) { ?>
                        <tr>
                          <?php $data['row'] = $row ?>
                          <?php $this->load->view('body/frontdesk/components/booking_table_data', $data) ?>
                          <td class="action">
                            <?php if ($row['arrival'] == date('m/d/Y')) { ?>
                              <a href="javascript:" class="btn btn-sm btn-default checkIn" onclick="popup(event, 'Proceed Check In', 'Are you sure do you want to check in this reservation?', '<?= base_url('index.php/main/checkIn/' . $row['booking_id']) ?>')" data-placement="top" title="Check In Reservation" rel="tooltip">
                                <i class="fa-solid fa-calendar-check"></i>
                              </a>
                            <?php } ?>
                            <a href="<?= base_url('index.php/main/cancelReservation/' . $row['booking_id']) ?>" class="btn btn-sm btn-danger confirm" data-placement="top" title="Cancel Booking" rel="tooltip">
                              <span class="fa fa-ban"></span>
                            </a>
                          </td>
                        </tr>
                    <?php }
                    } ?>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane" id="pending">
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
                      <?php if ($row['reservation_status'] == 2 || $row['reservation_status'] == 3) { ?>
                        <tr>
                          <?php $data['row'] = $row ?>
                          <?php $this->load->view('body/frontdesk/components/booking_table_data', $data) ?>
                          <td class="action">
                            <a href="javascript:" class="btn btn-sm confirm-reservation mb-1" data='<?= json_encode($row) ?>' data-placement="top" title="Confirm Reservation" rel="tooltip">
                              <span class="fa fa-check"></span>
                            </a>
                            <a href="<?= base_url('index.php/main/cancelReservation/' . $row['booking_id']) ?>" class="btn btn-sm btn-danger confirm mb-1" data-placement="top" title="Cancel Reservation" rel="tooltip">
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
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($reservations as $row) { ?>
                      <?php if ($row['reservation_status'] == 4) { ?>
                        <tr>
                          <?php $data['row'] = $row ?>
                          <?php $this->load->view('body/frontdesk/components/booking_table_data', $data) ?>
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

<div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog">
  <div class="modal-dialog pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="nc-icon nc-simple-remove"></i>
        </button>
        <h4 class="title title-up titleBooking">Verify Reservation</h4>
      </div>
      <div class="modal-body">
        <?= form_open('main/confirm', ['id' => 'frmConfirm']) ?>
        <input type="hidden" name="booking_id">
        <div class="form-group">
          <label>Advance Payment Option</label>
          <div class="d-flex justify-content-around">
            <div class="form-check-radio mb-0">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="payment_option" value="Cash">
                Cash
                <span class="form-check-sign"></span>
              </label>
            </div>
            <div class="form-check-radio mb-0">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="payment_option" value="Card" checked>
                Card
                <span class="form-check-sign"></span>
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Amount</label>
          <input type="number" name="amount" class="form-control" value="0" min="0" required>
        </div>
        <div class="card-div">
          <div class="row">
            <div class="form-group col-md-6">
              <label>Account Number</label>
              <input type="number" name="card_number" class="form-control" placeholder="XXXX" maxlength="4">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Notes / Remarks</label>
          <textarea name="remarks" rows="5" class="form-control"></textarea>
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <input type="submit" value="Confirm" class="btn btn-link" form="frmConfirm">
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
  const guests = JSON.parse(`<?= json_encode($guests) ?>`);
</script>
<script defer src="<?= base_url('assets/js/modal-reservation.js') ?>"></script>
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

  $("[name=payment_option]").change(function() {
    const option = $(this).val();
    if (option == "Cash") {
      $(".card-div").hide();
      $("[name=card_number]").val("");
      $("[name=card_number]").removeAttr("required");
    } else {
      $("[name=card_number]").attr("required", true);
      $(".card-div").show();
    }
  });

  $('.confirm-reservation').click(function() {
    const data = JSON.parse($(this).attr('data'));
    $('[name=booking_id]').val(data.booking_id);
    $('[name=amount]').val(data.amount);
    $('[name=card_number]').val(data.card_number);
    $('[name=remarks]').val(data.remarks);
    $('#modalConfirm').modal('show');
  });
</script>