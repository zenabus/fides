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
<?php $sess = $this->session->userdata('username'); ?>

<div class="content pb-0">
  <div class="row">

    <div class="col-md-6">
      <h5><b>REPORTS</b></h5>
      <div class="card ">
        <div class="card-header ">
          <div class="timeline-heading">
            <!--<span class="badge badge-pill badge-danger">Reports</span>-->

          </div>

        </div>
        <div class="card-body ">
          <form action="<?php echo base_url() ?>index.php/admin/viewReports" target="blank" method="post" class="form-horizontal">



            <div class="row">

              <div class="col-sm-12">
                <label class="form-label">Type</label>
                <div class="form-group">
                  <select class="form-control" required name="user_type">
                    <option value="">Select</option>
                    <option>Front Desk</option>
                    <option>Coffee Shop</option>
                    <option>Restaurant</option>

                  </select>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-sm-12">
                <label class="form-label">From</label>
                <div class="form-group">

                  <input type="date" class="form-control" name="from" id="" required>

                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <label class="form-label">To</label>
                <div class="form-group">

                  <input type="date" class="form-control" name="to" id="" required>

                </div>
              </div>
            </div>


            <div class="card-footer ">
              <div class="row">

                <div class="col-md-12">
                  <input type="submit" class="btn btn-success" value="Generate">
                  <input type="reset" class="btn btn-info " value="Clear">
                  <!-- <button type="submit" class="btn btn-info btn-round">Sign in</button> -->
                </div>
              </div>
            </div>



          </form>
        </div>

        <!--  -->


        <!--  -->
      </div>
    </div>

  </div>







  <script type="text/javascript">
    $('.edit').click(function() {
      $('#ModalRoom').on('show.bs.modal', function(e) {
        $('#formRoom').attr('action', '<?= base_url('index.php/main/updateRestaurantCart') ?>');
        $('#LabelRoom').text('Update Form');
        $('#id').val($(e.relatedTarget).data('id'));
        $('#prodid').val($(e.relatedTarget).data('prodid'));
        $('#name').val($(e.relatedTarget).data('name'));
        $('#qty').val($(e.relatedTarget).data('qty'));



      })
    });
  </script>

  <script type="text/javascript">
    $('.senior').click(function() {
      $('#ModalRoom2').on('show.bs.modal', function(e) {
        $('#formRoom2').attr('action', '<?= base_url('index.php/main/adddeductionRestaurant') ?>');
        $('#LabelRoom2').text('Discount Form');
        $('#user').val($(e.relatedTarget).data('user'));
        $('#id_no').val($(e.relatedTarget).data('id'));
        $('#name_client').val($(e.relatedTarget).data('client'));
        $('#deduction').val($(e.relatedTarget).data('deduction'));




      })
    });
  </script>

  <script type="text/javascript">
    $('.delete').click(function() {
      swal({
        title: 'Are you sure to Cancel Order?',
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



    $('.clear').click(function() {
      swal({
        title: 'Are you sure to Clear Cart?',
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

    $('.deliver').click(function() {
      swal({
        title: 'Change to Delivered?',
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

  <script>
    function popupCenter(url, title, w, h) {
      var left = (screen.width / 2) - (w / 2);
      var top = (screen.height / 2) - (h / 2);
      return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
    }
  </script>