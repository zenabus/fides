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
  <h5><b>REQUESTS</b></h5>
  <div class="row">

    <div class="col-md-12">

      <div class="card">

        <div class="card-header">
          <h6><b>BED REQUEST LIST</b></h6>
          <!-- <span class="badge badge-pill badge-danger">List of Request (Bed) </span> --> <i>(Note: Actions will automatically hide after 10 seconds)</i><a class="float-right btn btn-primary " href="<?php echo base_url() ?>index.php/main/RTHousekeepingBedRequest" rel="tooltip" data-toggle="tooltip" data-placement="left" title="Hide Actions" class="btn-icon btn-sm "><i class="nc-icon nc-simple-add"></i></a>

        </div>

        <div class="card-body">

          <div class="toolbar">

            <!--        Here you can write extra buttons/actions for the toolbar              -->

          </div>

          <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">

            <thead>
              <tr>
                <th class="disabled-sorting">Room #</th>
                <th># of Bed/s Request</th>
                <th class="text-center">Status</th>
                <th class="disabled-sorting text-center">Action</th>
              </tr>
            </thead>
            <tbody>

              <?php foreach ($room_result as $data) {

                # code...

              ?>

                <tr>
                  <td><?php echo $data['room_number'] ?></td>
                  <td><?php echo $data['add_bed'] ?> PC/S</td>
                  <td class="text-center"><span class="badge badge-info"><?php echo $data['bed_status'] ?></span></td>
                  <td class="text-center">
                    <a id="<?php echo base_url('index.php/main/HousekechangeStatusDelivered/' . $data['id_rooms']) ?>" class="request btn btn-info btn-icon btn-sm text-light"><i class="fa fa-edit"></i></a>
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
  $('.request').click(function() {

    swal({

      title: 'Delivered?',

      text: '',

      type: 'warning',

      showCancelButton: true,

      confirmButtonText: 'Yes',

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

      location.href = "https://booking.hoteldefides.com/index.php/main/RTHousekeepingBedRequest";

    }, 10000);

  });
</script>