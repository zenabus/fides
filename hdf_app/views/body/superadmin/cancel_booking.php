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
    <div class="col-md-12">
      <h5><b>CANCEL BOOKING</b></h5>
      <div class="card">
        <div class="card-header">
          <h6><b>BOOKING LISTS</b></h6>
          <!-- <span class="badge badge-pill badge-danger">List of Room/s </span> -->
        </div>
        <div class="card-body">
          <div class="toolbar">
            <!--        Here you can write extra buttons/actions for the toolbar              -->
          </div>
          <table id="datatable" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Room #</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Name</th>
                <th>Room Type</th>
                <th class="disabled-sorting text-center">Action</th>
              </tr>
            </thead>
            <?php foreach ($result as $row) {
              # code...
              if ($row['room_type'] == 'DR') {
                $type = 'Deluxe';
              } elseif ($row['room_type'] == 'SSR') {
                $type = 'Seaside Suite';
              } elseif ($row['room_type'] == 'ER') {
                $type = 'Executive';
              } elseif ($row['room_type'] == 'ESR') {
                $type = 'Executive Suite';
              } else {
                $type = '';
              }
            ?>
              <tr>
                <td><?php echo $row['label'] ?></td>
                <td><?php echo $row['start_date'] ?></td>
                <td><?php echo $row['end_date'] ?></td>
                <td><?php echo $row['text'] ?></td>
                <td><?php echo $type ?></td>
                <td class="text-center">

                  <a id="<?php echo base_url('index.php/admin/cancelBookingProcess/' . $row['book_id']) ?>" data-placement="left" title="Delete" rel="tooltip" class="Block btn btn-danger btn-icon btn-sm text-light"><i class="fa fa-times"></i></a>
                </td>

              </tr>


            <?php } ?>
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

<script type="text/javascript">
  $('.Block').click(function() {
    swal({
      title: 'Cancel Booking?',
      text: 'You will not be able to rever it.',
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
  $('.UNBlock').click(function() {
    swal({
      title: 'Unblock the Room?',
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