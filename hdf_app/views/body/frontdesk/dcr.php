<div class="content pb-0">
  <h5>Daily Collection Report</h5>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header border-bottom px-4 pb-2">
          <h6>All Daily Collection Reports</h6>
        </div>
        <div class="card-body">
          <table class="table table-striped table-bordered datatable">
            <thead>
              <tr>
                <th>Date</th>
                <th>No. of Payments</th>
                <th>Cash</th>
                <th>Card</th>
                <th>Sales</th>
                <th>Expense</th>
                <th>Event Collectables</th>
                <th>Total</th>
                <th>Remitted By</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($dcr as $row) { ?>
                <tr>
                  <td>
                    <?php
                    $date_time = date_create($row['payment_added']);
                    $date_time = date_format($date_time, "F d, Y");
                    ?>
                    <?= $row['payment_added'] ?><br>
                    <small><?= $date_time ?></small>
                  </td>
                  <td>
                    <a href="javascript:" class="payments text-danger font-weight-bold" date="<?= $row['payment_added'] ?>"><?= $row['count'] ?></a>
                  </td>
                  <td>₱ <?= number_format(isset($row['cash']) ? $row['cash'] : 0) ?></td>
                  <td>₱ <?= number_format(isset($row['card']) ? $row['card'] : 0) ?></td>
                  <td>
                    ₱ <?= number_format(floatval($row['sales_total']->sales_amount), 2) ?><br>
                    <small><a href="javascript:" class="<?= count($row['sales']) == 0 ? '' : 'sales' ?> font-weight-bold text-danger" date="<?= $row['payment_added'] ?>"><?= count($row['sales']) ?> sale<?= count($row['expenses']) == 0 || count($row['sales']) == 1 ? '' : 's' ?></a></small>
                  </td>
                  <td>
                    ₱ <?= number_format(floatval($row['expense_total']->expense_amount)) ?><br>
                    <small><a href="javascript:" class="<?= count($row['expenses']) == 0 ? '' : 'expenses' ?> font-weight-bold text-danger" date="<?= $row['payment_added'] ?>"><?= count($row['expenses']) ?> expense<?= count($row['expenses']) == 0 || count($row['expenses']) == 1 ? '' : 's' ?></a></small>
                  </td>
                  <td>
                    ₱ <?= number_format(floatval($row['collectable_total']->collectable_amount)) ?><br>
                    <small><a href="javascript:" class="<?= count($row['collectables']) == 0 ? '' : 'collectables' ?> font-weight-bold text-danger" date="<?= $row['payment_added'] ?>"><?= count($row['collectables']) ?> collectable<?= count($row['collectables']) == 0 || count($row['collectables']) == 1 ? '' : 's' ?></a></small>
                  </td>
                  <td><b>₱ <?= number_format($row['sum'] + $row['sales_total']->sales_amount - $row['expense_total']->expense_amount) ?></b></td>
                  <td>
                    <?php if ($row['remitted']) { ?>
                      <?= $row['remitted']->name ?> <span class="fa fa-info-circle text-info" data-placement="top" title="<?= $row['remitted']->remittance_note ?>" rel="tooltip"></span><br>
                      <?php
                      $time = date_create($row['remitted']->remittance_added);
                      $time = date_format($time, "h:i a");
                      ?>
                      <small>₱ <?= number_format($row['remitted']->remitted_amount) ?> - <?= $time ?></small>
                    <?php } ?>
                  </td>
                  <td class="action">
                    <a href="<?= base_url('index.php/main/dcr/' . $row['payment_added'] . '/AM') ?>" class="btn btn-sm mb-1 btn-primary dcr" target="_blank" data-placement="top" title="View DCR" rel="tooltip">
                      AM
                    </a>
                    <a href="<?= base_url('index.php/main/dcr/' . $row['payment_added'] . '/PM') ?>" class="btn btn-sm mb-1 btn-primary dcr" target="_blank" data-placement="top" title="View DCR" rel="tooltip">
                      PM
                    </a>
                    <?php if (date('Y-m-d') == $row['payment_added']) { ?>
                      <a href="javascript:" class="btn btn-sm mb-1 btn-success sale" data-placement="top" title="Add Sales" rel="tooltip" date="<?= $row['payment_added'] ?>">
                        <i class="fa-solid fa-sack-dollar"></i>
                      </a>
                      <a href="javascript:" class="btn btn-info mb-1 btn-sm collectable" data-placement="top" title="Add Event Collectable" rel="tooltip" date="<?= $row['payment_added'] ?>">
                        <i class="fa-solid fa-hand-holding-dollar"></i>
                      </a>
                      <a href="javascript:" class="btn btn-danger mb-1 btn-sm expense" data-placement="top" title="Add Expense" rel="tooltip" date="<?= $row['payment_added'] ?>">
                        <i class="fa-solid fa-comment-dollar"></i>
                      </a>
                    <?php } ?>
                    <?php if (!$row['remitted']) { ?>
                      <?php if (date_create()->modify('-1 days')->format('Y-m-d') == $row['payment_added']) { ?>
                        <a href="javascript:" class="btn btn-sm mb-1 btn-success sale" data-placement="top" title="Add Sales" rel="tooltip" date="<?= $row['payment_added'] ?>">
                          <i class="fa-solid fa-sack-dollar"></i>
                        </a>
                        <a href="javascript:" class="btn btn-info mb-1 btn-sm collectable" data-placement="top" title="Add Event Collectable" rel="tooltip" date="<?= $row['payment_added'] ?>">
                          <i class="fa-solid fa-hand-holding-dollar"></i>
                        </a>
                        <a href="javascript:" class="btn btn-danger mb-1 btn-sm expense" data-placement="top" title="Add Expense" rel="tooltip" date="<?= $row['payment_added'] ?>">
                          <i class="fa-solid fa-comment-dollar"></i>
                        </a>
                        <?php if ($row['sales_total']) {
                          $cash = isset($row['cash']) ? $row['cash'] : 0;
                        ?>
                          <a href="javascript:" class="btn btn-sm mb-1 remit" data-placement="top" title="Remit" rel="tooltip" cash="<?= $cash + $row['sales_total']->sales_amount - $row['expense_total']->expense_amount ?>">
                            <i class="fa-solid fa-money-bill-transfer"></i>
                          </a>
                        <?php } ?>
                      <?php } ?>
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

<div class="modal fade" id="modalNote" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Remittance</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('main/remit', ['id' => 'frmRemit']) ?>
        <div class="form-group">
          <label>Amount remitted</label>
          <input type="number" class="form-control" name="remitted_amount" required>
        </div>
        <div class="form-group">
          <label>Amount left</label>
          <input type="text" class="form-control" id="left" readonly value="₱ 0">
        </div>
        <div class="form-group">
          <label>Note</label>
          <textarea class="form-control" name="remittance_note" required></textarea>
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <button type="submit" class="btn btn-link btnRemit" form="frmRemit">Add</button>
        </div>
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalPayments" tabindex="-1" role="dialog">
  <div class="modal-dialog pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Payments</h4>
      </div>
      <div class="modal-body px-4">
        <table class="table table-bordered mb-0">
          <thead>
            <th>Booking No.</th>
            <th>Room</th>
            <th>Amount</th>
          </thead>
          <tbody class="payments-tbody">
            <!-- javascript -->
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalSale" tabindex="-1" role="dialog">
  <div class="modal-dialog pt-0 modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Add Sales</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('main/addSales', ['id' => 'frmSales']) ?>
        <input type="hidden" name="sales_date">
        <div class="form-group">
          <label>Type</label>
          <select name="sales_type" class="form-control" required>
            <option value="">- select sales type -</option>
            <option value="Event">Event</option>
            <option value="Pool">Swimming Pool</option>
          </select>
        </div>
        <div class="form-group">
          <label>Amount</label>
          <input type="number" class="form-control" name="sales_amount" required>
          <small>Sales will add up.</small>
        </div>
        <div class="form-group">
          <label>Remarks</label>
          <textarea name="sales_remarks" rows="1" class="form-control"></textarea>
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="right-side">
          <button type="submit" class="btn btn-link" form="frmSales">Add</button>
        </div>
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalCollectable" tabindex="-1" role="dialog">
  <div class="modal-dialog pt-0 modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Event Collectable</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('main/addCollectable', ['id' => 'frmCollectable']) ?>
        <input type="hidden" name="collectable_date">
        <div class="form-group">
          <label>Amount</label>
          <input type="number" class="form-control" name="collectable_amount" required>
        </div>
        <div class="form-group">
          <label>Remarks</label>
          <textarea name="collectable_remarks" rows="1" class="form-control"></textarea>
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="right-side">
          <button type="submit" class="btn btn-link" form="frmCollectable">Add</button>
        </div>
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalExpense" tabindex="-1" role="dialog">
  <div class="modal-dialog pt-0 modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Expenses</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('main/addExpense', ['id' => 'frmExpense']) ?>
        <input type="hidden" name="expense_date">
        <div class="form-group">
          <label>Type</label>
          <select name="expense_type" class="form-control" required>
            <option value="">- select expense type -</option>
            <option value="Hotel">Hotel</option>
            <option value="Event">Event</option>
            <option value="Pool">Swimming Pool</option>
            <option value="Resto">Resto</option>
            <option value="Otilla's">Otilla's</option>
          </select>
        </div>
        <div class="form-group">
          <label>Amount</label>
          <input type="number" class="form-control" name="expense_amount" required>
        </div>
        <div class="form-group">
          <label>Remarks</label>
          <textarea name="expense_remarks" rows="1" class="form-control"></textarea>
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="right-side">
          <button type="submit" class="btn btn-link" form="frmExpense">Confirm</button>
        </div>
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalSales" tabindex="-1" role="dialog">
  <div class="modal-dialog pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Sales</h4>
      </div>
      <div class="modal-body px-4">
        <table class="table table-bordered mb-0">
          <thead>
            <th>Type</th>
            <th>Amount</th>
            <th>Remarks</th>
            <th>Date</th>
          </thead>
          <tbody class="sales-tbody">
            <!-- javascript -->
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalExpenses" tabindex="-1" role="dialog">
  <div class="modal-dialog pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Expenses</h4>
      </div>
      <div class="modal-body px-4">
        <table class="table table-bordered mb-0">
          <thead>
            <th>Type</th>
            <th>Amount</th>
            <th>Remarks</th>
            <th>Date</th>
          </thead>
          <tbody class="expenses-tbody">
            <!-- javascript -->
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modalCollectables" tabindex="-1" role="dialog">
  <div class="modal-dialog pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Event Collectables</h4>
      </div>
      <div class="modal-body px-4">
        <table class="table table-bordered mb-0">
          <thead>
            <th>Type</th>
            <th>Amount</th>
            <th>Remarks</th>
            <th>Date</th>
          </thead>
          <tbody class="collectables-tbody">
            <!-- javascript -->
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  const base_url = '<?= base_url() ?>';
  let current_cash = 0;

  $(document).ready(function() {
    $('.datatable').dataTable({
      ordering: false
    });
  });

  $('.remit').click(function() {
    const cash = $(this).attr('cash');
    current_cash = cash;
    $('[name=remitted_amount]').val(cash);
    $('#modalNote').modal('show');
  });

  $('[name=remitted_amount]').on('input', function() {
    const remit_amount = parseInt($(this).val());
    const left = current_cash - remit_amount;
    $('#left').val('₱ ' + formatNumber(left));
    if (left < 0) {
      $('.btnRemit').attr('disabled', 'disabled');
    } else {
      $('.btnRemit').removeAttr('disabled');
    }
  });

  $('.payments').click(function() {
    const date = $(this).attr('date');
    const icon = {
      room: 'fa fa-bed',
      addons: 'fa fa-plus',
      restaurant: 'fa-solid fa-utensils',
      coffeeshop: 'fa-solid fa-mug-saucer',
      reservation: 'fa-solid fa-hourglass',
      advance: 'fa-solid fa-money-bill-1'
    };

    $('.payments-tbody').html('');

    fetch(base_url + 'index.php/main/getPaymentsByDate/' + date)
      .then(response => response.json())
      .then(data => {
        console.log(data);
        data.forEach(row => {
          const html = `<tr>
              <td>
                <a href="${base_url}index.php/main/booking/${row.booking_number}" class="text-danger font-weight-bold">${row.booking_number}</a><br>
                <small>${ampm(row.booking_payment_added)}</small>
              </td>
              <td>
                ${row.room_number} ${row.room_type_abbr}<br>
                <small><span class="${icon[row.payment_for]}"></span> ${capitalize(row.payment_for)}</small>
              </td>
              <td>
                ₱ ${formatNumber(row.amount)}
                <span class="fa fa-credit-card text-info ${row['payment_option'] != 'Card' ? 'd-none' : ''}" data-placement="top" title="XXXX XXXX XXXX ${row['card_number']}" rel="tooltip"></span>
                <br>
                <small>${row.name}</small>
              </td>
            </tr>
          `;
          $('.payments-tbody').append(html);
        });

        $('#modalPayments').modal('show');
      });
  });

  $('.expenses').click(function() {
    const date = $(this).attr('date');
    $('.expenses-tbody').html('');

    fetch(base_url + 'index.php/main/getExpensesByDate/' + date)
      .then(response => response.json())
      .then(data => {
        data.forEach(row => {
          const html = `<tr>
             <td>${row.expense_type}</td>
             <td>₱ ${formatNumber(row.expense_amount)}</td>
             <td>${row.expense_remarks}</td>
             <td>${ampm(row.expense_added)}</td>
            </tr>
          `;
          $('.expenses-tbody').append(html);
        });

        $('#modalExpenses').modal('show');
      });
  });

  $('.collectables').click(function() {
    const date = $(this).attr('date');

    $('.collectables-tbody').html('');

    fetch(base_url + 'index.php/main/getCollectablesByDate/' + date)
      .then(response => response.json())
      .then(data => {
        data.forEach(row => {
          const html = `<tr>
             <td>${row.collectable_type}</td>
             <td>₱ ${formatNumber(row.collectable_amount)}</td>
             <td>${row.collectable_remarks}</td>
             <td>${ampm(row.collectable_added)}</td>
            </tr>
          `;
          $('.collectables-tbody').append(html);
        });

        $('#modalCollectables').modal('show');
      });
  });

  $('.sales').click(function() {
    const date = $(this).attr('date');
    $('.sales-tbody').html('');

    fetch(base_url + 'index.php/main/getSalesByDate/' + date)
      .then(response => response.json())
      .then(data => {
        data.forEach(row => {
          const html = `<tr>
             <td>${row.sales_type}</td>
             <td>₱ ${formatNumber(row.sales_amount)}</td>
             <td>${row.sales_remarks}</td>
             <td>${ampm(row.sales_added)}</td>
            </tr>
          `;
          $('.sales-tbody').append(html);
        });

        $('#modalSales').modal('show');
      });
  });

  $('.sale').click(function() {
    const date = $(this).attr('date');
    $('[name=sales_date]').val(date);
    $('#modalSale').modal('show');
  });

  $('.collectable').click(function() {
    const date = $(this).attr('date');
    $('[name=collectable_date]').val(date);
    $('#modalCollectable').modal('show');
  });

  $('.expense').click(function() {
    const date = $(this).attr('date');
    $('[name=expense_date]').val(date);
    $('#modalExpense').modal('show');
  });
</script>