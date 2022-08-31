$(document).on("click", ".confirm", function (e) {
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
      window.location.replace(this.href);
    }
  });
});

$(document).on("click", ".reset", function (e) {
  e.preventDefault();
  swal({
    title: "Reset user password?",
    html: "Password will be reset back to hdf2022",
    type: "warning",
    buttonsStyling: false,
    showCancelButton: true,
    cancelButtonClass: "btn",
    confirmButtonClass: "btn btn-primary mr-2",
  }).then((result) => {
    if (result) {
      window.location.replace(this.href);
    }
  });
});

$(document).ready(function () {
  if ($(".datatables")[0]) {
    $(".datatables").DataTable({
      pagingType: "full_numbers",
      order: [[3, "desc"]],
      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"],
      ],
      responsive: true,
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Search records",
      },
    });
  }
});

const formatNumber = (num) => num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
const pad = (num, places = 2) => String(num).padStart(places, "0");

function getMonth() {
  const month = new Date();
  const months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];
  return months[month.getMonth()];
}
