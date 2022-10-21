const minDate = new Date();
minDate.setDate(minDate.getDate() - 2);
$(".datepicker").datetimepicker({
  icons: {
    time: "fa fa-clock-o",
    date: "fa fa-calender",
    up: "fa fa-chevron-up",
    down: "fa fa-chevron-down",
    previous: "fa fa-chevron-left",
    next: "fa fa-chevron-right",
    today: "fa fa-screenshot",
    clear: "fa fa-trash",
    close: "fa fa-remove",
  },
  format: "L",
  defaultDate: new Date(),
  minDate,
});

$(document).ready(function () {
  $("[name=check_in]").on("dp.change", function (e) {
    const checkin = moment($(this).val());
    const checkout = moment($("[name=check_out]").val());
    const nights = checkout.diff(checkin, "days");
    $("[name=check_out]").data("DateTimePicker").date(moment(checkin).add(1, "days"));
    $("[name=check_out]").data("DateTimePicker").minDate(moment(checkin).add(1, "days"));
    $("[name=nights]").val(nights);
  });
});

$("#returning_guest").click(function () {
  $("#modalGuest").modal("show");
});

$("#modalGuest").on("shown.bs.modal", function () {
  $("#search").focus();
});

$("[name=payment_option]").change(function () {
  const option = $(this).val();
  if (option == "Cash") {
    $(".card-div").hide();
    $("[name=card_number]").val("");
    $("[name=card_number]").removeAttr("required");
  } else {
    $("[name=card_number]").attr("required", true);
    $(".card-div").show();
  }
});

$("#search").on("keypress", function (e) {
  if (e.which === 13) {
    $(".guests-tbody tr:first-child td:last-child button:first-child").click();
  }
});

$("#search").on("input", function () {
  const search = $(this).val();
  const guest = guests.filter(g => {
    const guest_name = g.first_name + " " + g.last_name;
    if (
      guest_name.toLowerCase().includes(search.toLowerCase()) ||
      g.contact.toLowerCase().includes(search.toLowerCase()) ||
      g.company_name.toLowerCase().includes(search.toLowerCase())
    ) {
      return g;
    }
  });

  $(".guests-tbody").html("");

  if (guest.length && search) {
    guest.map(g => {
      let tbody = `
        <tr>
          <td>
            ${g.last_name}, ${g.first_name} ${g.middle_name}<br>
            <small>${g.contact}</small>
          </td>
          <td>
            ${g.company_name}<br>
            <small>${g.company_address}</small>
          </td>
          <td class="action text-center">
            <button class="btn btn-sm btn-primary choose" guest='${JSON.stringify(g)}'>
              <span class="fa fa-check"></span>
            </button>
            </button>
          </td>
        </tr>
        `;
      $(".guests-tbody").append(tbody);
    });
  } else {
    $(".guests-tbody").html('<tr><td colspan="5" class="text-center">No result found</td></tr>');
  }
});

$(document).on("click", ".choose", function () {
  const guest = JSON.parse($(this).attr("guest"));
  $("[name=guest_id]").val(guest.guest_id);
  $("[name=first_name]").val(guest.first_name);
  $("[name=middle_name]").val(guest.middle_name);
  $("[name=last_name]").val(guest.last_name);
  $("[name=contact]").val(guest.contact);
  $("[name=email]").val(guest.email);
  $("[name=company_name]").val(guest.company_name);
  $("#modalGuest").modal("hide");
  $("#returning_guest").hide();
  $("#new_guest").show();
  $(".guest_details").prop("readonly", true);
});

$("#new_guest").click(function () {
  $(".guest_details").prop("readonly", false).val("");
  $("[name=guest_id]").val(0);
  $("[name=first_name]").focus();
  $("#returning_guest").show();
  $("#new_guest").hide();
});

