let modalGuestType = "Single";
let room_id;

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

$("#returning_guest").click(function () {
  modalGuestType = "Single";
  $("#modalGuest").modal("show");
});

$("#modalGuest").on("shown.bs.modal", function () {
  $("#search").focus();
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

  if (modalGuestType == "Single") {
    $("[name=guest_id]").val(guest.guest_id);
    $("[name=first_name]").val(guest.first_name);
    $("[name=middle_name]").val(guest.middle_name);
    $("[name=last_name]").val(guest.last_name);
    $("[name=contact]").val(guest.contact);
    $("[name=email]").val(guest.email);
    $("[name=company_name]").val(guest.company_name);
    $("#txt-contact").text(`${guest.contact.length} digits`);
    $("#modalGuest").modal("hide");
    $("#returning_guest").hide();
    $("#new_guest").show();
    $(".guest_details").prop("readonly", true);
  } else {
    const guest_name = `${guest.first_name} ${guest.middle_name} ${guest.last_name} ${guest.suffix}`;
    $("#modalGuest").modal("hide");
    $("[name=guest_id]").val(guest.guest_id);
    $("#select-guest").hide();
    $("#new-guest").hide();
    $("#new_guest").hide();
    $("#guest-name").text(guest_name).show();
    $(".guest-close").show();
  }
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

const updateAvailableRoom = (check_in, check_out) => {
  fetch(`${base_url}index.php/main/checkAvailableDates/${check_in}/${check_out}/${room_id}/${booked_room_id}`)
    .then(response => response.json())
    .then(data => {
      if (data.length) {
        $("#btnBooking").addClass("disabled");
      } else {
        $("#btnBooking").removeClass("disabled");
      }
    });
};

$("[name=check_in]").on("dp.change", function (e) {
  let checkin = moment($("[name=check_in]").val());
  let checkout = moment($("[name=check_out]").val());
  const nights = checkout.diff(checkin, "days");
  $("[name=check_out]").data("DateTimePicker").minDate(moment(checkin).add(1, "days"));
  $("[name=check_out]").data("DateTimePicker").date(moment(checkin).add(1, "days"));
  $("[name=nights]").val(nights);
});

$("[name=check_out]").on("dp.change", function (e) {
  let checkin = moment($("[name=check_in]").val());
  let checkout = moment($("[name=check_out]").val());
  const nights = checkout.diff(checkin, "days");
  checkin = moment(checkin).format("YYYY-MM-DD");
  checkout = moment(checkout).format("YYYY-MM-DD");
  updateAvailableRoom(checkin, checkout);
  $("[name=nights]").val(nights);
});

$("#modalBooking").on("shown.bs.modal", function () {
  $("#btnBooking").removeClass("disabled");
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
  room_id = data.room_id;
  $("#room_type").val(data.room_type);
  $("#room_number").val(data.room_number);
  $("[name=room_id]").val(data.room_id);
  $("[name=check_in]").data("DateTimePicker").date(date);
  $("[name=check_out]").data("DateTimePicker").minDate(moment(date).add(minDate, "days"));
  $("[name=check_out]").data("DateTimePicker").date(moment(date).add(1, "days"));
  $("[name=nights]").val(1);
  $("[name=booking_type]").val(booking_type);
  if (booking_type == "Check In") {
    $(".reservation-div").hide();
    $("#btnChange").hide();
    if (booking_number) {
      $("#btnUpdate").show().css("display", "block");
    }
  } else {
    if (booking_number) {
      $("#btnChange").show().css("display", "block");
    }
    $(".reservation-div").show();
    $("[name=check_in]").removeAttr("readonly");
    $("[name=check_out]").removeAttr("readonly");
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

$("#btnChange").click(function () {
  const date = new Date();
  const size = ["height=" + screen.height / 2, "width=" + screen.width / 2].join(",");
  const calendar = window.open(
    `${base_url}index.php/main/calendar/${date.getFullYear()}/${pad(date.getMonth() + 1)}/1`,
    "Calendar",
    size
  );
  calendar.onbeforeunload = function () {
    const booking_id = $("[name=booking_id]").val();
    const nights = localStorage.getItem("nights");
    const room_id = localStorage.getItem("room_id");
    const check_in = localStorage.getItem("check_in");
    const check_out = localStorage.getItem("check_out");

    const data = {
      nights,
      room_id,
      check_in,
      check_out,
      booking_id,
      booked_room_id,
    };

    console.log(data);

    if (data.room_id) {
      console.log(1);
      fetch(`${base_url}index.php/main/changeRoomAjax`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
      })
        .then(response => response.json())
        .then(data => {
          console.log("Success:", data);
          location.reload();
        })
        .catch(error => {
          console.error("Error:", error);
        });

      localStorage.removeItem("check_in");
      localStorage.removeItem("check_out");
      localStorage.removeItem("room_id");
      localStorage.removeItem("room_type");
      localStorage.removeItem("room_number");
      localStorage.removeItem("nights");
    } else {
      console.log(2);
    }
  };
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
  $(".card-div").addClass("d-none").hide();

  $("#txt-contact").text("");
  $("#btnUpdate").hide();
});

$("[name=payment_option]").change(function () {
  const option = $(this).val();
  $("[name=amount]").focus();
  if (option == "Cash") {
    $(".card-div").addClass("d-none");
    $(".card-div").hide();
    $("[name=card_number]").val("");
    $("[name=card_number]").removeAttr("required");
  } else {
    $("[name=card_number]").attr("required", true);
    $(".card-div").removeClass("d-none");
    $(".card-div").show();
  }
});

$("[name=payment_payment_option]").change(function () {
  const option = $(this).val();
  $("[name=amount]").focus();
  if (option == "Cash") {
    $(".payment-card-div").addClass("d-none");
    $("[name=payment_card_number]").val("");
    $("[name=payment_card_number]").removeAttr("required");
  } else {
    $("[name=payment_card_number]").attr("required", true);
    $(".payment-card-div").removeClass("d-none");
  }
});

// $("[name=payment_option]").change(function () {
//   const option = $(this).val();
//   if (option == "Cash") {
//     $(".card-div").hide();
//     $("[name=card_number]").val("");
//     $("[name=card_number]").removeAttr("required");
//   } else {
//     $("[name=card_number]").attr("required", true);
//     $(".card-div").show();
//   }
// });

$("#btnPay").click(function () {
  $("#modalPay").modal("show");
});

$("#btnPayments").click(function () {
  const booking_id = $("[name=booking_id]").val();
  $("#payments-tbody").html(`
    <tr>
      <td class="text-center" colspan="5">Loading..</td>
    </tr>
  `);
  fetch(`${base_url}index.php/main/getAdvancePayments/${booking_id}`)
    .then(response => response.json())
    .then(data => {
      let tbody = "";
      data.forEach(payment => {
        const amount = parseInt(payment.amount).toLocaleString("en-US", { minimumFractionDigits: 2 });

        const timeString = payment.booking_payment_added;
        const dateTime = new Date(timeString);
        const formattedDate = dateTime.toLocaleDateString("en-US", {
          year: "numeric",
          month: "long",
          day: "numeric",
        });
        const formattedTime = dateTime.toLocaleTimeString("en-US", {
          hour: "numeric",
          minute: "numeric",
          hour12: true,
        });

        tbody += `
          <tr>
            <td>
              ₱${amount}<br/>
              <small class="text-muted">${payment.payment_option} ${
          payment.payment_option == "Card" ? `[${payment.payment_details}]` : ""
        }</small>
            </td>
            <td>
              ${payment.name}<br/>
              <small class="text-muted">${formattedDate + " " + formattedTime}</small>
            </td>
            <td><a href="${base_url}index.php/main/deletePayment/${
          payment.booking_payment_id
        }" class="btn btn-sm btn-danger deletePayment px-2"><span class="fa fa-trash"></span></a></td>
          </tr>`;
        console.log(payment);
      });
      console.log(tbody);
      $("#payments-tbody").html(tbody);
    });
  $("#modalPayments").modal("show");
});

$(document).on("click", ".deletePayment", function (e) {
  e.preventDefault();
  swal({
    title: "Are you sure?",
    text: "Please confirm your selected action",
    type: "warning",
    buttonsStyling: false,
    showCancelButton: true,
    zIndex: 99999999,
    cancelButtonClass: "btn",
    confirmButtonClass: "btn btn-primary mr-2",
  }).then(result => {
    if (result) {
      window.location.replace(this.href);
    }
  });
});
