<style>
  .room {
    background-color: white;
    border: 1px solid #66615B;
    color: #66615B;
    padding: 8px;
    border-radius: 5px;
    margin-right: 8px;
    margin-bottom: 8px;
    cursor: pointer;
    width: 92px;
    text-align: center;
    user-select: none;
  }

  .room:hover {
    background-color: #999591;
    color: white;
  }

  .room-active {
    background-color: #66615B !important;
    color: white;
  }

  #modalGuest {
    z-index: 9999999999 !important;
  }

  .guest-close,
  .mass {
    cursor: pointer;
  }
</style>

<div class="modal fade" id="modalMass" tabindex="-1" role="dialog">
  <div class="modal-dialog pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title title-up">Mass Booking</h4>
      </div>
      <div class="modal-body">
        <?= form_open('main/massBooking', ['id' => 'frmMass']) ?>
        <input type="hidden" name="guest_id">
        <input type="hidden" name="room_ids">
        <div class="form-group">
          <label>Booking Type</label>
          <div class="d-flex justify-content-around">
            <div class="form-check-radio">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="rdo_booking_type" id="rdo_checkin_mass" value="Check In" checked>
                Check In
                <span class="form-check-sign"></span>
              </label>
            </div>
            <div class="form-check-radio">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="rdo_booking_type" id="rdo_reservation_mass" value="Reservation">
                Reservation
                <span class="form-check-sign"></span>
              </label>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Check In</label>
            <input type="text" class="form-control datepicker text-center" name="check_in_mass" readonly>
          </div>
          <div class="form-group col-md-4">
            <label>Check Out</label>
            <input type="text" class="form-control datepicker text-center" name="check_out_mass">
          </div>
          <div class="form-group col-md-4">
            <label>Night(s)</label>
            <input type="number" class="form-control text-center" name="nights" value="1" min="0" autocomplete="off" readonly>
          </div>
        </div>
        <div class="form-group mb-0 d-flex justify-content-between align-items-baseline">
          <label>Guest</label>
          <div>
            <a href="javascript:" class="btn btn-sm" id="select-guest">Select Guest</a>
            <span id="guest-name"></span>
            <span class="fa fa-times text-danger guest-close"></span>
          </div>
        </div>
        <p class="text-center mb-2">Select Rooms (<span id="selected">0</span>)</p>
        <div class="d-flex flex-wrap justify-content-between">
          <?php $prev = 0; ?>
          <?php foreach ($rooms as $room) { ?>
            <div class="room" id="<?= $room['room_id'] ?>"><?= $room['room_number'] ?> <?= $room['room_type_abbr'] ?></div>
            <?php $prev = $room['room_number'] ?>
          <?php } ?>
        </div>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <button type="submit" form="frmMass" class="btn btn-link">Proceed</button>
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
  let selected = 0;
  let room_ids = [];

  $(document).ready(function() {
    $('.guest-close').hide();
  });

  $('.room').click(function() {
    const room_id = this.id;
    if ($(this).hasClass('room-active')) {
      room_ids = room_ids.filter(item => item !== room_id)
      $(this).removeClass('room-active');
      $('#selected').text(--selected);
    } else {
      room_ids.push(room_id);
      $(this).addClass('room-active');
      $('#selected').text(++selected);
    }
    $('[name=room_ids]').val(JSON.stringify(room_ids));
  });

  $('#select-guest').click(function() {
    modalGuestType = 'Mass';
    $('#modalGuest').modal('show')
  });

  $("#modalMass").on("hide.bs.modal", function() {
    $('#frmMass').trigger('reset');
    $("#returning_guest").show();
    $("#new_guest").hide();
    $("#select-guest").show();
    $("#guest-name").hide();
    $(".guest-close").hide();
  });

  $('.guest-close').click(function() {
    $('[name=guest_id]').val(null)
    $("#select-guest").show();
    $("#guest-name").hide();
    $(".guest-close").hide();
  });

  $('.mass').click(function() {
    const date = $(this).attr('date');
    const type = $(this).attr('type');

    $("[name=check_in_mass]").data("DateTimePicker").date(moment(date));
    $("[name=check_out_mass]").data("DateTimePicker").date(moment(date).add(1, "days"));
    $("[name=check_out_mass]").data("DateTimePicker").minDate(moment(date).add(1, "days"));
    $("input[name=rdo_booking_type][value='" + type + "']").prop("checked", true);

    $('#modalMass').modal('show');
  });

  $("[name=check_out_mass]").on("dp.change", function(e) {
    const checkout = moment($(this).val());
    const checkin = moment($("[name=check_in_mass]").val());
    const nights = checkout.diff(checkin, "days");
    $("[name=nights]").val(nights);
  });

  $('#frmMass').submit(function(e) {
    const guest_id = $('[name=guest_id]').val();

    if (!guest_id) {
      swal({
        title: "Incomplete",
        text: "Please select a guest",
        type: "warning",
      })
      e.preventDefault();
    }

    if (!room_ids.length) {
      swal({
        title: "Incomplete",
        text: "Please select rooms",
        type: "warning",
      })
      e.preventDefault();
    }
  });
</script>