<div class="modal fade" id="modalBooking" tabindex="-1" role="dialog">
  <div class="modal-dialog pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="nc-icon nc-simple-remove"></i>
        </button>
        <h4 class="title title-up titleBooking">Booking Details</h4>
      </div>
      <div class="modal-body">
        <?= form_open('main/book', ['id' => 'frmBook']) ?>
        <input type="hidden" name="room_id">
        <input type="hidden" name="guest_id">
        <input type="hidden" name="booking_type">
        <div class="form-group reservation-div">
          <label>Reservation Type</label>
          <div class="d-flex justify-content-around">
            <div class="form-check-radio">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="reservation_type" id="reservation_type" value="Arrival/Tentative" checked>
                Arrival/Tentative
                <span class="form-check-sign"></span>
              </label>
            </div>
            <div class="form-check-radio">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="reservation_type" id="reservation_type" value="Confirmed">
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
            <input type="number" class="form-control text-center" name="nights" value="1" min="0">
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
            <input type="text" class="form-control guest_details" name="middle_name">
          </div>
          <div class="form-group col-md-4">
            <label>Last Name</label>
            <input type="text" class="form-control guest_details" name="last_name" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Contact Number</label>
            <input type="text" class="form-control guest_details" name="contact" required>
          </div>
          <div class="form-group col-md-8">
            <label>E-mail <small>(optional)</small></label>
            <input type="text" class="form-control guest_details" name="email">
          </div>
        </div>
        <div class="form-group">
          <label>Company Name <small>(optional)</small></label>
          <input type="text" class="form-control guest_details" name="company_name">
        </div>
        <div class="form-group">
          <label>Advance Payment Option</label>
          <div class="d-flex justify-content-around">
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
        <div class="form-group">
          <label>Amount</label>
          <input type="number" name="amount" class="form-control" value="0" min="0">
        </div>
        <div class="card-div">
          <div class="row">
            <div class="form-group col-md-12">
              <label>Card Type</label>
              <select name="card_type" class="form-control">
                <option value="">- select card type -</option>
                <option value="BDO">Banco de Oro (BDO)</option>
                <option value="Landbank">Land Bank of the Philippines</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label>Account Number</label>
              <input type="text" name="card_number" class="form-control" placeholder="XXXX XXXX XXXX XXXX" maxlength="19">
            </div>
            <div class="form-group col-md-6">
              <label>Account Name</label>
              <input type="text" name="card_name" class="form-control">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Notes / Remarks</label>
          <textarea name="remarks" rows="3" class="form-control"></textarea>
        </div>
        <?= form_close() ?>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <input type="submit" value="Check In" class="btn btn-link" form="frmBook" id="btnBooking">
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