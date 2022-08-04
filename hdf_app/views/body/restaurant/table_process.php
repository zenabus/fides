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

<?php $sess = $this->session->userdata('username'); ?>



<div class="content pb-0">
  <h5><b>TABLES</b></h5>
  <div class="row">
    <div class="col-md-4">

      <div class="card ">

        <div class="card-header ">

          <div class="timeline-heading">

            <h6><b style="color:red"><?php echo $result_name[0]['table_number'] ?></b></h6>

            <span class="badge badge-pill badge-danger">Add an Order</span>


            <a id="modal" class="float-right btn btn-primary btn-icon btn-sm text-light" data-toggle="modal" data-target="#details" data-placement="left" title="View Prices" rel="tooltip"><i class="fa fa-list"></i></a>



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
                <label class="form-label">Quantity</label>
                <div class="form-group">
                  <input type="number" class="form-control" name="product_qty" id="" required>
                </div>
              </div>
            </div>


            <div class="card-footer ">

              <div class="row">

                <div class="col-md-12">

                  <input type="submit" class="btn btn-success" value="Add" onclick="return confirm('Add Order?')">

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

      $charge_id = $data['charge_id'];

      $charge_name = $data['charge_name'];
    }

    ?>

    <?php if (!empty($product_cart)) {

      $temp = $total_amount[0]['total'] / $divide;

      $dis = $temp * ".$percent";

      $forcart = $total_amount[0]['total'] - $dis;
    } else {

      $forcart = $total_amount[0]['total'];
    }



    ?>



    <div class="col-md-8">

      <div class="card ">

        <div class="card-header ">

          <div class="timeline-heading">

            <span class="badge badge-pill badge-danger">Order Details</span>



            <?php if (!empty($product_cart)) : ?>

              <a id="" data-toggle="modal" data-chargeid="<?php echo $charge_id ?>" data-chargename="<?php echo $charge_name ?>" data-amount="<?php echo $forcart ?>" data-id="<?php echo $id_num ?>" class="chargeto float-right btn btn-success btn-icon btn-sm text-light" data-target="#charge" data-placement="top" title="Charge to Room" rel="tooltip"><i class="fa fa-plus"></i></a>

            <?php endif ?>

            <?php if (!empty($product_cart)) : ?>





              <a id="" data-toggle="modal" data-user="<?php echo $sess ?>" data-person="<?php echo $divide ?>" data-deduction="<?php echo $type ?>" data-id="<?php echo $id_num ?>" data-client="<?php echo $client ?>" class="senior float-right btn btn-info btn-icon btn-sm text-light" data-target="#ModalRoom2" data-placement="left" title="Add a Discount" rel="tooltip"><i class="fa fa-plus"></i></a>

            <?php endif ?>



          </div>



        </div>

        <div class="card-body ">

          <div class="row">

            <label class="col-sm-3 col-form-label"><strong></strong></label>

            <label class="col-sm-2 col-form-label"><strong>QTY</strong></label>

            <label class="col-sm-3 col-form-label"><strong>UNIT COST</strong></label>

            <label class="col-sm-3 col-form-label"><strong>TOTAL COST</strong></label>

            <label class="col-sm-1 col-form-label"><strong></strong></label>

          </div>

          <?php foreach ($product_cart as $data) {

            # code...

            $product_cost =  $data['product_cost'];

            $product_qty =  $data['product_qty'];

            $total = $product_cost * $product_qty;

          ?>







            <div class="row">

              <label class="col-sm-3 col-form-label"><b><?php echo $data['product_name'] ?></b></label>

              <label class="col-sm-2 col-form-label"><strong><?php echo $product_qty ?></strong></label>

              <label class="col-sm-3 col-form-label"><strong>P <?php echo number_format($product_cost, 2) ?></strong></label>

              <label class="col-sm-2 col-form-label"><strong>P <?php echo number_format($total, 2) ?></strong></label>

              <label class="col-sm-1 col-form-label">
                <span>
                  <a href="" data-toggle="modal" data-id="<?php echo $data['id_cart'] ?>" data-prodid="<?php echo $data['product_id'] ?>" data-name="<?php echo $data['product_name'] ?>" data-qty="<?php echo $data['product_qty'] ?>" class="edit" data-target="#ModalRoom" data-placement="top" title="Update Order" rel="tooltip">
                    <i class="fa fa-edit"></i></a>
                </span></label>

              <label class="col-sm-1 col-form-label"><span><a id="<?php echo base_url('index.php/main/deleteRestauranCartPerTable/' . $data['id_cart'] . 'H' . $id) ?>" class="delete" data-placement="top" title="Cancel Order" rel="tooltip"><i class="fa fa-times"></i></a></span></label>

            </div>



          <?php } ?>





          <?php if (!empty($product_cart)) {

            $temp = $total_amount[0]['total'] / $divide;

            $dis = $temp * ".$percent";



            $total_balance_input = $total_amount[0]['total'] - $dis;

          ?>



            <hr>

            <div class="row">

              <label class="col-sm-3 col-form-label"><strong>Discount(s)</strong><br><?php echo $type  ?></label>

              <label class="col-sm-2 col-form-label"><strong></strong></label>

              <label class="col-sm-3 col-form-label"><strong><?php echo $percent ?> %</strong></label>

              <label class="col-sm-3 col-form-label"><strong>P -<?php echo number_format($dis, 2) ?></strong></label>

              <label class="col-sm-1 col-form-label"><strong></strong></label>

            </div>

            <hr>

            <div class="row">

              <label class="col-sm-3 col-form-label"><a href="" data-tamount="<?php echo $total_balance_input ?>" data-toggle="modal" data-target="#Complete" class="complete btn btn-primary">Complete Order</a></label>




              <label class="col-sm-2 col-form-label"><strong></strong></label>

              <label class="col-sm-3 col-form-label"><strong>TOTAL</strong></label>

              <label class="col-sm-3 col-form-label"><b style="color:red">P <?php echo number_format($total_amount[0]['total'] - $dis, 2) ?></b></label>

              <label class="col-sm-1 col-form-label"></label>

            </div>

          <?php } else { ?>

            <hr>

            <div class="row">

              <label class="col-sm-2 col-form-label"></label>

              <label class="col-sm-3 col-form-label"></label>

              <label class="col-sm-3 col-form-label">Total:</label>

              <label class="col-sm-4 col-form-label">P <b style="color:red"><?php echo $total_amount[0]['total'] ?></b></label>

              <label class="col-sm-2 col-form-label"></label>

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

        <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">

          <thead>

            <tr>

              <th class="disabled-sorting">Ref. #</th>

              <th>Product</th>

              <th>Status</th>



              <th class="disabled-sorting text-center">Action</th>

            </tr>

          </thead>

          <tbody>

            <?php foreach ($product_cart_deleted as $data) { ?>

              <tr>

                <td>HFRES<?php echo $data['id_cart'] ?></td>

                <td><?php echo $data['product_name'] ?></td>

                <td><span class="badge badge-info"><?php echo $data['deliver_status'] ?></span></td>

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

                <label>Quantity</label>

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



              <button type="button" class="btn btn-default btn-link" data-dismiss="modal">Cancel</button>

            </div>



          </div>

        </div>

        <?= form_close() ?>

      </div>

    </div>



    <!-- details -->

    <!-- chaarge to room -->





    <div class="modal fade" id="charge" tabindex="-1" role="dialog" aria-labelledby="roomLabel" aria-hidden="true">

      <div class="modal-dialog" role="document">

        <div class="modal-content">

          <div class="modal-header justify-content-center">



            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

              <i class="nc-icon nc-simple-remove"></i>

            </button>

            <h4 class="title title-up" id="LabelRoom6">Charge To:</h4>

            <?php $attributes = array('id' => 'formRoom6'); ?>

            <?= form_open('', $attributes); ?>

          </div>



          <div class="modal-body">



            <input type="hidden" class="form-control" name="redirect" value="<?php echo $id ?>">

            <input type="hidden" class="form-control" name="id" id="id">

            <input type="hidden" class="form-control" name="amount" id="amount">

            <div class="form-group">

              <label>Room #</label>

              <select class="form-control" required name="charge_id" id="charge_id">

                <option value="" disabled="">Select</option>

                <?php foreach ($result_rooms_checked as $data) {

                  # code...

                ?>

                  <option value="<?php echo $data['id_rooms'] ?>"><?php echo $data['room_number'] ?> <?php echo $data['last_name'] ?>, <?php echo $data['first_name']  ?></option>

                <?php } ?>

              </select>



            </div>



            <div class="form-group">

              <label>Name</label>

              <input type="text" class="form-control" name="charge_name" id="charge_name">



            </div>





          </div>

          <div class="modal-footer">

            <div class="left-side">

              <input type="submit" value="Save" class="btn btn-danger btn-link">

            </div>

            <div class="divider"></div>

            <div class="right-side">



              <button type="button" class="btn btn-default btn-link" data-dismiss="modal">Cancel</button>

            </div>



          </div>



          <?= form_close() ?>

        </div>

      </div>









      <!-- end Details -->

      <!-- complete details -->



      <div class="modal fade" id="Complete" tabindex="-1" role="dialog" aria-labelledby="roomLabel" aria-hidden="true">

        <div class="modal-dialog" role="document">

          <div class="modal-content">

            <div class="modal-header justify-content-center">



              <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <i class="nc-icon nc-simple-remove"></i>

              </button>

              <h4 class="title title-up" id="LabelRoomComplete">Payment</h4>

            </div>

            <?php $attributes = array('id' => 'formRoomComplete'); ?>

            <?= form_open('', $attributes); ?>

            <div class="modal-body">

              <div class="form-group">

                <label>Payment Type</label>

                <select class="form-control" required onchange="toViewInputifCash(this);" name="type">

                  <option value="">Select</option>

                  <option value="cash">Cash</option>

                  <option value="card">Card</option>

                  <option value="charge">Charge to</option>

                </select>

              </div>

              <input type="hidden" id="tamount" name="tamount">

              <input type="hidden" class="form-control" name="redirect" value="<?php echo $id ?>">

              <div class="form-group" id="cardnumber" style="display: none;">

                <label>Card Number</label>

                <input type="number" class="form-control" name="card">

              </div>
              <div class="form-group" id="appcode" style="display: none;">

                <label>Approval Code</label>

                <input type="text" class="form-control" name="appcode">

              </div>



              <div class="form-group">

                <label>Enter Amount</label>

                <input type="number" class="form-control" name="amount">

              </div>









            </div>

            <div class="modal-footer">

              <div class="left-side">



                <input type="submit" value="Proceed" class="btn btn-danger btn-link">

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











      <!-- complete details -->

      <!-- completed order details -->



      <div class="modal fade" id="completed" tabindex="-1" role="dialog" aria-labelledby="roomLabel" aria-hidden="true">

        <div class="modal-dialog" role="document">

          <div class="modal-content" style="width:650px">

            <?php foreach ($product_cart_receipt as $data) {

              $type = $data['deduction_type'];

              $id_num = $data['id_number'];

              $client = $data['name_of_client'];

              $percent = $data['deduction_percent'];

              $divide = $data['divide_person'];

              $charge_id = $data['charge_id'];

              $charge_name = $data['charge_name'];
            } ?>



            <div class="modal-header justify-content-center">



              <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <i class="nc-icon nc-simple-remove"></i>

              </button>

              <h4 class="title title-up" id="LabelRoom">Payment Reciept</h4>

            </div>

            <div class="modal-body">

              <div class="row">OR# RHDF<?php echo $id_reports ?></div>

              <hr>

              <div class="row">

                <label class="col-sm-3 col-form-label"><b></b></label>

                <label class="col-sm-2 col-form-label">QTY</label>

                <label class="col-sm-3 col-form-label">Unit Cost:</label>

                <label class="col-sm-3 col-form-label">Total Cost:</label>

                <label class="col-sm-1 col-form-label"></label>

              </div>

              <?php foreach ($product_cart_receipt as $data) {

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

                </div>



              <?php } ?>

              <?php if (!empty($product_cart_receipt)) {

                $temp = $total_amount_receipt[0]['total'] / $divide;

                $dis = $temp * ".$percent";



                $total_balance_input = $total_amount_receipt[0]['total'] - $dis;

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

                  <label class="col-sm-3 col-form-label"></label>

                  <label class="col-sm-2 col-form-label"></label>

                  <label class="col-sm-3 col-form-label">Total:</label>

                  <label class="col-sm-3 col-form-label">P <b style="color:red"><?php echo $total_amount_receipt[0]['total'] - $dis ?></b></label>

                  <label class="col-sm-1 col-form-label"></label>



                </div>



                <div class="row">

                  <label class="col-sm-3 col-form-label"></label>

                  <label class="col-sm-2 col-form-label"></label>

                  <label class="col-sm-3 col-form-label">Change:</label>

                  <label class="col-sm-3 col-form-label">P <b style="color:green"><?php echo $amount_give - ($total_amount_receipt[0]['total'] - $dis) ?></b></label>

                  <label class="col-sm-1 col-form-label"></label>

                </div>

              <?php } else { ?>

                <hr>

                <div class="row">

                  <label class="col-sm-3 col-form-label"></label>

                  <label class="col-sm-2 col-form-label"></label>

                  <label class="col-sm-3 col-form-label">Total:</label>

                  <label class="col-sm-3 col-form-label">P <b style="color:red"><?php echo $total_amount_receipt[0]['total'] ?></b></label>

                  <label class="col-sm-1 col-form-label"></label>

                </div>





              <?php } ?>







            </div>

            <div class="modal-footer">

              <div class="left-side">



                <button class="btn btn-primary btn-link" onclick="popupCenter('<?php echo base_url('index.php/main/printRecieptRestaurantPerTable/' . $id_reports . 'M' . $id) ?>',  'myPop1', 600,600); return false;">Print</button>

              </div>

              <div class="divider"></div>

              <div class="right-side">



                <button type="button" class="btn btn-default btn-link" data-dismiss="modal">CLOSE</button>

              </div>



            </div>

          </div>

        </div>











        <!-- completed order -->





        <!-- charge to room -->





        <!-- details -->



        <div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="roomLabel" aria-hidden="true">

          <div class="modal-dialog" role="document">

            <div class="modal-content" style="width:650px">

              <div class="modal-header justify-content-center">



                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                  <i class="nc-icon nc-simple-remove"></i>

                </button>

                <h4 class="title title-up" id="LabelRoom">Product Rates</h4>

              </div>

              <div class="modal-body">

                <table id="datatable2" class="table table-striped table-bordered" cellspacing="0" width="100%">

                  <thead>

                    <tr>

                      <th class="disabled-sorting">Product</th>

                      <th>Rate</th>



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



                  <button type="button" class="btn btn-default btn-link" data-dismiss="modal">Cancel</button>

                </div>



              </div>

            </div>

          </div>

        </div>

      </div>





      <!-- completed order -->



      <!-- completed order details -->



      <div class="modal fade" id="completed" tabindex="-1" role="dialog" aria-labelledby="roomLabel" aria-hidden="true">

        <div class="modal-dialog" role="document">

          <div class="modal-content" style="width:650px">

            <?php foreach ($product_cart_receipt as $data) {

              $type = $data['deduction_type'];

              $id_num = $data['id_number'];

              $client = $data['name_of_client'];

              $percent = $data['deduction_percent'];
            } ?>



            <div class="modal-header justify-content-center">



              <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <i class="nc-icon nc-simple-remove"></i>

              </button>

              <h4 class="title title-up" id="LabelRoom">Payment Reciept</h4>

            </div>

            <div class="modal-body">

              <div class="row">OR# RHDF<?php echo $id_reports ?></div>

              <hr>

              <div class="row">

                <label class="col-sm-3 col-form-label"><b></b></label>

                <label class="col-sm-2 col-form-label">QTY</label>

                <label class="col-sm-3 col-form-label">Unit Cost:</label>

                <label class="col-sm-3 col-form-label">Total Cost:</label>

                <label class="col-sm-1 col-form-label"></label>

              </div>

              <?php foreach ($product_cart_receipt as $data) {

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

                </div>



              <?php } ?>

              <?php if (!empty($product_cart_receipt)) {

                $dis = $total_amount_receipt[0]['total'] * ".$percent";

              ?>



                <hr>

                <div class="row">

                  <label class="col-sm-3 col-form-label"><small>Discount</small><br><?php echo $type  ?></label>

                  <label class="col-sm-2 col-form-label"></label>

                  <label class="col-sm-3 col-form-label"><?php echo $percent ?>%</label>

                  <label class="col-sm-3 col-form-label">P <b style="color:red">-<?php echo $total_amount_receipt[0]['total'] * ".$percent" ?></b></label>

                  <label class="col-sm-1 col-form-label"></label>

                </div>

                <hr>

                <div class="row">

                  <label class="col-sm-3 col-form-label"></label>

                  <label class="col-sm-2 col-form-label"></label>

                  <label class="col-sm-3 col-form-label">Total:</label>

                  <label class="col-sm-3 col-form-label">P <b style="color:red"><?php echo $total_amount_receipt[0]['total'] - $dis ?></b></label>

                  <label class="col-sm-1 col-form-label"></label>



                </div>



                <div class="row">

                  <label class="col-sm-3 col-form-label"></label>

                  <label class="col-sm-2 col-form-label"></label>

                  <label class="col-sm-3 col-form-label">Change:</label>

                  <label class="col-sm-3 col-form-label">P <b style="color:green"><?php echo $amount_give - ($total_amount_receipt[0]['total'] - $dis) ?></b></label>

                  <label class="col-sm-1 col-form-label"></label>

                </div>

              <?php } else { ?>

                <hr>

                <div class="row">

                  <label class="col-sm-3 col-form-label"></label>

                  <label class="col-sm-2 col-form-label"></label>

                  <label class="col-sm-3 col-form-label">Total:</label>

                  <label class="col-sm-3 col-form-label">P <b style="color:red"><?php echo $total_amount_receipt[0]['total'] ?></b></label>

                  <label class="col-sm-1 col-form-label"></label>

                </div>





              <?php } ?>









            </div>

            <div class="modal-footer">

              <div class="left-side">



                <button class="btn btn-primary btn-link" onclick="popupCenter('<?php echo base_url('index.php/main/printRecieptRestaurantPerTable/' . $id_reports . 'M' . $id) ?>',  'myPop1', 600,600); return false;">Print</button>

              </div>

              <div class="divider"></div>

              <div class="right-side">



                <button type="button" class="btn btn-default btn-link" data-dismiss="modal">CLOSE</button>

              </div>



            </div>

          </div>

        </div>

      </div>

    </div>









    <!-- completed order -->



    <!-- end completed order -->

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



              <button type="button" class="btn btn-default btn-link" data-dismiss="modal">Cancel</button>

            </div>



          </div>

        </div>

        <?= form_close() ?>

      </div>

    </div>

  </div>





  <script type="text/javascript">
    $('.chargeto').click(function() {

      $('#charge').on('show.bs.modal', function(e) {

        $('#formRoom6').attr('action', '<?= base_url('index.php/main/PerTableChargetoRoomRestaurant') ?>');

        $('#LabelRoom6').text('Charge to Room');

        $('#charge_id').val($(e.relatedTarget).data('chargeid'));

        $('#charge_name').val($(e.relatedTarget).data('chargename'));

        $('#id').val($(e.relatedTarget).data('id'));

        $('#amount').val($(e.relatedTarget).data('amount'));







      })

    });
  </script>



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



  <!-- complete -->

  <script type="text/javascript">
    $('.complete').click(function() {

      $('#Complete').on('show.bs.modal', function(e) {

        $('#formRoomComplete').attr('action', '<?= base_url('index.php/main/perTablerestaurantCompleteOrder') ?>');

        $('#LabelRoomComplete').text('Payment s');

        $('#tamount').val($(e.relatedTarget).data('tamount'));









      })

    });
  </script>



  <!-- end complete -->



  <script type="text/javascript">
    $('.delete').click(function() {

      swal({

        title: 'Cancel Order?',

        text: '',

        type: 'warning',

        showCancelButton: true,

        confirmButtonText: 'Yes',

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

        title: 'Clear Cart?',

        text: '',

        type: 'warning',

        showCancelButton: true,

        confirmButtonText: 'Yes',

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

        title: 'Delivered?',

        text: '',

        type: 'warning',

        showCancelButton: true,

        confirmButtonText: 'Yes',

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



    function toViewInputifCash(that) {

      if (that.value == "card") {



        document.getElementById("cardnumber").style.display = "block";
        document.getElementById("appcode").style.display = "block";

      } else {

        document.getElementById("cardnumber").style.display = "none";
        document.getElementById("appcode").style.display = "none";

      }

    }
  </script>





  <?php if ($view == '0') {

    $this->db->query('update all_reports set view_reciept="1" where id_reports=' . $id_reports . '');

  ?>



    <script>
      $(document).ready(function() {

        $("#completed").modal('show');

      });
    </script>





  <?php





  } ?>