$("[name=nights]").on("input", function () {
  const nights = parseInt($(this).val());
  const checkin = moment($("[name=check_in]").val());
  const checkout = moment(checkin).add(nights, "days");

  if (!nights || nights > 0) {
    $(this).val(1);
  }

  $("[name=check_out]").data("DateTimePicker").date(checkout);
});

$("[name=check_out]").on("dp.change", function (e) {
  const checkout = moment($(this).val());
  const checkin = moment($("[name=check_in]").val());
  const nights = checkout.diff(checkin, "days");
  $("[name=nights]").val(nights);
});

const modalBooking = (obj, booking_type, minDate = 0, booking_number = "") => {
  let date = $(obj).attr("date") ?? new Date();
  const data = JSON.parse($(obj).attr("data"));

  // automatic early check-in
  // const now = new Date();
  // if(now.getHours() < 10) {
  //   date = moment(date).subtract(1, 'days');
  // }
  // console.log(date);

  $("#room_type").val(data.room_type);
  $("#room_number").val(data.room_number);
  $("[name=room_id]").val(data.room_id);
  $("[name=check_in]").data("DateTimePicker").date(date);
  $("[name=check_out]").data("DateTimePicker").date(moment(date).add(1, "days"));
  $("[name=check_out]").data("DateTimePicker").minDate(moment(date).add(minDate, "days"));
  $("[name=nights]").val(1);
  $("[name=booking_type]").val(booking_type);
  if (booking_type == "Check In") {
    $(".reservation-div").hide();
  } else {
    $(".reservation-div").show();
  }
  $(".titleBooking").text(`${booking_type} Details`);
  $("#booking_number").text(booking_number);
  $("#btnBooking").val(booking_type == "Check In" ? booking_type : "Reserve");
  setTimeout(() => {
    $("#title").text(`Room Calendar [ROOM: ${data.room_number} - ${date}]`);
  });
  $("#modalBooking").modal("show");
};

$("[name=action]").change(function () {
  if ($(this).val() == "Update") {
    $("#frmBook").attr("action", `${base_url}index.php/main/updateReservation`);
    $(".reservation-div").show();
  } else {
    $("#frmBook").attr("action", `${base_url}index.php/main/checkIn`);
    $(".reservation-div").hide();
  }
  $("#btnBooking").val($(this).val());
});

$("#btnCancel").click(function () {
  $("#modalReason").modal("show");
});

$("[name=rdo_booking_type]").change(function () {
  if ($(this).val() == "Check In") {
    $("#frmBook").attr("action", `${base_url}index.php/main/book`);
    $("#btnBooking").val("Check In");
    $(".reservation-div").hide();
    $("[name=booking_type]").val("Check In");
    $(".advanced-div").hide();
  } else {
    $("#frmBook").attr("action", `${base_url}index.php/main/book`);
    $("#btnBooking").val("Reserve");
    $(".reservation-div").show();
    $("[name=booking_type]").val("Reservation");
  }
});

$(document).ready(function () {
  $(".advanced-div").hide();
});

$("[name=reservation_type]").change(function () {
  if ($(this).val() == "Confirmed") {
    $(".advanced-div").show();
  } else {
    // $("[name=amount]").val("");
    // $("[name=card_number]").val("");
    $(".advanced-div").hide();
  }
});

$("#modalBooking").on("hide.bs.modal", function (e) {
  $(".advanced-div").hide();
  $("[name=guest_id]").removeAttr("value");
  $("#frmBook").trigger("reset");
  $("[name=booking_id]").val("");

  $("[name=amount]").removeAttr("disabled");
  $("[name=card_number]").removeAttr("disabled");
  $("[name=payment_option]").removeAttr("disabled");
});

$("[name=payment_option]").change(function () {
  const option = $(this).val();
  $("[name=amount]").focus();
  if (option == "Cash") {
    $(".card-div").addClass("d-none");
    $("[name=card_number]").val("");
    $("[name=card_number]").removeAttr("required");
  } else {
    $("[name=card_number]").attr("required", true);
    $(".card-div").removeClass("d-none");
  }
});
