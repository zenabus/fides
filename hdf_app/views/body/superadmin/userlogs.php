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
      <h5><b>LOGS</b></h5>
      <div class="card">
        <div class="card-header">
          <h6><b>USER</b></h6>
          <!--<span class="badge badge-pill badge-danger">Activity Logs </span>-->
        </div>
        <div class="card-body">
          <div class="toolbar">
            <!--        Here you can write extra buttons/actions for the toolbar              -->
          </div>
          <table id="datatable" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>User</th>
                <th>User type</th>
                <th>Logs</th>
                <th>Date</th>

              </tr>
            </thead>
            <tbody>
              <?php foreach ($result_logs as $data) { ?>
                <tr>
                  <td><?php echo $data['user']; ?></td>
                  <td><?php echo $data['type']; ?></td>
                  <td><?php echo $data['content']; ?></td>
                  <td><?php echo $data['date_entered']; ?></td>
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