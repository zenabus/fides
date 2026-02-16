<div class="content pb-0">
  <div class="row">
    <div class="col-md-12">
      <h5>For checkout</h5>
      <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
          <table class="table table-striped table-bordered tbl_booking">
            <thead>
              <tr>
                <th>Room</th>
                <th>Guest Name</th>
                <th>Stay Dates</th>
                <th>Room Charge</th>
                <th>Amount</th>
                <th>Cleared By</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($checkouts as $row) {
                $total = 0;
              ?>
                <tr>
                  <td>
                    <?= $row['room_number'] ?> <?= $row['room_type_abbr'] ?><br>
                    <small>
                      <?= $row['booking_number'] ?>
                      <?php if ($row['reservation_status'] == -1) { ?>
                        <span class="fa fa-lock"></span>
                      <?php } ?>
                    </small>
                  </td>
                  <td>
                    <?= $row['first_name'] ?> <?= $row['middle_name'] ?> <?= $row['last_name'] ?> <?= $row['suffix'] ?><br>
                    <small><?= $row['contact'] ?> <br> <?= $row['email'] ?></small>
                  </td>
                  <td>
                    <?= $row['check_in'] ?> - <?= $row['check_out'] ?><br>
                    <small>No. of nights: <?= $row['nights'] ?></small>
                  </td>
                  <td>
                    <?php if ($row['extra_bed'] || $row['extra_person']) { ?>
                      <details>
                        <summary>Extra charges</summary>
                        <small>Bed: ₱ <?= number_format($row['extra_bed'] * $bed->price) ?></small><br>
                        <small>Person: ₱ <?= number_format($row['extra_person'] * $person->price) ?></small>
                        <?php $total += $row['extra_bed'] * $bed->price; ?>
                        <?php $total += $row['extra_person'] * $person->price; ?>
                      </details>
                    <?php } ?>
                    <?php if ($row['restaurant']) { ?>
                      <details>
                        <summary>Resto charges</summary>
                        <?php foreach ($row['restaurant'] as $r) { ?>
                          <small><?= $r['particulars'] ?>: ₱ <?= number_format($r['charges_food_amount']) ?></small>
                          <?php $total += $r['charges_food_amount']; ?>
                        <?php } ?>
                      </details>
                    <?php } ?>
                    <?php if ($row['coffeeshop']) { ?>
                      <details>
                        <summary>Otilla's charges</summary>
                        <?php foreach ($row['coffeeshop'] as $c) { ?>
                          <small><?= $c['particulars'] ?>: ₱ <?= number_format($c['charges_food_amount']) ?></small>
                          <?php $total += $c['charges_food_amount']; ?>
                        <?php } ?>
                      </details>
                    <?php } ?>
                    <?php if ($row['amenities']) { ?>
                      <details>
                        <summary>Other charges</summary>
                        <?php foreach ($row['amenities'] as $a) { ?>
                          <small><?= $a['charge'] ?>: ₱ <?= number_format($a['charge_amount']) ?></small>
                          <?php $total += $a['charge_amount']; ?>
                        <?php } ?>
                      </details>
                    <?php } ?>
                  </td>
                  <td>₱ <?= number_format($total) ?></td>
                  <td><?= $row['last_updated_by'] ?></td>
                  <?php
                  $badge = 'default';

                  if ($row['id'] == 8) {
                    $badge = 'primary';
                  } elseif ($row['id'] == 6 || $row['id'] == 7) {
                    $badge = 'danger';
                  } elseif ($row['id'] == 3 || $row['id'] == 5) {
                    $badge = 'warning';
                  } elseif ($row['id'] == 1 || $row['id'] == 2) {
                    $badge = 'success';
                  }
                  ?>
                  <td>
                    <span class="badge badge-<?= $badge ?>">
                      <span class="fa fa-<?= $row['icon'] ?>"></span>
                      <?= $row['description'] ?>
                    </span>
                  </td>
                  <td class="action">
                    <?php if ($_SESSION['user_type'] != 'Housekeeping') { ?>
                      <a href="<?= base_url('index.php/main/booking/' . $row['booking_number']) ?>" class="btn btn-sm" data-placement="top" title="View Booking" rel="tooltip">
                        <span class="fa fa-address-book"></span>
                      </a>
                      <a href="<?= base_url('index.php/main/receipt/' . $row['booking_id']) ?>" class="btn btn-sm btn-info receipt" data-placement="top" title="View Receipt" rel="tooltip">
                        <i class="fa-solid fa-receipt"></i>
                      </a>
                    <?php } else { ?>
                      <?= form_open('main/updateRoomStatus', ['id' => 'frmStatus']); ?>
                      <input type="hidden" name="room_id" value="<?= $row['room_id'] ?>">
                      <select class="form-control form-control-sm mb-1" style="width:70px" name="room_status_id">
                        <?php foreach ($statuses as $status) { ?>
                          <option value="<?= $status['id'] ?>" <?= $status['id'] == $row['id'] ? 'selected' : '' ?>><?= $status['name'] ?></option>
                        <?php } ?>
                      </select>
                      <button class="btn btn-sm">Update</button>
                      <?= form_close(); ?>
                    <?php } ?>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    demo.initWizard();
    $('.tbl_booking').DataTable({
      dom: 'Bfrtip',
      buttons: [
        'print'
      ]
    });

    $('.dt-button').addClass('btn');
  });

  $(document).on('click', '.receipt', function(e) {
    e.preventDefault();
    const size = ['height=' + screen.height / 2, 'width=' + screen.width / 2].join(',');
    window.open($(this).attr('href'), size, size);
  });

  $('#frmStatus').on('submit', function(e) {
    e.preventDefault();
    swal({
      title: "Are you sure?",
      text: "Please confirm your selected action",
      type: "warning",
      buttonsStyling: false,
      showCancelButton: true,
      cancelButtonClass: "btn",
      confirmButtonClass: "btn btn-primary mr-2",
    }).then((result) => {
      if (result) {
        $(this).unbind().submit();
      }
    });
  });
</script>