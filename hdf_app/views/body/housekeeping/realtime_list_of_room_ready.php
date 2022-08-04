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
      <div class="card">
        <div class="card-header">
          <span class="badge badge-pill badge-danger">List of Rooms (Status: Ready) </span><a class="float-right btn btn-primary " href="<?php echo base_url() ?>index.php/main/HousekeepingReady" rel="tooltip" data-toggle="tooltip" data-placement="left" title="View Actions" class="btn-icon btn-sm "><i class="nc-icon nc-simple-add"></i></a>
        </div>
        <div class="card-body">
          <div class="toolbar">
            <!--        Here you can write extra buttons/actions for the toolbar              -->
          </div>
          <table id="datatables" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Room No.</th>
                <th>Room Type</th>

                <th>Status</th>


              </tr>
            </thead>
            <tbody class="readys">


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
    done();
  });

  function done() {
    setTimeout(function() {
      updates();
      done();
    }, 200);
  }

  function updates() {
    $.getJSON("https://booking.hoteldefides.com/assets/fetch/housekeeping_fetch_ready.php", function(data) {
      $('.readys').empty();
      $.each(data.result, function() {
        $('.readys').append('<tr><td> ' + this["room_number"] + '</td> <td> ' + this["room_type"] + '</td><td> ' + this["status_by_room"] + ' </td>  </tr>');
      });
    });
  }
</script>