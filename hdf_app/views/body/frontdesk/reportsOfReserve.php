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
      <h5><b>Date: <?php echo $dates ?> </b></h5>
      <div class="card">
        <div class="card-header">
          <h6><b>Count Reserve</b></h6>
          <!-- <span class="badge badge-pill badge-danger">List of Room/s </span> -->
        </div>
        <div class="card-body">
          <div class="toolbar">
            <!--        Here you can write extra buttons/actions for the toolbar              -->
          </div>
          <table id="datatables" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Room Type</th>
                <th>Count</th>

              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Executive Room / Family Room</td>
                <td><?php echo $roomType1['total'] ?></td>
              </tr>

              <tr>
                <td>Deluxe (Twin)</td>
                <td><?php echo $roomType2['total'] ?></td>
              </tr>

              <tr>
                <td>Executive Suite</td>
                <td><?php echo $roomType3['total'] ?></td>
              </tr>

              <tr>
                <td>Seaside Suite (King)</td>
                <td><?php echo $roomType4['total'] ?></td>
              </tr>

              <tr>
                <td>Deluxe (King)</td>
                <td><?php echo $roomType5['total'] ?></td>
              </tr>

              <tr>
                <td>Seaside Suite Twin</td>
                <td><?php echo $roomType6['total'] ?></td>
              </tr>

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