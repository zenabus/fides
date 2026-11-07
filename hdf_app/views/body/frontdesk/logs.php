<div class="content pb-0">
  <h5>Logs</h5>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header border-bottom px-4 pb-2">
          <h6>All User Logs</h6>
        </div>
        <div class="card-body">
          <table class="table table-striped table-bordered datatable" id="tblLogs" style="width: 100%;">
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
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#tblLogs').DataTable({
      "processing": true,
      "serverSide": true,
      "pageLength": 25,
      "lengthMenu": [
        [10, 25, 50, 100],
        [10, 25, 50, 100]
      ],
      "ajax": {
        "url": "<?= base_url('index.php/main/logs_dt') ?>",
        "type": "POST"
      },
      "ordering": true,
      "order": [[<?= ($_SESSION['user_type'] == 'Superadmin') ? 3 : 2 ?>, 'desc']],
      "autoWidth": false,
      "columns": [
        { "data": 0, "width": "18%" },
        <?php if ($_SESSION['user_type'] == 'Superadmin') { ?>
          { "data": 1, "width": "18%" },
          { "data": 2 },
          { "data": 3, "width": "18%" }
        <?php } else { ?>
          { "data": 1 },
          { "data": 2, "width": "18%" }
        <?php } ?>
      ]
    });
  });
</script>