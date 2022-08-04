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

  <div class="row">



    <div class="col-md-8">

      <h5><b>ROOMS</b></h5>

      <div class="card ">

        <div class="card-header ">

          <div class="timeline-heading">

            <h6><b>ROOM TYPE</b></h6>

            <span class="badge badge-pill badge-danger">Update a Room Type</span>

          </div>



        </div>

        <div class="card-body ">

          <form action="<?php echo base_url() ?>index.php/admin/updatingRoomTypes" method="post" class="form-horizontal">



            <div class="row">
              <div class="col-sm-12">
                <label class="form-label">Type</label>

                <div class="form-group">

                  <input type="hidden" name="id" value="<?php echo $result_update[0]['id'] ?>">

                  <input type="text" class="form-control" name="roomtype" value="<?php echo $result_update[0]['room_type'] ?>">

                </div>

              </div>

            </div>



            <div class="row">
              <div class="col-sm-12">
                <label class="form-label">Description</label>

                <div class="form-group">

                  <input type="text" class="form-control" name="details" value="<?php echo $result_update[0]['details'] ?>" required>

                </div>

              </div>

            </div>











            <div class="row">
              <div class="col-sm-12">
                <label class="form-label">Amenities</label>

                <div class="form-group">

                  <textarea class="form-control" name="amenities"><?php echo $result_update[0]['amenities'] ?></textarea>

                </div>

              </div>

            </div>















            <div class="card-footer ">

              <div class="row">

                <label class="col-sm-2 col-form-label"></label>

                <div class="col-md-12">

                  <input type="submit" class="btn btn-success" value="Update">

                  <input type="reset" class="btn btn-info " value="Clear">

                  <!-- <button type="submit" class="btn btn-info btn-round">Sign in</button> -->

                </div>

              </div>

            </div>





          </form>

        </div>

      </div>

    </div>





    <!-- image -->



    <div class="col-md-4">
      <h5>&nbsp;</h5>
      <div class="card ">

        <div class="card-header ">

          <div class="timeline-heading">

          </div>



        </div>

        <div class="card-body ">

          <form action="<?php echo base_url() ?>index.php/admin/updateRoomTypeImage" method="post" class="form-horizontal" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?php echo $result_update[0]['id'] ?>">

            <div class="row">
              <div class="col-sm-12">
                <label class="form-label">Image</label>

                <div class="form-group">

                  <div class="fileinput fileinput-new text-center" data-provides="fileinput" style="width:250; height:250">

                    <div class="fileinput-new thumbnail">

                      <img src="<?php echo base_url() ?>uploaded_files/<?php echo $result_update[0]['upload_file'] ?>" alt="files" width="250" height="250">

                    </div>

                    <div class="fileinput-preview fileinput-exists thumbnail"></div>

                    <div>

                      <span class="btn btn-rose btn-round btn-file">

                        <span class="fileinput-new">Choose image</span>

                        <span class="fileinput-exists">Change</span>

                        <input type="file" name="files" required>

                      </span>

                      <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>

                    </div>

                  </div>

                </div>





















                <div class="card-footer ">

                  <div class="row">

                    <label class="col-sm-2 col-form-label"></label>

                    <div class="col-md-12">

                      <input type="submit" class="btn btn-success" value="Update">

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

</div>

</div>





<!-- end image -->



<div class="row">

  <div class="col-md-12">

    <div class="card">

      <div class="card-header">

        <span class="badge badge-pill badge-danger">List of Room Types</span>

      </div>

      <div class="card-body">

        <div class="toolbar">

          <!--        Here you can write extra buttons/actions for the toolbar              -->

        </div>

        <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">

          <thead>

            <tr>
              <th>Room Type</th>
              <th>Image</th>
              <th>Description</th>
              <th>Amenities</th>
              <th class="disabled-sorting text-right">
                <center>Actions</center>
              </th>
            </tr>

          </thead>

          <tbody>

            <?php foreach ($result_roomtype as $data) {

              # code...

            ?>

              <tr>

                <td class="td-actions text-center"><?php echo $data['room_type'] ?></td>

                <td class="td-actions text-center"><img src="<?php echo base_url() ?>uploaded_files/<?php echo $data['upload_file'] ?>" width="200" height="200"></td>

                <td width="30%"><?php echo $data['details'] ?></td>
                <td width="30%"><?php echo $data['amenities'] ?></td>

                <td class="td-actions text-center">
                  <a href="<?php echo base_url('index.php/admin/updateRoomtype/' . $data['id']) ?>" data-placement="top" title="Update" rel="tooltip" class="btn btn-info btn-icon"><i class="fa fa-edit"></i></a>

                  <!-- <a id="<?php echo base_url('index.php/admin/deleteRoomType/' . $data['id']) ?>" data-placement="top" title="Delete" rel="tooltip" class="delete btn btn-danger btn-icon text-light"><i class="fa fa-times"></i></a> -->
                </td>

              </tr>

            <?php } ?>

          </tbody>

          <tbody>





          </tbody>

        </table>

      </div>

      <!-- end content-->

    </div>

    <!--  end card  -->

  </div>

  <!-- end col-md-12 -->

</div>

<!-- end row -->

</div>