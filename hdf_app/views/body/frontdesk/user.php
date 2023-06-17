<div class="content pb-0">
  <div class="d-flex justify-content-between align-items-center mb-2">
    <h5 class="mb-0">Activity logs of <?=$user->name?></h5>
    <button class="btn btn-primary my-0 back" onclick="history.back()">Back</button>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header border-bottom px-4 pb-2">
          <h6>All User Logs</h6>
        </div>
        <div class="card-body">
          <table class="table table-striped table-bordered datatable">
            <thead>
              <tr>
                <th>User</th>
                <th>Activity</th>
                <th>Log Date</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($logs as $row) { ?>
                <tr>
                  <td>
                    <?= $row['name'] ?><br>
                    <small><?= ucfirst(strtolower($row['user_type'])) ?></small>
                  </td>
                  <td>
                    <?= $row['content'] ?><br>
                    <small><?= LOG_TYPE[$row['log_type']] ?></small>
                  </td>
                  <td>
                    <?php
                    $date_time = date_create($row['date_entered']);
                    $date_time = date_format($date_time, "M d, Y h:i a");
                    ?>
                    <?= $row['ago'] ?><br>
                    <small><?= $date_time ?></small>
                  </td>
                </tr>
              <?php }  ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const base_url = '<?= base_url() ?>';

  $(document).ready(function() {
    $('.datatable').dataTable({
      ordering: false
    });
  });
</script>