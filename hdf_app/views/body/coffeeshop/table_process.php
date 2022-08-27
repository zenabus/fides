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
    <div class="col-md-12">

    </div>
    <div class="col-md-6">
      <div class="card ">
        <div class="card-header ">
          <div class="timeline-heading">
            <span class="badge badge-pill badge-danger">Processing</span> <i><b><?php echo $result_name[0]['table_number'] ?></b></i>
            <a id="modal" class="float-right btn btn-danger btn-link" data-toggle="modal" data-target="#details" data-placement="left" title="View Prices" rel="tooltip"><i class="fa fa-edit"></i></a>

          </div>

        </div>
        <div class="card-body ">
          <form action="<?php echo base_url() ?>index.php/main/addCartRestaurantPerTable" method="post" class="form-horizontal">


            <input type="hidden" value="<?php echo $id ?>" name="table_number">
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
                  <input type="submit" class="btn btn-success" value="Add To Cart" onclick="return confirm('Add to Cart?')">
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
    <?php foreach ($product_cart as $data) {
      $type = $data['deduction_type'];
      $id_num = $data['id_number'];
      $client = $data['name_of_client'];
      $percent = $data['deduction_percent'];
      $divide = $data['divide_person'];
    }
    ?>

    <div class="col-md-6">
      <div class="card ">
        <div class="card-header ">
          <div class="timeline-heading">
            <span class="badge badge-pill badge-danger">Product Cart</span><a id="<?php echo base_url('index.php/main/clearCartPerTable/' . $id) ?>" class="clear float-right btn btn-danger btn-link"><i class="fa fa-times"></i></a>
            <?php if (!empty($product_cart)) : ?>


              <a id="" data-toggle="modal" data-user="<?php echo $sess ?>" data-person="<?php echo $divide ?>" data-deduction="<?php echo $type ?>" data-id="<?php echo $id_num ?>" data-client="<?php echo $client ?>" class="senior float-right btn btn-danger btn-link" data-target="#ModalRoom2" data-placement="left" title="Discounted Form" rel="tooltip"><i class="fa fa-plus"></i></a>
            <?php endif ?>

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
              <label class="col-sm-3 col-form-label"><b><?php echo $data['product_name'] ?></b></label>
              <label class="col-sm-2 col-form-label"><?php echo $product_qty ?></label>
              <label class="col-sm-3 col-form-label">P <?php echo $product_cost ?></label>
              <label class="col-sm-2 col-form-label">P <?php echo $total ?></label>
              <label class="col-sm-1 col-form-label"><span><a href="" data-toggle="modal" data-id="<?php echo $data['id_cart'] ?>" data-prodid="<?php echo $data['product_id'] ?>" data-name="<?php echo $data['product_name'] ?>" data-qty="<?php echo $data['product_qty'] ?>" class="edit" data-target="#ModalRoom" data-placement="left" title="Update Order" rel="tooltip"><i class="fa fa-edit"></i></a></span></label>
              <label class="col-sm-1 col-form-label"><span><a id="<?php echo base_url('index.php/main/deleteRestauranCartPerTable/' . $data['id_cart'] . 'H' . $id) ?>" class="delete" data-placement="left" title="Cancel Order" rel="tooltip"><i class="fa fa-times"></i></a></span></label>
            </div>

          <?php } ?>


          <?php if (!empty($product_cart)) {
            $temp = $total_amount[0]['total'] / $divide;
            $dis = $temp * ".$percent";
          ?>

            <hr>
            <div class="row">
              <label class="col-sm-3 col-form-label"><small>Discount</small><br><?php echo $type  ?></label>
              <label class="col-sm-2 col-form-label"></label>
              <label class="col-sm-3 col-form-label"><?php echo $percent ?>%</label>
              <label class="col-sm-3 col-form-label">P <b style="color:red">-<?php echo $dis ?></b></label>
              <label class="col-sm-1 col-form-label"></label>
            </div>
            <hr>
            <div class="row">
              <label class="col-sm-3 col-form-label"><button onclick="popupCenter('<?php echo base_url('index.php/main/printRecieptRestaurantPerTable/' . $id) ?>',  'myPop1', 600,600); return false;" class="btn btn-primary">Print Reciept</button></label>
              <label class="col-sm-2 col-form-label"></label>
              <label class="col-sm-3 col-form-label">Total:</label>
              <label class="col-sm-3 col-form-label">P <b style="color:red"><?php echo $total_amount[0]['total'] - $dis ?></b></label>
              <label class="col-sm-1 col-form-label"></label>
            </div>
          <?php } else { ?>
            <hr>
            <div class="row">
              <label class="col-sm-3 col-form-label"><button onclick="popupCenter('<?php echo base_url('index.php/main/printRecieptRestaurantPerTable/' . $id) ?>',  'myPop1', 600,600); return false;" class="btn btn-primary">Print Reciept</button></label>
              <label class="col-sm-2 col-form-label"></label>
              <label class="col-sm-3 col-form-label">Total:</label>
              <label class="col-sm-3 col-form-label">P <b style="color:red"><?php echo $total_amount[0]['total'] ?></b></label>
              <label class="col-sm-1 col-form-label"></label>
            </div>


          <?php } ?>





        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="card ">
      <div class="card-header ">
        <div class="timeline-heading">
          <span class="badge badge-pill badge-danger">Order Status</span>
        </div>

      </div>
      <div class="card-body ">
        <table id="datatable" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th class="disabled-sorting">Ref No.</th>
              <th>PName</th>
              <th>Status</th>

              <th class="disabled-sorting">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($product_cart_deleted as $data) { ?>
              <tr>
                <td>HFRES<?php echo $data['id_cart'] ?></td>
                <td><?php echo $data['product_name'] ?></td>
                <td><?php echo $data['deliver_status'] ?></td>
                <td>
                  <center><button id="<?php echo base_url('index.php/main/restaunratChangeToDeliveredPertable/' . $data['id_cart'] . 'H' . $id) ?>" class="deliver btn btn-primary ">Delivered</button></center>
                </td>
              </tr>

            <?php } ?>
          </tbody>
        </table>
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
              <input type="hidden" class="form-control" name="redirect" value="<?php echo $id ?>">
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




