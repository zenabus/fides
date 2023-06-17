<div class="content pb-0">
  <h5>Extras & Charges</h5>
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-header px-4 pt-4 d-flex justify-content-between align-items-center">
          <h6>Categories</h6>
          <button class="btn btn-sm mb-2 mt-0 addCategory">Add Category</button>
        </div>
        <div class="card-body px-0 py-2">
          <table class="table table-bordered border-right-0 border-left-0">
            <thead>
              <tr>
                <th class="pl-4">Category</th>
                <th width="100px">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!count($categories)) { ?>
                <tr>
                  <td colspan="2" class="text-center">No record found</td>
                </tr>
              <?php } ?>
              <?php foreach ($categories as $row) { ?>
                <tr>
                  <td class="border-left-0 pl-4"><?= $row['category'] ?></td>
                  <td class="border-right-0 action">
                    <a href="javascript:" class="btn btn-success btn-sm updateCategory" id='<?= json_encode($row) ?>' data-placement="top" title="Update Category" rel="tooltip">
                      <span class="fa fa-edit"></span>
                    </a>
                    <?php if ($_SESSION['user_type'] == 'Superadmin') { ?>
                      <a href="<?= base_url('index.php/admin/deleteCategory/' . $row['category_id']) ?>" class="btn btn-danger btn-sm confirm" data-placement="top" title="Delete Category" rel="tooltip">
                        <span class="fa fa-trash"></span>
                      </a>
                    <?php } ?>
                  </td>
                </tr>
              <?php }  ?>
            </tbody>
          </table>
        </div>
      </div>

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
                <td class="pl-4">Bed</td>
                <td>₱ <?= number_format($bed->price) ?></td>
                <td class="action">
                  <a href="javascript:" class="btn btn-success btn-sm updateExtra" id='<?= json_encode($bed) ?>' data-placement="top" title="Update Extra Bed Price" rel="tooltip">
                    <span class="fa fa-edit"></span>
                  </a>
                </td>
              </tr>
              <tr>
                <td class="pl-4">Person</td>
                <td>₱ <?= number_format($person->price) ?></td>
                <td class="action">
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
    <div class="col-md-8">
      <div class="card">
        <div class="card-header px-4 pt-4 d-flex justify-content-between align-items-center">
          <h6>Charges</h6>
          <button class="btn btn-sm mb-2 mt-0 addCharge">Add Charge</button>
        </div>
        <div class="card-body px-0 py-2">
          <table class="table table-bordered border-right-0 border-left-0">
            <thead>
              <tr>
                <th class="pl-4">Charge Name</th>
                <th>Amount</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!count($charges)) { ?>
                <tr>
                  <td colspan="4" class="text-center">No record found</td>
                </tr>
              <?php } ?>
              <?php $category = ''; ?>
              <?php foreach ($charges as $row) { ?>
                <?php if ($category != $row['category']) { ?>
                  <td colspan="4" class="text-center p-0 bg-default"><small class="text-white"><?= $row['category'] ?></small></td>
                <?php } ?>
                <tr>
                  <td class="border-left-0 pl-4"><?= $row['charge'] ?></td>
                  <td>₱ <?= number_format($row['charge_amount']) ?></td>
                  <td class="border-right-0 action">
                    <a href="javascript:" class="btn btn-success btn-sm updateCharge" id='<?= json_encode($row) ?>' data-placement="top" title="Update Charge" rel="tooltip">
                      <span class="fa fa-edit"></span>
                    </a>
                    <?php if ($_SESSION['user_type'] == 'Superadmin') { ?>
                      <a href="<?= base_url('index.php/admin/deleteCharge/' . $row['charge_id']) ?>" class="btn btn-danger btn-sm confirm" data-placement="top" title="Delete Charge" rel="tooltip">
                        <span class="fa fa-trash"></span>
                      </a>
                    <?php } ?>
                  </td>
                </tr>
                <?php $category = $row['category'] ?>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalCategory" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up title-category">Add Category</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('admin/addCategory', ['id' => 'frmCategory']) ?>
        <input type="hidden" name="category_id">
        <div class="form-group">
          <label>Charge Category</label>
          <input type="text" class="form-control" required name="category">
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <button type="submit" class="btn btn-link btn-category" form="frmCategory">Add</button>
        </div>
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalCharge" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up title-charge">Add Charge</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('admin/addCharge', ['id' => 'frmCharge']) ?>
        <input type="hidden" name="charge_id">
        <div class="form-group">
          <label>Category</label>
          <select name="category_id" class="form-control" required>
            <option value="">- select category -</option>
            <?php foreach ($categories as $row) { ?>
              <option value="<?= $row['category_id'] ?>"><?= $row['category'] ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label>Charge Name</label>
          <input type="text" class="form-control" required name="charge">
        </div>
        <div class="form-group">
          <label>Amount</label>
          <input type="number" class="form-control" required name="charge_amount" value="0" min="0">
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <button type="submit" class="btn btn-link btn-charge" form="frmCharge">Add</button>
        </div>
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
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

<script src="<?= base_url() ?>assets/demo/demo.js"></script>

<script>
  const base_url = '<?= base_url() ?>';

  $('.addCategory').click(function() {
    $('#modalCategory').modal('show');
    $('#frmCategory').attr('action', `${base_url}index.php/admin/addCategory`).trigger('reset');
    $('.title-category').text('Add Category');
    $('.btn-category').text('Add');
  });

  $('.updateCategory').click(function() {
    const data = JSON.parse(this.id);
    $('[name=category_id]').val(data.category_id);
    $('[name=category]').val(data.category);
    $('#frmCategory').attr('action', `${base_url}index.php/admin/updateCategory`);
    $('.title-category').text('Update Category');
    $('.btn-category').text('Update');
    $('#modalCategory').modal('show');
  });

  $('.addCharge').click(function() {
    $('#modalCharge').modal('show');
    $('#frmCharge').attr('action', `${base_url}index.php/admin/addCharge`).trigger('reset');
    $('.title-charge').text('Add Charge');
    $('.btn-charge').text('Add');
  });

  $('.updateCharge').click(function() {
    const data = JSON.parse(this.id);
    $('[name=charge_id]').val(data.charge_id);
    $('[name=category_id]').val(data.category_id);
    $('[name=charge]').val(data.charge);
    $('[name=charge_amount]').val(data.charge_amount);
    $('#frmCharge').attr('action', `${base_url}index.php/admin/updateCharge`);
    $('.title-charge').text('Update Charge');
    $('.btn-charge').text('Update');
    $('#modalCharge').modal('show');
  });

  $('.updateExtra').click(function() {
    const data = JSON.parse(this.id);
    $('.title-extra').text('Extra ' + data.description);
    $('[name=price_id]').val(data.price_id);
    $('[name=price]').val(Math.round(data.price));
    $('#modalExtra').modal('show');
  });
</script>