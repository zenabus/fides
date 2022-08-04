<div class="content pb-0">
  <h5>Account Details</h5>
  <div class="row">
    <div class="col-md-5">
      <div class="card">
        <div class="card-header px-4 pt-4">
          <h6>User Profile</h6>
          <hr>
        </div>
        <?= form_open('main/FrontdeskUpdateProfileDetails', ['id' => 'frmProfile']) ?>
        <div class="card-body px-4 py-0">
          <div class="form-group">
            <label class="form-label">User Role</label>
            <input type="text" class="form-control" value="<?= $profile->user_type ?>" readonly>
          </div>
          <div class="form-group">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" name="username" value="<?= $profile->username ?>" readonly>
          </div>
          <div class="form-group">
            <label class="form-label">Full Name</label>
            <input type="text" class="form-control" name="name" value="<?= $profile->name ?>" required>
          </div>
          <div class="form-group">
            <label class="form-label">Contact Number</label>
            <input type="text" class="form-control" name="contact" value="<?= $profile->contact ?>" required>
          </div>
          <div class="form-group">
            <label class="form-label">E-mail</label>
            <input type="text" class="form-control" name="email" value="<?= $profile->email ?>">
          </div>
        </div>
        <div class="card-footer pb-4 px-4 pt-0">
          <hr>
          <input type="submit" class="btn btn-default" value="Save Profile">
          <input type="reset" class="btn btn-primary" value="Reset">
        </div>
        <?= form_close() ?>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card" style="min-height:534px">
        <div class="card-header px-4 pt-4">
          <h6>Profile Picture</h6>
          <hr>
        </div>
        <div class="card-body px-4 py-0">
          <?= form_open_multipart('main/frontdeskUploadImage') ?>
          <div class="fileinput fileinput-new text-center mb-0 w-100" data-provides="fileinput">
            <div class="fileinput-new thumbnail">
              <img src="<?= base_url() ?>uploaded_files/<?= $profile->image_source ?>" alt="files">
            </div>
            <div class="fileinput-preview fileinput-exists thumbnail"></div>
            <div>
              <span class="btn btn-info btn-round btn-file">
                <span class="fileinput-new">Choose image</span>
                <span class="fileinput-exists">Change</span>
                <input type="file" name="files" />
              </span>
              <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
            </div>
          </div>
          <?= form_close() ?>
        </div>
        <div class="card-footer pb-4 px-4 pt-0">
          <hr>
          <input type="submit" class="btn btn-default" value="Save Image">
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card" style="min-height:534px">
        <div class="card-header px-4 pt-4">
          <h6>Change Password</h6>
          <hr>
        </div>
        <div class="card-body px-4 py-0">
          <?= form_open('main/changePassword', ['id' => 'frmChangePassword']) ?>
          <div class="form-group">
            <label class="form-label">Old Password</label>
            <input type="password" class="form-control" name="old_password" required>
          </div>
          <div class="form-group">
            <label class="form-label">New Password</label>
            <input type="password" class="form-control" name="password" required>
          </div>
          <div class="form-group">
            <label class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="confirm_password" required>
          </div>
          <?= form_close() ?>
        </div>
        <div class="card-footer pb-4 px-4 pt-0">
          <hr>
          <input type="submit" class="btn btn-default" value="Change Password" form="frmChangePassword">
          <input type="reset" class="btn btn-primary " value="Clear" form="frmChangePassword">
        </div>
      </div>
    </div>
  </div>