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
          <span class="badge badge-pill badge-danger">List of Rooms (Status: Ready) </span>
        </div>
        <div class="card-body">
          <div class="toolbar">
            <!--        Here you can write extra buttons/actions for the toolbar              -->
          </div>





          <div class="col-lg-10" style="float:left">
            <table id="datatables" class="table table-striped table-bordered" cellspacing="0">
              <thead>
                <tr>
                  <th>Room No.</th>
                  <th>Room Type</th>

                  <th>Status </th>



                </tr>
              </thead>


              <tbody class="tr">


              </tbody>


            </table>
          </div>
          <div class="col-lg-2 " style="float:left">
            <table class=" table table-striped table-bordered" cellspacing="0">
              <tr>
                <th class="disabled-sorting">Action</th>
              </tr>
              <tr>
                <td></td>
              </tr>

            </table>
          </div>



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
  $('.um').click(function() {
    swal({
      title: 'Change Status of Room to Under Mainetenance?',
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
</script>