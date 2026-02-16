<div class="content pb-0">
  <h5>Logs</h5>
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
                <?php if ($_SESSION['user_type'] == 'Superadmin') { ?>
                  <th>IP Address</th>
                <?php } ?>
                <th>Activity</th>
                <th>Log Date</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($logs as $row) { ?>
                <tr>
                  <td style="white-space: nowrap">
                    <?= $row['name'] ?><br>
                    <small><?= ucfirst(strtolower($row['user_type'])) ?></small>
                  </td>
                  <?php if ($_SESSION['user_type'] == 'Superadmin') { ?>
                    <td style="white-space: nowrap">
                      <?= array_key_exists($row['ip_address'], IP) ? IP[$row['ip_address']] : 'Unknown' ?><br>
                      <small><?= $row['ip_address'] ?></small>
                    </td>
                  <?php } ?>
                  <td>
                    <?php
                    $content = explode('→', $row['content']);
                    if (isset($content[1])) {
                      $booking_id = explode(' ', $content[0]);
                      $booking_id = strip_tags($booking_id[0]);
                      if (strpos($booking_id, 'HDF') !== false) {
                        $url = base_url('index.php/main/booking/' . $booking_id);
                        $booking_id = "<a href='{$url}' class='text-dark'>{$content[0]}</a>";
                      }
                      $i = isset($content[2]) ? 2 : 1;
                      $content = "{$booking_id} → {$content[$i]}";
                    } else {
                      $content = $content[0];
                    }
                    ?>
                    <?= $content ?><br>
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