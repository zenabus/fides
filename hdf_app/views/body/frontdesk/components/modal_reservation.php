<div class="modal fade" id="modalBooking" tabindex="-1" role="dialog">
  <div class="modal-dialog pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="nc-icon nc-simple-remove"></i>
        </button>
        <h4 class="title title-up titleBooking mb-0">Booking Details</h4>
        <p id="booking_number"></p>
      </div>
      <div class="modal-body">
        <?= form_open('main/book', ['id' => 'frmBook']) ?>
        <input type="hidden" name="room_id">
        <input type="hidden" name="guest_id">
        <input type="hidden" name="booking_type">
        <input type="hidden" name="booking_id">
        <input type="hidden" name="booked_room_id">
        <div class="form-group type-div d-none">
          <label>Booking Type</label>
          <div class="d-flex justify-content-around">
            <div class="form-check-radio">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="rdo_booking_type" id="rdo_checkin" value="Check In" checked>
                Check In
                <span class="form-check-sign"></span>
              </label>
            </div>
            <div class="form-check-radio">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="rdo_booking_type" id="rdo_reservation" value="Reservation">
                Reservation
                <span class="form-check-sign"></span>
              </label>
            </div>
          </div>
        </div>
        <div class="form-group action-div d-none">
          <label>Action</label>
          <div class="d-flex justify-content-around">
            <div class="form-check-radio">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="action" id="rdo_check" value="Check In" checked>
                Check In
                <span class="form-check-sign"></span>
              </label>
            </div>
            <div class="form-check-radio">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="action" id="rdo_update" value="Update">
                Update
                <span class="form-check-sign"></span>
              </label>
            </div>
          </div>
        </div>
        <div class="form-group reservation-div">
          <label>Reservation Type</label>
          <div class="d-flex justify-content-around">
            <div class="form-check-radio">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="reservation_type" id="rdo_arrival" value="Arrival/Tentative" checked>
                Arrival/Tentative
                <span class="form-check-sign"></span>
              </label>
            </div>
            <div class="form-check-radio">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="reservation_type" id="rdo_confirmed" value="Confirmed">
                Confirmed
                <span class="form-check-sign"></span>
              </label>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-8">
            <label>Room Type</label>
            <input type="text" class="form-control" id="room_type" readonly>
          </div>
          <div class="form-group col-md-4">
            <label>Room Number</label>
            <input type="number" class="form-control text-center" id="room_number" readonly>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Check In</label>
            <input type="text" class="form-control datepicker text-center" name="check_in" readonly>
          </div>
          <div class="form-group col-md-4">
            <label>Check Out</label>
            <input type="text" class="form-control datepicker text-center" name="check_out">
          </div>
          <div class="form-group col-md-4">
            <label>Night(s)</label>
            <input type="number" class="form-control text-center" name="nights" value="1" min="0" autocomplete="off" readonly>
          </div>
        </div>
        <div class="form-group text-center">
          <a href="javascript:" id="returning_guest">Returning Guest?</a>
          <a href="javascript:" id="new_guest">New Guest?</a>
        </div>
        <div class=" form-row">
          <div class="form-group col-md-4">
            <label>First Name</label>
            <input type="text" class="form-control guest_details" name="first_name" required>
          </div>
          <div class="form-group col-md-4">
            <label>Middle Name</label>
            <input type="text" class="form-control guest_details" name="middle_name" placeholder="optional">
          </div>
          <div class="form-group col-md-4">
            <label>Last Name</label>
            <input type="text" class="form-control guest_details" name="last_name" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-8">
            <label>Contact No.</label>
            <input type="number" class="form-control guest_details" name="contact" required>
            <small class="text-muted" id="txt-contact"></small>
          </div>
          <div class="form-group col-md-4">
            <label>Suffix</label>
            <input type="text" class="form-control guest_details" name="suffix" placeholder="optional">
          </div>
        </div>
        <div class="form-group">
          <label>Special Request(s)</label>
          <input type="text" class="form-control" name="request" placeholder="optional">
        </div>
        <div class="form-group">
          <label>Notes / Remarks</label>
          <textarea name="remarks" rows="3" class="form-control" placeholder="optional"></textarea>
        </div>
        <div class="advanced-div">
          <div class="form-row">
            <div class="form-group col-md-12 payment_option">
              <label>Payment Option</label>
              <div class="d-flex justify-content-around my-2">
                <div class="form-check-radio mb-0">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="payment_option" value="Cash" checked>
                    Cash
                    <span class="form-check-sign"></span>
                  </label>
                </div>
                <div class="form-check-radio mb-0">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="payment_option" value="Card">
                    Card
                    <span class="form-check-sign"></span>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Advance Payment</label>
            <input type="number" class="form-control" name="amount" value="0" min="0" step="0.01">
          </div>
          <div class="form-group card-div d-none mb-0">
            <label>Account Number</label>
            <input type="number" class="form-control" name="card_number" placeholder="XXXX" maxlength="4">
            <small>Last 4 digit only.</small>
          </div>
        </div>
        <div class="row">
          <div class="col" style="padding-right:2px">
            <a href="javascript:" class="btn btn-info my-0 btn-block mb-1" id="btnPayments">View Payments</a>
          </div>
          <div class="col" style="padding-left:2px">
            <a href="javascript:" class="btn btn-info my-0 btn-block mb-1" id="btnPay">Add Payment</a>
          </div>
        </div>

        <a href="javascript:" class="btn my-0 btn-block mb-1" id="btnChange">Change Room</a>
        <a href="javascript:" class="btn btn-danger my-0 d-none btn-block" id="btnCancel">Cancel Reservation</a>
        <a href="javascript:" class="btn my-0 d-none btn-block" id="btnUpdate">Update Booking</a>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <input type="submit" value="Check In" class="btn btn-link" form="frmBook" id="btnBooking">
          <a href="javascript:" class="btn btn-link d-none" id="btnRedirect">Go to Booking</a>
        </div>
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalGuest" tabindex="-1" role="dialog">
  <div class="modal-dialog pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="nc-icon nc-simple-remove"></i>
        </button>
        <h4 class="title title-up">Search Guest</h4>
      </div>
      <div class="modal-body px-4">
        <input type="text" class="form-control mb-3" placeholder="Search Guest" id="search">
        <table class="table table-bordered mb-0">
          <thead>
            <tr>
              <th>Name</th>
              <th>Company</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody class="guests-tbody">
            <tr>
              <td colspan="3" class="text-center">Search guest record</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modalReason" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Cancel Reservation</h4>
      </div>
      <div class="modal-body px-4">
        <?= form_open('main/cancelReservation', ['id' => 'frmCancel']) ?>
        <input type="hidden" name="booking_id">
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
  $('#btnUpdate').click(function() {
    $('#frmBook').submit();
  });
</script>