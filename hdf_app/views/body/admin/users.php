<div class="content pb-0">
  <h5>Users</h5>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center border-bottom px-4 pb-2">
          <h6>Users</h6>
          <button class="btn btn-sm mb-2 mt-0 addUser">Add User</button>
        </div>
        <div class="card-body">
          <table class="table table-striped table-bordered tbl_user">
            <thead>
              <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Contact Details</th>
                <th>Last Login</th>
                <th width="110px">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $row) {
                if ($row['id'] == 1) continue;
              ?>
                <tr>
                  <td>
                    <?= $row['name'] ?><br>
                    <small><?= ucfirst(strtolower($row['status'])) ?></small>
                  </td>
                  <td>
                    <?= $row['username'] ?><br>
                    <small><?= $row['user_type'] ?></small>
                  </td>
                  <td>
                    <?= $row['contact'] ?><br>
                    <small><?= $row['email'] ?></small>
                  </td>
                  <td>
                    <?php
                    if ($row['last_login']) {
                      $date_time = date_create($row['last_login']);
                      $date_time = date_format($date_time, "M d, Y h:i a");
                    }
                    ?>
                    <?php if ($row['last_login']) { ?>
                      <?= ucfirst($row['last_login_ago']) ?><br>
                      <small><?= $date_time ?></small>
                    <?php } ?>
                  </td>
                  <td class="border-right-0 action">
                    <a href="<?= base_url('index.php/main/user/' . $row['id']) ?>" class="btn btn-sm mb-1" data-placement="top" title="View User" rel="tooltip">
                      <span class="fa fa-eye"></span>
                    </a>
                    <a href="javascript:" class="btn btn-success btn-sm mb-1 updateUser" id='<?= json_encode($row) ?>' data-placement="top" title="Update User" rel="tooltip">
                      <span class="fa fa-edit"></span>
                    </a>
                    <a href="<?= base_url('index.php/admin/resetPassword/' . $row['id']) ?>" class="btn btn-info btn-sm mb-1 reset" data-placement="top" title="Reset User Password" rel="tooltip">
                      <span class="fa fa-refresh"></span>
                    </a>
                    <?php if ($row['status'] == 'Active') { ?>
                      <a href="<?= base_url('index.php/admin/changeStatus/' . $row['id'] . '/InActive') ?>" class="btn btn-danger btn-sm mb-1 confirm" data-placement="top" title="Deactivate User" rel="tooltip">
                        <span class="fa fa-times"></span>
                      </a>
                    <?php } else { ?>
                      <a href="<?= base_url('index.php/admin/changeStatus/' . $row['id'] . '/Active') ?>" class="btn btn-primary btn-sm mb-1 confirm" data-placement="top" title="Activate User" rel="tooltip">
                        <span class="fa fa-check"></span>
                      </a>
                    <?php } ?>
                  </td>
                </tr>
              <?php }  ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalUser" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up title-user">Add User</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('admin/addUser', ['id' => 'frmUser']) ?>
        <input type="hidden" name="user_id">
        <div class="form-group">
          <label>User Type</label>
          <select name="user_type" class="form-control" required>
            <option value="">- select category -</option>
            <option value="Superadmin">Super Administrator</option>
            <option value="Admin">Administrator</option>
            <option value="Front Desk">Front Desk</option>
            <option value="Housekeeping">Housekeeping</option>
            <!-- <option value="Restaurant">Restaurant</option>
            <option value="Coffee Shop">Coffee Shop</option> -->
          </select>
        </div>
        <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" required name="username">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" required name="password">
        </div>
        <div class="form-group">
          <label>Full Name</label>
          <input type="text" class="form-control" required name="name">
        </div>
        <div class="form-group">
          <label>Contact Number</label>
          <input type="text" class="form-control" required name="contact">
          <small class="text-muted" id="txt-contact"></small>
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" class="form-control" required name="email">
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <button type="submit" class="btn btn-link title-user" form="frmUser">Add User</button>
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

  $(document).ready(function() {
    $('.tbl_user').dataTable();
  });

  $('.addUser').click(function() {
    $('#modalUser').modal('show');
    $('#frmUser').attr('action', `${base_url}index.php/admin/addUser`).trigger('reset');
    $('[name=password]').attr('required', true).parent().show();
    $('.title-user').text('Add User');
    $('.btn-user').text('Add User');
  });

  $('.updateUser').click(function() {
    const data = JSON.parse(this.id);
    $('[name=user_id]').val(data.id);
    $('[name=user_type]').val(data.user_type);
    $('[name=username]').val(data.username);
    $('[name=name]').val(data.name);
    $('[name=contact]').val(data.contact);
    $('[name=email]').val(data.email);
    $('[name=password]').removeAttr('required').parent().hide();
    $('#frmUser').attr('action', `${base_url}index.php/admin/updateUser`);
    $("#txt-contact").text(`${data.contact.length} digits`);
    $('.title-user').text('Update User');
    $('.btn-user').text('Update User');
    $('#modalUser').modal('show');
  });

  $("#modalUser").on("hide.bs.modal", function(e) {
    $("#txt-contact").text("");
  });
</script>