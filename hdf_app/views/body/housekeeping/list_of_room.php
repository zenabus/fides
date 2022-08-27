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
  <h5><b>ROOMS</b></h5>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h6><b>ROOM LIST(S)</b></h6>
          <!-- <span class="badge badge-pill badge-danger">List of Rooms  </span>  -->
        </div>
        <div class="card-body">
          <div class="toolbar">
            <!--        Here you can write extra buttons/actions for the toolbar              -->
          </div>
          <table id="datatable" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th class="disabled-sorting">Room #</th>
                <th>Room Type</th>
                <th class="text-center">Status</th>
                <th class="enable-sorting text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($room_result as $data) {

                # code...select * ,room_types_booking.name as room_type from rooms_booking inner join room_types_booking on rooms_booking.type= room_types_booking.id inner join room_statuses on rooms_booking.status = room_statuses.id
                if ($data['room_type'] == 'ER') {
                  $type = 'Executive Room ';
                } elseif ($data['room_type'] == 'DT') {
                  $type = 'Deluxe (Twin)';
                } elseif ($data['room_type'] == 'ES') {
                  $type = 'Executive';
                } elseif ($data['room_type'] == 'SSK') {
                  $type = 'Seaside Suite (King)';
                } elseif ($data['room_type'] == 'DK') {
                  $type = 'Deluxe (King)';
                } elseif ($data['room_type'] == 'SST') {
                  $type = 'Seaside Suite';
                } else {
                  $type = '';
                }

                if ($data['id'] == '1') {
                  $status = "<span class='badge badge-info'>Vacant Clean</span>";
                  // $status ="<b style='color:green'>Ready</b>";
                } elseif ($data['id'] == '2') {
                  $status = "<span class='badge badge-info'>Room Check</span>";
                  // $status ="<b style='color:red'>For Cleaning</b>";
                } elseif ($data['id'] == '3') {
                  $status = "<span class='badge badge-danger'>Vacant Dirty</span>";
                  // $status ="<b style='color:orange'>For Maintenance</b>";
                } elseif ($data['id'] == '4') {
                  $status = "<span class='badge badge-danger'>Vacant Clean Inspected</span>";
                  // $status ="<b style='color:gray'>Block</b>";
                } elseif ($data['id'] == '5') {
                  $status = "<span class='badge badge-success'>Make Up Room</span>";
                  // $status ="<b style='color:gray'>Block</b>";
                } elseif ($data['id'] == '6') {
                  $status = "<span class='badge badge-danger'>Out Of Service</span>";
                  // $status ="<b style='color:gray'>Block</b>";
                } elseif ($data['id'] == '7') {
                  $status = "<span class='badge badge-warning'>Out of Order</span>";
                  // $status ="<b style='color:gray'>Block</b>";
                }
                // elseif ($data['id'] =='7') {
                //   $status ="<span class='badge badge-warning'>Occupied</span>";
                //   // $status ="<b style='color:gray'>Block</b>";
                // }
                // elseif ($data['id'] =='7') {
                //   $status ="<span class='badge badge-warning'>Extended</span>";
                //   // $status ="<b style='color:gray'>Block</b>";
                // }

                else {
                  $status = "";
                }
              ?>

                <tr>

                  <td><?php echo $data['label'] ?> </td>

                  <td><?php echo $type ?></td>

                  <td class="text-center" width="20%"><b><?php echo $status ?></b></td>

                  <td>
                    <!-- 
                        <a id="<?php //echo base_url('index.php/main/HousekechangeStatusUC/'.$data['id']) 
                                ?>"  data-placement="left" title="Change Status of Room to Under Cleaning" rel="tooltip" class="uc btn btn-danger btn-icon btn-sm   btn-neutral  "><i class="fa fa-edit"></i></a> -->
                    <form action="<?php echo base_url('index.php/main/updateStatusOfRoom') ?>" method="post">
                      <input type="hidden" name="id" value="<?php echo $data['room_id'] ?>">
                      <input type="hidden" name="room" value="<?php echo $data['label'] ?>">
                      <select name="type" class="form-control" style="margin-bottom: 5px;" required="">
                        <option value="">Select</option>
                        <option value="1">Vacant Clean</option>
                        <option value="2">Room Check</option>
                        <option value="3">Vacant Dirty</option>
                        <option value="4">Vacant Clean Inspected</option>
                        <option value="5">Make Up Room</option>
                        <option value="6">Out Of Service</option>
                        <option value="7">Out Of Order</option>
                      </select>
                      <input type="submit" value="Update" class="btn btn-success">
                      <input type="reset" value="Clear" class="btn btn-info ">
                      <!-- <input type="reset" value="Clear" class="btn btn-warning"> -->
                    </form>
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

<script type="text/javascript">
  $('.uc').click(function() {
    swal({
      title: 'Change Status of Room to Under Cleaning?',
      text: '',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Confirm',
      cancelButtonText: 'Cancel',
      confirmButtonClass: "btn btn-success",
      cancelButtonClass: "btn btn-danger",
      buttonsStyling: false
    }).then((result) => {
      if (!result.value) {
        window.location.replace(this.id);
      }
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    // Handler for .ready() called.
    window.setTimeout(function() {
      // location.href = "https://booking.hoteldefides.com/index.php/main/RTHousekeepingList";
    }, 10000);
  });
</script>