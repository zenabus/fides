function popup(e, title, text, link) {
  e.preventDefault();
  swal({
    title,
    text,
    type: "info",
    buttonsStyling: false,
    showCancelButton: true,
    cancelButtonClass: "btn",
    confirmButtonClass: "btn btn-primary mr-2",
    confirmButtonText: "Yes",
    cancelButtonText: "No",
  }).then(result => {
    if (result) {
      window.location.replace(link);
    }
  });
}

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
  }).then(result => {
    if (result) {
      window.location.replace(this.href);
    }
  });
});

$(document).on("click", ".reset", function (e) {
  e.preventDefault();
  swal({
    title: "Are you sure?",
    html: "Password will be reset back to hdf2022",
    type: "warning",
    buttonsStyling: false,
    showCancelButton: true,
    cancelButtonClass: "btn",
    confirmButtonClass: "btn btn-primary mr-2",
  }).then(result => {
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

const addDays = (checkin, days = 1) => {
  let date = new Date(checkin);

  // Add days to the date
  date.setDate(date.getDate() + parseInt(days));

  // Format the new date as MM/DD/YYYY
  const month = (date.getMonth() + 1).toString().padStart(2, "0");
  const day = date.getDate().toString().padStart(2, "0");
  const year = date.getFullYear();
  return month + "/" + day + "/" + year;
};

const formatNumber = num => num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
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

const getDatesBetween = function (start, end) {
  for (var arr = [], dt = new Date(start); dt <= new Date(end); dt.setDate(dt.getDate() + 1)) {
    const date = new Date(dt);
    const string_date = `${pad(date.getMonth() + 1)}/${pad(date.getDate())}/${date.getFullYear()}`;
    arr.push(string_date);
  }
  return arr;
};

const toDashed = date => {
  const [month, day, year] = date.split("/");
  return `${year}-${month}-${day}`;
};

const ampm = date => {
  var date = new Date(date);
  let hours = date.getHours();
  let minutes = date.getMinutes();
  const ampm = hours >= 12 ? "pm" : "am";
  hours = hours % 12;
  hours = hours ? hours : 12;
  minutes = minutes < 10 ? "0" + minutes : minutes;
  return hours + ":" + minutes + " " + ampm;
};

const capitalize = str => {
  return str.charAt(0).toUpperCase() + str.slice(1);
};
