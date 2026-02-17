<div class="content pb-0">
  <div class="row">
    <div class="col-md-12">
      <h5 class="mb-0">Guests with White Spaces</h5>
      <a href="<?= base_url('index.php/main/guests') ?>" class="btn">Back to Guests</a>
      <?php if (!empty($guests)) { ?>
        <a href="<?= base_url('index.php/main/trim_guests') ?>" class="btn btn-success" onclick="return confirm('Are you sure you want to trim all whitespace from these guests?')">Trim All Spaces</a>
      <?php } ?>

      <div class="card">
        <div class="card-body">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Original Name</th>
                <th>Cleaned Name (Preview)</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($guests)) { ?>
                <tr>
                  <td colspan="2" class="text-center">No guests with extra spaces found! Good job! </td>
                </tr>
              <?php } else { ?>
                <?php foreach ($guests as $row) {
                  $original = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
                  $cleaned = trim($row['first_name']) . ' ' . trim($row['middle_name']) . ' ' . trim($row['last_name']);
                ?>
                  <tr>
                    <td>
                      <pre><?= $original ?></pre>
                    </td>
                    <td><?= $cleaned ?></td>
                  </tr>
                <?php } ?>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>