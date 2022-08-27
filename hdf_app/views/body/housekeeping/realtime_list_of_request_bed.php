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
  <h5><b>REQUESTS</b></h5>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h6><b>BED REQUEST LIST</b></h6>
          <!-- <span class="badge badge-pill badge-danger">List of Request (Bed) </span>--> <a class="float-right btn btn-primary " href="<?php echo base_url() ?>index.php/main/HousekeepingBedRequest" rel="tooltip" data-toggle="tooltip" data-placement="left" title="View Actions" class="btn-icon btn-sm "><i class="nc-icon nc-simple-add"></i></a>
        </div>
        <div class="card-body">
          <div class="toolbar">
            <!--        Here you can write extra buttons/actions for the toolbar              -->
          </div>
          <table id="datatable" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th class="disabled-sorting">Room #</th>
                <th># of Bed/s Request</th>
                <th class="text-center">Status</th>

              </tr>
            </thead>
            <tbody class="bed_request">

              <tr>
                <td></td>
                <td></td>
                <td></td>
              </tr>

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
    $.getJSON("https://booking.hoteldefides.com/assets/fetch/housekeeping_fetch_bed_request.php", function(data) {
      $('.bed_request').empty();
      $.each(data.result, function() {
        $('.bed_request').append('<tr><td> ' + this["room_number"] + '</td> <td> ' + this["add_bed"] + ' PC/S</td><td class="text-center"><span class="badge badge-info"> ' + this["bed_status"] + ' </span></td>  </tr>');
      });
    });
  }
</script>