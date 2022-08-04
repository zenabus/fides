<div class="content pb-0">
  <div class="row">
    <div class="col-md-6">
      <h5><b>USERS</b></h5>
      <div class="card ">
        <div class="card-header ">
          <div class="timeline-heading">
            <span class="badge badge-pill badge-danger">Add a User</span>
          </div>
        </div>
        <div class="card-body ">
          <form action="<?php echo base_url() ?>index.php/admin/insertUser" method="post" class="form-horizontal">
            <div class="row">
              <div class="col-sm-12">
                <label class="form-label">Type</label>
                <div class="form-group">
                  <select class="form-control" required name="user_type">
                    <option value="">Select</option>
                    <option>Coffee Shop</option>
                    <option>Front Desk</option>
                    <option>Housekeeping</option>
                    <option>Restaurant</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <label class="form-label">Full Name</label>
                <div class="form-group">
                  <input type="text" class="form-control" name="full_name" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <label class="form-label">Contact Number</label>
                <div class="form-group">
                  <input type="text" class="form-control" name="contact" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <label class="form-label">E-mail</label>
                <div class="form-group">
                  <input type="text" class="form-control" name="email" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <label class="form-label">Username</label>
                <div class="form-group">
                  <input type="text" class="form-control" name="username" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <label class="form-label">Default Password</label>
                <div class="form-group">
                  <input type="text" class="form-control" name="password" disabled value="hoteldefides<?= date('Y') ?>">
                </div>
              </div>
            </div>
            <div class="card-footer ">
              <div class="row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-md-12">
                  <input type="submit" class="btn btn-success" value="Add">
                  <input type="reset" class="btn btn-info " value="Clear">
                  <!-- <button type="submit" class="btn btn-info btn-round">Sign in</button> -->
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <span class="badge badge-pill badge-danger">List of Users</span>
        </div>
        <div class="card-body">
          <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Full Name</th>
                <th>User Type</th>
                <th>Username</th>
                <th>Password</th>
                <th>Contact</th>
                <th>E-mail</th>
                <th>Status</th>
                <th class="disabled-sorting text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($result_users as $data) { ?>
                <?php if ($data['user_type'] == 'superadmin') { ?>
                <?php } else { ?>
                  <tr>
                    <td><?php echo $data['name'] ?></td>
                    <td><?php echo $data['user_type'] ?></td>
                    <td><?php echo $data['username'] ?></td>
                    <td><?php echo $data['password'] ?></td>
                    <td><?php echo $data['contact'] ?></td>
                    <td><?php echo $data['email'] ?></td>
                    <td><?php echo $data['status'] ?></td>
                    <td class="td-actions text-center">
                      <a href="<?php echo base_url('index.php/admin/updateUser/' . $data['id']) ?>" data-placement="top" title="Update" rel="tooltip" class="btn btn-info btn-icon btn-sm"><i class="fa fa-edit"></i></a>
                      <a href="<?php echo base_url('index.php/admin/changeToActive/' . $data['id']) ?>" data-placement="top" title="Active" rel="tooltip" type="button" class=" btn btn-success btn-icon btn-sm text-light"><i class="fa fa-check"></i></a>
                      <a href="<?php echo base_url('index.php/admin/changeToInActive/' . $data['id']) ?>" data-placement="top" title="In Active" rel="tooltip" type="button" class=" btn btn-warning btn-icon btn-sm text-light"><i class="fa fa-times"></i></a>
                      <a id="<?php echo base_url('index.php/admin/deleteUsers/' . $data['id']) ?>" data-placement="top" title="Delete" rel="tooltip" type="button" class="delete btn btn-danger btn-icon btn-sm text-light"><i class="fa fa-times"></i></a>
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