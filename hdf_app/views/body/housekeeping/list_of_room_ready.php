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

    <div class="col-md-12">

      <div class="card">

        <div class="card-header">

          <span class="badge badge-pill badge-danger">List of Rooms (Status: Ready) </span><i>(Note: It will automatic Hide the Actions after 10sec for security purposes)</i><a class="float-right btn btn-primary " href="<?php echo base_url() ?>index.php/main/RTHousekeepingReady" rel="tooltip" data-toggle="tooltip" data-placement="left" title="Hide Actions" class="btn-icon btn-sm "><i class="nc-icon nc-simple-add"></i></a>

        </div>

        <div class="card-body">

          <div class="toolbar">

            <!--        Here you can write extra buttons/actions for the toolbar              -->

          </div>

          <table id="datatables" class="table table-striped table-bordered">

            <thead>

              <tr>

                <th>Room No.</th>

                <th>Room Type</th>



                <th>Status</th>





                <th class="disabled-sorting">Action</th>

              </tr>

            </thead>

            <tbody>

              <?php foreach ($room_result as $data) {

                # code...



              ?>

                <tr>

                  <td><?php echo $data['label'] ?></td>

                  <td><?php echo $data['type'] ?></td>

                  <td> Ready </td>

                  <td>



                    <a id="<?php echo base_url('index.php/main/HousekechangeStatusUMReady/' . $data['id']) ?>" data-placement="left" title="Change Status of Room to Under Mainetenance" rel="tooltip" class="um btn btn-danger btn-icon btn-sm   btn-neutral  "><i class="fa fa-edit"></i></a>

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
  $('.um').click(function() {

    swal({

      title: 'Change Status of Room to Under Mainetenance?',

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



</script>

<script type="text/javascript">
  $(document).ready(function() {

    // Handler for .ready() called.

    window.setTimeout(function() {

      location.href = "https://booking.hoteldefides.com/index.php/main/RTHousekeepingReady";

    }, 10000);

  });
</script>