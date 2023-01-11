<style type="text/css">
  .bg-brown {
    background-color: #66615B;
    padding: 4px !important;
  }

  .card-div,
  #new_guest {
    display: none;
  }

  .modal {
    overflow-y: scroll !important;
  }
</style>

<div class="content pb-0">
  <div class="row">
    <div class="col-md-12">
      <h5 class="<?= $_SESSION['user_type'] == 'Admin' || $_SESSION['user_type'] == 'Superadmin' ? 'mb-0' : '' ?>">Rooms</h5>
      <?php if ($_SESSION['user_type'] == 'Admin' || $_SESSION['user_type'] == 'Superadmin') { ?>
        <button class="btn" id="addRoom">Add Room</button>
        <a href="<?= base_url('index.php/admin/roomTypes') ?>" class="btn btn-info">Room Types</a>
      <?php } ?>
      <div class="card mb-0">
        <div class="card-body px-0">
          <table class="table table-striped">
            <thead>
              <tr>
                <th class="pl-4">Room #</th>
                <th>Type</th>
                <?php if ($_SESSION['user_type'] != 'Housekeeping') { ?>
                  <th>Price</th>
                  <th>Persons</th>
                <?php } ?>
                <th>Status</th>
                <th class="disabled-sorting">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td colspan="7" class="text-center bg-brown"></td>
              </tr>
              <?php $prev = 199; ?>
              <?php foreach ($rooms as $row) {
                $badge = 'default';

                if ($row['id'] == 8) {
                  $badge = 'primary';
                } elseif ($row['id'] == 6 || $row['id'] == 7) {
                  $badge = 'danger';
                } elseif ($row['id'] == 3 || $row['id'] == 5) {
                  $badge = 'warning';
                } elseif ($row['id'] == 1 || $row['id'] == 2) {
                  $badge = 'success';
                }

                if ($row['room_number'] - $prev > 20) { ?>
                  <tr>
                    <td colspan="7" class="text-center bg-brown"></td>
                  </tr>
                <?php } ?>
                <tr>
                  <td class="pl-4"><?= $row['room_number'] ?></td>
                  <td><?= $row['room_type'] ?></td>
                  <?php if ($_SESSION['user_type'] != 'Housekeeping') { ?>
                    <td>₱ <?= number_format($row['pricing_type']) ?></td>
                    <td><?= $row['max_persons'] == 2 ? 'Two' : 'Three' ?></td>
                  <?php } ?>
                  <td>
                    <span class="badge badge-<?= $badge ?>">
                      <span class="fa fa-<?= $row['icon'] ?>"></span>
                      <?= $row['description'] ?>
                    </span>
                  </td>
                  <td class="action">
                    <?php if ($_SESSION['user_type'] != 'Housekeeping') { ?>
                      <?php if ($_SESSION['user_type'] == 'Admin' || $_SESSION['user_type'] == 'Superadmin') { ?>
                        <button class="btn btn-sm btn-success updateRoom" id='<?= json_encode($row) ?>' data='<?= json_encode($row) ?>' data-placement="top" title="Update Room" rel="tooltip">
                          <span class="fa fa-edit"></span>
                        </button>
                        <a href="<?= base_url('index.php/admin/deleteRoom/' . $row['room_id']) ?>" class="btn btn-sm btn-danger deleteRoom confirm" data='<?= json_encode($row) ?>' data-placement="top" title="Delete Room" rel="tooltip">
                          <span class="fa fa-trash"></span>
                        </a>
                      <?php } ?>
                      <?php if ($row['room_status_id'] == 4) { ?>
                        <button class="btn btn-sm checkin" data='<?= json_encode($row) ?>' data-placement="top" title="Check In Guest" rel="tooltip">
                          <span class="fa fa-check"></span>
                        </button>
                      <?php } ?>
                    <?php } else { ?>
                      <?= form_open('main/updateRoomStatus', ['id' => 'frmStatus']); ?>
                      <input type="hidden" name="room_id" value="<?= $row['room_id'] ?>">
                      <select class="form-control form-control-sm d-inline mr-2 mb-1" style="width:70px" name="room_status_id">
                        <?php foreach ($statuses as $status) { ?>
                          <option value="<?= $status['id'] ?>" <?= $status['id'] == $row['id'] ? 'selected' : '' ?>><?= $status['name'] ?></option>
                        <?php } ?>
                      </select>
                      <button class="btn btn-sm d-inline">Update Room Status</button>
                      <?= form_close(); ?>
                    <?php } ?>
                  </td>
                </tr>
                <?php $prev = $row['room_number'] ?>
              <?php } ?>
              <tr>
                <td colspan="7" class="text-center bg-brown"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalRoom" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Add Room</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('admin/addRoom', ['id' => 'frmRoom']) ?>
        <input type="hidden" name="room_id">
        <div class="form-group">
          <label>Room Type</label>
          <select name="room_type_id" class="form-control" required>
            <option value="">- select room type -</option>
            <?php foreach ($room_types as $row) { ?>
              <option value="<?= $row['id'] ?>"><?= $row['room_type'] ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label>Room Number</label>
          <input type="number" class="form-control" name="room_number" required min="1" value="1" max="999">
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <input type="submit" value="Add Room" class="btn btn-link btn-room" form="frmRoom">
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
  const base_url = '<?= base_url() ?>';

  $('.checkin').click(function() {
    modalBooking(this, 'Check In');
  });

  $('#addRoom').click(function() {
    $('.title-up').text('Add Room');
    $('.btn-room').val('Add Room')
    $('#frmRoom').attr('action', `${base_url}index.php/admin/addRoom`).trigger('reset');
    $('#modalRoom').modal('show');
  });

  $('.updateRoom').click(function() {
    const data = JSON.parse(this.id);
    $('.title-up').text('Update Room');
    $('.btn-room').val('Update Room');
    $('[name=room_id]').val(data.room_id);
    $('[name=room_type_id]').val(data.room_type_id);
    $('[name=room_number]').val(data.room_number);
    $('#frmRoom').attr('action', `${base_url}index.php/admin/updateRoom`);
    $('#modalRoom').modal('show');
  });

  $('#frmStatus').on('submit', function(e) {
    e.preventDefault();
    swal({
      title: "Are you sure?",
      text: "Please confirm your selected action",
      type: "warning",
      buttonsStyling: false,
      showCancelButton: true,
      cancelButtonClass: "btn",
      confirmButtonClass: "btn btn-primary mr-2",
    }).then((result) => {
      if (result) {
        $(this).unbind().submit();
      }
    });
  });
</script>