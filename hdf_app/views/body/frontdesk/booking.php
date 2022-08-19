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
          <?= form_open('main/updateGuest', ['id' => 'frmGuest']) ?>
          <input type="hidden" name="guest_id" value="<?= $booking->guest_id ?>">
          <div class="form-row px-4 py-3">
            <div class="form-group col-md-4 mb-0">
              <label>Arrival</label>
              <input type="text" class="form-control-plaintext" tabindex="-1" value="<?= $booking->arrival ?>" readonly>
            </div>
            <div class="form-group col-md-4 mb-0">
              <label>Departure</label>
              <input type="text" class="form-control-plaintext" tabindex="-1" value="<?= $booking->departure ?>" readonly>
            </div>
            <?php
            $arrival = new DateTime($booking->arrival);
            $departure = new DateTime($booking->departure);
            $nights = $arrival->diff($departure);
            ?>
            <div class="form-group col-md-4 mb-0">
              <label>Nights</label>
              <input type="text" class="form-control-plaintext" tabindex="-1" value="<?= $nights->d ?>" readonly>
            </div>
          </div>

          <div class="px-4 py-3 border-bottom border-top">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>First Name</label>
                <input type="text" class="form-control-plaintext editable" name="first_name" value="<?= $booking->first_name ?>" tabindex="-1" readonly>
              </div>
              <div class="form-group col-md-4">
                <label>Middle Name</label>
                <input type="text" class="form-control-plaintext editable" name="middle_name" value="<?= $booking->middle_name ?>" tabindex="-1" readonly>
              </div>
              <div class="form-group col-md-4">
                <label>Last Name</label>
                <input type="text" class="form-control-plaintext editable" name="last_name" value="<?= $booking->last_name ?>" tabindex="-1" readonly>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Contact Number</label>
                <input type="text" class="form-control-plaintext editable" name="contact" value="<?= $booking->contact ?>" tabindex="-1" readonly>
              </div>
              <div class="form-group col-md-4">
                <label>Email</label>
                <input type="text" class="form-control-plaintext editable" name="email" value="<?= $booking->email ?>" tabindex="-1" readonly>
              </div>
              <div class="form-group col-md-4">
                <label>Address</label>
                <input type="text" class="form-control-plaintext editable" name="address" value="<?= $booking->address ?>" tabindex="-1" readonly>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6 mb-0">
                <label>Company Name</label>
                <input type="text" class="form-control-plaintext editable" name="company_name" value="<?= $booking->company_name ?>" tabindex="-1" readonly>
              </div>
              <div class="form-group col-md-6 mb-0">
                <label>Company Address</label>
                <input type="text" class="form-control-plaintext editable" name="company_address" value="<?= $booking->company_address ?>" tabindex="-1" readonly>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer my-2">
          <button class="btn btn-default updateDetails" type="button">Update Details</button>
          <button class="btn btn-default saveChanges" form="frmGuest">Save Changes</button>
          <button class="btn btn-primary cancelUpdate" type="button">Cancel Update</button>
        </div>
      </div>

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

    <div class="col-md-6">
      <?php $this->load->view('body/frontdesk/components/collection_details') ?>

      <div class="card">
        <div class="card-header border-bottom px-4 pt-4 pb-2">
          <h6>Notes</h6>
        </div>
        <?= form_open('main/updateNotes', ['id' => 'frmNotes']) ?>
        <input type="hidden" name="booking_id" value="<?= $booking->booking_id ?>">
        <div class="card-body px-4">
          <textarea class="form-control-plaintext px-2 pt-1" tabindex="-1" name="remarks" rows="5" readonly><?= $booking->remarks ?></textarea>
        </div>
        <div class="card-footer my-2 border-top px-4">
          <input type="button" value="Update Notes" class="btn btn-default updateNotes">
          <input type="submit" value="Save Notes" class="btn btn-default saveNotes" form="frmNotes">
          <input type="button" value="Cancel Update" class="btn btn-primary cancelNotes">
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('.cancelUpdate').hide();
    $('.saveChanges').hide();
    $('.saveNotes').hide();
    $('.cancelNotes').hide();
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

    if (reservation_status == -1) {
      $('.btn').attr('disabled', true);
      $('.btn').hide();
      $('.hidable').hide();
      $('.form-control').attr('readonly', true);
      $('.back').attr('disabled', false);
      $('.back').show();
    }
  });

  $('.updateDetails').click(function() {
    $('.editable').removeClass('form-control-plaintext').addClass('form-control').removeAttr('readonly').removeAttr('tabindex');
    $('.updateDetails').hide();
    $('.cancelUpdate').show();
    $('.saveChanges').show();
    $('[name=first_name]').focus();
  });

  $('.cancelUpdate').click(function() {
    $('.editable').addClass('form-control-plaintext').removeClass('form-control').attr('readonly', true).attr('tabindex', -1);
    $('.updateDetails').show();
    $('.cancelUpdate').hide();
    $('.saveChanges').hide();
    $('#frmGuest').trigger('reset');
  });

  $('.updateNotes').click(function() {
    $('textarea').removeClass('form-control-plaintext').addClass('form-control').removeAttr('readonly').removeAttr('tabindex');
    $('.updateNotes').hide();
    $('.cancelNotes').show();
    $('.saveNotes').show();
    $('[name=first_name]').focus();
  });

  $('.cancelNotes').click(function() {
    $('textarea').addClass('form-control-plaintext').removeClass('form-control').attr('readonly', true).attr('tabindex', -1);
    $('.updateNotes').show();
    $('.cancelNotes').hide();
    $('.saveNotes').hide();
    $('#frmNotes').trigger('reset');
  });
</script>