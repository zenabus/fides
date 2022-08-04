<style type="text/css">
  .bg-brown {
    background-color: #66615B;
    padding: 4px !important;
  }

  .card-div,
  #new_guest {
    display: none;
  }

  .modal {
    overflow-y: scroll !important;
  }
</style>

<div class="content pb-0">
  <div class="row">
    <div class="col-md-12">
      <h5>Rooms</h5>
      <div class="card mb-0">
        <div class="card-body px-0">
          <table class="table table-striped" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Room #</th>
                <th>Type</th>
                <th>Price</th>
                <th>Persons</th>
                <th>Status</th>
                <th class="disabled-sorting">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td colspan="7" class="text-center bg-brown"></td>
              </tr>
              <?php $prev = 199; ?>
              <?php foreach ($rooms as $row) {
                $badge = $row['id'] == '4' ? 'default' : 'danger';
                if ($row['room_number'] - $prev > 20) { ?>
                  <tr>
                    <td colspan="7" class="text-center bg-brown"></td>
                  </tr>
                <?php } ?>
                <tr>
                  <td><?= $row['room_number'] ?></td>
                  <td><?= $row['room_type'] ?></td>
                  <td>₱ <?= number_format($row['pricing_type'], 2) ?></td>
                  <td><?= $row['max_persons'] == 2 ? 'Two' : 'Three' ?></td>
                  <td>
                    <span class="badge badge-<?= $badge ?>">
                      <span class="fa fa-<?= $row['icon'] ?>"></span>
                      <?= $row['description'] ?>
                    </span>
                  </td>
                  <td class="action">
                    <?php if ($row['room_status_id'] == 4) { ?>
                      <button class="btn btn-sm btn-default checkin" data='<?= json_encode($row) ?>'>Check In</button>
                    <?php } ?>
                  </td>
                </tr>
                <?php $prev = $row['room_number'] ?>
              <?php } ?>
              <tr>
                <td colspan="7" class="text-center bg-brown"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const guests = JSON.parse('<?= json_encode($guests) ?>');
</script>
<script defer src="<?= base_url('assets/js/modal-reservation.js') ?>"></script>
<script>
  $('.checkin').click(function() {
    modalBooking(this, 'Check In');
  });
</script>