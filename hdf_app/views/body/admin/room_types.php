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

  td {
    vertical-align: top !important;
  }
</style>

<div class="content pb-0">
  <div class="row">
    <div class="col-md-12">
      <h5 class="mb-0">Room Types</h5>
      <div class="d-flex justify-content-between">
        <button class="btn" id="addRoomType">Add Room Type</button>
        <button class="btn btn-primary" onclick="history.back()">Back</button>
      </div>
      <div class="card mb-0">
        <div class="card-body px-0">
          <table class="table mb-0">
            <thead>
              <tr>
                <th class="pl-3">Room Type</th>
                <th width="35%">Description</th>
                <th>Amenities</th>
                <th>Accommodation</th>
                <th>Breakfast</th>
                <th class="disabled-sorting pr-3">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($room_types as $row) { ?>
                <tr>
                  <td class="text-center">
                    <img src="<?= base_url('assets/img/rooms/' . $row['upload_file']) ?>" alt="Bed Picture" class="img-fluid my-2" width="300"><br>
                    <span class="wsp"><?= $row['room_type'] ?></span>
                  </td>
                  <td><?= $row['details'] ?></td>
                  <td class="wsp"><?= $row['amenities'] ?></td>
                  <td>
                    <?= $row['max_persons'] ?> person(s)<br>
                    <small>₱ <?= number_format($row['pricing_type']) ?> </small>
                  </td>
                  <td>
                    <?= $row['breakfast'] ?> breakfast(s)<br>
                    <small>₱ <?= number_format($row['pricing_breakfast']) ?> </small>
                  </td>
                  <td class="action">
                    <button class="btn btn-sm btn-success updateRoomType mb-1" id='<?= json_encode($row) ?>' data-placement="top" title="Update Room Type" rel="tooltip">
                      <span class="fa fa-edit"></span>
                    </button>
                    <button class="btn btn-sm btn-primary viewImage mb-1" id='<?= base_url('assets/img/rooms/' . $row['upload_file']) ?>~<?= $row['id'] ?>' data-placement="top" title="View Room Image" rel="tooltip">
                      <span class="fa fa-image"></span>
                    </button>
                    <a href="<?= base_url('index.php/admin/deleteRoomType/' . $row['id']) ?>" class="btn btn-sm btn-danger deleteRoom confirm mb-1" data-placement="top" title="Delete Room" rel="tooltip">
                      <span class="fa fa-trash"></span>
                    </a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalRoom" tabindex="-1" role="dialog">
  <div class="modal-dialog pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Add Room Type</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('admin/addRoomType', ['id' => 'frmRoom']) ?>
        <input type="hidden" name="room_type_id">
        <div class="row">
          <div class="form-group col-md-8">
            <label>Room Type Name</label>
            <input type="text" class="form-control" name="room_type" required>
          </div>
          <div class="form-group col-md-4">
            <label>Abbreviation</label>
            <input type="text" class="form-control" name="room_type_abbr" required>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label>Room Price</label>
            <input type="number" class="form-control" name="pricing_type" required value="0" min="0">
          </div>
          <div class="form-group col-md-6">
            <label>No. of Person(s)</label>
            <input type="number" class="form-control" name="max_persons" required value="0" min="0">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label>Breakfast Price</label>
            <input type="number" class="form-control" name="pricing_breakfast" required value="0" min="0">
          </div>
          <div class="form-group col-md-6">
            <label>No. of Breakfast(s)</label>
            <input type="number" class="form-control" name="breakfast" required value="0" min="0">
          </div>
        </div>
        <div class="form-group">
          <label>Description</label>
          <textarea class="form-control" name="details" rows="4" required></textarea>
        </div>
        <div class="form-group">
          <label>Amenities</label>
          <textarea class="form-control" name="amenities" rows="5" required></textarea>
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <input type="submit" value="Add Room Type" class="btn btn-link btn-room" form="frmRoom">
        </div>
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalImage" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Update Image</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open_multipart('admin/updateRoomImage', ['id' => 'frmImage']) ?>
        <input type="hidden" name="room_type_id">
        <div class="form-group">
          <label>Room Image</label>
          <img src="<?= base_url('assets/img/placeholder.png') ?>" alt="Room Image" id="image">
          <input type="file" class="form-control" accept="image/*" name="image" required><br>
          <small id="message"></small>
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <input type="submit" value="Update Image" class="btn btn-link btn-room" form="frmImage" id="btnImage" disabled>
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
  const base_url = '<?= base_url() ?>';
  const placeholder = '<?= base_url('assets/img/placeholder.png') ?>';

  $('.checkin').click(function() {
    modalBooking(this, 'Check In');
  });

  $('#addRoomType').click(function() {
    $('.title-up').text('Add Room Type');
    $('.btn-room').val('Add')
    $('#frmRoom').attr('action', `${base_url}index.php/admin/addRoomType`).trigger('reset');
    $('#modalRoom').modal('show');
  });

  $('.updateRoomType').click(function() {
    const data = JSON.parse(this.id);
    $('.title-up').text('Update Room Type');
    $('.btn-room').val('Update');
    $('[name=room_type_id]').val(data.id);
    $('[name=room_type]').val(data.room_type);
    $('[name=room_type_abbr]').val(data.room_type_abbr);
    $('[name=pricing_type]').val(data.pricing_type);
    $('[name=pricing_breakfast]').val(data.pricing_breakfast);
    $('[name=max_persons]').val(data.max_persons);
    $('[name=breakfast]').val(data.breakfast);
    $('[name=details]').val(data.details);
    $('[name=amenities]').val(data.amenities);
    $('#frmRoom').attr('action', `${base_url}index.php/admin/updateRoomType`);
    $('#modalRoom').modal('show');
  });

  $('.viewImage').click(function() {
    const [image, room_type_id] = this.id.split('~');
    $('#image').attr('src', image.split('.').length == 2 ? image : placeholder);
    $('[name=room_type_id]').val(room_type_id);
    $('#modalImage').modal('show');
  })

  $('[name=image]').change(function() {
    const extension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
    if ($.inArray($(this).val().split('.').pop().toLowerCase(), extension) == -1) {
      $("#image").attr('src', '');
      $('#btnImage').attr('disabled', true);
      $('#message').text('File type not allowed')
    } else {
      const image = window.URL.createObjectURL(this.files[0]);
      $("#image").attr('src', image);
      $('#btnImage').removeAttr('disabled');
      $('#message').text('');
    }
  });

  $('#modalImage').on('hidden.bs.modal', function() {
    $('#btnImage').attr('disabled', true);
    $('#message').text('');
  });

  $('#modalImage').on('show.bs.modal', function() {
    $('.title-up').text('Update Image');
    $('.btn-room').val('Update Image');
  });
</script>