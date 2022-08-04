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

<?php if ($this->session->flashdata('error')) : ?>
  <script>
    $(document).ready(function() {
      demo.showNotification_error('top', 'right');
    });
  </script>

<?php endif; ?>

<div class="content pb-0">
  <div class="row">

    <div class="col-md-12">
      <div class="card ">
        <div class="card-header ">
          <div class="timeline-heading">
            <span class="badge badge-pill badge-danger">Update Reservation</span>
          </div>

        </div>


        <div class="card-body ">

          <div class="row">
            <label class="col-sm-2 col-form-label">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspRoom Types</label>
            <div class="col-sm-10">
              <div class="form-group">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Room Types(Reserved)</th>
                      <th>Number of Room(Reserved)</th>
                      <th>Action</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($result_room_type as $data) {
                      # code...
                    ?>
                      <tr>
                        <td><?php echo $data['room_type_id'] ?></td>
                        <td><?php echo $data['room_number_res'] ?></td>
                        <td>
                          <form action="<?php //echo base_url('index.php/main/deleteReservationRoomType') 
                                        ?>" method="post">
                            <a data-redi="<?php echo $result_res_id[0]['id'] ?>" data-id="<?= $data['id'] ?>" data-room-type="<?= $data['room_type_id'] ?>" data-room-number="<?= $data['room_number_res'] ?>" href="#" rel="tooltip" data-toggle="modal" data-target="#ModalRoom" class="editRoom btn-icon btn-sm " data-toggle="tooltip" data-placement="left" title="Edit">
                              <i class="fa fa-edit"></i>&nbsp</a>



                            <input type="hidden" value="<?php echo $data['id'] ?>" name="id">
                            <input type="hidden" value="<?php echo $result_res_id[0]['id'] ?>" name="id_red">
                            <button type="submit" class="btn btn-danger btn-icon btn-sm btn-neutral" data-placement="left" title="Delete" rel="tooltip"><i class="fa fa-times"></i></button>
                          </form>

                        </td>
                      </tr>
                    <?php } ?>


                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <form action="<?php echo base_url() ?>index.php/main/updatingReservation" method="post" class="form-horizontal">
            <input type="hidden" name="id" value="<?php echo $result_res_id[0]['id'] ?>">
            <div class="row">
              <label class="col-sm-2 col-form-label">Reserve Date</label>
              <div class="col-sm-10">
                <div class="form-group">

                  <?php
                  $from = $result_res_id[0]['check_id_date'];
                  $to = $result_res_id[0]['check_out_date'];

                  // $date_1 = new DateTime($froms);
                  //  $from = $date_1->format('m/d/y');

                  // $date_2 = new DateTime($tos);
                  //  $to = $date_2->format('m/d/y');







                  ?>
                  <input type="text" class="form-control" name="daterange" value="<?php echo $from ?> - <?php echo $to ?>">
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">Last Name</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="last_name" value="<?php echo $result_res_id[0]['last_name'] ?>">
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">First Name</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="first_name" value="<?php echo $result_res_id[0]['first_name'] ?>">
                </div>
              </div>
            </div>


            <div class="row">
              <label class="col-sm-2 col-form-label">Middle Name</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="middle_name" value="<?php echo $result_res_id[0]['middle_name'] ?>">
                </div>
              </div>
            </div>







            <div class="row">
              <label class="col-sm-2 col-form-label">Contact No.</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" required="true" name="contact" value="<?php echo $result_res_id[0]['contact'] ?>">
                </div>
              </div>
            </div>





            <div class="row">
              <label class="col-sm-2 col-form-label">Email Address</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="email" value="<?php echo $result_res_id[0]['email'] ?>">
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">Address</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="address" value="<?php echo $result_res_id[0]['address'] ?>">
                </div>
              </div>
            </div>


            <div class="row">
              <label class="col-sm-2 col-form-label">Advance Payment</label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input type="text" class="form-control" name="advance" value="<?php echo $result_res_id[0]['advance_payment'] ?>">
                </div>
              </div>
            </div>

            <div class="card-footer ">
              <div class="row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-md-10">
                  <input type="submit" class="btn btn-success" value="Update">
                  <input type="reset" class="btn btn-info " value="Clear">
                </div>
              </div>
            </div>




            <!-- <div class="card-footer ">
                              <div class="row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-md-10" >
                                  <input type="submit" class="btn btn-success" value="Update" >
                                  <input type="reset" class="btn btn-info " value="Clear" >
                                  </form>
                                  <div class="col-md-12"></div>

                                  <!// pass data to check form -->
            <!--  <form action="<?php //echo base_url() 
                                ?>index.php/main/resToCheck" method="post">
                                  <input type="hidden" name="room_number" value="<? php // echo $data['room_number'] 
                                                                                  ?>"> 
                                  <input type="hidden" name="id" value="<?php //echo $result_res_id[0]['id'] 
                                                                        ?>">  

                                  <input type="hidden" class="form-control" name="last_name" value="<?php //echo $result_res_id[0]['last_name'] 
                                                                                                    ?>">
                                  <input type="hidden" class="form-control" name="first_name" value="<?php //echo $result_res_id[0]['first_name'] 
                                                                                                      ?>" >
                                  <input type="hidden" class="form-control" name="middle_name" value="<?php //echo $result_res_id[0]['middle_name'] 
                                                                                                      ?>">
                                  <input type="hidden" name="extra_person" value="<?php //echo $result_res_id[0]['add_person'] 
                                                                                  ?>"> 
                                  <input type="hidden" name="extra_bed" value="<?php //echo $result_res_id[0]['add_bed'] 
                                                                                ?>"> 

                                  <input type="hidden" name="check_date" value="<?php //echo $result_res_id[0]['check_in_date'] 
                                                                                ?>">
                                  <input type="hidden" class="form-control" required="true" name="contact" value="<?php //echo $result_res_id[0]['contact'] 
                                                                                                                  ?>">
                                  <input type="hidden" class="form-control" name="email" value="<?php //echo $result_res_id[0]['email'] 
                                                                                                ?>">
                                  <input type="hidden" class="form-control"  name="address" value="<?php //echo $result_res_id[0]['address'] 
                                                                                                    ?>">
                                  <input type="hidden" class="form-control"  name="advance" value="<?php //echo $result_res_id[0]['advance_payment'] 
                                                                                                    ?>">

                                  <input type="submit" class="btn btn-primary" value="Check In" >
                                  <!<button type="submit" class="btn btn-info btn-round">Sign in</button> -->
            <!-- </form> -->


            <!-- </div> -->
            <!-- </div>  -->
        </div>



      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="ModalRooms" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header justify-content-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="nc-icon nc-simple-remove"></i>
        </button>
        <h4 class="title title-up">Modal title</h4>
      </div>
      <div class="modal-body">
        <form action="sad.php" method="post">
          <input type="submit">
        </form>




        <div class="modal-footer">
          <div class="left-side">

            <input type="submit">
          </div>
          <div class="divider"></div>
          <div class="right-side">

            <button type="button" class="btn btn-default btn-link" data-dismiss="modal">Cancel</button>
          </div>

        </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- modal -->

