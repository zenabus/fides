$(document).on('click', '.confirm', function(e){
  e.preventDefault();
  swal({
    title:"Are you sure?", 
    text: "Please confirm your selected action", 
    type: "warning", 
    buttonsStyling: false,
    showCancelButton: true,
    cancelButtonClass: 'btn btn-default',
    confirmButtonClass: "btn btn-primary mr-2"
  }).then((result) => {
    if (result) {
      window.location.replace(this.href);
    }
  });
});

$(document).on('click', '.delete', function(e){
  swal({
    title: 'Are you sure to delete?',
    text: '',
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Delete',
    cancelButtonText: 'Cancel',
    confirmButtonClass: "btn btn-success",
    cancelButtonClass: "btn btn-danger",
    buttonsStyling: false
  }).then((result) => {
    if (!result.value) {
      window.location.replace(this.id);
    }
  });
});

$(document).on('click', '.update', function(e){
  swal({
    title: 'Are you sure to go update form?',
    text: '',
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Confirm',
    cancelButtonText: 'Cancel',
    confirmButtonClass: "btn btn-success",
    cancelButtonClass: "btn btn-danger",
    buttonsStyling: false
  }).then((result) => {
    if (!result.value) {
      window.location.replace(this.id);
    }
  });
});

$(document).ready(function(){
  $('.datatables').DataTable({
    "pagingType": "full_numbers",
    "order": [[ 3, "desc" ]],
    "lengthMenu": [
      [10, 25, 50, -1],
      [10, 25, 50, "All"]
    ],
    responsive: true,
    language: {
      search: "_INPUT_",
      searchPlaceholder: "Search records",
    }
  });  
});

const formatNumber = num => num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');