<!-- details -->

<div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="roomLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width:650px">
      <div class="modal-header justify-content-center">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="nc-icon nc-simple-remove"></i>
        </button>
        <h4 class="title title-up" id="LabelRoom">Product Prices</h4>
      </div>
      <div class="modal-body">
        <table id="datatable2" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th class="disabled-sorting">Product Name</th>
              <th>Product Price</th>

            </tr>
          </thead>
          <tbody>
            <?php foreach ($result_product_name as $data) {
              # code...
            ?>
              <tr>
                <td><?php echo $data['product_name'] ?></td>
                <td><?php echo $data['product_cost'] ?></td>

              </tr>

            <?php } ?>
          </tbody>
        </table>


      </div>
      <div class="modal-footer">

        <div class="divider"></div>
        <div class="right-side">

          <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
        </div>

      </div>
    </div>
  </div>
</div>
</div>



<!-- end Details -->
<div class="modal fade" id="ModalRoom2" tabindex="-1" role="dialog" aria-labelledby="roomLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header justify-content-center">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="nc-icon nc-simple-remove"></i>
        </button>
        <h4 class="title title-up" id="LabelRoom2"> Form</h4>
      </div>
      <?php $attributes = array('id' => 'formRoom2'); ?>
      <?= form_open('', $attributes); ?>
      <div class="modal-body">
        <div class="form-group">


          <input type="hidden" class="form-control" name="redirect" value="<?php echo $id ?>">
          <input type="hidden" id="user" name="user">
          <div class="form-group">
            <label>Deduction Type </label>
            <input type="text" class="form-control" id="deduction" disabled>


          </div>

          <div class="form-group">
            <label>ID No</label>
            <input type="text" class="form-control" name="id_no" id="id_no">



          </div>

          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name_client" id="name_client">

          </div>

          <div class="form-group">
            <label>Person Divide</label>
            <input type="text" class="form-control" name="person" id="person">

          </div>
          <div class="form-group">

            <input type="hidden" class="form-control" id="deduction">
            <label>Type</label>
            <select class="form-control" name="deduction" id="deduction">
              <option value="">Select</option>
              <?php foreach ($result_deduction as $data) {
                # code...
              ?>
                <option value="<?php echo $data['id_ded'] ?>"><?php echo $data['name'] ?></option>
              <?php } ?>
            </select>

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
      $('#formRoom').attr('action', '<?= base_url('index.php/main/updateRestaurantCartPerTable') ?>');
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
      $('#formRoom2').attr('action', '<?= base_url('index.php/main/PerTableadddeductionRestaurant') ?>');
      $('#LabelRoom2').text('Discount Form');
      $('#user').val($(e.relatedTarget).data('user'));
      $('#id_no').val($(e.relatedTarget).data('id'));
      $('#name_client').val($(e.relatedTarget).data('client'));
      $('#deduction').val($(e.relatedTarget).data('deduction'));
      $('#person').val($(e.relatedTarget).data('person'));




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