<div class="modal fade" id="ModalRoom" tabindex="-1" role="dialog" aria-labelledby="roomLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header justify-content-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="nc-icon nc-simple-remove"></i>
        </button>
        <h4 class="title title-up">Modal title</h4>
      </div>
      <?php $attributes = array('id' => 'formCategory'); ?>
      <?= form_open('main/updateReservationRoomType', $attributes); ?>
      <div class="modal-body">
        <div class="form-group">
          <input type="hidden" name="id" id="id">
          <input type="hidden" name="redi" id="redi">

          <div class="form-group">
            <label>Room Type</label>
            <input type="text" class="form-control" name="room_type" required id="room_type">
          </div>
          <div class="form-group">
            <label>Number of Rooms</label>

            <input type="text" class="form-control" name="room_number" required id="room_number">
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <div class="left-side">

          <input type="submit" class="btn btn-danger btn-link">
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
</div>





<script type="text/javascript">
  $('.editRoom').click(function() {
    $('#ModalRoom').on('show.bs.modal', function(e) {
      $('#formRoom').attr('action', '<?= base_url('index.php/main/updateReservationRoomType') ?>');
      $('#LabelRoom').text('Update Form');
      $('#id').val($(e.relatedTarget).data('id'));
      $('#redi').val($(e.relatedTarget).data('redi'));
      $('#room_type').val($(e.relatedTarget).data('room-type'));
      $('#room_number').val($(e.relatedTarget).data('room-number'));


    })
  });
</script>