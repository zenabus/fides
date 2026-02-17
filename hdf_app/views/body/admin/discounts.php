<div class="content pb-0">
  <h5>Discounts</h5>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header px-4 pt-4 d-flex justify-content-between align-items-center">
          <h6>Discounts</h6>
          <button class="btn btn-sm mb-2 mt-0 addDiscount">Add Discount</button>
        </div>
        <div class="card-body px-0 py-2">
          <table class="table table-bordered border-right-0 border-left-0">
            <thead>
              <tr>
                <th class="pl-4">Discount Type</th>
                <th>Percentage / Formula</th>
                <th>Using Formula</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($discounts as $row) {
                if ($row['discount_type'] == 'N/A') {
              ?>
                  <tr>
                    <td class="border-left-0 pl-4"><?= $row['discount_type'] ?></td>
                    <td>0</td>
                    <td></td>
                    <td class="border-right-0"></td>
                  </tr>
              <?php }
              } ?>
              <?php foreach ($discounts as $row) {
                if ($row['discount_type'] != 'N/A') {
              ?>
                  <tr>
                    <td class="border-left-0 pl-4"><?= $row['discount_type'] ?></td>
                    <td><?= $row['percentage'] ?><?= $row['using_formula'] ? '' : '%' ?></td>
                    <td><?= $row['using_formula'] ? '✔️' : '' ?></td>
                    <td class="border-right-0 action">
                      <?php if ($row['using_formula']) { ?>
                        <?php if ($_SESSION['user_type'] == 'Superadmin') { ?>
                          <a href="javascript:" class="btn btn-success btn-sm updateDiscount" id='<?= json_encode($row) ?>' data-placement="top" title="Update Discount" rel="tooltip">
                            <span class="fa fa-edit"></span>
                          </a>
                          <a href="<?= base_url('index.php/admin/deleteDiscount/' . $row['discount_id']) ?>" class="btn btn-danger btn-sm confirm" data-placement="top" title="Delete Discount" rel="tooltip">
                            <span class="fa fa-trash"></span>
                          </a>
                        <?php }
                      } else { ?>
                        <a href="javascript:" class="btn btn-success btn-sm updateDiscount" id='<?= json_encode($row) ?>' data-placement="top" title="Update Discount" rel="tooltip">
                          <span class="fa fa-edit"></span>
                        </a>
                        <a href="<?= base_url('index.php/admin/deleteDiscount/' . $row['discount_id']) ?>" class="btn btn-danger btn-sm confirm" data-placement="top" title="Delete Discount" rel="tooltip">
                          <span class="fa fa-trash"></span>
                        </a>
                      <?php } ?>
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

<div class="modal fade" id="modalDiscount" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Add Discount</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('admin/addDiscount', ['id' => 'frmDiscount']) ?>
        <input type="hidden" name="discount_id">
        <div class="form-group">
          <label>Discount Type</label>
          <input type="text" class="form-control" required name="discount_type">
        </div>
        <div class="form-group">
          <label>Percentage / Formula</label>
          <input type="text" class="form-control" required name="percentage">
        </div>
        <div class="form-group">
          <div class="form-check">
            <label class="form-check-label">
              <input class="form-check-input" type="checkbox" name="using_formula">
              <span class="form-check-sign"></span>
              Use Formula
            </label>
          </div>
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <button type="submit" class="btn btn-link btn-discount" form="frmDiscount">Add Discount</button>
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

  $('.addDiscount').click(function() {
    $('.title-up').text('Add Discount');
    $('.btn-discount').val('Add Discount');
    $('#frmDiscount').attr('action', `${base_url}index.php/admin/addDiscount`).trigger('reset');
    $('[name=using_formula]').attr('checked', false);
    $('#modalDiscount').modal('show');
  });

  $('.updateDiscount').click(function() {
    const data = JSON.parse(this.id);
    $('#frmDiscount').attr('action', `${base_url}index.php/admin/updateDiscount`);
    $('.title-up').text('Update Discount');
    $('.btn-discount').text('Update');
    $('[name=discount_id]').val(data.discount_id);
    $('[name=discount_type]').val(data.discount_type);
    $('[name=percentage]').val(data.percentage);
    $('[name=using_formula]').attr('checked', data.using_formula == '1' ? true : false);
    $('#modalDiscount').modal('show');
  });

  $('[name=using_formula]').change(function() {
    $('[name=percentage]').attr('type', this.checked ? 'text' : 'number');
  });
</script>