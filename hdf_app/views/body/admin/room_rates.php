<div class="content pb-0">
  <h5>Room Rates & Extras</h5>
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header px-4 pt-4 d-flex justify-content-between align-items-center">
          <h6>Room Rates</h6>
        </div>
        <div class="card-body px-0 py-2">
          <table class="table table-bordered border-right-0 border-left-0">
            <thead>
              <tr>
                <th class="pl-4">Room Type</th>
                <th>Room Rate</th>
                <th>Breakfast Rate</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($room_types as $row) { ?>
                <tr>
                  <td class="border-left-0 pl-4"><?= $row['room_type'] ?></td>
                  <td>₱ <?= number_format($row['pricing_type']) ?></td>
                  <td>₱ <?= number_format($row['pricing_breakfast']) ?></td>
                  <td class="border-right-0 action">
                    <a href="javascript:" class="btn btn-success btn-sm updateRate" id='<?= json_encode($row) ?>' data-placement="top" title="Update Room Rate" rel="tooltip">
                      <span class="fa fa-edit"></span>
                    </a>
                  </td>
                </tr>
              <?php }  ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-header px-4 pt-4 d-flex justify-content-between align-items-center">
          <h6>Bed & Person</h6>
        </div>
        <div class="card-body px-0 py-2">
          <table class="table table-bordered border-right-0 border-left-0">
            <thead>
              <tr>
                <th class="pl-4">Extra</th>
                <th>Price</th>
                <th width="100px">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="pl-4 border-left-0">Bed</td>
                <td>₱ <?= number_format($bed->price) ?></td>
                <td class="action border-right-0">
                  <a href="javascript:" class="btn btn-success btn-sm updateExtra" id='<?= json_encode($bed) ?>' data-placement="top" title="Update Extra Bed Price" rel="tooltip">
                    <span class="fa fa-edit"></span>
                  </a>
                </td>
              </tr>
              <tr>
                <td class="pl-4 border-left-0">Person</td>
                <td>₱ <?= number_format($person->price) ?></td>
                <td class="action border-right-0">
                  <a href="javascript:" class="btn btn-success btn-sm updateExtra" id='<?= json_encode($person) ?>' data-placement="top" title="Update Extra Person Price" rel="tooltip">
                    <span class="fa fa-edit"></span>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalExtra" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up title-extra">Extra Bed</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('admin/updateExtra', ['id' => 'frmExtra']) ?>
        <input type="hidden" name="price_id">
        <div class="form-group">
          <label>Price</label>
          <input type="number" class="form-control" required name="price">
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <button type="submit" class="btn btn-link" form="frmExtra">Update Price</button>
        </div>
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalRates" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Update Rate</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('admin/updateRoomType', ['id' => 'frmRates']) ?>
        <input type="hidden" name="room_type_id">
        <div class="form-group">
          <label>Room Type</label>
          <input type="text" class="form-control" id="room_type" readonly>
        </div>
        <div class="form-group">
          <label>Room Rate</label>
          <input type="number" class="form-control" required name="pricing_type">
        </div>
        <div class="form-group">
          <label>Breakfast Rate</label>
          <input type="number" class="form-control" required name="pricing_breakfast">
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <button type="submit" class="btn btn-link" form="frmRates">Update Price</button>
        </div>
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url() ?>assets/demo/demo.js"></script>

<script>
  const base_url = '<?= base_url() ?>';

  $('.updateExtra').click(function() {
    const data = JSON.parse(this.id);
    $('.title-extra').text('Extra ' + data.description);
    $('[name=price_id]').val(data.price_id);
    $('[name=price]').val(Math.round(data.price));
    $('#modalExtra').modal('show');
  });

  $('.updateRate').click(function() {
    const data = JSON.parse(this.id);
    $('#room_type').val(data.room_type);
    $('[name=room_type_id]').val(data.id);
    $('[name=pricing_type]').val(data.pricing_type);
    $('[name=pricing_breakfast]').val(data.pricing_breakfast);
    $('#modalRates').modal('show');
  });
</script>