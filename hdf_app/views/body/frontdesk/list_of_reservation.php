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
          <span class="badge badge-pill badge-danger">List of Reservation</span>
        </div>
        <div class="card-body">
          <div class="toolbar">
            <!--        Here you can write extra buttons/actions for the toolbar              -->
          </div>
          <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Name</th>
                <th>Contact No.</th>
                <th>Date Reserved</th>
                <th>Email Address</th>

                <th class="disabled-sorting text-right">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($result_reservation as $data) {
                # code...
              ?>
                <tr>
                  <td><?php echo $data['last_name'] ?>, <?php echo $data['first_name'] ?> <?php echo $data['middle_name'] ?></td>
                  <td><?php echo $data['contact'] ?></td>
                  <td><?php echo $data['reservation_date'] ?></td>
                  <td><?php echo $data['email'] ?></td>
                  <td>
                    <center>
                      <a id="<?php echo base_url('index.php/main/updateReservation/' . $data['id']) ?>" class="update btn btn-danger btn-icon btn-sm   btn-neutral  " data-placement="left" title="Edit" rel="tooltip"><i class="fa fa-edit"></i></a>
                      <a id="<?php echo base_url('index.php/main/deleteReservation/' . $data['id']) ?>" class="delete btn btn-danger btn-icon btn-sm   btn-neutral  " data-placement="left" title="Delete" rel="tooltip"><i class="fa fa-times"></i></a>



                      <!-- <a id="<?php //echo base_url('index.php/main/verifying/'.$data['id']) 
                                  ?>"  class="reserve btn btn-primary ">Reserve</a> -->
                      <a data-id="<?php echo $data['id'] ?>" data-ids="<?php echo $data['id'] ?>" data-fname="<?php echo $data['first_name'] ?>" data-lname="<?php echo $data['last_name'] ?>" data-type="<?php echo $data['room_id'] ?>" data-contact="<?php echo $data['contact'] ?>" data-date="<?php echo $data['check_id_date'] . '-' . $data['check_out_date'] ?>" data-in="<?php echo $data['check_id_date'] ?>" data-out="<?php echo $data['check_out_date'] ?>" data-address="<?php echo $data['address'] ?>" data-email="<?php echo $data['email'] ?>" data-advance="<?php echo $data['advance_payment'] ?>" data-contact="<?php echo $data['contact'] ?>" href="#" rel="tooltip" data-toggle="modal" data-target="#viewDetails" class="room_details btn btn-danger btn-icon btn-sm btn-neutral" data-toggle="tooltip" data-placement="left" title="Details"><i class="fa fa-hotel"></i></a>

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
  $('.reserve').click(function() {
    swal({
      title: 'Are you sure to Reserve?',
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


  $('.room_details').click(function() {
    $('#viewDetails').on('show.bs.modal', function(e) {
      $('#formRoomComplete').attr('action', '<?= base_url('index.php/main/insertReserveCheckInForm') ?>');
      $('#LabelRoomComplete').text('Information Details');
      $('#id').val($(e.relatedTarget).data('id'));
      $('#ids').val($(e.relatedTarget).data('ids'));
      $('#type').val($(e.relatedTarget).data('type'));
      $('#date').val($(e.relatedTarget).data('date'));
      $('#lname').val($(e.relatedTarget).data('lname'));
      $('#fname').val($(e.relatedTarget).data('fname'));
      $('#email').val($(e.relatedTarget).data('email'));
      $('#contact').val($(e.relatedTarget).data('contact'));
      $('#in').val($(e.relatedTarget).data('in'));
      $('#out').val($(e.relatedTarget).data('out'));
      $('#address').val($(e.relatedTarget).data('address'));
      $('#advance').val($(e.relatedTarget).data('advance'));


    })
  });
</script>
<!-- complete details -->

<div class="modal fade" id="viewDetails" tabindex="-1" role="dialog" aria-labelledby="roomLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header justify-content-center">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="nc-icon nc-simple-remove"></i>
        </button>
        <h4 class="title title-up" id="LabelRoomComplete">Reservation Details</h4>
      </div>
      <?php $attributes = array('id' => 'formRoomComplete'); ?>
      <?= form_open('', $attributes); ?>
      <div class="modal-body">

        <input type="hidden" name="id" id="id">
        <input type="hidden" name="address" id="address">
        <input type="hidden" name="advance_payment" id="advance">
        <input type="hidden" name="check_id_date" id="in">
        <input type="hidden" name="check_out_date" id="out">

        <div clas="form-control">
          <label>Last Name</label>
          <input type="text" class="form-control" name="last_name" id="lname" readonly>

        </div>

        <div clas="form-control">
          <label>First Name</label>
          <input type="text" class="form-control" name="first_name" id="fname" readonly>

        </div>

        <div clas="form-control">
          <label>Email</label>
          <input type="text" class="form-control" name="email" id="email" readonly>

        </div>

        <div clas="form-control">
          <label>Contact</label>
          <input type="text" class="form-control" name="contact" id="contact" readonly>
        </div>

      </div>
      <div class="modal-footer">
        <div class="left-side">
          <input type="submit" value="Check In" class="btn btn-danger btn-link">
        </div>
        <div class="divider"></div>
        <div class="right-side">

          <button type="button" class="btn btn-default btn-link" data-dismiss="modal">Cancel</button>
        </div>

      </div>
    </div>
    <?= form_close() ?>
  </div>
</div>