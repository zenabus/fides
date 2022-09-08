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
      <h5 class="<?=$_SESSION['user_type'] == 'Admin' ? 'mb-0' : '' ?>">Rooms</h5>
      <?php if ($_SESSION['user_type'] == 'Admin') { ?>
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
                <th>Price</th>
                <th>Persons</th>
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
                $badge = $row['id'] == '4' ? 'default' : 'danger';
                if ($row['room_number'] - $prev > 20) { ?>
                  <tr>
                    <td colspan="7" class="text-center bg-brown"></td>
                  </tr>
                <?php } ?>
                <tr>
                  <td class="pl-4"><?= $row['room_number'] ?></td>
                  <td><?= $row['room_type'] ?></td>
                  <td>₱ <?= number_format($row['pricing_type']) ?></td>
                  <td><?= $row['max_persons'] == 2 ? 'Two' : 'Three' ?></td>
                  <td>
                    <span class="badge badge-<?= $badge ?>">
                      <span class="fa fa-<?= $row['icon'] ?>"></span>
                      <?= $row['description'] ?>
                    </span>
                  </td>
                  <td class="action">
                    <?php if ($_SESSION['user_type'] == 'Admin') { ?>
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
  const guests = JSON.parse('<?= json_encode($guests) ?>');
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
</script>