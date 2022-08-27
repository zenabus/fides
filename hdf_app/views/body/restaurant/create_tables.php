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

    <div class="col-md-6">
      <div class="card ">
        <div class="card-header ">
          <div class="timeline-heading">
            <span class="badge badge-pill badge-danger">Processing</span>
          </div>

        </div>
        <div class="card-body ">
          <form action="<?php echo base_url() ?>index.php/main/addCartRestaurant" method="post" class="form-horizontal">



            <div class="row">
              <div class="col-sm-12">
                <label class="form-label">Product Name</label>
                <div class="form-group">
                  <select class="form-control" name="product_name" required>
                    <option value="">Select</option>
                    <?php foreach ($result_product_name as $data) {
                      # code...
                    ?>
                      <option value="<?php echo $data['id'] ?>"><?php echo $data['product_name'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <label class="form-label">Product QTY</label>
                <div class="form-group">

                  <input type="number" class="form-control" name="product_qty" id="" required>

                </div>
              </div>
            </div>


            <div class="card-footer ">
              <div class="row">

                <div class="col-md-12">
                  <input type="submit" class="submit btn btn-success" value="Add To Cart">
                  <input type="reset" class="btn btn-info " value="Clear">
                  <!-- <button type="submit" class="btn btn-info btn-round">Sign in</button> -->
                </div>
              </div>
            </div>



          </form>
        </div>
      </div>
    </div>


    <!--  -->


    <div class="col-md-6">
      <div class="card ">
        <div class="card-header ">
          <div class="timeline-heading">
            <span class="badge badge-pill badge-danger">Product Cart</span><a id="<?php echo base_url() ?>index.php/main/clearCart" class="clear float-right btn btn-danger btn-link"><i class="fa fa-times"></i></a>
          </div>

        </div>
        <div class="card-body ">
          <div class="row">
            <label class="col-sm-3 col-form-label"><b></b></label>
            <label class="col-sm-2 col-form-label">QTY</label>
            <label class="col-sm-3 col-form-label">Unit Cost:</label>
            <label class="col-sm-3 col-form-label">Total Cost:</label>
            <label class="col-sm-1 col-form-label"></label>
          </div>
          <?php foreach ($product_cart as $data) {
            # code...
            $product_cost =  $data['product_cost'];
            $product_qty =  $data['product_qty'];
            $total = $product_cost * $product_qty;
          ?>



            <div class="row">
              <label class="col-sm-3 col-form-label"><b><?php echo $product_cart[0]['product_name'] ?></b></label>
              <label class="col-sm-2 col-form-label"><?php echo $product_qty ?></label>
              <label class="col-sm-3 col-form-label">P <?php echo $product_cost ?></label>
              <label class="col-sm-2 col-form-label">P <?php echo $total ?></label>
              <label class="col-sm-1 col-form-label"><span><a href="" data-toggle="modal" data-id="<?php echo $data['id_cart'] ?>" data-prodid="<?php echo $data['product_id'] ?>" data-name="<?php echo $data['product_name'] ?>" data-qty="<?php echo $data['product_qty'] ?>" class="edit" data-target="#ModalRoom" data-placement="left" title="Update Order" rel="tooltip"><i class="fa fa-edit"></i></a></span></label>
              <label class="col-sm-1 col-form-label"><span><a id="<?php echo base_url('index.php/main/deleteRestauranCart/' . $data['id_cart']) ?>" class="delete" data-placement="left" title="Cancel Order" rel="tooltip"><i class="fa fa-times"></i></a></span></label>
            </div>

          <?php } ?>
          <hr>

          <div class="row">
            <label class="col-sm-3 col-form-label"><button onclick="popupCenter('<?php echo base_url() ?>',  'myPop1', 600,600); return false;" class="btn btn-primary">Print Reciept</button></label>
            <label class="col-sm-2 col-form-label"></label>
            <label class="col-sm-3 col-form-label">Total:</label>
            <label class="col-sm-3 col-form-label"></label>
            <label class="col-sm-1 col-form-label"></label>
          </div>





        </div>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="ModalRoom" tabindex="-1" role="dialog" aria-labelledby="roomLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header justify-content-center">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="nc-icon nc-simple-remove"></i>
        </button>
        <h4 class="title title-up" id="LabelRoom">Add Room</h4>
      </div>
      <?php $attributes = array('id' => 'formRoom'); ?>
      <?= form_open('', $attributes); ?>
      <div class="modal-body">
        <div class="form-group">


          <div class="form-group">


            <div class="form-group">
              <label>Product Name</label>
              <input type="hidden" class="form-control" name="id" id="id">
              <input type="hidden" class="form-control" name="prodid" id="prodid">
              <input type="text" class="form-control" name="name" id="name" required disabled>

            </div>

            <div class="form-group">
              <label>Qty</label>
              <input type="number" class="form-control" name="qty" id="qty" required>

            </div>



          </div>
        </div>
        <div class="modal-footer">
          <div class="left-side">

            <input type="submit" value="Save" class="btn btn-danger btn-link">
          </div>
          <div class="divider"></div>
          <div class="right-side">

            <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
          </div>

        </div>
      </div>
      <?= form_close() ?>
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


  $('.submit').click(function() {
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
</script>