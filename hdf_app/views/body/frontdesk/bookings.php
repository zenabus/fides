<div class="content pb-0">
  <div class="row">
    <div class="col-md-12">
      <h5>Bookings</h5>
      <div class="wizard-container">
        <div class="card card-wizard active" data-color="primary" id="wizardProfile">
          <div class="card-header text-center">
            <div class="wizard-navigation">
              <ul>
                <li class="nav-item">
                  <a class="nav-link active" href="#active" data-toggle="tab" role="tab" aria-controls="active" aria-selected="true">
                    <i class="fa fa-check"></i> Active
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#collectables" data-toggle="tab" role="tab" aria-controls="collectables" aria-selected="false">
                    <i class="fa fa-money"></i> Collectables
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#locked" data-toggle="tab" role="tab" aria-controls="locked" aria-selected="false">
                    <i class="fa fa-lock"></i> Locked
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#cancel" data-toggle="tab" role="tab" aria-controls="cancel" aria-selected="false">
                    <i class="fa fa-ban"></i> Cancelled
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <div class="tab-content pt-0">
              <div class="tab-pane show active" id="active">
                <table class="table table-striped table-bordered tbl_active">
                  <thead>
                    <tr>
                      <th>Booking No.</th>
                      <th>Guest Name</th>
                      <th>Contact Details</th>
                      <th>Room Details</th>
                      <th>Payment Details</th>
                      <th>Date(s)</th>
                      <th class="disabled-sorting">Action</th>
                    </tr>
                  </thead>
                  <!-- <tbody>
                    <?php foreach ($active_bookings as $row) { ?>
                      <?php if ($row['charged_to'] == 0) { ?>
                        <tr>
                          <?php $data['row'] = $row ?>
                          <?php $this->load->view('body/frontdesk/components/booking_table_data', $data) ?>
                          <td class="action">
                            <a href="<?= base_url('index.php/main/booking/' . $row['booking_number']) ?>" class="btn btn-sm" data-placement="top" title="View Booking" rel="tooltip">
                              <span class="fa fa-address-book"></span>
                            </a>
                            <a href="<?= base_url('index.php/main/receipt/' . $row['booking_id']) ?>" class="btn btn-sm btn-info receipt" data-placement="top" title="View Receipt" rel="tooltip">
                              <i class="fa-solid fa-receipt"></i>
                            </a>
                            <a href="javascript:" id="<?= $row['booking_id'] ?>" class="btn btn-sm btn-danger cancelBooking" data-placement="top" title="Cancel Booking" rel="tooltip">
                              <span class="fa fa-ban"></span>
                            </a>
                          </td>
                        </tr>
                    <?php }
                    } ?>
                  </tbody> -->
                </table>
              </div>
              <div class="tab-pane show" id="collectables">
                <h5 class="pl-3 mb-4">Total Collectables: ₱ <?= number_format($total_collectable, 2) ?></h5>
                <table class="table table-striped table-bordered tbl_booking">
                  <thead>
                    <tr>
                      <th>Booking No.</th>
                      <th>Guest Name</th>
                      <th>Contact Details</th>
                      <th>Room Details</th>
                      <th>Payment Details</th>
                      <th>Date(s)</th>
                      <th class="disabled-sorting">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($charged as $row) { ?>
                      <?php if ($row['reservation_status'] == 0) { ?>
                        <tr>
                          <?php $data['row'] = $row ?>
                          <?php $this->load->view('body/frontdesk/components/booking_table_data', $data) ?>
                          <td class="action">
                            <a href="<?= base_url('index.php/main/booking/' . $row['booking_number']) ?>" class="btn btn-sm" data-placement="top" title="View Booking" rel="tooltip">
                              <span class="fa fa-address-book"></span>
                            </a>
                            <a href="<?= base_url('index.php/main/receipt/' . $row['booking_id']) ?>" class="btn btn-sm btn-info receipt" data-placement="top" title="View Receipt" rel="tooltip">
                              <i class="fa-solid fa-receipt"></i>
                            </a>
                            <a href="javascript:" id="<?= $row['booking_id'] ?>" class="btn btn-sm btn-danger cancelBooking" data-placement="top" title="Cancel Booking" rel="tooltip">
                              <span class="fa fa-ban"></span>
                            </a>
                          </td>
                        </tr>
                    <?php }
                    } ?>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane show" id="locked">
                <table class="table table-striped table-bordered tbl_locked">
                  <thead>
                    <tr>
                      <th>Booking No.</th>
                      <th>Guest Name</th>
                      <th>Contact Details</th>
                      <th>Room Details</th>
                      <th>Payment Details</th>
                      <th>Date(s)</th>
                      <th class="disabled-sorting">Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
              <div class="tab-pane show" id="cancel">
                <table class="table table-striped table-bordered tbl_cancelled">
                  <thead>
                    <tr>
                      <th>Booking No.</th>
                      <th>Guest Name</th>
                      <th>Contact Details</th>
                      <th>Room Details</th>
                      <th>Payment Details</th>
                      <th>Date(s)</th>
                      <th class="disabled-sorting">Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalReason" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Cancel Booking</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('main/cancelReservation', ['id' => 'frmCancel']) ?>
        <input type="hidden" name="booking_id">
        <input type="hidden" name="type" value="booking">
        <div class="form-group">
          <label>Reason</label>
          <textarea class="form-control" name="cancel_reason" required></textarea>
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <button type="submit" class="btn btn-link" form="frmCancel">Confirm</button>
        </div>
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  const base_url = '<?= base_url('index.php/main/') ?>';
  $(document).ready(function() {
    demo.initWizard();

    $('.tbl_booking').dataTable({
      order: [
        [0, 'desc']
      ],
      autoWidth: false,
      columnDefs: [{
          "width": "12%",
          "targets": 0
        },
        {
          "width": "12%",
          "targets": 1
        },
        {
          "width": "12%",
          "targets": 2
        },
        {
          "width": "15%",
          "targets": 4
        },
        {
          "width": "13%",
          "targets": 5
        },
        {
          "width": "10%",
          "targets": 6
        },
      ]
    });

    $(document).ready(function() {
      function initializeDataTable(selector, status, additionalColumnDefs) {
        return $(selector).DataTable({
          "ordering": false,
          "processing": true,
          "serverSide": true,
          "recordsTotal": 10,
          "recordsFiltered": 100,
          "lengthMenu": [10, 25, 50, 100],
          "ajax": {
            "url": "bookingsAjax",
            "type": "POST",
            "data": {
              status: status
            }
          },
          order: [
            [0, 'desc']
          ],
          autoWidth: false,
          "columns": [{
              "data": "booking_number"
            },
            {
              "data": "first_name"
            },
            {
              "data": "contact"
            },
            {
              "data": "contact"
            },
            {
              "data": "contact"
            },
            {
              "data": "arrival"
            },
            {
              "data": "arrival",
              "class": 'action'
            },
          ],
          "columnDefs": [{
              "targets": 0,
              "width": "12%",
              "render": function(data, type, row, meta) {
                var formattedDate = new Date(row.booking_added).toLocaleString('en-US', {
                  month: 'long',
                  day: 'numeric',
                  year: 'numeric',
                  hour: 'numeric',
                  minute: 'numeric',
                  hour12: true,
                });
                formattedDate = formattedDate.replace(' at ', ' ');
                formattedDate = formattedDate.replace(/\b([APMapm]{2})\b/g, function(match) {
                  return match.toLowerCase();
                });
                var formattedData = `<span style="${row.reservation_status === '6' ? 'text-decoration: line-through;' : ''}">${data}</span>`;

                if (row.reservation_status === '-1') {
                  formattedData += ` <span class="fa fa-lock"></span>`;
                }

                if (row.remarks) {
                  formattedData += `<span class="fa fa-info-circle ml-1 text-info" rel="tooltip" data-original-title="${row.remarks}"></span>`;
                }

                formattedData += `<br><small>${formattedDate}</small>`;

                if (row.cancel_reason) {
                  formattedData += `<br><small style="font-style:italic">(Cancel Reason - ${row.cancel_reason})</small>`;
                }

                return formattedData;
              }
            }, {
              "targets": 1,
              "width": "12%",
              "render": function(data, type, row, meta) {
                var guestLink = `<a href="${base_url}guest/${row.guest_id}" class="text-dark">${row.last_name}, ${row.first_name} ${row.middle_name}</a><br>
              <small>${row.address}</small>
            `;

                // if (row.charged_guest) {
                //   guestLink += `<br><small>Charged to: <a href="${base_url}guest/${row.charged_guest.guest_id}">
                //         ${row.charged_guest.first_name} ${row.charged_guest.middle_name} ${row.charged_guest.last_name} ${row.charged_guest.suffix}
                //       </a></small>`;
                // }
                return guestLink;
              }
            }, {
              "targets": 2,
              "width": "12%",
              "render": function(data, type, row, meta) {
                return `${row.contact}<br><small>${row.email}</small>`;
              }
            }, {
              "targets": 3,
              "render": function(data, type, row, meta) {
                const limit = 2;
                let roomDetails = '';

                row.rooms.forEach((room, i) => {
                  const detailsClass = i >= limit ? `d-none div-other-${room.booking_id}` : '';
                  roomDetails += `<details class="${detailsClass}">
                <summary>Room ${room.room_number} - ${room.room_type}`;

                  if (room.check_out === (new Date()).toLocaleDateString('en-US')) {
                    roomDetails += `<i class="fa-solid fa-calendar-day heart"></i>`;
                  }
                  roomDetails += `</summary>
                <small class="ml-3">Check In: ${room.check_in}</small><br>
                <small class="ml-3">Check Out: ${room.check_out}</small><br>
                <small class="ml-3">No. Nights: ${room.nights} night${room.nights ? '' : 's'}</small><br>
                <small class="ml-3">Room Price: ₱ ${Number(room.pricing_type).toLocaleString()}</small><br>
                <small class="ml-3">Discount: ${room.discount_type} (${room.percentage}${room.using_formula!=0 ? '' : '%'})</small>
            </details>`;
                });

                if (row.rooms.length >= limit && row.rooms.length - limit > 0) {
                  roomDetails += `<a href="javascript:" class="text-dark btn-other" id="${row.rooms[0].booking_id}">
                And ${row.rooms.length - limit} other room${row.rooms.length - limit === 1 ? '' : 's'}
            </a>`;
                }

                return roomDetails;
              }
            }, {
              "targets": 4,
              "width": "15%",
              "render": function(data, type, row, meta) {
                let paymentDetails = `<details>
            <summary>₱ ${Number(row.payment.amount).toLocaleString()} <small>Payment</small></summary>`;

                row.payments.forEach(payment => {
                  let icon, tooltip;

                  switch (payment.payment_option) {
                    case 'Cash':
                      icon = 'fa-solid fa-money-bill text-success';
                      break;
                    case 'Card':
                      icon = 'fa-solid fa-credit-card text-warning';
                      break;
                    case 'Check':
                      icon = 'fa-solid fa-money-check text-info';
                      break;
                    case 'Bank Transfer':
                      icon = 'fa fa-bank text-danger';
                      break;
                  }

                  tooltip = `${payment.payment_option}<br>${payment.payment_details}`;
                  paymentDetails += `<small class="mb-0">
                <span class="${icon} mr-1" data-placement="top" title="${tooltip}" rel="tooltip" data-html="true"></span>
                ₱ ${Number(payment.amount).toLocaleString()} - ${new Date(payment.booking_payment_added).toLocaleString('en-US', { timeZone: 'UTC' })}
            </small><br>`;
                });

                paymentDetails += `</details><details>
            <summary>₱ ${Number(row.refund.booking_refund).toLocaleString()} <small>Refund</small></summary>`;

                row.refunds.forEach(refund => {
                  paymentDetails += `<small class="mb-0">
                <span class="fa fa-info-circle text-info mr-1" data-placement="top" title="${refund.booking_refund_reason}" rel="tooltip" data-html="true"></span>
                ₱ ${Number(refund.booking_refund).toLocaleString()} - ${new Date(refund.booking_payment_added).toLocaleString('en-US', { timeZone: 'UTC' })}
            </small><br>`;
                });

                if (row.collectable) {
                  paymentDetails += `<hr>
            ₱ ${Number(row.collectable).toLocaleString()} <small>Collectable</small>`;
                }

                paymentDetails += `</details>`;

                return paymentDetails;
              }
            }, {
              "targets": 5,
              "width": "13%",
              "render": function(data, type, row, meta) {
                const arrivalDeparture = `${row.arrival} - ${row.departure}<br>`;

                let nights;
                try {
                  const arrival = new Date(row.arrival);
                  const departure = new Date(row.departure);
                  const timeDiff = departure - arrival;
                  nights = Math.ceil(timeDiff / (1000 * 3600 * 24)); // Calculate nights
                } catch (error) {
                  nights = 0;
                }

                const numberOfNights = `<small>Number of nights: ${nights}</small>`;

                return `${arrivalDeparture}${numberOfNights}`;
              }
            },
            ...additionalColumnDefs
          ]
        });
      }

      // Use the function for each table
      initializeDataTable('.tbl_active', [0], [{
        "targets": 6,
        "width": "10%",
        "render": function(data, type, row, meta) {
          return `<a href="${base_url}booking/${row.booking_number}" class="btn btn-sm" data-placement="top" title="View Booking" rel="tooltip">
                      <span class="fa fa-address-book"></span>
                    </a>
                    <a href="${base_url}receipt/${row.booking_id}" class="btn btn-sm btn-info receipt" data-placement="top" title="View Receipt" rel="tooltip">
                      <i class="fa-solid fa-receipt"></i>
                    </a>
                    <a href="javascript:" id="${row.booking_id}" class="btn btn-sm btn-danger cancelBooking" data-placement="top" title="Cancel Booking" rel="tooltip">
                      <span class="fa fa-ban"></span>
                    </a>`;
        }
      }]);
      initializeDataTable('.tbl_locked', [-1], [{
        "targets": 6,
        "width": "10%",
        "render": function(data, type, row, meta) {
          return `<a href="${base_url}booking/${row.booking_number}" class="btn btn-sm" data-placement="top" title="View Booking" rel="tooltip">
                      <span class="fa fa-address-book"></span>
                    </a>
                    <a href="${base_url}receipt/${row.booking_id}" class="btn btn-sm btn-info receipt" data-placement="top" title="View Receipt" rel="tooltip">
                      <i class="fa-solid fa-receipt"></i>
                    </a>`;
        }
      }]);
      initializeDataTable('.tbl_cancelled', [6], [{
        "targets": 6,
        "width": "10%",
        "render": function(data, type, row, meta) {
          return `<a href="${base_url}booking/${row.booking_number}" class="btn btn-sm" data-placement="top" title="View Booking" rel="tooltip">
                                  <span class="fa fa-address-book"></span>
                                </a>`;
        }
      }]);
    });
  });



  $(document).on('click', '.receipt', function(e) {
    e.preventDefault();
    const size = ['height=' + screen.height / 2, 'width=' + screen.width / 2].join(',');
    window.open($(this).attr('href'), size, size);
  });

  $(document).on('click', '.cancelBooking', function(e) {
    e.preventDefault();
    const booking_id = this.id;
    $('[name=booking_id]').val(booking_id);
    $("#modalReason").modal("show");
  });
</script>