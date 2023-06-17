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
        <h4 class="title title-up" id="title-mass">Mass Booking</h4>
      </div>
      <div class="modal-body">
        <?= form_open('main/massBooking', ['id' => 'frmMass']) ?>
        <input type="hidden" name="guest_id">
        <input type="hidden" name="room_ids">
        <div class="form-group d-none">
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
            <a href="javascript:" class="btn btn-sm" id="new-guest">New Guest</a>
            <span id="guest-name"></span>
            <span class="fa fa-times text-danger guest-close"></span>
          </div>
        </div>
        <p class="text-center mb-2">Select Rooms (<span id="selected">0</span>)</p>
        <div class="d-flex flex-wrap justify-content-between">
          <?php $prev = 0; ?>
          <?php foreach ($rooms as $room) { ?>
            <div class="room r<?= $room['room_id'] ?>" id="<?= $room['room_id'] ?>"><?= $room['room_number'] ?> <?= $room['room_type_abbr'] ?></div>
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


<div class="modal fade" id="modalNew" tabindex="-1" role="dialog">
  <div class="modal-dialog pt-0" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="nc-icon nc-simple-remove"></i>
        </button>
        <h4 class="title title-up">New Guest</h4>
      </div>
      <div class="modal-body">
        <div class=" form-row">
          <div class="form-group col-md-4">
            <label>First Name</label>
            <input type="text" class="form-control" id="first_name" required>
          </div>
          <div class="form-group col-md-4">
            <label>Middle Name</label>
            <input type="text" class="form-control" id="middle_name" placeholder="optional">
          </div>
          <div class="form-group col-md-4">
            <label>Last Name</label>
            <input type="text" class="form-control" id="last_name" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-8">
            <label>Contact No.</label>
            <input type="number" class="form-control" id="contact" required>
            <small class="text-muted" id="txt-contact_new"></small>
          </div>
          <div class="form-group col-md-4">
            <label>Suffix</label>
            <input type="text" class="form-control" id="suffix" placeholder="optional">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <button type="button" class="btn btn-link" id="btnNewGuest">Proceed</button>
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

  $('#new-guest').click(function() {
    $('#modalNew').modal('show')
  });

  $("#modalMass").on("hide.bs.modal", function() {
    $('#frmMass').trigger('reset');
    $("#returning_guest").show();
    $("#new_guest").hide();
    $("#select-guest").show();
    $("#new-guest").show();
    $("#guest-name").hide();
    $(".guest-close").hide();
    $('[name=guest_id]').val('');
    $('[name=room_ids]').val('');
  });

  $('.guest-close').click(function() {
    $('[name=guest_id]').val(null)
    $("#select-guest").show();
    $("#new-guest").show();
    $("#guest-name").hide();
    $(".guest-close").hide();
    $('[name=guest_id]').val('');
  });

  const updateAvailableRooms = (check_in, check_out) => {
    fetch(`${base_url}index.php/main/checkAvailableRooms/${check_in}/${check_out}`)
      .then((response) => response.json())
      .then((data) => {
        selected = 0;
        $('#selected').text(selected);
        $('.room').removeAttr('disabled').removeClass('room-active');
        data.map(room => {
          $('.r' + room).attr('disabled', true);
        });
      });
  }

  $('.mass').click(function() {
    const base_url = '<?= base_url() ?>';
    const date = $(this).attr('date');
    const type = $(this).attr('type');

    $("[name=check_in_mass]").data("DateTimePicker").date(moment(date));
    $("[name=check_out_mass]").data("DateTimePicker").minDate(moment(date).add(1, "days"));
    $("[name=check_out_mass]").data("DateTimePicker").date(moment(date).add(1, "days"));
    $("input[name=rdo_booking_type][value='" + type + "']").prop("checked", true);
    $('#title-mass').text(`MASS ${type.toUpperCase()}`);

    const check_in = moment(date).format('YYYY-MM-DD');
    const check_out = moment(date).add(1, "days").format('YYYY-MM-DD');
    updateAvailableRooms(check_in, check_out);

    $('#modalMass').modal('show');
  });

  $("[name=check_in_mass], [name=check_out_mass]").on("dp.change", function(e) {
    let check_in = moment($("[name=check_in_mass]").val());
    let check_out = moment($("[name=check_out_mass]").val());
    const nights = check_out.diff(check_in, "days");
    $("[name=nights]").val(nights);

    check_in = moment(check_in).format('YYYY-MM-DD');
    check_out = moment(check_out).format('YYYY-MM-DD');

    if (check_in != 'Invalid date' && check_out != 'Invalid date') {
      updateAvailableRooms(check_in, check_out);
    }
  });

  $('#modalMass').on('hide.bs.modal', function() {
    selected = 0;
    $('#selected').text(0);
    $('.room').removeClass('room-active');
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

  $('#btnNewGuest').click(function() {
    const first_name = $('#first_name').val();
    const middle_name = $('#middle_name').val();
    const last_name = $('#last_name').val();
    const contact = $('#contact').val();
    const suffix = $('#suffix').val();

    if (!first_name) {
      $('#first_name').focus();
      return;
    }
    if (!last_name) {
      $('#last_name').focus();
      return;
    }
    if (!contact) {
      $('#contact').focus();
      return;
    }

    const data = {
      first_name,
      middle_name,
      last_name,
      contact,
      suffix
    }

    fetch(`${base_url}index.php/main/addNewGuest`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(data),
      })
      .then(response => response.json())
      .then(data => {
        console.log("Success:", data);
        $('[name=guest_id]').val(data.guest_id);
        $("#select-guest").hide();
        $("#new-guest").hide();
        $('#guest-name').text(`${data.first_name} ${data.middle_name} ${data.last_name} ${data.suffix}`).show();
        $(".guest-close").show();
        $("#modalNew").modal("hide");

        fetch(`${base_url}index.php/main/getGuests`)
          .then(response => response.json())
          .then(data => {
            console.log("Success:", data);
            guests = data;
          })
          .catch(error => {
            console.error("Error:", error);
          });
      })
      .catch(error => {
        console.error("Error:", error);
      });
  });
</script>