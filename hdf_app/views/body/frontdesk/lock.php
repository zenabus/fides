<script type="text/javascript">
  //window.location.reload();
  window.onload = function() {
    if (!window.location.hash) {
      window.location = window.location + '#loaded';
      window.location.reload();
    }
  }
</script>

<?php if (validation_errors()) : ?>

  <script>
    $(document).ready(function() {

      demo.showNotification_error('top', 'right');

    });
  </script>



<?php endif; ?>



<?php if ($this->session->flashdata('success')) : ?>

  <script>
    $(document).ready(function() {

      demo.showNotification('top', 'right');

    });
  </script>



<?php endif; ?>



<div class="content pb-0">

  <div class="row">

    <div class="col-md-12">

      <h5><b>LOCKED BOOKINGS</b></h5>

      <div class="card">

        <div class="card-header">

          <h6><b>GUEST LIST(S)</b></h6>

          <!-- <span class="badge badge-pill badge-danger">List of Checked In</span> -->

        </div>

        <div class="card-body">

          <div class="toolbar">

            <!--        Here you can write extra buttons/actions for the toolbar              -->

          </div>

          <table id="datatables" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Guest Name</th>
                <th>Contact No.</th>
                <th>E-mail</th>
                <th>Room no.</th>
                <th>Room Type</th>
                <th>Check-In Date</th>
                <th>Check-Out Date</th>
                <th>Payment Status</th>
                <th class="disabled-sorting text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($result_checked as $data) {

                # code...
              ?>
                <tr>
                  <td><?php echo $data['last_name'] ?>, <?php echo $data['first_name'] ?> <?php echo $data['middle_name'] ?></td>
                  <td><?php echo $data['contact'] ?></td>
                  <td><?php echo $data['email'] ?></td>
                  <td><?php echo $data['label'] ?> </td>
                  <td><?php echo $data['room_type'] ?> </td>
                  <td><?php echo $data['start_date'] ?> </td>
                  <td><?php echo $data['end_date'] ?> </td>
                  <td>
                    <?php
                    if ($data['status_payment'] == 'Paid') {
                      echo "<span class='badge badge-success'>Paid</span>";
                    } else {
                      echo "<span class='badge badge-danger'>Unpaid</span>";
                    }
                    ?></td>
                  <td>
                    <center>
                      <a href="<?php echo base_url('index.php/main/refresh/' . $data['che_id']) ?>" class="btn btn-info btn-icon btn-sm"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Details"></i></a>
                      <!-- <?php
                            //if ($data['status_payment'] =='Paid'  ) { 
                            ?>
                           <a href="<?php //echo base_url('index.php/main/deleteBookingCancel/'.$data['che_id']) 
                                    ?>"  class="btn btn-warning btn-icon btn-sm" disabled><i class="fa fa-trash"></i></a> 
                         <?php  // } else {  
                          ?>
                           <a id="<?php //echo base_url('index.php/main/deleteBookingCancel/'.$data['che_id']) 
                                  ?>"  class="cancel btn btn-warning btn-icon btn-sm"><i class="fa fa-trash"></i></a> 
                         <?php  // }
                          ?> -->

                      <!-- <a href="<?php //echo base_url('index.php/main//'.$data['id']) 
                                    ?>"  class="btn btn-danger btn-icon btn-sm   btn-neutral  "><i class="fa fa-times"></i></a> data-placement="top" title="Update" rel="tooltip" -->
                    </center>
                  </td>
                </tr>

              <?php } ?>

            </tbody>
          </table>
        </div>

        <!-- end content-->

      </div>

      <!--  end card  -->

    </div>

    <!-- end col-md-12 -->

  </div>

  <!-- end row -->

</div>

<script type="text/javascript">
  $(document).ready(function() {
    // Handler for .ready() called.
    window.setTimeout(function() {
      location.href = "https://booking.hoteldefides.com/index.php/main/listOfCheckedIn";
    }, 200000);
  });
</script>

<script src="<?php echo base_url() ?>assets/js/core/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/core/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/core/popper.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/core/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/moment.min.js"></script>

<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->

<script src="<?php echo base_url() ?>assets/js/plugins/bootstrap-switch.js"></script>

<!--  Plugin for Sweet Alert -->

<script src="<?php echo base_url() ?>assets/js/plugins/sweetalert2.min.js"></script>

<!-- Forms Validations Plugin -->

<script src="<?php echo base_url() ?>assets/js/plugins/jquery.validate.min.js"></script>

<!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->

<script src="<?php echo base_url() ?>assets/js/plugins/jquery.bootstrap-wizard.js"></script>

<!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->

<script src="<?php echo base_url() ?>assets/js/plugins/bootstrap-selectpicker.js"></script>

<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->

<script src="<?php echo base_url() ?>assets/js/plugins/bootstrap-datetimepicker.js"></script>

<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->

<script src="<?php echo base_url() ?>assets/js/plugins/jquery.dataTables.min.js"></script>

<!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->

<script src="<?php echo base_url() ?>assets/js/plugins/bootstrap-tagsinput.js"></script>

<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->

<script src="<?php echo base_url() ?>assets/js/plugins/jasny-bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/plugins/fullcalendar.min.js"></script>

<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->

<script src="<?php echo base_url() ?>assets/js/plugins/jquery-jvectormap.js"></script>

<!--  Plugin for the Bootstrap Table -->

<script src="<?php echo base_url() ?>assets/js/plugins/nouislider.min.js"></script>

<!--  Google Maps Plugin    -->

<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<!-- Chart JS -->

<script src="<?php echo base_url() ?>assets/js/plugins/chartjs.min.js"></script>

<!--  Notifications Plugin    -->

<script src="<?php echo base_url() ?>assets/js/plugins/bootstrap-notify.js"></script>

<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->

<script src="<?php echo base_url() ?>assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>

<!-- Paper Dashboard DEMO methods, don't include it in your project! -->

<script src="<?php echo base_url() ?>assets/demo/demo.js"></script>

<script>
  $(document).ready(function() {

    $('#datatables').DataTable({

      "pagingType": "full_numbers",
      "order": [
        [6, "desc"]
      ],

      "lengthMenu": [

        [25, 10, 50, 75, 100, -1],

        [25, 10, 50, 75, 100, "All"]

      ],

      responsive: true,

      language: {

        search: "_INPUT_",

        searchPlaceholder: "Search records",

      }



    });



    var table = $('#datatable').DataTable();



    // Edit record

    table.on('click', '.edit', function() {

      $tr = $(this).closest('tr');



      var data = table.row($tr).data();

      alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');

    });



    // Delete a record

    table.on('click', '.remove', function(e) {

      $tr = $(this).closest('tr');

      table.row($tr).remove().draw();

      e.preventDefault();

    });



    //Like record

    table.on('click', '.like', function() {

      alert('You clicked on Like button');

    });

  });
</script>
<script type="text/javascript">
  $('.cancel').click(function() {
    swal({
      title: 'Are you sure to Delete?',
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
</script>