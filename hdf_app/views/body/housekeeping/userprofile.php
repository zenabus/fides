<?php if (validation_errors()) : ?>
  <script>
    $(document).ready(function() {
      demo.showNotification_error('top', 'right');
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
  <h5><b>ACCOUNT DETAILS</b></h5>
  <div class="row">

    <div class="col-md-6">
      <div class="card ">
        <div class="card-header ">
          <div class="timeline-heading">
            <h6><b>USER'S PROFILE</b></h6>
            <!-- <span class="badge badge-pill badge-danger">User Profile</span> -->
          </div>

        </div>
        <div class="card-body ">
          <form action="<?php echo base_url() ?>index.php/main/HousekeepingUpdateProfileDetails" method="post" class="form-horizontal">




            <div class="row">
              <div class="col-sm-12">
                <label class="form-label">Type</label>
                <div class="form-group">
                  <input type="text" class="form-control" value="<?php echo $get_user[0]['user_type'] ?>" disabled>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-sm-12">
                <label class="form-label">Full Name</label>
                <div class="form-group">
                  <input type="text" class="form-control" name="full_name" value="<?php echo $get_user[0]['name'] ?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <label class="form-label">Contact Number</label>
                <div class="form-group">
                  <input type="text" class="form-control" name="contact" value="<?php echo $get_user[0]['contact'] ?>" required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <label class="form-label">E-mail</label>
                <div class="form-group">
                  <input type="text" class="form-control" name="email" value="<?php echo $get_user[0]['email'] ?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <label class="form-label">Username</label>
                <div class="form-group">
                  <input type="text" class="form-control" name="username" value="<?php echo $get_user[0]['username'] ?>" required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <label class="form-label">Password</label>
                <div class="form-group">
                  <input type="text" class="form-control" name="password" value="<?php echo $get_user[0]['password'] ?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <label class="form-label">Confirm Password</label>
                <div class="form-group">
                  <input type="text" class="form-control" name="password" value="<?php echo $get_user[0]['password'] ?>">
                </div>
              </div>
            </div>










            <div class="card-footer ">
              <div class="row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-md-12">
                  <input type="submit" class="btn btn-success" value="Save">
                  <input type="reset" class="btn btn-info " value="Clear">
                  <!-- <button type="submit" class="btn btn-info btn-round">Sign in</button> -->
                </div>
              </div>
            </div>


          </form>
        </div>
      </div>
    </div>



    <div class="col-md-5">
      <div class="card ">
        <div class="card-header ">
          <div class="timeline-heading">
            <h6><b>PROFILE PICTURE</b></h6>
            <!-- <span class="badge badge-pill badge-danger">Change Profile Picture</span> -->
          </div>

        </div>
        <div class="card-body ">
          <form action="<?php echo base_url() ?>index.php/main/HousekeepingUploadImage" method="post" enctype="multipart/form-data" class="form-horizontal">
            <center>
              <div class="col-md-12">
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                  <div class="fileinput-new thumbnail">
                    <img src="<?php echo base_url() ?>uploaded_files/<?php echo $get_user[0]['image_source'] ?>" alt="files">
                  </div>
                  <div class="fileinput-preview fileinput-exists thumbnail"></div>
                  <div>
                    <span class="btn btn-rose btn-round btn-file">
                      <span class="fileinput-new">Choose image</span>
                      <span class="fileinput-exists">Change</span>
                      <input type="file" name="files" />
                    </span>
                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                  </div>
                </div>
              </div>
            </center>
            <div class="card-footer ">
              <div class="row">
                <div class="col-md-12">
                  <input type="submit" class="btn btn-success" value="Save"> &nbsp;
                  <input type="reset" class="btn btn-info " value="Clear">
                  <!-- <button type="submit" class="btn btn-info btn-round">Sign in</button> -->

                </div>
              </div>


          </form>
        </div>
      </div>
    </div>
  </div>