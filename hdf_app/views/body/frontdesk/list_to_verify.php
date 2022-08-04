<?php if (($this->session->flashdata('error'))) : ?>
  <script>
    $(document).ready(function() {
      demo.showNotification_error('top', 'right');
      swal("Error", "Date and Room is not available", "error");
    });
  </script>
<?php endif; ?>

<?php if (($this->session->flashdata('errors'))) : ?>
  <script>
    $(document).ready(function() {
      demo.showNotification_error('top', 'right');
      swal("Error", "Invalid to Check in! Invalid Date", "error");
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

<div class="content pb-0">
  <div class="row">
    <div class="col-md-12">
      <h5>ONLINE</h5>
      <div class="wizard-container">
        <div class="card card-wizard" data-color="primary" id="wizardProfile">
          <div class="card-header text-center">
            <div class="wizard-navigation">
              <ul>
                <li class="nav-item">
                  <a class="nav-link active" href="#available" data-toggle="tab" role="tab" aria-controls="available" aria-selected="true">
                    <i class="fa fa-check"></i> Active
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#unavailable" data-toggle="tab" role="tab" aria-controls="unavailable" aria-selected="true">
                    <i class="fa fa-ban"></i> Canceled
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <div class="tab-content pt-0">
              <div class="tab-pane show active" id="available">
                <h6 class="mb-3 ml-3">Reservation List(s)</h6>
                <table id="datatables" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Booking #</th>
                      <th>Guest Name</th>
                      <th>Contact No.</th>
                      <th>Reservation Date</th>
                      <th>E-mail</th>
                      <th class="disabled-sorting text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($result_reservation as $data) { ?>
                      <tr>
                        <td>RBHDF<?= $data['id'] ?></td>
                        <td><?= $data['last_name'] ?>, <?= $data['first_name'] ?> <?= $data['middle_name'] ?></td>
                        <td><?= $data['contact'] ?></td>
                        <td><?= $data['reservation_date'] ?></td>
                        <td><?= $data['email'] ?></td>
                        <td class="text-center">
                          <a data-id="RBHDF<?= $data['id'] ?>" data-ids="<?= $data['id'] ?>" data-fname="<?= $data['first_name'] ?>" data-lname="<?= $data['last_name'] ?>" data-type="<?= $data['room_id'] ?>" data-contact="<?= $data['contact'] ?>" data-date1="<?= $data['check_id_date'] ?>" data-date2="<?= $data['check_out_date'] ?>" data-email="<?= $data['email'] ?>" href="#" data-toggle="modal" data-target="#viewDetails" class="room_details btn btn-primary" data-toggle="tooltip" data-placement="left" title="Details"><span class="nc-icon nc-alert-circle-i"></span> Details</a>
                          <a class="btn btn-warning" onclick="return confirm('Are you sure cancel booking?')" href="<?= base_url('index.php/main/cancelOnlineBooking/' . $data['id']) ?>"><span class="nc-icon nc-simple-remove"></span> Cancel</a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane show" id="unavailable">
                <h6 class="ml-3 mb-3">Canceled Reservation List(s)</h6>
                <table id="datatablel" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Booking #</th>
                      <th>Guest Name</th>
                      <th>Contact No.</th>
                      <th>Reservation Date</th>
                      <th>E-mail</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($result_reservation_cancel as $data) { ?>
                      <tr>
                        <td>RBHDF<?= $data['id'] ?></td>
                        <td><?= $data['last_name'] ?>, <?= $data['first_name'] ?> <?= $data['middle_name'] ?></td>
                        <td><?= $data['contact'] ?></td>
                        <td><?= $data['reservation_date'] ?></td>
                        <td><?= $data['email'] ?></td>
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
    setTimeout(function() {
      $('.card.card-wizard').addClass('active');
    }, 600);
  });
</script>
<script type="text/javascript">
  $('.reserve').click(function() {
    swal({
      title: 'Are you sure to Reserve?',
      text: '',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Confirm',
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

  $(document).on('change', '.type', function() {
    let room = $("#type option:selected").text();
    room = room.replaceAll('/', '-');
    const url = '<?= base_url('index.php/main/getRoomsByType/') ?>' + room;
    $('#room_type').html('<option>Select Room</option>');
    fetch(url)
      .then(res => res.json())
      .then(res => {
        let html = '';
        res.map(room => {
          html += `<option value="${room.id}">${room.room_number}</option>`;
          $('#room_type').html(html);
        });
      });
  });

  $('.room_details').click(function() {
    $('#viewDetails').on('show.bs.modal', function(e) {
      let room = $(e.relatedTarget).data('type');
      room = room.replaceAll('/', '-');
      const url = '<?= base_url('index.php/main/getRoomsByType/') ?>' + room;
      $('#formRoomComplete').attr('action', '<?= base_url('index.php/main/insertReservationOnlineBooking') ?>');
      $('#LabelRoomComplete').text('Reservation Details');
      $('#id').val($(e.relatedTarget).data('id'));
      $('#ids').val($(e.relatedTarget).data('ids'));
      $('#type').val($(e.relatedTarget).data('type'));
      $('#room_type').html('<option>Select Room</option>');
      fetch(url)
        .then(res => res.json())
        .then(res => {
          let html = '';
          res.map(room => {
            html += `<option value="${room.id}">${room.room_number}</option>`;
            $('#room_type').html(html);
          });
        });
      $('#date1').val($(e.relatedTarget).data('date1'));
      $('#date2').val($(e.relatedTarget).data('date2'));
      $('#lname').val($(e.relatedTarget).data('lname'));
      $('#fname').val($(e.relatedTarget).data('fname'));
      $('#email').val($(e.relatedTarget).data('email'));
      $('#contact').val($(e.relatedTarget).data('contact'));
    });
  });
</script>
<script>
  $(document).ready(function() {
    $('#datatablel').DataTable({
      "pagingType": "full_numbers",
      "order": [
        [3, "desc"]
      ],
      "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
      ],
      responsive: true,
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Search records",
      }
    });

    var table = $('#datatablel').DataTable();

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

<div class="modal fade" id="viewDetails" tabindex="-1" role="dialog" aria-labelledby="roomLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header justify-content-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="nc-icon nc-simple-remove"></i>
        </button>
        <h4 class="title title-up" id="LabelRoomComplete">Reservation Details</h4>
      </div>
      <?php $attributes = array('id' => 'formRoomComplete'); ?>
      <?= form_open('', $attributes); ?>
      <div class="modal-body">
        <input type="hidden" name="ids" id="ids">
        <div class="form-group">
          <div>
            <label>Booking Number Request</label>
            <input type="text" class="form-control" id="id" readonly><br>
          </div>
          <div>
            <label>Reservation Date Request</label><br>
            <label>Check In</label>
            <input type="text" class="form-control" id="date1" name="date1">
            <label>Check Out</label>
            <input type="text" class="form-control" id="date2" name="date2"><br>
          </div>
          <div>
            <label>Room Type Request</label>
            <select class="form-control type" id="type" name="roomType">
              <?php foreach ($getRoomType as $row) : ?>
                <option><?= $row['room_type'] ?></option>
              <?php endforeach ?>
            </select><br>
            <!-- <input type="text"  class="form-control" id="type" readonly><br> -->
          </div>
          <div>
            <label>Room Number</label>
            <select class="form-control" id="room_type" required name="roomNumber">
              <option value="">Select</option>
            </select><br>
            <!-- <input type="text"  class="form-control" id="type" readonly><br> -->
          </div>
          <div>
            <label>Last Name</label>
            <input type="text" class="form-control" id="lname" name="lname"><br>
          </div>
          <div>
            <label>First Name</label>
            <input type="text" class="form-control" id="fname" name="fname"><br>
          </div>
          <div>
            <label>E-mail</label>
            <input type="text" class="form-control" id="email" name="email"><br>
          </div>
          <div>
            <label>Contact Number</label>
            <input type="text" class="form-control" id="contact" name="contact"><br>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <input type="submit" value="Check In" class="btn btn-danger btn-link">
        </div>
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-default btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
    <?= form_close() ?>
  </div>
</div>