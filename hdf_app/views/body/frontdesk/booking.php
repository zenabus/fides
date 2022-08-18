<script src="<?= base_url() ?>assets/demo/demo.js"></script>

<div class="content pb-0">
  <div class="d-flex justify-content-between align-items-center mb-2">
    <h5 class="mb-0">Booking Number: <?= $booking->booking_number ?></h5>
    <button class="btn btn-primary my-0 back" onclick="history.back()">Back</button>
  </div>
  <div class="row">
    <div class="col-md-6">
      <?php $this->load->view('body/frontdesk/components/room_details') ?>

      <div class="card">
        <div class="card-header border-bottom px-4 pt-4 pb-2">
          <h6>Guest Details</h6>
        </div>
        <div class="card-body p-0">
          <div class="form-row px-4 py-3">
            <div class="form-group col-md-4">
              <label>Arrival</label>
              <input type="text" class="form-control datepicker" name="arrival" value="<?= $booking->arrival ?>">
            </div>
            <div class="form-group col-md-4">
              <label>Departure</label>
              <input type="text" class="form-control datepicker" name="departure" value="<?= $booking->departure ?>">
            </div>
            <?php
            $arrival = new DateTime($booking->arrival);
            $departure = new DateTime($booking->departure);
            $nights = $arrival->diff($departure);
            ?>
            <div class="form-group col-md-1">
              <label>Nights</label>
              <input type="text" class="form-control text-center" value="<?= $nights->d ?>" readonly>
            </div>
            <div class="form-group col-md-3">
              <label>&nbsp;</label>
              <input type="button" class="btn btn-default btn-block mt-0" value="Change Dates">
            </div>
          </div>

          <div class="px-4 py-3 border-bottom border-top">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>First Name</label>
                <input type="text" class="form-control" value="<?= $booking->first_name ?>">
              </div>
              <div class="form-group col-md-4">
                <label>Middle Name</label>
                <input type="text" class="form-control" value="<?= $booking->middle_name ?>">
              </div>
              <div class="form-group col-md-4">
                <label>Last Name</label>
                <input type="text" class="form-control" value="<?= $booking->last_name ?>">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Contact Number</label>
                <input type="text" class="form-control" value="<?= $booking->contact ?>">
              </div>
              <div class="form-group col-md-4">
                <label>Email</label>
                <input type="text" class="form-control" value="<?= $booking->email ?>">
              </div>
              <div class="form-group col-md-4">
                <label>Address</label>
                <input type="text" class="form-control" value="<?= $booking->address ?>">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Company Name</label>
                <input type="text" class="form-control" value="<?= $booking->company_name ?>">
              </div>
              <div class="form-group col-md-6">
                <label>Company Address</label>
                <input type="text" class="form-control" value="<?= $booking->company_address ?>">
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer my-2">
          <button class="btn btn-default">Update Details</button>
          <button class="btn btn-success text-light" onclick="popupCenter('<?= base_url('index.php/main/printForm/') ?>',  'myPop1', 600,600); return false;">Print Form </button>
        </div>
      </div>

      <div class="card">
        <div class="card-header border-bottom px-4 pt-4 pb-2">
          <h6>Notes</h6>
        </div>
        <div class="card-body px-4">
          <textarea class="form-control px-2 pt-1" name="notes"></textarea>
        </div>
        <div class="card-footer my-2 border-top px-4">
          <input type="submit" value="Save Notes" class="btn btn-default">
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <?php $this->load->view('body/frontdesk/components/collection_details') ?>

      <div class="card">
        <div class="card-header border-bottom px-4 pt-4 pb-2">
          <h6>Logs</h6>
        </div>
        <div class="card-body p-4">
          <table class="table table-striped table-bordered mb-0">
            <thead>
              <tr>
                <th>User</th>
                <th>Activity</th>
                <th>Date Modified</th>
              </tr>
            </thead>
            <tbody>
              <?php $logs = [] ?>
              <?php if (!count($logs)) { ?>
                <tr>
                  <td class="text-center" colspan="3">No record found</td>
                </tr>
              <?php } ?>
              <?php foreach ($logs as $row1) { ?>
                <tr>
                  <td><?= $row1['user'] ?></td>
                  <td><?= str_replace("%20", " ", $row1['content']); ?></td>
                  <td><?= $row1['date_entered'] ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
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

    if(reservation_status == -1) {
      $('.btn').attr('disabled', true);
      $('.btn').hide();
      $('.hidable').hide();
      $('.form-control').attr('readonly', true);
      $('.back').attr('disabled', false);
      $('.back').show();
    }
  });


  $('[name=card_number]').on('input', function() {
    const value = $(this).val();
    const newValue = value.replace(/[^\dA-Z]/g, '').replace(/(.{4})/g, '$1 ').trim();
    $(this).val(newValue);
  });
</script>