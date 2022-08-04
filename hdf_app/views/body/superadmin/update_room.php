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

<?php if ($this->session->flashdata('error')) : ?>

  <script>
    $(document).ready(function() {

      demo.showNotification_error('top', 'right');
    });
  </script>

<?php endif; ?>



<div class="content pb-0">

  <div class="row">



    <div class="col-md-6">

      <h5><b>ROOMS</b></h5>

      <div class="card ">

        <div class="card-header ">

          <div class="timeline-heading">

            <h6><b>ROOM LIST</b></h6>

            <span class="badge badge-pill badge-danger">Update a Room</span>

          </div>



        </div>

        <div class="card-body ">

          <form action="<?php echo base_url() ?>index.php/admin/updatingRoom" method="post" class="form-horizontal">

            <input type="hidden" name="id" value="<?php echo $result_rooms_by_id[0]['id'] ?>">



            <div class="row">
              <div class="col-sm-12">
                <label class="form-label">Type</label>

                <div class="form-group">

                  <select class="form-control" required name="room_type_id">

                    <option value="<?php echo $result_rooms_by_id[0]['room_type_id'] ?>"><?php echo $result_rooms_by_id[0]['room_type'] ?></option>

                    <?php foreach ($result_roomtype as $data) {

                      # code...

                    ?>

                      <option value="<?php echo $data['id'] ?>"><?php echo $data['room_type'] ?></option>

                    <?php } ?>

                  </select>

                </div>

              </div>

            </div>





            <div class="row">
              <div class="col-sm-12">
                <label class="form-label">Number</label>

                <div class="form-group">

                  <input type="number" class="form-control" name="room_number" value="<?php echo $result_rooms_by_id[0]['room_number'] ?>">

                </div>

              </div>

            </div>



            <div class="row">
              <div class="col-sm-12">
                <label class="form-label">Number of Person(s)</label>

                <div class="form-group">

                  <input type="number" class="form-control" name="person" value="<?php echo $result_rooms_by_id[0]['persons'] ?>">

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



  <div class="row">

    <div class="col-md-12">

      <div class="card">

        <div class="card-header">

          <span class="badge badge-pill badge-danger">List of Room(s)</span>

        </div>

        <div class="card-body">

          <div class="toolbar">

            <!--        Here you can write extra buttons/actions for the toolbar              -->

          </div>

          <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">

            <thead>

              <tr>

                <th>Room #</th>

                <th>Room Type</th>

                <th># of Person(s)</th>

                <th>Modified</th>

                <!-- <th>Status</th> -->



                <th class="disabled-sorting text-right">
                  <center>Actions</center>
                </th>

              </tr>

            </thead>

            <tbody>

              <?php foreach ($result_rooms as $data) {

                # code...

              ?>

                <tr>

                  <td><?php echo $data['room_number'] ?></td>

                  <td><?php echo $data['room_type'] ?></td>

                  <td><?php echo $data['persons'] ?></td>

                  <td><?php echo $data['date_modified'] ?></td>

                  <!-- <td><?php echo $data['status'] ?></td> -->

                  <td class="td-actions text-center">

                    <!--<center>-->

                    <a href="<?php echo base_url('index.php/admin/updateRoom/' . $data['id']) ?>" data-placement="top" title="Update" rel="tooltip" class="btn btn-info btn-icon btn-sm"><i class="fa fa-edit"></i></a>

                    <a id="<?php echo base_url('index.php/admin/deleteRoom/' . $data['id']) ?>" data-placement="top" title="Delete" rel="tooltip" class="delete btn btn-danger btn-icon btn-sm text-light"><i class="fa fa-times"></i></a>

                    <!--</center>-->

                  </td>

                </tr>

              <?php } ?>





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